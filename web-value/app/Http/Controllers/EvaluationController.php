<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTraining;
use Illuminate\Support\Facades\Auth;
use App\Models\FeedbackTraining;
use App\Models\Evaluation;
use App\Models\EvaluationItem;
use App\Models\EvaluationResponse;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Log;
use Mpdf\Mpdf;

class EvaluationController extends Controller
{
    // Menampilkan evaluasi berdasarkan tanggal
    public function index(Request $request)
    {
        // Jika ada input tanggal dari form pencarian, gunakan tanggal tersebut
        $searchDate = $request->input('search_date');
        $query = Evaluation::with(['trainee', 'training.post.scheduleTraining']);

        // Jika ada pencarian berdasarkan tanggal
        if ($searchDate) {
            $query->whereDate('created_at', Carbon::parse($searchDate));
        }

        // Ambil data evaluasi
        $evaluations = $query->paginate(10);

        return view('admin.evaluation.index', compact('evaluations', 'searchDate'));
    }

    // Menampilkan detail evaluasi dari trainee tertentu
    public function show($id)
    {
        $evaluation = Evaluation::with(['trainee', 'training.post', 'evaluationResponses.item'])->findOrFail($id);

        return view('admin.evaluation.show', compact('evaluation'));
    }

    public function downloadPdf($id)
    {
        $evaluation = Evaluation::with(['trainee', 'training.post', 'evaluationResponses.item'])->findOrFail($id);
    
        $mpdf = new \Mpdf\Mpdf();
        
        // Load HTML content
        $html = view('admin.evaluation.pdf', compact('evaluation'))->render();
        $mpdf->WriteHTML($html);
    
        // Format the filename
        $filename = 'Evaluation_' . str_replace(' ', '_', $evaluation->training->post->dataPrice->training_title) . '_' . str_replace(' ', '_', $evaluation->trainee->name) . '.pdf';
    
        // Output PDF as download
        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }    

    // Menampilkan form untuk menambahkan atau mengedit pertanyaan evaluasi
    public function create()
    {
        return view('admin.evaluation.create');
    }

