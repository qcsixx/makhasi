<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role_badge', function ($row) {
                    if ($row->isAdmin()) {
                        return '<span class="badge badge-danger">Admin</span>';
                    } else {
                        return '<span class="badge badge-success">User</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    // Prevent deleting self
                    $disabled = ($row->id == Auth::id()) ? 'disabled' : '';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '" data-name="' . $row->name . '" ' . $disabled . '><i class="fas fa-trash"></i></button>';
                    $editBtn = '<button type="button" class="btn btn-sm btn-warning mr-1 edit-btn" data-id="' . $row->id . '" data-name="' . $row->name . '" data-email="' . $row->email . '" data-role="' . $row->usertype . '"><i class="fas fa-edit"></i></button>';

                    return '<div class="btn-group">' . $editBtn . $deleteBtn . '</div>';
                })
                ->rawColumns(['role_badge', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'usertype' => 'required|in:0,1', // 0: User, 1: Admin
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        $this->logActivity('create', 'Created new user: ' . $user->name, 'User', $user->id);

        return response()->json(['success' => 'User created successfully.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'usertype' => 'required|in:0,1',
            'password' => 'nullable|string|min:8', // Optional for update
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->usertype = $request->usertype;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $this->logActivity('update', 'Updated user: ' . $user->name, 'User', $user->id);

        return response()->json(['success' => 'User updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id == Auth::id()) {
            return response()->json(['error' => 'You cannot delete yourself.'], 403);
        }

        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        $this->logActivity('delete', 'Deleted user: ' . $name, 'User', $id);

        return response()->json(['success' => 'User deleted successfully.']);
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
}
