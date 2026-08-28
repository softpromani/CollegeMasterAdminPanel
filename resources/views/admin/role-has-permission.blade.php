@extends('college-admin::admin.includes.master')
@section('title', 'Role Permission Matrix')

@section('header-area')

<style>

    .card{
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(12px);
    }

    .permission-box{

        border:1px solid #eee;
        border-radius:20px;
        padding:20px;
        margin-bottom:20px;
        background:#fff;

    }

</style>

@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">
        {{ __('college-admin::messages.role_has_permission') }}
    </h1>

</div>

<section class="section">

    {{-- Select Role --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body mt-4">

            <form action="{{ route('admin.roles.permission') }}"
                method="GET">

                <div class="row align-items-end">

                    <div class="col-md-4">
<x-select-box

    label="Select Role"

    name="role"

    :options="$roles->map(fn($role)=>[
        'id'=>$role->id,
        'name'=>$role->name
    ])->toArray()"

    optionValue="id"

    optionLabel="name"
/>
                    </div>

                    <div class="col-md-2">

                        <button type="submit"
                            class="btn btn-warning rounded-pill px-5">

                            Fetch

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Permissions --}}

    @isset($selectedRole)

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <form action="{{ route('admin.roles.permission.update', $selectedRole->id) }}"
                method="POST">

                @csrf

                <div class="row">

                    @foreach($permissions as $module => $modulePermissions)

                    <div class="col-md-4">

                        <div class="permission-box">

                            <h5 class="fw-bold text-capitalize mb-3">

                                {{ str_replace('_',' ', $module) }}

                            </h5>

                            @foreach($modulePermissions as $permission)

                            <div class="form-check mb-2">

                                <input
                                    type="checkbox"

                                    class="form-check-input"

                                    name="permissions[]"

                                    value="{{ $permission->name }}"

                                    id="{{ $permission->id }}"

                                    {{ $selectedRole->hasPermissionTo($permission->name)
                                        ? 'checked'
                                        : '' }}
                                >

                                <label class="form-check-label"
                                    for="{{ $permission->id }}">

                                    {{ $permission->name }}

                                </label>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    @endforeach

                </div>

                <button type="submit"
                    class="btn btn-warning rounded-pill px-5">

                    Update Permissions

                </button>

            </form>

        </div>

    </div>

    @endisset

</section>

@endsection
