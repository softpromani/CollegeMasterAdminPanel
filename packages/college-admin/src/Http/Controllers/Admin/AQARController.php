<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\AQAR;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AQARController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $aqars = AQAR::latest();

            return DataTables::of($aqars)

                ->addIndexColumn()

                ->addColumn('criteria', function ($row) {

                    return '
                        <a
                            href="' . route(
                        'admin.aqar-criteria.index',
                        ['aqar_id' => $row->id]
                    ) . '"

                            class="btn btn-sm btn-info"
                        >

                            View Criteria

                        </a>
                    ';
                })

                ->addColumn('action', function ($row) {

                    return '

                        <div class="d-flex gap-2">

                            <a
                                href="' . route(
                        'admin.aqar.edit',
                        $row->id
                    ) . '"

                                class="btn btn-sm btn-warning
                                d-flex
                                align-items-center
                                justify-content-center"
                            >

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form
                                action="' . route(
                        'admin.aqar.destroy',
                        $row->id
                    ) . '"

                                method="POST"

                                onsubmit="return confirm(
                                    \'Are you sure want to delete?\'
                                )"
                            >

                                ' . csrf_field() . '

                                ' . method_field('DELETE') . '

                                <button
                                    type="submit"

                                    class="btn btn-sm btn-danger
                                    d-flex
                                    align-items-center
                                    justify-content-center"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>
                    ';
                })

                ->rawColumns([
                    'criteria',
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
                'data' => 'name',
                'name' => 'name',
                'title' => 'AQAR Name',
            ],

            [
                'data' => 'criteria',
                'name' => 'criteria',
                'title' => 'Criteria',
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

        return view(
            'admin.aqar.index',
            compact('columns')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('college-admin::admin.aqar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255'

        ]);

        AQAR::create([

            'name' => $request->name

        ]);

        toast('AQAR Created Successfully', 'success');
        return redirect()
            ->route('admin.aqar.index');
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
        $aqar = AQAR::findOrFail($id);

        return view(
            'admin.aqar.create',
            compact('aqar')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        string $id
    ) {
        $request->validate([

            'name' => 'required|max:255'

        ]);

        $aqar = AQAR::findOrFail($id);

        $aqar->update([

            'name' => $request->name

        ]);

        toast('AQAR Updated Successfully', 'success');
        return redirect()
            ->route('admin.aqar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aqar = AQAR::findOrFail($id);

        $aqar->delete();
        toast('AQAR Deleted Successfully', 'success');
        return redirect()->route( 'admin.aqar.index' );
    }
}
