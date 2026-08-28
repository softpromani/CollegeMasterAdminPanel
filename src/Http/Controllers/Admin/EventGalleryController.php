<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Event;
use CollegeAdmin\Models\EventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EventGalleryController extends Controller
{
   public function index(Request $request,$eventId)
    {
        $event = Event::findOrFail($eventId);

        if($request->ajax())
        {
            $gallery = EventGallery::where(
                'event_id',
                $eventId
            )->latest();

            return DataTables::of($gallery)

                ->addIndexColumn()

                ->addColumn('image',function($row){

                    return '

                        <img
                            src="'.asset('storage/'.$row->image).'"
                              width="100"
                            height="100"
                            class=" rounded object-fit-cover""
                        >

                    ';
                })

                ->addColumn('action',function($row){

                    return '

                        <form
                            action="'.route('admin.event.gallery.destroy',$row->id).'"
                            method="POST"

                            onsubmit="return confirm(
                                \'Delete this image?\'
                            )"
                        >

                            '.csrf_field().'

                            '.method_field('DELETE').'

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
                'data'=>'image',
                'name'=>'image',
                'title'=>'Photo',
                'searchable'=>false,
                'orderable'=>false
            ],

            [
                'data'=>'created_at',
                'name'=>'created_at',
                'title'=>'Created At'
            ],

            [
                'data'=>'action',
                'name'=>'action',
                'title'=>'Action',
                'searchable'=>false,
                'orderable'=>false
            ],

        ];

        return view('college-admin::admin.event.gallery',
            compact(
                'event',
                'columns'
            )
        );
    }

public function store(Request $request)
{
    $request->validate([
        'event_id' => 'required',
        'images' => 'required|array',
        'images.*' => 'image',
    ]);

    if ($request->hasFile('images')) {
        foreach($request->file('images') as $image)
        {
            $path = $image->store('event-gallery','public');

            EventGallery::create([
                'event_id' => $request->event_id,
                'image' => $path
            ]);
        }
    }

    toast('Image uploaded', 'success');
    return back();
}

public function destroy($id)
{
    $gallery = EventGallery::findOrFail($id);

    Storage::disk('public')
        ->delete($gallery->image);

    $gallery->delete();

    toast('Image Deleted Successfully', 'success');
    return back();
}
}
