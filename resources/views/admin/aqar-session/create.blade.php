@extends('college-admin::admin.includes.master')

@section('title')
    {{ isset($aqar) ? 'Edit AQAR' : 'Add AQAR' }}
@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

        {{ isset($aqar)
            ? 'Edit AQAR'
            : 'Create AQAR Session' }}

    </h1>

</div>

<section class="section">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body mt-4">

<form
    action="{{ isset($aqar)
        ? route('admin.aqar-session.update',$aqar->id)
        : route('admin.aqar-session.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    @if(isset($aqar))
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-4 mb-4">

            <x-select-box
                label="Session"
                name="session"
                :options="[
                    '2016-17',
                    '2017-18',
                    '2018-19',
                    '2019-20',
                    '2020-21',
                    '2021-22',
                    '2022-23',
                    '2023-24',
                    '2024-25',
                    '2025-26'
                ]"
                :selected="old('session',$aqar->session ?? '')"
            />

        </div>

        <div class="col-md-4 mb-4">

            <x-input-box
                label="Title"
                name="title"
                type="text"
                placeholder="Enter Title"
                :value="old('title',$aqar->title ?? '')"
            />

        </div>

        <div class="col-md-4 mb-4">

            <x-input-box
                label="Upload PDF"
                name="file"
                type="file"
            />

            @if(isset($aqar))

                <a
                    href="{{ asset('storage/'.$aqar->file) }}"
                    target="_blank"
                    class="btn btn-sm btn-warning mt-2">

                    View Current PDF

                </a>

            @endif

        </div>

    </div>

    <button
        type="submit"
        class="btn btn-warning rounded-pill px-5">

        {{ isset($aqar)
            ? 'Update AQAR'
            : 'Save AQAR' }}

    </button>

</form>

</div>

</div>

</section>

@endsection
