@extends('college-admin::admin.includes.master')

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

      {{ __('messages.department') }}
    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <div class="d-flex justify-content-end mb-3">

                <a
                    href="{{ route('admin.department.create') }}"
                    class="btn btn-warning rounded-pill px-4"
                >

                    <i class="bi bi-plus-circle me-2"></i>

                    {{ __('messages.add_department') }}
                </a>

            </div>

            <x-data-table
                id="departmentTable"
                :columns="$columns"
                :ajax="route('admin.department.index')"
            />

        </div>

    </div>

</section>

@endsection
