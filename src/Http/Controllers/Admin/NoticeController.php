<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    if ($request->ajax()) {

        $notices = Notice::latest();

        return DataTables::of($notices)

            ->addIndexColumn()

            ->editColumn('filename', function ($row) {

                // FILE TYPE
                if ($row->type == 'file') {

                    return '
                        <a href="' . asset('storage/' . $row->filename) . '"
                            target="_blank"
                            class="btn btn-sm btn-info">

                            View File

                        </a>
                    ';
                }

                // LINK TYPE
                if ($row->type == 'link') {

                    return '
                        <a href="' . $row->filename . '"
                            target="_blank"
                            class="btn btn-sm btn-primary">

                            Open Link

                        </a>
                    ';
                }

                return '-';
            })

            ->editColumn('created_at', function ($row) {

                return $row->created_at
                    ? $row->created_at->format('d M Y')
                    : '-';
            })

            ->addColumn('action', function ($row) {

                return '

                    <div class="d-flex gap-2">

                        <a href="' . route('admin.notice.edit', $row->id) . '"

                            class="btn btn-sm btn-warning d-flex align-items-center justify-content-center">

                            <i class="bi bi-pencil"></i>

                        </a>

                        <form
                            action="' . route('admin.notice.destroy', $row->id) . '"
                            method="POST"

                            onsubmit="return confirm(\'Are you sure want to delete?\')"
                        >

                            ' . csrf_field() . '

                            ' . method_field('DELETE') . '

                            <button
                                type="submit"

                                class="btn btn-sm btn-danger d-flex align-items-center justify-content-center">

                                <i class="bi bi-trash"></i>

                            </button>

                        </form>

                    </div>
                ';
            })

            ->rawColumns(['action', 'filename'])

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
            'data' => 'title',
            'name' => 'title',
            'title' => 'Title',
        ],

        [
            'data' => 'category',
            'name' => 'category',
            'title' => 'Category',
        ],



        [
            'data' => 'filename',
            'name' => 'filename',
            'title' => 'File / Link',
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

    return view('college-admin::admin.notice.index',
        compact('columns')
    );
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('college-admin::admin.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([

        'title' => 'required',

        'category' => 'required',

        'type' => 'required',

        'file' => 'nullable|file',

        'link' => 'nullable',

    ]);

    $filename = null;

    // FILE SAVE
    if ($request->type == 'file' && $request->hasFile('file')) {

        $filename = $request->file('file')
            ->store('notice', 'public');
    }

    // LINK SAVE
    if ($request->type == 'link') {

        $filename = $request->link;
    }

    Notice::create([

        'title' => $request->title,

        'category' => $request->category,

        'type' => $request->type,

        'filename' => $filename,

    ]);

    toast('Notice Created Successfully', 'success');
    return redirect()
        ->route('admin.notice.index');
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
        $notice = Notice::findOrFail($id);

        return view('college-admin::admin.notice.create', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $notice = Notice::findOrFail($id);

    $request->validate([

        'title' => 'required',

        'category' => 'required',

        'type' => 'required',

        'file' => 'nullable|file',

        'link' => 'nullable',

    ]);

    $filename = $notice->filename;

    // FILE TYPE
    if ($request->type == 'file') {

        if ($request->hasFile('file')) {

            if (
                $notice->filename &&
                Storage::disk('public')->exists($notice->filename)
            ) {

                Storage::disk('public')
                    ->delete($notice->filename);
            }

            $filename = $request->file('file')
                ->store('notice', 'public');
        }
    }

    // LINK TYPE
    if ($request->type == 'link') {

        // old file delete
        if (
            $notice->type == 'file' &&
            $notice->filename &&
            Storage::disk('public')->exists($notice->filename)
        ) {

            Storage::disk('public')
                ->delete($notice->filename);
        }

        $filename = $request->link;
    }

    $notice->update([

        'title' => $request->title,

        'category' => $request->category,

        'type' => $request->type,

        'filename' => $filename,

    ]);

    toast('Notice Updated Successfully', 'success');
    return redirect()
        ->route('admin.notice.index');
}

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        if ($notice->type == 'file' && !empty($notice->filename) && Storage::disk('public')->exists($notice->filename)) {
            Storage::disk('public')->delete($notice->filename);
        }

        $notice->delete();

        toast('Notice Deleted Successfully', 'success');
        return redirect()->route('admin.notice.index');
    }
}