    // Menyimpan pertanyaan evaluasi
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'section' => 'required|string|max:255',
            'question' => 'required|string|max:255',
        ]);

        // Simpan pertanyaan evaluasi
        EvaluationItem::create([
            'section' => $request->input('section'),
            'question' => $request->input('question'),
        ]);

        return redirect()->route('admin.evaluation.create')->with('success', 'Evaluation item created successfully.');
    }
    
    // Menampilkan form evaluasi hanya jika pelatihan telah selesai
    public function showEvaluationForm($trainingId)
    {
        // Cari training berdasarkan ID dan eager load dengan relasi evaluasi dan scheduleTraining
        $training = Training::with('post.scheduleTraining')->findOrFail($trainingId);

        // Dapatkan tanggal pelatihan
        $scheduleDate = Carbon::parse($training->post->scheduleTraining->schedule_date);
        
        // Tentukan tanggal akhir (3 hari setelah pelatihan)
        $endDate = $scheduleDate->copy()->addDays(3);
    
        // Pastikan trainee yang mencoba mengakses adalah trainee yang terdaftar di pelatihan ini
        if ($training->trainee_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not registered for this training.');
        }
    
        // Cek apakah scheduleTraining ada
        if (!$training->post || !$training->post->scheduleTraining) {
            return redirect()->back()->with('error', 'Training schedule not found.');
        }
    
        // Cek apakah tanggal pelatihan telah terlewati
        $scheduleDate = $training->post->scheduleTraining->schedule_date ?? null;
        if (!$scheduleDate || Carbon::now()->lt(Carbon::parse($scheduleDate))) {
            return redirect()->back()->with('error', 'You can only evaluate after the training date.');
        }
    
        // Cek apakah evaluasi sudah ada atau belum, jika belum, buatkan evaluasi baru
        $evaluation = Evaluation::firstOrCreate([
            'training_id' => $training->id,
            'trainee_id' => auth()->user()->id
        ]);

        // Cek apakah hari ini masih dalam rentang waktu 3 hari setelah tanggal pelatihan
        if (Carbon::now()->gt($endDate)) {
            return redirect()->back()->with('error', 'The evaluation form is no longer available.');
        }
    
        // Ambil semua pertanyaan evaluasi dari tabel evaluation_items
        $evaluationItems = EvaluationItem::all();
    
        // Tampilkan form evaluasi
        return view('trainee.evaluation.form', compact('training', 'evaluationItems', 'evaluation'));
    }    

    public function showTrainingsForTrainee()
    {
        // Ambil semua pelatihan yang diikuti oleh trainee yang sedang login
        $traineeId = Auth::guard('trainee')->user();
        $trainings = Training::where('trainee_id', $traineeId)->with('evaluation')->get();

        return view('trainee.training.list', compact('trainings'));
    }

    public function createEvaluationItemsForTraining($trainingId)
    {
        // Misalkan Anda ingin membuat beberapa items evaluasi untuk training tertentu
        $items = [
            ['training_id' => $trainingId, 'trainer_id' => 1, 'section' => 'Content', 'question' => 'How would you rate the content of the training?'],
            ['training_id' => $trainingId, 'trainer_id' => 1, 'section' => 'Delivery', 'question' => 'How would you rate the trainer\'s delivery?'],
            // Tambahkan lebih banyak item sesuai kebutuhan
        ];
    
        foreach ($items as $item) {
            EvaluationItem::create($item);
        }
    }    

    // Simpan atau update hasil evaluasi
    public function storeEvaluation(Request $request, $evaluationId)
{
    // Validasi data dari request
    $validatedData = $request->validate([
        'responses.*.score' => 'required|integer|min:1|max:5',
        'responses.*.comment' => 'nullable|string|max:255',
    ]);

    // Cek apakah evaluationId valid
    $evaluation = Evaluation::findOrFail($evaluationId);

    // Pastikan trainee yang mengisi adalah yang berhak
    if ($evaluation->trainee_id !== auth()->user()->id) {
        return redirect()->back()->with('error', 'Unauthorized access to this evaluation.');
    }

    // Simpan setiap jawaban dari trainee untuk setiap pertanyaan evaluasi
    foreach ($validatedData['responses'] as $itemId => $response) {
        // Pastikan item_id ada di tabel evaluation_items
        if (EvaluationItem::find($itemId)) {
            EvaluationResponse::updateOrCreate(
                ['evaluation_id' => $evaluationId, 'item_id' => $itemId],
                [
                    'response' => $response['score'],
                    'comments' => $response['comment'] ?? null
                ]
            );
        } else {
            Log::error('Invalid item_id for evaluation response: ' . $itemId);
        }
    }

    return redirect()->route('trainings.list')->with('success', 'Terimakasih atas penilaian anda.');
}


     // Menampilkan hasil evaluasi untuk diedit
     public function editEvaluation($evaluationId)
     {
         // Ambil evaluasi yang ingin diedit
         $evaluation = Evaluation::findOrFail($evaluationId);
         $evaluationItems = EvaluationItem::all();
         $evaluationResponses = EvaluationResponse::where('evaluation_id', $evaluationId)->get();
     
         // Asumsikan bahwa Anda memiliki relasi atau cara lain untuk mendapatkan training dari evaluasi
         $training = Training::findOrFail($evaluation->training_id); // Sesuaikan dengan logika Anda
     
         // Dapatkan jumlah edit dari session
         $editCount = Session::get("evaluation_edit_count_{$evaluationId}", 0);

         $scheduleDate = Carbon::parse($evaluation->training->post->scheduleTraining->schedule_date);

         // Tentukan batas akhir (3 hari setelah pelatihan)
         $endDate = $scheduleDate->copy()->addDays(3);
     
         // Cek apakah hari ini masih dalam batas waktu
         if (Carbon::now()->gt($endDate)) {
             return redirect()->back()->with('error', 'Evaluasi tidak dapat lagi diedit setelah 3 hari.');
         }
     
         return view('trainee.evaluation.edit', compact('evaluation', 'training', 'evaluationItems', 'evaluationResponses'));
     }     
 
     // Simpan perubahan pada evaluasi yang telah di edit
     public function updateEvaluation(Request $request, $evaluationId)
     {
         // Validasi data dari request
         $validatedData = $request->validate([
             'responses.*.score' => 'required|integer|min:1|max:5',
             'responses.*.comment' => 'nullable|string|max:255',
         ]);
 
         // Cek apakah evaluationId valid
         $evaluation = Evaluation::findOrFail($evaluationId);
 
         // Dapatkan jumlah edit dari session
         $editCount = Session::get("evaluation_edit_count_{$evaluationId}", 0);
 
         // Cek apakah jumlah edit belum mencapai batas
         if ($editCount >= 3) {
             return redirect()->route('trainings.list')->with('error', 'You have reached the maximum number of edits.');
         }
 
         // Simpan atau update setiap respons evaluasi
         foreach ($validatedData['responses'] as $itemId => $response) {
             if (EvaluationItem::find($itemId)) {
                 EvaluationResponse::updateOrCreate(
                     ['evaluation_id' => $evaluationId, 'item_id' => $itemId],
                     [
                         'response' => $response['score'],
                         'comments' => $response['comment'] ?? null
                     ]
                 );
             }
         }
 
         // Update jumlah edit di session
         Session::put("evaluation_edit_count_{$evaluationId}", $editCount + 1);
 
         return redirect()->route('trainings.list')->with('success', 'Terimakasih atas penilaian anda.');
     }

     public function showFeedbackForm($trainingId)
     {
        // Ambil detail pelatihan berdasarkan training_id
        $training = Training::with('post.scheduleTraining')->findOrFail($trainingId);
     
        // Ambil tanggal sekarang dan tanggal pelatihan
        $currentDate = Carbon::now();
             // Dapatkan tanggal pelatihan
        $scheduleDate = Carbon::parse($training->post->scheduleTraining->schedule_date);

        // Tentukan batas akhir pengisian feedback (3 hari setelah pelatihan)
        $endDate = $scheduleDate->copy()->addDays(3);
     
        // Cek apakah hari ini masih dalam rentang waktu 3 hari setelah pelatihan
        if (Carbon::now()->gt($endDate)) {
            return redirect()->back()->with('error', 'Formulir feedback tidak dapat lagi diedit setelah 3 hari.');
        }
     
        // Tampilkan form feedback
        return view('trainee.evaluation.feedback', compact('training'));
     }     

    public function storeFeedback(Request $request, $trainingId)
    {
        // Ambil pelatihan yang bersangkutan
        $training = Training::findOrFail($trainingId);
    
        // Simpan feedback di tabel feedback_trainings
        FeedbackTraining::create([
            'trainee_id' => auth()->user()->id,
            'post_id' => $training->post->id,
            'trainer_id' => $training->post->scheduleTraining->trainer_id,
            'description' => $request->input('description'),
            'score' => $request->input('score')
        ]);
    
        return redirect()->route('trainings.list')->with('success', 'Terimakasih atas Feedback anda.');
    }    
}
