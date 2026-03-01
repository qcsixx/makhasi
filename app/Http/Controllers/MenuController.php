<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FoodService;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected FoodService $foodService
    ) {}

    /**
     * Display the menu page with food items.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function menu(Request $request)
    {
        // Get regions for filter dropdown
        $daerah = $this->foodService->getAllRegions();

        // Get paginated foods with filters
        $makanan = $this->foodService->getPaginatedFoods([
            'search' => $request->search,
            'daerah' => $request->daerah,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_order' => $request->sort_order ?? 'desc',
        ], 12);

        return view('menu', compact('makanan', 'daerah'));
    }

    /**
     * Display a specific food item.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $makanan = $this->foodService->getFoodById($id);

        // Check if user has this food in library
        $inLibrary = false;
        if (Auth::check()) {
            $inLibrary = Auth::user()->makanan()->where('makanan_id', $id)->exists();
        }

        return view('detail', compact('makanan', 'inLibrary'));
    }
}
