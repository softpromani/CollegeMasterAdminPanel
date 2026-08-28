<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $events = Event::latest();

            return DataTables::of($events)

                ->addIndexColumn()

                ->addColumn('thumbnail', function ($row) {

                    return '
                        <img
                            src="' . asset('storage/' . $row->thumbnail) . '"
                            width="70"
                            height="70"
                            class="rounded object-fit-cover"
                        >
                    ';
                })

                ->addColumn('gallery', function ($row) {

                    return '
                        <a
                            href="' . route('admin.event.gallery', $row->id) . '"
                            class="btn btn-info btn-sm"
                        >
                            View Upload Image
                        </a>
                    ';
                })

                ->addColumn('action', function ($row) {

                    return '
                        <div class="d-flex gap-2">

                            <a
                                href="' . route('admin.event.edit', $row->id) . '"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form
                                action="' . route('admin.event.destroy', $row->id) . '"
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
                    'thumbnail',
                    'gallery',
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
                'data' => 'thumbnail',
                'name' => 'thumbnail',
                'title' => 'Thumbnail',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'event_name',
                'name' => 'event_name',
                'title' => 'Event Name',
            ],

            [
                'data' => 'gallery',
                'name' => 'gallery',
                'title' => 'Gallery',
                'searchable' => false,
                'orderable' => false,
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
            'admin.event.index',
            compact('columns')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('college-admin::admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([

        'event_name' => 'required',

        'thumbnail' => 'nullable'

    ]);

    $thumbnail = $request
        ->file('thumbnail')
        ->store('events','public');

    Event::create([

        'event_name' => $request->event_name,

        'thumbnail' => $thumbnail

    ]);

    toast('Event Created Successfully', 'success');
    return redirect()->route('admin.event.index');
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
        $event = Event::findOrFail($id);

        return view(
            'admin.event.create',
            compact('event')
        );
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request,$id)
{
    $event = Event::findOrFail($id);

    $request->validate([

        'event_name' => 'required',

        'thumbnail' => 'nullable|image'

    ]);

    $thumbnail = $event->thumbnail;

    if($request->hasFile('thumbnail'))
    {
        Storage::disk('public')
            ->delete($event->thumbnail);

        $thumbnail = $request
            ->file('thumbnail')
            ->store('events','public');
    }

    $event->update([

        'event_name' => $request->event_name,

        'thumbnail' => $thumbnail

    ]);

    toast('Event Updated Successfully', 'success');
    return redirect()->route('admin.event.index');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $event = Event::findOrFail($id);

    if($event->thumbnail)
    {
        Storage::disk('public')
            ->delete($event->thumbnail);
    }

    $event->delete();

    toast('Event Deleted Successfully', 'success');
    return back();
}
}
