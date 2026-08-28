@extends('college-admin::admin.includes.master')

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">
       {{ __('college-admin::messages.aqar') }}
    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div
            class="card-header
            bg-transparent
            border-0
            d-flex
            justify-content-end
            py-4"
        >

            <a
                href="{{ route('admin.aqar.create') }}"
                class="btn btn-warning rounded-pill px-4"
            >

              {{ __('college-admin::messages.add_aqar') }}

            </a>

        </div>

        <div class="card-body">

            <x-data-table
                id="aqar-table"
                :columns="$columns"
                :ajax="route('admin.aqar.index')"
            />

        </div>

    </div>

</section>

@endsection
