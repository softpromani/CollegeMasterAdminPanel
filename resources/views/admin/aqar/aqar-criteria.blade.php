@extends('college-admin::admin.includes.master')
@section('title', 'AQAR Criteria')

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

      {{ __('college-admin::messages.add_aqar') }}

    </h1>

</div>

<section class="section">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body mt-4">

<form
    action="{{ route('admin.aqar-criteria.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    <input
        type="hidden"
        name="aqar_id"
        value="{{ $aqarId }}"
    >

    <div class="row">

        <div class="col-md-6 mb-4">

            <x-input-box
                label="Criteria Name"
                name="criteria_name"
                type="text"
            />

        </div>

        <div class="col-md-6 mb-4">

            <x-input-box
                label="File"
                name="criteria_data"
                type="file"
            />

        </div>

    </div>

    <button
        type="submit"
        class="btn btn-warning rounded-pill px-5"
    >

        Save Criteria

    </button>

</form>

<hr class="my-4">

<x-data-table
    id="criteria-table"
    :columns="$columns"
    :ajax="route(
        'admin.aqar-criteria.index',
        ['aqar_id'=>$aqarId]
    )"
/>

</div>

</div>

</section>

@endsection
