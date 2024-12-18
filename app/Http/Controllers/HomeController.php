<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Community;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $events = Event::all();
        $communities = Community::all();

        // Return data to Inertia
        return Inertia::render('Home', [
            'events' => $events,
            'communities' => $communities,
            'isLoggedIn' => session()->has('user'),
        ]);
    }

    public function up_coming()
    {

        $events = Event::all();

        // Return data to Inertia
        return Inertia::render('Up_coming', [
            'events' => $events,
        ]);
    }


    public function show_event($id)
    {
        $event = Event::findOrFail($id);
        return Inertia::render('Event_info', ['event' => $event]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');



        $events = Event::where('judul', 'LIKE', "%{$query}%")
            ->orWhere('deskripsi', 'LIKE', "%{$query}%")
            ->get();

        return Inertia::render('SearchResults', [
            'query' => $query,
            'events' => $events
        ]);
    }
}
