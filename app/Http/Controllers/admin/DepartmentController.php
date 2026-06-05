<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $departments = Department::latest();

            return DataTables::of($departments)

                ->addIndexColumn()

                ->addColumn('department_image', function ($row) {

                    if ($row->department_image) {

                        return '

                            <img
                                src="' . asset('storage/' . $row->department_image) . '"
                                width="60"
                                height="60"
                                class="rounded object-fit-cover"
                            >

                        ';
                    }

                    return '-';
                })

                ->addColumn('action', function ($row) {

                    return '

                        <div class="d-flex gap-2">

                            <a
                                href="' . route('admin.department.edit', $row->id) . '"
                                class="btn btn-warning btn-sm"
                            >

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form
                                action="' . route('admin.department.destroy', $row->id) . '"
                                method="POST"

                                onsubmit="return confirm(\'Are you sure want to delete?\')"
                            >

                                ' . csrf_field() . '

                                ' . method_field('DELETE') . '

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>

                    ';
                })

                ->rawColumns([
                    'department_image',
                    'action'
                ])

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
                'data' => 'department_image',
                'name' => 'department_image',
                'title' => 'Image',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'department_name',
                'name' => 'department_name',
                'title' => 'Department Name',
            ],

            [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => 'Created At',
            ],

            [
                'data' => 'action',
                'name' => 'action',
                'title' => 'Action',
                'searchable' => false,
                'orderable' => false,
            ],

        ];

        return view(
            'admin.department.index',
            compact('columns')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.department.create');
    }
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([

            'department_name' => 'required',

            'department_image' => 'nullable|image'

        ]);

        $image = null;

        if ($request->hasFile('department_image')) {

            $image = $request->file('department_image')
                ->store('departments', 'public');
        }

        Department::create([

            'department_name' => $request->department_name,

            'department_image' => $image

        ]);

        return redirect()
            ->route('admin.department.index')
            ->with('success', 'Department Created Successfully');
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
        $department = Department::findOrFail($id);

        return view(
            'admin.department.create',
            compact('department')
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([

            'department_name' => 'required',

            'department_image' => 'nullable|image'

        ]);

        $image = $department->department_image;

        if ($request->hasFile('department_image')) {

            if (
                $department->department_image &&
                Storage::disk('public')->exists($department->department_image)
            ) {
                Storage::disk('public')->delete($department->department_image);
            }

            $image = $request->file('department_image')
                ->store('departments', 'public');
        }

        $department->update([

            'department_name' => $request->department_name,

            'department_image' => $image

        ]);

        return redirect()
            ->route('admin.department.index')
            ->with('success', 'Department Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy($id)
    {
        $department = Department::findOrFail($id);

        if (
            $department->department_image &&
            Storage::disk('public')->exists($department->department_image)
        ) {
            Storage::disk('public')->delete($department->department_image);
        }

        $department->delete();

        return redirect()
            ->back()
            ->with('success', 'Department Deleted Successfully');
    }
}
