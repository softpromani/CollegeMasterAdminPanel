<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('role')->latest();

            return DataTables::of($users)->addIndexColumn()->editColumn('created_at', function ($row) {

                return
                 $row->created_at ? $row->created_at->format('d M Y') : '-';
            })
            ->addColumn('role', function ($row) {
                return $row->role->name ?? '-';
            })
            ->addColumn('image', function ($row) {
                if ($row->image) {
                    return ' <img src="' . asset('storage/' . $row->image) . '" width="40" height="40" class="rounded-circle object-fit-cover" > ';
                }
                return ' <img src="' . asset('admin/assets/img/profile-img.jpg') . '" width="40" height="40" class="rounded-circle object-fit-cover" > ';
            })
            ->addColumn('action', function ($row) {
                return ' <div class="d-flex gap-2"> <a href="' . route('admin.user.edit', $row->id) . '" class="btn btn-sm btn-warning d-flex align-items-center justify-content-center" > <i class="bi bi-pencil"></i> </a> <form action="' . route('admin.user.destroy', $row->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this user?\')" > ' . csrf_field() . ' ' . method_field('DELETE') . ' <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center" > <i class="bi bi-trash"></i> </button> </form> </div> ';
            })

            ->rawColumns(['image', 'action'])->make(true);
        }

        $columns =
         [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No', 'searchable' => false, 'orderable' => false,],
          ['data' => 'image', 'name' => 'image', 'title' => 'Image', 'searchable' => false, 'orderable' => false,],
           ['data' => 'first_name', 'name' => 'first_name', 'title' => 'First Name',],
            ['data' => 'last_name', 'name' => 'last_name', 'title' => 'Last Name',],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email',],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone',],
            ['data' => 'role', 'name' => 'role', 'title' => 'Role', 'searchable' => false, 'orderable' => false,],
          ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'searchable' => false, 'orderable' => false,],
          ];

        return view('admin.user.index', compact('columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
             'last_name' => 'required',
             'email' => 'nullable|unique:users,email',
              'phone' => 'nullable',
              'role' => 'nullable',
              'image' => 'nullable|image|mimes:jpg,jpeg,png',]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('users', 'public');

        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
             'email' => $request->email,
              'phone' => $request->phone,
              'role_id' => $request->role,
               'image' => $imagePath,
               'password' => bcrypt('12345678'),]);

        return redirect()->route('admin.user.index')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('admin.user.create', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
             'email' => 'nullable|unique:users,email,' . $id,
              'phone' => 'nullable',
              'role' => 'nullable',
              'image' => 'nullable|image|mimes:jpg,jpeg,png',]);


        $imagePath = $user->image;

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $imagePath = $request->file('image')->store('users', 'public');

        }
        $user->update([

            'first_name' => $request->first_name,
             'last_name' => $request->last_name,
              'email' => $request->email,
              'phone' => $request->phone,
               'role_id' => $request->role,
               'image' => $imagePath,

               ]);

        return redirect()->route('admin.user.index')->with('success', 'User Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->image && Storage::disk('public')->exists($user->image)) {

            Storage::disk('public')->delete($user->image);

        }

        $user->delete();

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
}
