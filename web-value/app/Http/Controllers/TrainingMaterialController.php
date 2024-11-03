<?php

namespace App\Http\Controllers;

use App\Models\DataPrice;
use App\Models\TrainingMaterial;
use Illuminate\Http\Request;

class TrainingMaterialController extends Controller
{
    // Display the form for trainers to send material
    public function createMaterials()
    {
        // Get the current logged-in trainer ID
        $trainerId = auth()->user()->id;

        // Fetch data prices that are associated with the current trainer
        $dataPrices = DataPrice::where('trainer_id', $trainerId)->get();

        return view('trainer.send_materials.create', compact('dataPrices'));
    }

    // Store the uploaded material
    public function storeMaterials(Request $request)
    {
        // Validasi input
        $request->validate([
            'data_price_id' => 'required|exists:data_prices,id',
            'material_file' => 'required|file|mimes:pdf,doc,docx,zip|max:51200', // 50 MB max
        ]);

        // Ambil file yang diupload
        $file = $request->file('material_file');

        // Ambil nama file asli
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Tambahkan timestamp ke nama file untuk menghindari konflik
        $filename = $originalName . '-' . time() . '.' . $file->getClientOriginalExtension();

        // Generate path untuk menyimpan file
        $filePath = $file->storeAs('training_materials', $filename, 'public');

        // Ambil ID trainer dari pengguna yang sedang login
        $trainerId = auth()->user()->id;

        // Simpan data materi pelatihan
        TrainingMaterial::create([
            'data_price_id' => $request->data_price_id,
            'trainer_id' => $trainerId,
            'material_file' => $filePath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('trainer.send_materials.index')->with('success', 'Material file uploaded successfully.');
    }

    // Display a list of materials uploaded by the trainer
    public function myMaterials()
    {
        $trainerId = auth()->user()->id; // Adjust based on your authentication setup
        $trainingMaterials = TrainingMaterial::where('trainer_id', $trainerId)
            ->with('dataPrice')
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->get();

        return view('trainer.send_materials.index', compact('trainingMaterials'));
    }
}
