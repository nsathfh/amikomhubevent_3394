<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index() {
        $query = \App\Models\Event::with('category')->latest();
        if (auth()->user()->role === 'organizer') {
            $query->where('user_id', auth()->id());
        }
        $events = $query->paginate(10);
        return view('admin.events.index', compact('events'));
    }


    public function create() {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'date'        => 'required|date',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'poster'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['status'] = auth()->user()->role === 'admin' ? 'approved' : 'pending';

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event) {
        if (auth()->user()->role === 'organizer' && $event->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event) {
        if (auth()->user()->role === 'organizer' && $event->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $data = $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'description' => 'required',
            'date'        => 'required',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'poster'      => 'nullable|image|max:2048',
        ]);


        if ($request->hasFile('poster')) {
            if ($event->poster_path) Storage::disk('public')->delete($event->poster_path);
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }


        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event) {
        if (auth()->user()->role === 'organizer' && $event->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        if ($event->poster_path) Storage::disk('public')->delete($event->poster_path);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function approve(Event $event) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $event->update(['status' => 'approved']);
        return back()->with('success', 'Event berhasil disetujui.');
    }

    public function reject(Event $event) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $event->update(['status' => 'rejected']);
        return back()->with('success', 'Event berhasil ditolak.');
    }
}
