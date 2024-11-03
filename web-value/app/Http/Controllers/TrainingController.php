<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Training;
use App\Models\CategoriesPost;
use App\Models\Evaluation;
use App\Models\OrderPost;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    // Menampilkan daftar postingan
    public function indexPost(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');

        $query = Post::where('status', 'active')
            ->with('dataPrice', 'trainer', 'categoriesPost');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                  ->orWhereHas('dataPrice', function($q) use ($search) {
                      $q->where('training_title', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($categoryId) {
            $query->where('categories_post_id', $categoryId);
        }

        // Menampilkan postingan secara acak
        $posts = $query->inRandomOrder()->get();
        $categories = CategoriesPost::all();

        return view('trainee.posts.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    // Menampilkan detail postingan
    public function showPost($postId)
    {
        // Ambil detail postingan beserta data terkait
        $post = Post::with('dataPrice', 'trainer', 'schedule', 'categoriesPost')->findOrFail($postId);
    
        // Dapatkan ID trainee yang sedang login
        $traineeId = Auth::id();
    
        // Cek apakah trainee sudah terdaftar di pelatihan ini
        $training = Training::where('trainee_id', $traineeId)
                            ->where('post_id', $postId)
                            ->first();
    
        // Cek apakah trainee terdaftar
        $isRegistered = $training ? true : false;
    
        // Inisialisasi variabel orderStatus
        $orderStatus = null;
    
        // Jika trainee sudah terdaftar, periksa status order
        if ($isRegistered) {
            $orderPost = OrderPost::where('trainee_id', $traineeId)
                                  ->where('training_id', $training->id)
                                  ->first();
    
            // Ambil status order jika ada
            $orderStatus = $orderPost ? $orderPost->status : null;
        }
    
        // Cek apakah pendaftaran masih terbuka (H-1)
        $scheduleDate = Carbon::parse($post->schedule->schedule_date);
        $today = Carbon::now();
    
        // Pendaftaran hanya bisa dilakukan jika hari ini <= H-1 dari tanggal pelatihan
        $canRegister = $today->lessThanOrEqualTo($scheduleDate->subDay());
    
        // Kirim data ke view
        return view('trainee.posts.show', [
            'post' => $post,
            'isRegistered' => $isRegistered,
            'orderStatus' => $orderStatus, // Mengirimkan status order ke view
            'canRegister' => $canRegister
        ]);
    }

    // Mendaftar ke postingan
    // public function registerPost(Request $request, $postId)
    // {
    //     $traineeId = Auth::id(); // Mendapatkan ID trainee yang sedang login

    //     $alreadyRegistered = Training::where('trainee_id', $traineeId)
    //                                 ->where('post_id', $postId)
    //                                 ->exists();

    //     if ($alreadyRegistered) {
    //         return redirect()->back()->with('error', 'You are already registered for this post.');
    //     }

    //     // $post = Post::findOrFail($postId);

    //     Training::create([
    //         'trainee_id' => $traineeId,
    //         'post_id' => $postId,
    //         // 'trainer_id' => $post->trainer_id,
    //         // 'schedule_id' => $post->schedule_id,
    //     ]);

    //     return redirect()->back()->with('success', 'Successfully registered for the post.');
    // }

    // Menampilkan daftar pendaftaran
    public function listUnregister()
    {
        $traineeId = Auth::id(); // Mendapatkan ID trainee yang sedang login
    
        // Ambil pelatihan yang didaftarkan oleh trainee
        $trainings = Training::with('post.dataPrice', 'post.scheduleTraining')
                             ->where('trainee_id', $traineeId)
                             ->get();
        
        // Ambil evaluasi yang sudah diisi oleh trainee
        $evaluations = Evaluation::where('trainee_id', $traineeId)
            ->pluck('id', 'training_id'); // Pluck to get a map of training_id to evaluation_id
    
        return view('trainee.posts.list', [
            'trainings' => $trainings,
            'evaluations' => $evaluations
        ]);
    }    

    // Membatalkan pendaftaran
    public function unregisterPost(Request $request, $postId)
    {
        $traineeId = Auth::id(); // ID dari trainee yang sedang login
    
        // Cari data training berdasarkan trainee_id dan post_id
        $training = Training::where('trainee_id', $traineeId)
                            ->where('post_id', $postId)
                            ->first();
    
        // Cek apakah trainee terdaftar di training tersebut
        if (!$training) {
            return redirect()->back()->with('error', 'You are not registered for this training.');
        }
    
        // Cari order yang berkaitan dengan training ini
        $orderPost = OrderPost::where('trainee_id', $traineeId)
                              ->where('training_id', $training->id)
                              ->first();
    
        // Jika tidak ada order terkait, berikan pesan error
        if (!$orderPost) {
            return redirect()->back()->with('error', 'No payment record found for this training.');
        }
    
        // Cek status order, jika sudah completed maka tidak bisa unregister
        if ($orderPost->status === 'completed') {
            return redirect()->back()->with('error', 'You cannot unregister from a completed training.');
        }
    
        // Jika status bukan 'completed', hapus data training (unregister)
        $deleted = $training->delete();
    
        if ($deleted) {
            return redirect()->back()->with('success', 'Successfully unregistered from the training.');
        }
    
        return redirect()->back()->with('error', 'Failed to unregister from the training.');
    }

    // public function index(Request $request)
    // {
    //     // Ambil input dari form pencarian
    //     $search = $request->input('search');
    
    //     // Query data training dengan relasi ke trainee dan post (dataPrice) serta filter pencarian
    //     $trainings = Training::with(['trainee', 'post.dataPrice'])
    //         ->when($search, function ($query, $search) {
    //             // Filter pelatihan berdasarkan judul post
    //             $query->whereHas('post.dataPrice', function ($query) use ($search) {
    //                 $query->where('training_title', 'like', "%{$search}%");
    //             });
    //         })
    //         ->get();
    
    //     // Mengembalikan view dengan data pelatihan
    //     return view('admin.trainings.index', compact('trainings'));
    // }    

    public function show(Request $request, $post_id)
    {
        // Ambil input dari form pencarian (jika ada)
        $search = $request->input('search');
    
        // Query untuk mendapatkan pelatihan berdasarkan post_id dan filter nama trainee jika ada
        $trainings = Training::with(['trainee', 'post.dataPrice'])
            ->where('post_id', $post_id) // Mengambil hanya pelatihan dengan post_id tertentu
            ->when($search, function ($query, $search) {
                // Filter berdasarkan nama peserta (trainee.name)
                $query->whereHas('trainee', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            })
            ->get();
    
        // Mengembalikan view dengan data pelatihan yang terkait dengan post tertentu dan filter pencarian (jika ada)
        return view('admin.trainings.show', compact('trainings'));
    }    
}
