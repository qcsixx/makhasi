<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Daerah;
use App\Http\Requests\StoreMakananRequest;
use App\Http\Requests\UpdateMakananRequest;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function show($id)
    {
        $makanan = Makanan::with('daerah')->findOrFail($id);
        $makanan->image_url = asset('images/' . $makanan->image);
        return response()->json($makanan);
    }

    /**
     * Show Admin Dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_makanan' => Makanan::count(),
            'total_daerah' => Cache::remember('daerah_count', 3600, fn() => Daerah::count()),
            'today_added' => Makanan::whereDate('created_at', \Carbon\Carbon::today())->count(),
            'this_month' => Makanan::whereMonth('created_at', \Carbon\Carbon::now()->month)->count(),
        ];

        // Recent activity logs (displayed as "Recent Activity" in the view)
        $recent_activities = \App\Models\ActivityLog::with('user')->latest()->take(5)->get();

        // Chart data
        $makanan_by_daerah = Makanan::select('daerah_id', DB::raw('count(*) as total'))
            ->with('daerah')
            ->groupBy('daerah_id')
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_activities', 'makanan_by_daerah'));
    }

    /**
     * Display food list with DataTables
     */
    public function index(Request $request)
    {
        // Cache daerah list for 1 hour
        $daerah = Cache::remember('daerah_list', 3600, function () {
            return Daerah::pluck('nama', 'id');
        });

        if ($request->ajax()) {
            $query = Makanan::with('daerah')->select('makanan.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row) {
                    return '<input type="checkbox" class="food-checkbox" value="'.$row->id.'">';
                })
                ->addColumn('action', function($row){
                    $editUrl = route('admin.food.edit', $row->id);
                    // Use generic classes and data attributes
                    $viewBtn = '<button type="button" class="btn btn-sm btn-info mr-1 view-btn" data-id="'.$row->id.'"><i class="fas fa-eye"></i></button>';
                    $editBtn = '<a href="'.$editUrl.'" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i></a>';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('.$row->id.', \''.addslashes($row->nama).'\')"><i class="fas fa-trash"></i></button>';

                    return '<div class="btn-group" role="group">' . $viewBtn . $editBtn . $deleteBtn . '</div>';
                })
                ->editColumn('image', function($row) {
                    $url = asset('images/' . $row->image);
                    // Use generic class and data-src
                    return '<img src="'.$url.'" class="img-thumbnail-admin preview-img-btn" data-src="'.$url.'" alt="'.$row->nama.'">';
                })
                ->editColumn('created_at', function($row) {
                    return '<small>' . $row->created_at->format('d M Y') . '</small><br><small class="text-muted">' . $row->created_at->diffForHumans() . '</small>';
                })
                ->editColumn('nama', function($row) {
                    return '<strong>'.$row->nama.'</strong><br><small class="text-muted">'.\Illuminate\Support\Str::limit($row->deskripsi, 60).'</small>';
                })
                ->addColumn('daerah_nama', function($row) {
                     return '<span class="badge badge-info">' . ($row->daerah?->nama ?? '-') . '</span>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%")
                              ->orWhere('deskripsi', 'like', "%{$search}%");
                        });
                    }
                    if ($request->has('daerah_id') && !empty($request->daerah_id)) {
                        $query->where('daerah_id', $request->daerah_id);
                    }
                })
                ->rawColumns(['checkbox', 'image', 'nama', 'daerah_nama', 'created_at', 'action'])
                ->make(true);
        }

        return view('admin.food.index', ['daerah' => $daerah]);
    }

    /**
     * Show create form (replaces admin method)
     */
    public function create()
    {
        // Cache daerah list for 1 hour
        $daerah = Cache::remember('daerah_list', 3600, function () {
            return Daerah::pluck('nama', 'id');
        });

        return view('admin.food.create', ['daerah' => $daerah]);
    }

    /**
     * Store new food item (replaces add method)
     */
    public function store(StoreMakananRequest $request)
    {
        // Validation is handled by StoreMakananRequest
        $validated = $request->validated();

        // Simpan gambar dengan nama yang aman (UUID)
        $imageName = \Illuminate\Support\Str::uuid() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Simpan data ke dalam database
        $makanan = new Makanan();
        $makanan->nama = $validated['nama'];
        $makanan->daerah_id = $validated['daerah_id'];
        $makanan->deskripsi = $validated['deskripsi'];
        $makanan->resep = $validated['resep'];
        $makanan->panduan = $validated['panduan'];
        $makanan->image = $imageName;
        $makanan->save();

        $makanan->save();

        $this->logActivity('create', 'Created new food item: ' . $makanan->nama, 'Makanan', $makanan->id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'New food item berhasil disimpan!'
            ]);
        }

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.food.index')->with('success', 'New food item berhasil disimpan!');
    }

    public function edit($id)
    {
        $makanan = Makanan::findOrFail($id);
        $daerah = Cache::remember('daerah_list', 3600, function () {
            return Daerah::pluck('nama', 'id');
        });
        return view('admin.food.edit', compact('makanan', 'daerah'));
    }

    public function update($id, UpdateMakananRequest $request)
    {
        $makanan = Makanan::findOrFail($id);

        // Validation is handled by UpdateMakananRequest
        $validated = $request->validated();

        // Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            File::delete(public_path('images/' . $makanan->image));

            // Simpan gambar baru dengan UUID
            $imageName = \Illuminate\Support\Str::uuid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $makanan->image = $imageName;
        }

        // Update data ke dalam database
        $makanan->nama = $validated['nama'];
        $makanan->daerah_id = $validated['daerah_id'];
        $makanan->deskripsi = $validated['deskripsi'];
        $makanan->resep = $validated['resep'];
        $makanan->panduan = $validated['panduan'];
        $makanan->save();

        $this->logActivity('update', 'Updated food item: ' . $makanan->nama, 'Makanan', $makanan->id);

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.food.index')->with('success', 'Food item berhasil diupdate!');
    }

    /**
     * Delete food item (renamed from delete)
     */
    public function destroy($id)
    {
        // Mengambil instance tunggal dari model Makanan berdasarkan ID
        $makanan = Makanan::find($id);

        // Periksa apakah instance Makanan ditemukan
        if ($makanan) {
            // Hapus gambar lama dari direktori penyimpanan
            File::delete(public_path('images/' . $makanan->image));

            $nama = $makanan->nama; // Store name before deletion for logging
            // Hapus data dari database
            $makanan->delete();

            $this->logActivity('delete', 'Deleted food item: ' . $nama, 'Makanan', $id);

            return redirect()->route('admin.food.index')->with('success', 'Food item berhasil dihapus!');
        } else {
            // Handle jika instance Makanan tidak ditemukan
            return redirect()->route('admin.food.index')->with('error', 'Makanan tidak ditemukan.');
        }
    }

    /**
     * Bulk delete food items
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        if (!$ids || count($ids) === 0) {
            return response()->json(['success' => false, 'message' => 'No items selected']);
        }

        $makanan = Makanan::whereIn('id', $ids)->get();
        $count = 0;
        $deletedNames = [];

        foreach ($makanan as $item) {
            File::delete(public_path('images/' . $item->image));
            $deletedNames[] = $item->nama;
            $item->delete();
            $count++;
        }

        $this->logActivity('bulk_delete', "Deleted $count food items: " . implode(', ', $deletedNames), 'Makanan', null);

        return response()->json(['success' => true, 'message' => $count . ' items deleted successfully']);
    }

    private function logActivity($action, $description, $model = null, $modelId = null)
    {
        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'model' => $model,
            'model_id' => $modelId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Display activity log
     */
    public function activityLog(Request $request)
    {
        if ($request->ajax()) {
            $query = \App\Models\ActivityLog::with('user')->select('activity_logs.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function($row) {
                    return '<small>' . $row->created_at->format('d M Y H:i') . '</small>';
                })
                ->addColumn('user_name', function($row) {
                    return $row->user ? $row->user->name : 'System';
                })
                ->editColumn('action', function($row) {
                    $badges = [
                        'create' => '<span class="badge badge-success">Create</span>',
                        'update' => '<span class="badge badge-warning">Update</span>',
                        'delete' => '<span class="badge badge-danger">Delete</span>',
                        'bulk_delete' => '<span class="badge badge-danger">Bulk Delete</span>',
                        'login' => '<span class="badge badge-info">Login</span>',
                        'logout' => '<span class="badge badge-secondary">Logout</span>',
                    ];
                    return $badges[$row->action] ?? '<span class="badge badge-secondary">'.$row->action.'</span>';
                })
                ->editColumn('description', function($row) {
                    return \Illuminate\Support\Str::limit($row->description, 60);
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin.activity-log.index');
    }
}
