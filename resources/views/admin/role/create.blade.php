@extends('admin.includes.master')

@section('header-area')

<style>

    .card{
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(12px);
    }

</style>

@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">
       {{ __('messages.add_role') }}
    </h1>

    <nav>

        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li class="breadcrumb-item active">
                Roles
            </li>

        </ol>

    </nav>

</div>

   <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body mt-4">


<form
    action="{{ isset($role)
        ? route('admin.roles.update', $role->id)
        : route('admin.roles.store') }}"

    method="POST"
>

    @csrf

    @if(isset($role))

        @method('PUT')

    @endif

    <div class="row align-items-end">

        <div class="col-md-4">

            <x-input-box
                label="Role Name"
                name="role"
                type="text"
                placeholder="Enter Role Name"

                :value="old(
                    'role',
                    $role->name ?? ''
                )"
            />

        </div>

        <div class="col-md-2">

            <button
                type="submit"

                class="btn btn-warning rounded-pill px-5 shadow-sm fw-semibold"
            >



                {{ isset($role) ? 'Update' : 'Save' }}

            </button>

        </div>

    </div>

</form>



        </div>

    </div>


@endsection
