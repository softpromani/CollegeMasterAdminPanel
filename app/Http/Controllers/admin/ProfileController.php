<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profile');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;
    $user->email      = $request->email;
    $user->phone      = $request->phone;

if ($request->hasFile('image')) {

    if ($user->image &&
        Storage::disk('public')->exists($user->image)) {

        Storage::disk('public')->delete($user->image);
    }

    $user->image = $request
        ->file('image')
        ->store('users', 'public');
}

    $user->save();

    return back()->with('success','Profile updated successfully.');
}


public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required'
    ]);

    $user = Auth::user();

    if (!Hash::check(
        $request->current_password,
        $user->password
    )) {

        return back()->with(
            'error',
            'Current password is incorrect.'
        );
    }

    $user->password = Hash::make(
        $request->password
    );

    $user->save();

    return back()->with(
        'success',
        'Password changed successfully.'
    );
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
