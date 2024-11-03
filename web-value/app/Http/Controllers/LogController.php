<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // Menampilkan daftar log
    public function index()
    {
        // Mengambil semua log dari database
        $logs = Log::orderBy('created_at', 'desc')->get();

        // Mengembalikan tampilan dengan data log
        return view('admin.logs.index', compact('logs'));
    }

    public function deleteAll(Request $request)
    {
        // Hapus semua log
        Log::truncate();

        return redirect()->route('logs.index')->with('success', 'All logs have been deleted successfully.');
    }
}
