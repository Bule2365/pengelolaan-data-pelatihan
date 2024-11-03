<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleTraining;
use App\Models\DataPrice;
use App\Models\TrainingMaterial;
use App\Models\Hotel;
use App\Models\TypeTraining;
use App\Models\Trainer;

class ScheduleTrainingController extends Controller
{
    public function index(Request $request)
    {
        $searchBy = $request->input('search_by');
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $schedules = ScheduleTraining::with(['dataPrice', 'trainingMaterial', 'hotel', 'trainer'])
            ->when($searchBy == 'training_title' && $search, function ($query) use ($search) {
                // Filter berdasarkan judul training
                return $query->whereHas('dataPrice', function ($query) use ($search) {
                    $query->where('training_title', 'like', "%{$search}%");
                });
            })
            ->when($searchBy == 'trainer_name' && $search, function ($query) use ($search) {
                // Filter berdasarkan nama trainer
                return $query->whereHas('trainer', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            })
            ->when($searchBy == 'schedule_date' && $startDate && $endDate, function ($query) use ($startDate, $endDate) {
                // Filter berdasarkan range tanggal schedule_date
                return $query->whereBetween('schedule_date', [$startDate, $endDate]);
            })
            ->orderBy('schedule_date', 'desc')
            ->get();
    
        return view('admin.schedule.index', compact('schedules'));
    }    

    public function create()
    {
        $trainers = Trainer::all();
        $hotels = Hotel::all();
        return view('admin.schedule.create', compact('trainers', 'hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_price_id' => 'required|exists:data_prices,id',
            'trainer_id' => 'required|exists:trainers,id',
            'training_material_id' => 'required|exists:training_materials,id',
            'schedule_date' => 'required|date',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        // Check for additional validation errors
        $messages = [];

        if (!$request->has('data_price_id') || empty($request->data_price_id)) {
            $messages[] = 'Data Price is required.';
        }

        if (!$request->has('trainer_id') || empty($request->trainer_id)) {
            $messages[] = 'Trainer is required.';
        }

        if (!$request->has('training_material_id') || empty($request->training_material_id)) {
            $messages[] = 'Training Material is required.';
        }

        if (!$request->has('schedule_date') || empty($request->schedule_date)) {
            $messages[] = 'Schedule Date is required.';
        }

        if (!$request->has('hotel_id') || empty($request->hotel_id)) {
            $messages[] = 'Hotel is required.';
        }

        if (!empty($messages)) {
            return redirect()->back()->with('warning', implode(' ', $messages))->withInput();
        }

        ScheduleTraining::create($request->all());

        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully.');
    }

    public function destroy(ScheduleTraining $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Schedule deleted successfully.');
    }

    public function getDataPrices($trainerId)
    {
        return DataPrice::where('trainer_id', $trainerId)->get();
    }

    public function getTrainingMaterials($trainerId)
    {
        return TrainingMaterial::whereHas('dataPrice', function ($query) use ($trainerId) {
            $query->where('trainer_id', $trainerId);
        })->get();
    }
}
