<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $roles = Role::latest();

            return DataTables::of($roles)

                ->addIndexColumn()

                ->editColumn('created_at', function ($row) {

                    return $row->created_at
                        ? $row->created_at->format('d M Y')
                        : '';
                })

                ->addColumn('action', function ($row) {

                    return '

        <div class="d-flex gap-2">

            <a href="' . route('admin.roles.edit', $row->id) . '"

                class="btn btn-sm btn-warning">

                <i class="bi bi-pencil"></i>

            </a>

            <a href="' . route('admin.roles.permission', $row->id) . '"

                class="btn btn-sm btn-info">

                <i class="bi bi-shield-lock"></i>

            </a>

            <form
                action="' . route('admin.roles.destroy', $row->id) . '"
                method="POST"

                onsubmit="return confirm(\'Are you sure you want to delete this role?\')"
            >

                ' . csrf_field() . '

                ' . method_field('DELETE') . '

                <button
                    type="submit"

                    class="btn btn-sm btn-danger">

                    <i class="bi bi-trash"></i>

                </button>

            </form>

        </div>
    ';
                })
                ->rawColumns(['action'])

                ->make(true);
        }

        $columns = [

            [
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => 'No',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Role Name',
            ],



            [
                'data' => 'action',
                'name' => 'action',
                'title' => 'Action',
                'searchable' => false,
                'orderable' => false,
            ],

        ];

        return view('college-admin::admin.role.index',
            compact('columns')
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('college-admin::admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'role' => 'required|unique:roles,name'

        ]);

        Role::create([

            'name' => $request->role

        ]);

        toast('Role Created Successfully', 'success');
        return redirect()
            ->route('admin.roles.index');
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

        $role = Role::find($id);

        return view('college-admin::admin.role.create', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id) {

     $role = Role::findOrFail($id);

     $request->validate([ 'role' => 'required|unique:roles,name,' . $id ]);

     $role->update([ 'name' => $request->role ]);

     toast('Role Updated Successfully', 'success');
     return redirect() ->route('admin.roles.index'); }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Role::find($id)->delete();

        toast('Role Deleted Successfully', 'success');
        return redirect()->route('admin.roles.index');
    }
}
