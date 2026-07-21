<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Review;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function show(User $user)
    {
        // Pastikan user adalah admin atau organizer
        if (!in_array($user->role, ['admin', 'organizer'])) {
            abort(404);
        }

        $categories = \App\Models\Category::all();

        // Ambil semua event milik organizer ini yang approved
        $events = Event::where('user_id', $user->id)
            ->where('status', 'approved')
            ->orderBy('date', 'desc')
            ->get();

        // Ambil semua review untuk event milik organizer ini
        $eventIds = Event::where('user_id', $user->id)->pluck('id');
        $reviews = Review::whereIn('event_id', $eventIds)->latest()->get();

        // Hitung rata-rata rating
        $averageRating = $reviews->avg('rating') ?? 0;

        return view('organizer.show', compact('user', 'events', 'reviews', 'averageRating', 'categories'));
    }
}
