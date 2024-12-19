<?php


namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::latest()
            ->paginate(6)
            ->through(function ($event) {
                return [
                    'id' => $event->id,
                    'judul' => $event->judul,
                    'deskripsi' => $event->deskripsi,
                    'tanggal' => $event->tanggal,
                    'image' => $event->image,
                    'judul_detail' => $event->judul_detail,
                    'detail' => $event->detail,
                ];
            });

        return Inertia::render('Add_event', [
            'events' => $events,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'judul_detail' => 'required|string|max:255',
                'detail' => 'required|string',
            ]);
    
            if ($request->hasFile('image')) {
                // Store the image in the 'public/image' directory and get the relative path
                $imagePath = $request->file('image')->store('image', 'public');
                
                // Store only the relative path in the database, not the full URL
                $validated['image'] = $imagePath;
            }
    
            // Create the event with the validated data
            Event::create($validated);
    
            // Return a JSON response with success status
            return response()->json([
                'success' => true,
                'message' => 'Event berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan event: ' . $e->getMessage()
            ]);
        }
    }


public function update(Request $request, $eventId)
{
    
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggal' => 'required',
        'image' => 'nullable',
        'judul_detail' => 'required|string',
        'detail' => 'required|string',
    ]);

    // Temukan event berdasarkan $eventId
    $event = Event::findOrFail($eventId);

    // Update data event
    $event->judul = $validated['judul'];
    $event->deskripsi = $validated['deskripsi'];
    $event->tanggal = $validated['tanggal'];
    $event->judul_detail = $validated['judul_detail'];
    $event->detail = $validated['detail'];

    if ($request->hasFile('image')) {
        // Store the image on the 'public' disk and get the relative path
        $imagePath = $request->file('image')->store('image', 'public');
        $event->image = $imagePath;
    }

    // Simpan perubahan
    $event->save();

    return response()->json(['success' => true]);
}

public function destroy($id)
{
    $event = Event::findOrFail($id);
    $event->delete();

    return response()->json(['success' => true]);
}
}
