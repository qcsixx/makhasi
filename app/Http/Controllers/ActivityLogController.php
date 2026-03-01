<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog; // Assuming ActivityLog model is used
use Yajra\DataTables\Facades\DataTables; // Assuming DataTables facade is used

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ActivityLog::with('user');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function($row) {
                    return $row->created_at->format('d M Y H:i:s');
                })
                ->addColumn('user_name', function($row) {
                    return $row->user ? $row->user->name : 'System/Guest';
                })
                ->editColumn('action', function($row) {
                    $badges = [
                        'create' => 'success',
                        'update' => 'warning',
                        'delete' => 'danger',
                        'bulk_delete' => 'danger',
                        'login' => 'info',
                    ];
                    $color = $badges[$row->action] ?? 'secondary';
                    return '<span class="badge badge-'.$color.'">'.ucfirst(str_replace('_', ' ', $row->action)).'</span>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.activity.index');
    }
}
