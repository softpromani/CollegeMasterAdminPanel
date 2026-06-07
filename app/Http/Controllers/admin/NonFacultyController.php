<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NonFaculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class NonFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = NonFaculty::latest();

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('image', function ($row) {

                    if ($row->image) {

                        return '<img src="' . asset('storage/' . $row->image) . '"
                                width="50"
                                height="50"
                                class="rounded-circle object-fit-cover">';
                    }

                    return '-';
                })

                ->addColumn('action', function ($row) {

                    return '
                        <div class="d-flex gap-2">

                            <a href="' . route('admin.non-faculty.edit', $row->id) . '"
                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="' . route('admin.non-faculty.destroy', $row->id) . '"
                                method="POST"
                                onsubmit="return confirm(\'Delete this record?\')">

                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '

                                <button class="btn btn-danger btn-sm">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>
                    ';
                })

                ->rawColumns(['image','action'])

                ->make(true);
        }

        $columns = [

            [
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => 'No',
                'searchable' => false,
                'orderable' => false
            ],

            [
                'data' => 'image',
                'name' => 'image',
                'title' => 'Image',
                'searchable' => false,
                'orderable' => false
            ],

            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Name'
            ],

            [
                'data' => 'email',
                'name' => 'email',
                'title' => 'Email'
            ],

            [
                'data' => 'phone',
                'name' => 'phone',
                'title' => 'Phone'
            ],

            [
                'data' => 'designation',
                'name' => 'designation',
                'title' => 'Designation'
            ],

            [
                'data' => 'action',
                'name' => 'action',
                'title' => 'Action',
                'searchable' => false,
                'orderable' => false
            ],
        ];

        return view(
            'admin.non-faculty.index',
            compact('columns')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        return view('admin.non-faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'designation' => 'nullable',
            'image' => 'nullable'

        ]);

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('non-faculty', 'public');
        }

        NonFaculty::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'image' => $image,

        ]);

        toast('Non-Faculty Created Successfully', 'success');
        return redirect()->route('admin.non-faculty.index');
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
        $nonFaculty = NonFaculty::findOrFail($id);

        return view(
            'admin.non-faculty.create',
            compact('nonFaculty')
        );
    }

    public function update(Request $request, $id)
    {
        $nonFaculty = NonFaculty::findOrFail($id);

        $image = $nonFaculty->image;

        if ($request->hasFile('image')) {

            if (
                $nonFaculty->image &&
                Storage::disk('public')->exists($nonFaculty->image)
            ) {
                Storage::disk('public')->delete($nonFaculty->image);
            }

            $image = $request->file('image')
                ->store('non-faculty', 'public');
        }

        $nonFaculty->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'image' => $image,

        ]);

        toast('Non-Faculty Updated Successfully', 'success');
        return redirect()
            ->route('admin.non-faculty.index');
    }

    public function destroy($id)
    {
        $nonFaculty = NonFaculty::findOrFail($id);

        if (
            $nonFaculty->image &&
            Storage::disk('public')->exists($nonFaculty->image)
        ) {
            Storage::disk('public')->delete($nonFaculty->image);
        }

        $nonFaculty->delete();

      toast('Non-Faculty Deleted Successfully', 'success');
        return back();
    }
}

