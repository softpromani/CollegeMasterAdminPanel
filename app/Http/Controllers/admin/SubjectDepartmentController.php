<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\SubjectDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SubjectDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
    {
        if ($request->ajax()) {

            $subjects = SubjectDepartment::with('department')->latest();

            return DataTables::of($subjects)

                ->addIndexColumn()

                ->addColumn('department', function ($row) {

                    return $row->department->department_name ?? '-';

                })

                ->addColumn('image', function ($row) {

                    if ($row->image) {

                        return '
                            <img
                                src="'.asset('storage/'.$row->image).'"
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

                            <a href="'.route('admin.subject-department.edit',$row->id).'"

                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form
                                action="'.route('admin.subject-department.destroy',$row->id).'"
                                method="POST"

                                onsubmit="return confirm(\'Are you sure?\')"
                            >

                                '.csrf_field().'

                                '.method_field('DELETE').'

                                <button
                                    class="btn btn-danger btn-sm"
                                    type="submit">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>
                    ';
                })

                ->rawColumns([
                    'image',
                    'action'
                ])

                ->make(true);
        }

        $columns = [

            [
                'data'=>'DT_RowIndex',
                'name'=>'DT_RowIndex',
                'title'=>'No',
                'searchable'=>false,
                'orderable'=>false
            ],

            [
                'data'=>'department',
                'name'=>'department',
                'title'=>'Department'
            ],

            [
                'data'=>'subject_name',
                'name'=>'subject_name',
                'title'=>'Subject Name'
            ],

            [
                'data'=>'image',
                'name'=>'image',
                'title'=>'Image',
                'searchable'=>false,
                'orderable'=>false
            ],

            [
                'data'=>'action',
                'name'=>'action',
                'title'=>'Action',
                'searchable'=>false,
                'orderable'=>false
            ]

        ];

        return view(
            'admin.subject-department.index',
            compact('columns')
        );
    }


    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $departments = Department::all();

        return view(
            'admin.subject-department.create',
            compact('departments')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([

            'department_id' => 'required',

            'subject_name' => 'required',

            'image' => 'nullable'
        ]);

        $image = null;

        if($request->hasFile('image')){

            $image = $request
                ->file('image')
                ->store(
                    'subject_department',
                    'public'
                );
        }

        SubjectDepartment::create([

            'department_id' => $request->department_id,

            'subject_name' => $request->subject_name,

            'image' => $image
        ]);

        return redirect()
            ->route('admin.subject-department.index')
            ->with(
                'success',
                'Subject Created Successfully'
            );
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
        $subject = SubjectDepartment::findOrFail($id);

        $departments = Department::get();

        return view(
            'admin.subject-department.create',
            compact(
                'subject',
                'departments'
            )
        );
    }


    /**
     * Update the specified resource in storage.
     */
   public function update(
        Request $request,
        $id
    )
    {
        $subject = SubjectDepartment::findOrFail($id);

        $request->validate([

            'department_id'=>'required',

            'subject_name'=>'required',

            'image'=>'nullable'
        ]);

        $image = $subject->image;

        if($request->hasFile('image')){

            if(
                $subject->image &&
                Storage::disk('public')
                ->exists($subject->image)
            ){
                Storage::disk('public')
                    ->delete($subject->image);
            }

            $image = $request
                ->file('image')
                ->store(
                    'subject_department',
                    'public'
                );
        }

        $subject->update([

            'department_id'=>$request->department_id,

            'subject_name'=>$request->subject_name,

            'image'=>$image
        ]);

        return redirect()
            ->route('admin.subject-department.index')
            ->with(
                'success',
                'Subject Updated Successfully'
            );
    }

    public function destroy($id)
    {
        $subject = SubjectDepartment::findOrFail($id);

        if(
            $subject->image &&
            Storage::disk('public')
            ->exists($subject->image)
        ){
            Storage::disk('public')
                ->delete($subject->image);
        }

        $subject->delete();

        return back()
            ->with(
                'success',
                'Subject Deleted Successfully'
            );
    }

}
