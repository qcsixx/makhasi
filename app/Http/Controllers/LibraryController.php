<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LibraryService;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected LibraryService $libraryService
    ) {}

    /**
     * Display the user's library.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $makanan = $this->libraryService->getUserLibrary($userId);

        return view('library', compact('makanan'));
    }

    /**
     * Add a food item to the user's library.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Add a food item to the user's library.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToLibrary(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $makananId = $request->input('makanan_id');

        $result = $this->libraryService->addToLibrary($userId, $makananId);

        if ($result) {
            return redirect()->back()->with('success', 'Makanan berhasil ditambahkan ke Library!');
        }

        return redirect()->back()->with('error', 'Makanan sudah ada di library Anda.');
    }

    /**
     * Remove a food item from the user's library.
     *
     * @param int $makananId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromLibrary($makananId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $result = $this->libraryService->removeFromLibrary($userId, $makananId);

        if ($result) {
            return redirect()->back()->with('success', 'Makanan berhasil dihapus dari Library!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus makanan dari Library.');
    }
}
