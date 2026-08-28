<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::latest();

            return DataTables::of($contacts)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status === 'unread') {
                        return '<span class="badge bg-danger rounded-pill px-3 py-1">New Unread</span>';
                    }
                    return '<span class="badge bg-secondary rounded-pill px-3 py-1">Read</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d M, Y h:i A') : '-';
                })
                ->addColumn('action', function ($row) {
                    $escapedName = htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8');
                    $escapedEmail = htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8');
                    $escapedSubject = htmlspecialchars($row->subject ?? 'Contact Inquiry', ENT_QUOTES, 'UTF-8');
                    $escapedMessage = htmlspecialchars(str_replace(["\r", "\n"], ' ', $row->message), ENT_QUOTES, 'UTF-8');
                    $date = $row->created_at ? $row->created_at->format('d M, Y h:i A') : 'Recently';

                    return '
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3"
                                onclick="viewMessage(' . $row->id . ', \'' . $escapedName . '\', \'' . $escapedEmail . '\', \'' . $escapedSubject . '\', \'' . $escapedMessage . '\', \'' . $date . '\')">
                                <i class="bi bi-eye me-1"></i> View
                            </button>
                            <form action="' . route('admin.contact-inquiries.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this message?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-2">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'orderable' => false, 'searchable' => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Sender Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email Address'],
            ['data' => 'subject', 'name' => 'subject', 'title' => 'Subject'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Received Date'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
        ];

        return view('college-admin::admin.contacts.index', compact('columns'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }
        return response()->json([
            'status' => 'success',
            'data' => $contact
        ]);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->back()->with('success', 'Inquiry deleted successfully.');
    }
}