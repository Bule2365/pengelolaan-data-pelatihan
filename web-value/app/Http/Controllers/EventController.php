<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\EventParticipant;
use App\Models\OrderEvent;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;

class EventController extends Controller
{
    // ADMIN FUNCTIONALITY

    // List all events (Admin)
    public function index(Request $request)
    {
        // Ambil input dari form pencarian
        $search = $request->input('search');
    
        // Lakukan query dengan pencarian
        $events = Event::with('trainer')
            ->withCount('participants')
            ->when($search, function ($query, $search) {
                return $query->where('event_title', 'like', "%{$search}%")
                             ->orWhereHas('trainer', function ($query) use ($search) {
                                 $query->where('event_title', 'like', "%{$search}%");
                             });
            })->get();
    
        return view('admin.events.index', compact('events'));
    }    
    
    // public function indexParticipant(Event $event)
    // {
    //     $participants = Participant::where('event_id', $event->id)->with('trainee')->get();
    //     return view('admin.events.participants', compact('participants', 'event'));
    // }
    
    // Show participants of an event (Admin)
    public function show(Event $event)
    {
        $participants = Participant::where('event_id', $event->id)->with('trainee')->get();
        return view('admin.events.participants', compact('event', 'participants'));
    }

    public function create()
    {
        // Assuming you have a list of trainers to select from
        $trainers = \App\Models\Trainer::all();
        $hotels = \App\Models\Hotel::all();
        return view('admin.events.create', compact('trainers', 'hotels'));
    }

    // Show create event form (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'nullable|string',
            'event_time' => 'required|date',
            'price' => 'required|numeric',
            'trainer_id' => 'required|exists:trainers,id',
            'event_type' => 'required|in:online,offline',
            'hotel_id' => [
                'nullable',
                'exists:hotels,id',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->event_type === 'offline' && !$value) {
                        $fail('The ' . $attribute . ' field is required for offline events.');
                    }
                }
            ],
            'image' => 'nullable|image|max:2048',
        ]);
    
        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event_images', 'public');
        }
    
        Event::create($data);
    
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show edit event form (Admin)
    public function edit(Event $event)
    {
        $trainers = \App\Models\Trainer::all();
        $hotels = \App\Models\Hotel::all();
        return view('admin.events.edit', compact('event', 'trainers', 'hotels'));
    }

    // Update event (Admin)
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'nullable|string',
            'event_time' => 'required|date',
            'price' => 'required|numeric',
            'trainer_id' => 'required|exists:trainers,id',
            'event_type' => 'required|in:online,offline',
            'hotel_id' => [
                'nullable',
                'exists:hotels,id',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->event_type === 'offline' && !$value) {
                        $fail('The ' . $attribute . ' field is required for offline events.');
                    }
                }
            ],
            'image' => 'nullable|image|max:2048',
        ]);
    
        $data = $request->except('image');
    
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('event_images', 'public');
        }
    
        $event->update($data);
    
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Delete event (Admin)
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    // TRAINEE FUNCTIONALITY
    // Trainee: Melihat daftar event
    public function listEventsForTrainee()
    {
        $events = Event::inRandomOrder()->get(); // Mengambil event terbaru
        return view('trainee.events.index', compact('events'));
    }        
    
        // Trainee: Melihat detail event
        public function showEventDetail(Request $request, Event $event)
        {
            $traineeId = Auth::id();
            
            // Cek apakah trainee sudah terdaftar
            $participant = Participant::where('trainee_id', $traineeId)
                                      ->where('event_id', $event->id)
                                      ->first();
        
            $isRegistered = $participant ? true : false;
        
            // Inisialisasi variabel untuk order status
            $orderStatus = null;
        
            // Jika sudah terdaftar, cek status pembayaran di order_events
            if ($isRegistered) {
                $orderEvent = OrderEvent::where('trainee_id', $traineeId)
                                        ->where('participant_id', $participant->id)
                                        ->first();
        
                // Ambil status order jika ditemukan
                $orderStatus = $orderEvent ? $orderEvent->status : null;
            }
        
            // Kirim data ke view
            return view('trainee.events.show', compact('event', 'isRegistered', 'orderStatus'));
        }
        

    // Trainee: Register untuk event
    public function register(Request $request, Event $event)
    {
        $traineeId = Auth::id();
    
        // Hapus peserta dan order yang lama jika trainee unregister sebelumnya
        Participant::where('trainee_id', $traineeId)->where('event_id', $event->id)->delete();
        OrderEvent::where('trainee_id', $traineeId)->whereHas('participant', function($query) use ($event) {
            $query->where('event_id', $event->id);
        })->delete();
        
        // Buat entri baru di tabel Participant
        $participant = Participant::create([
            'trainee_id' => $traineeId,
            'event_id' => $event->id,
        ]);
    
        // Buat orderEvent baru untuk participant ini
        $orderEvent = OrderEvent::create([
            'participant_id' => $participant->id,
            'trainee_id' => $traineeId,
            'total_amount' => $event->price,
            'status' => 'pending'
        ]);

        // dd($participant->orderEvent);
    
        // Arahkan ke halaman pembayaran
        return redirect()->route('trainee.order.create', $participant->id)
            ->with('success', 'Successfully registered for the event. Please complete the payment.');
    }    
    
    public function unregister(Event $event)
    {
        $traineeId = Auth::id();
    
        // Cari data participant berdasarkan trainee dan event
        $participant = Participant::where('trainee_id', $traineeId)
                                  ->where('event_id', $event->id)
                                  ->first();
    
        // Jika participant tidak ditemukan, arahkan kembali dengan pesan error
        if (!$participant) {
            return redirect()->back()->with('error', 'You are not registered for this event.');
        }
    
        // Cari data order event untuk status pembayaran
        $orderEvent = OrderEvent::where('trainee_id', $traineeId)
                                ->where('participant_id', $participant->id)
                                ->first();
    
        // Cek jika status order event adalah 'completed'
        if ($orderEvent && $orderEvent->status === 'completed') {
            return redirect()->back()->with('error', 'You cannot unregister from a completed event.');
        }
    
        // Hapus participant
        $participant->delete();
    
        // Cari data eventParticipant berdasarkan event_id
        $eventParticipant = EventParticipant::where('event_id', $event->id)->first();
    
        // Cek apakah eventParticipant ditemukan
        if ($eventParticipant) {
            // Jika jumlah participant lebih dari 1, kurangi 1
            if ($eventParticipant->participant_count > 1) {
                $eventParticipant->decrement('participant_count');
            } else {
                // Hapus eventParticipant jika tidak ada peserta yang tersisa
                $eventParticipant->delete();
            }
        }
    
        return redirect()->back()->with('success', 'Successfully unregistered from the event.');
    }    

    // Trainee: Melihat daftar event yang diikuti
    public function listMyEvents()
    {
        $traineeId = Auth::id();
        $events = Participant::with(['event', 'orderEvent'])
                              ->where('trainee_id', $traineeId)
                              ->get();
        return view('trainee.events.my-events', compact('events'));
    }    
}
