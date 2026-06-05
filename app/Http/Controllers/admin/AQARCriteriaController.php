<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AQARCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AQARCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
    {
        $aqarId = $request->aqar_id;

        if ($request->ajax()) {

            $criterias = AQARCriteria::where(
                'aqar_id',
                $aqarId
            )->latest();

            return DataTables::of($criterias)

                ->addIndexColumn()

                ->addColumn('file', function ($row) {

                    if ($row->criteria_data) {

                        return '
                            <a
                                href="' . asset('storage/' . $row->criteria_data) . '"
                                target="_blank"
                                class="btn btn-info btn-sm"
                            >
                                View File
                            </a>
                        ';
                    }

                    return '-';
                })

                ->addColumn('action', function ($row) {

                    return '

                        <a
                            href="' .
                            route(
                                'admin.aqar-criteria.edit',
                                $row->id
                            ) .
                            '"
                            class="btn btn-warning btn-sm"
                        >
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form
                            action="' .
                            route(
                                'admin.aqar-criteria.destroy',
                                $row->id
                            ) .
                            '"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm(\'Delete this record?\')"
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

                    ';
                })

                ->rawColumns([
                    'file',
                    'action'
                ])

                ->make(true);
        }

        $columns = [

            [
                'data' => 'DT_RowIndex',
                'title' => 'No',
                'searchable' => false,
                'orderable' => false
            ],

            [
                'data' => 'criteria_name',
                'title' => 'Criteria Name'
            ],

            [
                'data' => 'file',
                'title' => 'File'
            ],

            [
                'data' => 'action',
                'title' => 'Action',
                'searchable' => false,
                'orderable' => false
            ],

        ];

        return view(
            'admin.aqar.aqar-criteria',
            compact(
                'columns',
                'aqarId'
            )
        );
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
        $request->validate([
            'criteria_name' => 'required'
        ]);

        $file = null;

        if ($request->hasFile('criteria_data')) {

            $file = $request
                ->file('criteria_data')
                ->store(
                    'aqar-criteria',
                    'public'
                );
        }

        AQARCriteria::create([

            'aqar_id'       => $request->aqar_id,

            'criteria_name' => $request->criteria_name,

            'criteria_data' => $file

        ]);

        return back()->with(
            'success',
            'Criteria Added Successfully'
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
        $criteria = AQARCriteria::findOrFail($id);

        $columns = [

            [
                'data' => 'DT_RowIndex',
                'title' => 'No'
            ],

            [
                'data' => 'criteria_name',
                'title' => 'Criteria Name'
            ],

            [
                'data' => 'file',
                'title' => 'File'
            ],

            [
                'data' => 'action',
                'title' => 'Action'
            ]
        ];

        return view(
            'admin.aqar.aqar-criteria',
            compact(
                'criteria',
                'columns'
            )
        );
    }


    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
    {
        $criteria = AQARCriteria::findOrFail($id);

        $request->validate([
            'criteria_name' => 'required'
        ]);

        $file = $criteria->criteria_data;

        if ($request->hasFile('criteria_data')) {

            if (
                $criteria->criteria_data &&
                Storage::disk('public')->exists(
                    $criteria->criteria_data
                )
            ) {
                Storage::disk('public')->delete(
                    $criteria->criteria_data
                );
            }

            $file = $request
                ->file('criteria_data')
                ->store(
                    'aqar-criteria',
                    'public'
                );
        }

        $criteria->update([

            'criteria_name' => $request->criteria_name,

            'criteria_data' => $file

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Criteria Updated Successfully'
            );
    }

    public function destroy($id)
    {
        $criteria = AQARCriteria::findOrFail($id);

        if (
            $criteria->criteria_data &&
            Storage::disk('public')->exists(
                $criteria->criteria_data
            )
        ) {
            Storage::disk('public')->delete(
                $criteria->criteria_data
            );
        }

        $criteria->delete();

        return back()->with(
            'success',
            'Criteria Deleted Successfully'
        );
    }

}
