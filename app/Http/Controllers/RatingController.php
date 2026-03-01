<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Store a new rating.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'makanan_id' => 'required|exists:makanan,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'makanan_id' => $request->makanan_id,
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        return redirect()->back()->with('success', 'Rating berhasil disimpan!');
    }

    /**
     * Delete a rating.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $rating = Rating::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $rating->delete();

        return redirect()->back()->with('success', 'Rating berhasil dihapus!');
    }
}
