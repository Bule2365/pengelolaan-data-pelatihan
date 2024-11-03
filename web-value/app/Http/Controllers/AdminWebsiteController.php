<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Payment;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\TrainingMaterial;

class AdminWebsiteController extends Controller
{
    public function dashboard()
    {
        $totalTrainees = Trainee::count();
        $totalTrainers = Trainer::count();

        return view('admin.dashboard', [
            'totalTrainees' => $totalTrainees,
            'totalTrainers' => $totalTrainers
        ]);
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin.layouts.edit-profile', compact('admin'));
    }

    // public function update(Request $request)
    // {
    //     $admin = Auth::user();

    //     $request->validate([
    //         'username' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
    //         'password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     $admin->username = $request->username;
    //     $admin->email = $request->email;

    //     if ($request->filled('password')) {
    //         $admin->password = Hash::make($request->password);
    //     }

    //     $admin->save();

    //     return redirect()->route('admin.edit-profile')->with('success', 'Profile updated successfully.');
    // }

    public function indexMaterials(Request $request)
    {
        // Ambil input pencarian dari request
        $search = $request->input('search');
    
        // Query untuk join tabel training_materials dengan data_prices dan trainers
        $trainingMaterials = TrainingMaterial::with('dataPrice', 'trainer')
            ->when($search, function ($query, $search) {
                // Join ke data_prices dan filter berdasarkan training_title
                return $query->whereHas('dataPrice', function ($query) use ($search) {
                    $query->where('training_title', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->get();
    
        return view('admin.training_materials.index', compact('trainingMaterials'));
    }    

    public function index()
    {
        $trainings = Training::with('post.dataPrice', 'trainee')->get();
        return view('admin.trainings.index', ['trainings' => $trainings]);
    }     
}
