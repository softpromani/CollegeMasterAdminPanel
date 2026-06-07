<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AQARSessionWise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AQARSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        if ($request->ajax()) {

            $aqars = AQARSessionWise::latest();

            return DataTables::of($aqars)

                ->addIndexColumn()

                ->editColumn('file', function ($row) {

                    return '
                        <a href="' . asset('storage/' . $row->file) . '"
                            target="_blank"
                            class="btn btn-sm btn-warning">

                            View File

                        </a>
                    ';
                })

                ->addColumn('action', function ($row) {

                    return '

                        <div class="d-flex gap-2">

                            <a href="' . route('admin.aqar-session.edit', $row->id) . '"
                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form
                                action="' . route('admin.aqar-session.destroy', $row->id) . '"
                                method="POST"
                                onsubmit="return confirm(\'Delete AQAR?\')"
                            >

                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '

                                <button
                                    class="btn btn-danger btn-sm">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>
                    ';
                })

                ->rawColumns(['file', 'action'])

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
                'data' => 'session',
                'name' => 'session',
                'title' => 'Session'
            ],

            [
                'data' => 'title',
                'name' => 'title',
                'title' => 'Title'
            ],

            [
                'data' => 'file',
                'name' => 'file',
                'title' => 'File',
                'searchable' => false,
                'orderable' => false
            ],

            [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => 'Created At'
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
            'admin.aqar-session.index',
            compact('columns')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aqar-session.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'session' => 'required',
            'title' => 'nullable',
            'file' => 'nullable'

        ]);

        $file = $request->file('file')
            ->store('aqar', 'public');

        AQARSessionWise::create([

            'session' => $request->session,
            'title' => $request->title,
            'file' => $file

        ]);

        toast('AQAR-Session Created Successfully', 'success');
        return redirect()
            ->route('admin.aqar-session.index');
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
        $aqar = AQARSessionWise::findOrFail($id);

        return view(
            'admin.aqar-session.create',
            compact('aqar')
        );
    }

    public function update(Request $request, $id)
    {
        $aqar = AQARSessionWise::findOrFail($id);

        $request->validate([

            'session' => 'required',
            'title' => 'required'

        ]);

        $file = $aqar->file;

        if ($request->hasFile('file')) {

            Storage::disk('public')
                ->delete($aqar->file);

            $file = $request->file('file')
                ->store('aqar', 'public');
        }

        $aqar->update([

            'session' => $request->session,
            'title' => $request->title,
            'file' => $file

        ]);

        toast('AQAR-Session updated Successfully', 'success');
        return redirect()
            ->route('admin.aqar.index');
    }

    public function destroy($id)
    {
        $aqar = AQARSessionWise::findOrFail($id);

        Storage::disk('public')
            ->delete($aqar->file);

        $aqar->delete();

        toast('AQAR-Session Deleted Successfully', 'success');
        return redirect()
            ->back();
    }
}

