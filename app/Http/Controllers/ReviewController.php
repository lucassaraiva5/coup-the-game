<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string'
        ]);

        Review::create($request->all());

        return redirect()->route('reviews.index')
            ->with('success', 'Review created successfully.');
    }

    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string'
        ]);

        $review->update($request->all());

        return redirect()->route('reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
} 