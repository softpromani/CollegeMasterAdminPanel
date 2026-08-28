<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use CollegeAdmin\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('college-admin::admin.contacts.index', compact('contacts'));
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