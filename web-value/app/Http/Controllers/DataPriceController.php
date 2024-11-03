<?php

namespace App\Http\Controllers;

use App\Models\DataPrice;
use App\Models\TypeTraining;
use App\Models\Trainer;
use Illuminate\Http\Request;

class DataPriceController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari request untuk pencarian dan tipe pencarian
        $search = $request->input('search');
        $searchBy = $request->input('search_by');
    
        // Query untuk join tabel data_prices dan trainers
        $dataPrices = DataPrice::join('trainers', 'data_prices.trainer_id', '=', 'trainers.id')
            ->when($search && $searchBy == 'trainer', function ($query) use ($search) {
                // Pencarian berdasarkan nama trainer
                return $query->where('trainers.name', 'like', "%{$search}%");
            })
            ->when($search && $searchBy == 'training_title', function ($query) use ($search) {
                // Pencarian berdasarkan judul training
                return $query->where('data_prices.training_title', 'like', "%{$search}%");
            })
            ->select('data_prices.*', 'trainers.name as trainer_name') // Pilih kolom yang diinginkan
            ->get();
    
        return view('admin.data_prices.index', compact('dataPrices'));
    }

    public function create()
    {
        $typeTrainings = TypeTraining::all();
        $trainers = Trainer::all();
        return view('admin.data_prices.create', compact('typeTrainings', 'trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type_training_id' => 'required|exists:type_trainings,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        DataPrice::create($request->all());

        return redirect()->route('data-prices.index')->with('success', 'Data price created successfully.');
    }

    public function edit(DataPrice $dataPrice)
    {
        $typeTrainings = TypeTraining::all();
        $trainers = Trainer::all();
        return view('admin.data_prices.edit', compact('dataPrice', 'typeTrainings', 'trainers'));
    }

    public function update(Request $request, DataPrice $dataPrice)
    {
        $request->validate([
            'training_title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type_training_id' => 'required|exists:type_trainings,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $dataPrice->update($request->all());

        return redirect()->route('data-prices.index')->with('success', 'Data price updated successfully.');
    }

    public function destroy($id)
    {
        $dataPrice = DataPrice::findOrFail($id);
        $dataPrice->delete();

        return redirect()->route('data-prices.index')->with('success', 'Data price deleted successfully.');
    }
}
