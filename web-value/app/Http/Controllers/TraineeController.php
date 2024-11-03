<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CertificateTrainee;
use App\Models\Evaluation;
use App\Models\Post;
use App\Models\OrderPost;
use App\Models\Training;
use Illuminate\Support\Facades\Hash;

class TraineeController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan trainee yang sedang login
        $trainee = Auth::guard('trainee')->user();

        // Mengambil semua sertifikat milik trainee tersebut
        $certificates = CertificateTrainee::where('trainee_id', $trainee->id)
                                           ->orderBy('issue_date', 'desc')
                                           ->get();

        // Mengirim data trainee dan sertifikat ke view dashboard
        return view('trainee.dashboard', compact('trainee', 'certificates'));
    }

    public function downloadCertificate($certificateId)
    {
        // Ambil data sertifikat berdasarkan ID
        $certificate = CertificateTrainee::findOrFail($certificateId);
        
        // Path lengkap dari gambar sertifikat
        $filePath = public_path('images/' . $certificate->certificate_image);
        
        // Cek apakah file sertifikat ada
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'Certificate file not found.');
        }
    }    

    // public function index()
    // {
    //     $posts = Post::all();
    //     return view('trainee.posts.index', compact('posts'));
    // }

    // Trainee: Register untuk Post
    public function register(Request $request, $postId)
    {
        // Cari post berdasarkan ID dan eager load scheduleTraining dan dataPrice
        $post = Post::with(['scheduleTraining', 'dataPrice'])->findOrFail($postId);
    
        // Cek apakah post memiliki jadwal (schedule)
        if (!$post->scheduleTraining) {
            return redirect()->back()->with('error', 'No schedule available for this post.');
        }
    
        // Buat data pelatihan untuk trainee, pastikan schedule_id diisi
        $training = Training::create([
            'post_id' => $postId,
            'trainee_id' => auth()->user()->id,
            'schedule_id' => $post->scheduleTraining->id,
        ]);
    
        // Buat data order dengan nilai default (harga dan metode pembayaran = 0)
        OrderPost::create([
            'training_id' => $training->id,
            'trainee_id' => auth()->user()->id,
            'payment_method_id' => null, // Metode pembayaran akan diubah saat pembayaran
            'total_amount' => 0,         // Akan diisi saat trainee melakukan pembayaran
            'status' => 'pending',       // Status awal sebagai pending
        ]);

                // Buat evaluasi hanya jika belum ada
            Evaluation::firstOrCreate([
                'training_id' => $training->id,
                'trainee_id' => auth()->user()->id,
            ]);
            
            // dd($evaluation); 
    
        // Setelah mendaftar, arahkan trainee ke halaman pembayaran
        return redirect()->route('trainee.payment.post', $training->id)
            ->with('success', 'Successfully registered for the post. Please complete the payment.');
    }    

    public function editProfile()
    {
        $trainee = Auth::guard('trainee')->user();
        return view('trainee.layouts.edit-profile', compact('trainee'));
    }

    public function updateProfile(Request $request)
    {
        $trainee = Auth::guard('trainee')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'personal_phone' => 'required|string|max:15',
            'company' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:15',
            'company_address' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $trainee->update([
            'name' => $request->name,
            'personal_phone' => $request->personal_phone,
            'company' => $request->company,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'job_title' => $request->job_title,
            'gender' => $request->gender,
            'password' => $request->password ? Hash::make($request->password) : $trainee->password,
        ]);

        return redirect()->route('trainee.dashboard')->with('success', 'Profile updated successfully.');
    }

    public function deleteAccount()
    {
        $trainee = Auth::guard('trainee')->user();
        $trainee->delete();
        Auth::guard('trainee')->logout();
        return redirect('/homepage')->with('success', 'Account deleted successfully.');
    }
}
