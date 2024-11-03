<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TrainerAccountCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Trainer;
use App\Models\Post;
use App\Models\ScheduleTraining;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get search input
    
        // Query untuk mendapatkan daftar trainers berdasarkan pencarian
        $query = Trainer::query();
    
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        $trainers = $query->get();
    
        return view('admin.trainer.index', compact('trainers', 'search'));
    }    

    public function create()
    {
        return view('admin.trainer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:trainers,name',
            'phone' => 'required|string|max:15|unique:trainers,phone',
            'biography' => 'nullable|string',
            'experience' => 'nullable|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Menyimpan trainer baru
        $trainer = Trainer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'biography' => $request->biography,
            'experience' => $request->experience,
            'password' => bcrypt($request->password),
        ]);
    
        // Mengirim email notifikasi ke trainer yang baru dibuat
        Mail::to($request->name . '@gmail.com')->send(new TrainerAccountCreated($trainer, $request->password));
    
        return redirect()->route('trainers.index')->with('success', 'Trainer created successfully.');
    }
    

    public function show($id)
    {
        $trainer = Trainer::findOrFail($id);
        return view('admin.trainer.show', compact('trainer'));
    }

    public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        return view('admin.trainer.edit', compact('trainer'));
    }

    public function update(Request $request, $id)
    {
        $trainer = Trainer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:trainers,name,' . $trainer->id,
            'phone' => 'required|string|max:15|unique:trainers,phone,' . $trainer->id,
            'biography' => 'nullable|string',
            'experience' => 'nullable|integer',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $trainer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'biography' => $request->biography,
            'experience' => $request->experience,
            'password' => $request->password ? Hash::make($request->password) : $trainer->password,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully.');
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->delete();

        return redirect()->route('trainers.index')->with('success', 'Trainer deleted successfully.');
    }

    // Bagian Trainer
    public function dashboard()
    {
        // Ambil ID dari trainer yang sedang login
        $trainerId = Auth::guard('trainer')->user()->id;

        // Ambil semua jadwal berdasarkan trainer_id
        $upcomingSessions = ScheduleTraining::where('trainer_id', $trainerId)
            ->with(['dataPrice', 'trainingMaterial', 'hotel']) // Load relasi yang dibutuhkan
            ->get();

        // Kembalikan ke view dashboard dengan variabel upcomingSessions
        return view('trainer.dashboard', compact('upcomingSessions'));
    }

    public function indexPost(Post $post)
    {
        $trainerId = auth()->user()->id; 
        $posts = Post::where('trainer_id', $trainerId)->with('dataPrice', 'schedule')->get();
        $post->post_date = Carbon::parse($post->post_date);
        return view('trainer.posts.index', compact('posts'));
    }
}
