<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Makanan;

class HomeController extends Controller
{
    public function home()
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect admin to admin panel
            if ($user->isAdmin()) {
                return redirect()->route('feed');
            }
        }

        // Fetch popular/latest makanan for homepage
        $makananPopuler = Makanan::with('daerah')
            ->latest()
            ->limit(15)
            ->get();

        // Show home page for regular users and guests
        return view('home', compact('makananPopuler'));
    }
}
