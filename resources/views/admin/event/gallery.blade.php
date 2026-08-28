@extends('college-admin::admin.includes.master')
@section('title', 'Event Gallery')

@section('header-area')

<style>

.card{
    background: rgba(255,255,255,.75);
    backdrop-filter: blur(12px);
}

.gallery-img{
    width:120px;
    height:90px;
    object-fit:cover;
    border-radius:10px;
}

</style>

@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

       {{ __('college-admin::messages.gallery') }}

    </h1>

    <nav>
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="#">
                    Dashboard
                </a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('admin.event.index') }}">
                    Events
                </a>
            </li>

            <li class="breadcrumb-item active">

                Gallery

            </li>

        </ol>
    </nav>

</div>

<section class="section">

    {{-- Upload Card --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body mt-4">

            <h4 class="fw-bold mb-4">

                Upload Photos In

                {{ $event->event_name }}

            </h4>

            <form
                action="{{ route('admin.event.gallery.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <input
                    type="hidden"
                    name="event_id"
                    value="{{ $event->id }}"
                >

                <div class="row align-items-end">

                    <div class="col-md-6">

                        <x-input-box
                            label="Upload Photos"
                            name="images[]"
                            type="file"
                            multiple
                        />

                    </div>

                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-warning rounded-pill px-5"
                        >

                            Upload

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Datatable Card --}}

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <x-data-table
                id="galleryTable"
                :columns="$columns"
                :ajax="route('admin.event.gallery',$event->id)"
            />

        </div>

    </div>

</section>

@endsection
