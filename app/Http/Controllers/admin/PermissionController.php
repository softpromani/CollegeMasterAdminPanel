<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function roleHasPermission(Request $request)
    {
        $roles = Role::all();

        $selectedRole = null;

        $permissions = [];

        if ($request->role) {

            $selectedRole = Role::find($request->role);

            $permissions = Permission::all()

                ->groupBy(function ($permission) {

                    return explode('_', $permission->name)[0];
                });
        }

        return view(
            'admin.role-has-permission',

            compact(
                'roles',
                'selectedRole',
                'permissions'
            )
        );
    }


    public function rolePermissionUpdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions(

            $request->permissions ?? []

        );

        toast('Permission Updated Successfully', 'success');
        return redirect()
            ->back();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Permission::create([
            'name' => $request->name
        ]);

        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
