@extends('college-admin::admin.includes.master')

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
       {{ __('college-admin::messages.notices') }}
    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-transparent border-0 d-flex justify-content-end py-4">

            <a
                href="{{ route('admin.notice.create') }}"
                class="btn btn-warning rounded-pill px-4 fw-semibold shadow-sm"
            >

                <i class="bi bi-plus-circle me-2"></i>

             {{ __('college-admin::messages.add_notices') }}

            </a>

        </div>

        <div class="card-body">

            <x-data-table
                id="notice-table"
                :columns="$columns"
                :ajax="route('admin.notice.index')"
            />

        </div>

    </div>

</section>

@endsection
