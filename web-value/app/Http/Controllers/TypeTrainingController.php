<?php

namespace App\Http\Controllers;

use App\Models\TypeTraining;
use Illuminate\Http\Request;

class TypeTrainingController extends Controller
{
    public function index()
    {
        $types = TypeTraining::all();
        return view('admin.type_training.index', compact('types'));
    }

    public function create()
    {
        return view('admin.type_training.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        TypeTraining::create($request->all());

        return redirect()->route('type_trainings.index')->with('success', 'Jenis pelatihan berhasil ditambahkan.');
    }

    public function edit(TypeTraining $typeTraining)
    {
        return view('admin.type_training.edit', compact('typeTraining'));
    }

    public function update(Request $request, TypeTraining $typeTraining)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        $typeTraining->update($request->all());

        return redirect()->route('type_trainings.index')->with('success', 'Jenis pelatihan berhasil diperbarui.');
    }

    public function destroy(TypeTraining $typeTraining)
    {
        $typeTraining->delete();

        return redirect()->route('type_trainings.index')->with('success', 'Jenis pelatihan berhasil dihapus.');
    }
}
