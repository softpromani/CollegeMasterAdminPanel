<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $banners = Banner::latest();

            return DataTables::of($banners)

                ->addIndexColumn()

                ->addColumn('image', function ($row) {

                    return '
                    <img
                        src="' . asset('storage/' . $row->image) . '"
                        width="80"
                        class="rounded"
                    >
                ';
                })

                ->addColumn('action', function ($row) {

                    return '

                    <div class="d-flex gap-2">

                        <a
                            href="' . route('admin.banner.edit', $row->id) . '"
                            class="btn btn-sm btn-warning">

                            <i class="bi bi-pencil"></i>

                        </a>

                        <form
                            action="' . route('admin.banner.destroy', $row->id) . '"
                            method="POST"
                            onsubmit="return confirm(\'Are you sure want to delete?\')"
                        >

                            ' . csrf_field() . '

                            ' . method_field('DELETE') . '

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger">

                                <i class="bi bi-trash"></i>

                            </button>

                        </form>

                    </div>
                ';
                })

                ->rawColumns(['image', 'action'])

                ->make(true);
        }

        $columns = [

            [
                'data' => 'DT_RowIndex',
                'title' => 'No',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'image',
                'title' => 'Banner',
                'searchable' => false,
                'orderable' => false,
            ],

            [
                'data' => 'title_1',
                'title' => 'Title 1',
            ],

            [
                'data' => 'title_2',
                'title' => 'Title 2',
            ],

            [
                'data' => 'url',
                'title' => 'URL',
            ],

            [
                'data' => 'action',
                'title' => 'Action',
                'searchable' => false,
                'orderable' => false,
            ],
        ];

        return view('college-admin::admin.banner.index', compact('columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('college-admin::admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'title_1' => 'required',

            'image' => 'nullable',

        ]);

        $image = $request->file('image')
            ->store('banner', 'public');

        Banner::create([

            'title_1' => $request->title_1,

            'title_2' => $request->title_2,

            'url' => $request->url,

            'image' => $image,

        ]);

        toast('Banner Created Successfully', 'success');


        return redirect()
            ->route('admin.banner.index');
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
        $banner = Banner::findOrFail($id);

        return view(
            'admin.banner.create',
            compact('banner')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([

            'title_1' => 'required',

            'image' => 'nullable|image',

        ]);

        $image = $banner->image;

        if ($request->hasFile('image')) {

            if (
                $banner->image &&
                Storage::disk('public')->exists($banner->image)
            ) {

                Storage::disk('public')
                    ->delete($banner->image);
            }

            $image = $request->file('image')
                ->store('banner', 'public');
        }

        $banner->update([

            'title_1' => $request->title_1,

            'title_2' => $request->title_2,

            'url' => $request->url,

            'image' => $image,

        ]);

        toast('Banner updated Successfully', 'success');

        return redirect()
            ->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if (
            $banner->image &&
            Storage::disk('public')->exists($banner->image)
        ) {

            Storage::disk('public')
                ->delete($banner->image);
        }

        $banner->delete();

        toast('Banner Deleted Successfully', 'success');
        return redirect()->route('admin.banner.index');
    }
}
