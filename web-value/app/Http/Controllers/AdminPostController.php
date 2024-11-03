<?php

namespace App\Http\Controllers;

use App\Models\CategoriesPost;
use App\Models\Post;
use App\Models\Trainer;
use App\Models\DataPrice;
use App\Models\ScheduleTraining;
use Illuminate\Http\Request;
use Storage;

class AdminPostController extends Controller
{
    // Menampilkan daftar postingan
    public function index(Request $request)
    {
        // Ambil input dari form pencarian
        $search = $request->input('search');
        
        // Lakukan query dengan pencarian
        $posts = Post::with('dataPrice')
            ->when($search, function ($query, $search) {
                $query->whereHas('dataPrice', function ($query) use ($search) {
                    // Pencarian di kolom training_title dari tabel data_prices
                    $query->where('training_title', 'like', "%{$search}%");
                });
            })->get();
    
        return view('admin.posts.index', compact('posts'));
    }    

    // Menampilkan form untuk membuat postingan baru
    public function create()
    {
        $trainers = Trainer::all();
        $dataPrices = DataPrice::all();
        $schedules = ScheduleTraining::all();
        $categoriesPosts = CategoriesPost::all();
        return view('admin.posts.create', compact('trainers', 'dataPrices', 'schedules', 'categoriesPosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainer_id' => 'required|exists:trainers,id',
            'data_price_id' => 'required|exists:data_prices,id',
            'description' => 'required',
            'image' => 'nullable|image',
            'schedule_id' => 'required|exists:schedule_trainings,id',
            'categories_post_id' => 'required|exists:categories_posts,id',
            'post_date' => 'nullable|date', // Bisa dikosongkan
            'status' => 'required|in:active,inactive',
        ]);
    
        $post = new Post($request->all());
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }
    
        // Set default post_date to current date if not provided
        $post->post_date = $request->post_date ?: now();
    
        $post->save();
    
        return redirect()->route('manage-posts.index')->with('success', 'Post created successfully.');
    }    

    // Menampilkan form untuk mengedit postingan
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $trainers = Trainer::all();
        $dataPrices = DataPrice::all();
        $schedules = ScheduleTraining::all();
        $categoriesPosts = CategoriesPost::all();
        \Log::info('Categories Posts:', ['categoriesPosts' => $categoriesPosts]);
    
        return view('admin.posts.edit', compact('post', 'trainers', 'dataPrices', 'schedules', 'categoriesPosts'));
    }    

    public function update(Request $request, $id)
    {
        $request->validate([
            'trainer_id' => 'required|exists:trainers,id',
            'data_price_id' => 'required|exists:data_prices,id',
            'description' => 'required',
            'image' => 'nullable|image',
            'schedule_id' => 'required|exists:schedule_trainings,id',
            'categories_post_id' => 'required|exists:categories_posts,id',
            'post_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);
    
        $post = Post::findOrFail($id);
        $post->fill($request->all());
    
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('images', 'public');
        }
    
        // Set default post_date to current date if not provided
        $post->post_date = $request->post_date ?: now();
    
        $post->save();
    
        return redirect()->route('manage-posts.index')->with('success', 'Post updated successfully.');
    }           

    // Menghapus postingan dari database
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('manage-posts.index')->with('success', 'Post deleted successfully.');
    }

    public function getDataprices($trainerId)
    {
        $dataPrices = DataPrice::where('trainer_id', $trainerId)->get();
        return response()->json($dataPrices);
    }

    public function getSchedules($trainerId)
    {
        $schedules = ScheduleTraining::where('trainer_id', $trainerId)->get();
        return response()->json($schedules);
    }
}
