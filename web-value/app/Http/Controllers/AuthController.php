<?php

namespace App\Http\Controllers;

use App\Models\CategoriesPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Trainee;
use App\Models\Hotel;
use App\Models\Post;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        // Autentikasi Admin
        $admin = User::where('username', $credentials['username'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::login($admin);
    
            // Cek role
            if ($admin->role->role_name == 'admin-website') {
                return redirect()->route('admin.dashboard');
            } //elseif ($admin->role->role_name == 'admin-em') {
            //     return redirect()->route('admin.admin-em.dashboard');
            // }
        }
    
        // Autentikasi Trainer
        $trainer = Trainer::where('name', $credentials['username'])->first();
        if ($trainer && Hash::check($credentials['password'], $trainer->password)) {
            Auth::guard('trainer')->login($trainer);
            return redirect()->route('trainer.dashboard');
        }
    
        // Autentikasi untuk Trainee
        $trainee = Trainee::where('name', $credentials['username'])->first();
        if ($trainee && Hash::check($credentials['password'], $trainee->password)) {
            Auth::guard('trainee')->login($trainee);
            return redirect()->route('trainee.dashboard');
        }
    
        // Jika semua autentikasi gagal
        return back()->withErrors([
            'username' => 'Kredensial yang diberikan tidak sesuai dengan catatan kami.',
        ])->withInput($request->only('username'));
    }    

    public function showHomePage()
    {
        // $posts = Post::with('trainer', 'categoriesPost', 'dataPrice')->get();
        $posts = Post::inRandomOrder()->limit(6)->get();
        $hotels = Hotel::inRandomOrder()->limit(12)->get();
        $categories = CategoriesPost::all();
        return view('auth.login', compact('posts', 'hotels', 'categories'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:trainees',
            'name' => 'required|string|max:255',
            'personal_phone' => 'required|string|max:15',
            'company' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:15',
            'company_address' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat Trainee baru
        $trainee = Trainee::create([
            'email' => $request->email,
            'name' => $request->name,
            'personal_phone' => $request->personal_phone,
            'company' => $request->company,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'job_title' => $request->job_title,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        // Login Trainee dan arahkan ke dashboard
        Auth::guard('trainee')->login($trainee);
        return redirect()->route('trainee.dashboard');
    }

    public function logout(Request $request)
    {
        // Logout pengguna berdasarkan guard aktif
        if (Auth::guard('trainer')->check()) {
            Auth::guard('trainer')->logout();
        } elseif (Auth::guard('trainee')->check()) {
            Auth::guard('trainee')->logout();
        } else {
            Auth::logout();
        }
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/homepage');
    }    
}
