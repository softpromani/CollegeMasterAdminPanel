@extends('admin.includes.master')

@section('header-area')
    <style>
        .card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">

        <h1 class="fw-bold">
         {{ __('messages.add_users') }}
        </h1>

        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.user.index') }}">
                        Users
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    {{ isset($user) ? 'Edit' : 'Create' }}
                </li>

            </ol>
        </nav>

    </div>

    <section class="section">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body mt-4">

                <form
                    action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @if (isset($user))
                        @method('PUT')
                    @endif

                    <div class="row align-items-end">

                        <!-- First Name -->
                        <div class="col-md-4 mb-4">

                            <x-input-box
                                label="First Name"
                                name="first_name"
                                type="text"
                                placeholder="Enter First Name"
                                :value="old('first_name', $user->first_name ?? '')"
                            />

                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4 mb-4">

                            <x-input-box
                                label="Last Name"
                                name="last_name"
                                type="text"
                                placeholder="Enter Last Name"
                                :value="old('last_name', $user->last_name ?? '')"
                            />

                        </div>

                        <!-- Email -->
                        <div class="col-md-4 mb-4">

                            <x-input-box
                                label="Email"
                                name="email"
                                type="email"
                                placeholder="Enter Email Address"
                                :value="old('email', $user->email ?? '')"
                            />

                        </div>

                        <!-- Phone -->
                        <div class="col-md-4 mb-4">

                            <x-input-box
                                label="Phone"
                                name="phone"
                                type="number"
                                placeholder="Enter Phone Number"
                                :value="old('phone', $user->phone ?? '')"
                            />

                        </div>

                        <!-- Role -->
                        <div class="col-md-4 mb-4">

                            <x-select-box
                                label="Select Role"
                                name="role"
                                :options="$roles->map(fn($role) => [
                                    'id' => $role->id,
                                    'name' => $role->name,
                                ])->toArray()"
                                optionValue="id"
                                optionLabel="name"
                                :selected="old('role', $user->role_id ?? '')"
                            />

                        </div>

                        <!-- Image -->
                        <div class="col-md-4 mb-4">

                            <x-input-box
                                label="Image"
                                name="image"
                                type="file"
                            />

                            @if (isset($user) && $user->image)

                                <div class="mt-2">

                                    <img
                                        src="{{ asset('storage/' . $user->image) }}"
                                        width="60"
                                        height="60"
                                        class="rounded-circle object-fit-cover border"
                                    >

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="d-flex gap-3">

                        <button
                            type="submit"
                            class="btn btn-warning rounded-pill px-5 shadow-sm fw-semibold"
                        >

                            <i class="bi bi-check-circle me-2"></i>

                            {{ isset($user) ? 'Update User' : 'Save User' }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>
@endsection
