<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Department;
use CollegeAdmin\Models\Faculty;
use CollegeAdmin\Models\SubjectDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    if ($request->ajax()) {

        $faculties = Faculty::with([
            'department',
            'subject'
        ])->latest();

        return DataTables::of($faculties)

            ->addIndexColumn()

            ->addColumn('profile_image', function ($row) {

                if ($row->profile_image) {

                    return '
                        <img
                            src="' . asset('storage/' . $row->profile_image) . '"
                            width="50"
                            height="50"
                            class="rounded-circle object-fit-cover"
                        >
                    ';
                }

                return '-';
            })

            ->addColumn('department', function ($row) {

                return $row->department->department_name ?? '-';
            })

            ->addColumn('subject', function ($row) {

                return $row->subject->subject_name ?? '-';
            })

            ->addColumn('resume', function ($row) {

                if ($row->resume) {

                    return '
                        <a
                            href="' . asset('storage/' . $row->resume) . '"
                            target="_blank"
                            class="btn btn-sm btn-info"
                        >
                            View Resume
                        </a>
                    ';
                }

                return '-';
            })

            ->addColumn('action', function ($row) {

                return '

                    <div class="d-flex gap-2">

                        <a
                            href="' . route('admin.faculty.edit', $row->id) . '"

                            class="btn btn-sm btn-warning
                            d-flex align-items-center justify-content-center"
                        >

                            <i class="bi bi-pencil"></i>

                        </a>

                        <form
                            action="' . route('admin.faculty.destroy', $row->id) . '"
                            method="POST"

                            onsubmit="return confirm(\'Are you sure want to delete?\')"
                        >

                            ' . csrf_field() . '

                            ' . method_field('DELETE') . '

                            <button
                                type="submit"

                                class="btn btn-sm btn-danger
                                d-flex align-items-center justify-content-center"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </form>

                    </div>
                ';
            })

            ->rawColumns([
                'profile_image',
                'resume',
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
            'data' => 'profile_image',
            'name' => 'profile_image',
            'title' => 'Image',
            'searchable' => false,
            'orderable' => false,
        ],

        [
            'data' => 'name',
            'name' => 'name',
            'title' => 'Faculty Name',
        ],

        [
            'data' => 'department',
            'name' => 'department',
            'title' => 'Department',
        ],

        [
            'data' => 'subject',
            'name' => 'subject',
            'title' => 'Subject',
        ],

        [
            'data' => 'designation',
            'name' => 'designation',
            'title' => 'Designation',
        ],

        [
            'data' => 'status',
            'name' => 'status',
            'title' => 'Status',
        ],

        [
            'data' => 'resume',
            'name' => 'resume',
            'title' => 'Resume',
            'searchable' => false,
            'orderable' => false,
        ],

        [
            'data' => 'action',
            'name' => 'action',
            'title' => 'Action',
            'searchable' => false,
            'orderable' => false,
        ],

    ];

    return view('college-admin::admin.faculty.index',
        compact('columns')
    );
}

    /**
     * Show the form for creating a new resource.
     */
 public function create()
{
    $departments = Department::get();
    $subjects = SubjectDepartment::get();

    return view('college-admin::admin.faculty.create',
        compact(
            'departments',
            'subjects'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([

        'department_id' => 'required',

        'name' => 'required',

        'email' => 'nullable|email',

        'profile_image' => 'nullable|image',

        'resume' => 'nullable|mimes:pdf,doc,docx'
    ]);

    $profileImage = null;
    $resume = null;

    if ($request->hasFile('profile_image')) {

        $profileImage = $request
            ->file('profile_image')
            ->store('faculty/profile','public');
    }

    if ($request->hasFile('resume')) {

        $resume = $request
            ->file('resume')
            ->store('faculty/resume','public');
    }

    Faculty::create([

        'department_id' => $request->department_id,

        'subject_department_id' => $request->subject_department_id,

        'name' => $request->name,

        'email' => $request->email,

        'phone' => $request->phone,

        'status' => $request->status,

        'designation' => $request->designation,

        'profile_image' => $profileImage,

        'resume' => $resume,
    ]);

    toast('Faculty Created Successfully', 'success');
    return redirect()->route('admin.faculty.index');
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
        $faculty = Faculty::findOrFail($id);

    $departments = Department::get();

    $subjects = SubjectDepartment::get();


    return view('college-admin::admin.faculty.create',
        compact('faculty',
            'departments',
            'subjects'
        )
    );
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request,$id)
{
    $faculty = Faculty::findOrFail($id);

    $request->validate([

        'department_id'=>'required',

        'name'=>'required'
    ]);

    $profileImage = $faculty->profile_image;
    $resume = $faculty->resume;

    if ($request->hasFile('profile_image')) {

        if (
            $faculty->profile_image &&
            Storage::disk('public')
            ->exists($faculty->profile_image)
        ) {
            Storage::disk('public')
                ->delete($faculty->profile_image);
        }

        $profileImage = $request
            ->file('profile_image')
            ->store('faculty/profile','public');
    }

    if ($request->hasFile('resume')) {

        if (
            $faculty->resume &&
            Storage::disk('public')
            ->exists($faculty->resume)
        ) {
            Storage::disk('public')
                ->delete($faculty->resume);
        }

        $resume = $request
            ->file('resume')
            ->store('faculty/resume','public');
    }

    $faculty->update([

        'department_id'=>$request->department_id,

        'subject_department_id'=>$request->subject_department_id,

        'name'=>$request->name,

        'email'=>$request->email,

        'phone'=>$request->phone,

        'status'=>$request->status,

        'designation'=>$request->designation,

        'profile_image'=>$profileImage,

        'resume'=>$resume,
    ]);

    toast('Faculty Updated Successfully', 'success');
    return redirect()
        ->route('admin.faculty.index');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $faculty = Faculty::findOrFail($id);

    if (
        $faculty->profile_image &&
        Storage::disk('public')
        ->exists($faculty->profile_image)
    ) {
        Storage::disk('public')
            ->delete($faculty->profile_image);
    }

    if (
        $faculty->resume &&
        Storage::disk('public')
        ->exists($faculty->resume)
    ) {
        Storage::disk('public')
            ->delete($faculty->resume);
    }

    $faculty->delete();

    toast('Faculty Deleted Successfully', 'success');
    return back();
}
}
