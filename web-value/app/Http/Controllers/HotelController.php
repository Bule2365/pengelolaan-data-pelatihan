<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Menampilkan daftar hotel
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil nilai pencarian dari input
    
        // Query untuk mengambil semua hotel atau melakukan filter berdasarkan nama
        $query = Hotel::query();
        
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        $hotels = $query->get(); // Dapatkan hasil pencarian atau semua hotel
        return view('admin.hotels.index', compact('hotels'));
    }    

    // Menampilkan form untuk menambah hotel
    public function create()
    {
        return view('admin.hotels.create');
    }

    // Menyimpan hotel baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
        ]);

        Hotel::create($request->all());

        return redirect()->route('hotels.index')->with('success', 'Hotel created successfully.');
    }

    // Menampilkan form untuk mengedit hotel
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    // Memperbarui data hotel
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
        ]);

        $hotel->update($request->all());

        return redirect()->route('hotels.index')->with('success', 'Hotel updated successfully.');
    }

    // Menghapus hotel
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}
