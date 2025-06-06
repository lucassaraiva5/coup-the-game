<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->date = $request->date;
        
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('events', 'public');
                $imagePaths[] = $path;
            }
        }
        $event->images = $imagePaths;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event->name = $request->name;
        $event->date = $request->date;

        if ($request->hasFile('images')) {
            // Delete old images
            if ($event->images) {
                foreach ($event->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            // Store new images
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('events', 'public');
                $imagePaths[] = $path;
            }
            $event->images = $imagePaths;
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Delete associated images
        if ($event->images) {
            foreach ($event->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
} 