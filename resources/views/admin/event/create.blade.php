@extends('admin.includes.master')

@section('header-area')

<style>

.card{
    background: rgba(255,255,255,.75);
    backdrop-filter: blur(12px);
}

</style>

@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

        {{ isset($event) ? 'Edit Event' : 'Create Event' }}

    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <form
                action="{{ isset($event)
                    ? route('admin.event.update',$event->id)
                    : route('admin.event.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if(isset($event))
                    @method('PUT')
                @endif

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <x-input-box
                            label="Event Name"
                            name="event_name"
                            type="text"
                            placeholder="Enter Event Name"
                            :value="old('event_name',$event->event_name ?? '')"
                        />

                    </div>

                    <div class="col-md-6 mb-4">

                        <x-input-box
                            label="Thumbnail"
                            name="thumbnail"
                            type="file"
                        />

                             @if(isset($event))

                    <img
                        src="{{ asset('storage/'.$event->thumbnail) }}"
                        width="120"
                        class="rounded mb-3"
                    >

                @endif

                    </div>

                </div>



                <button
                    type="submit"
                    class="btn btn-warning rounded-pill px-5"
                >

                    {{ isset($event)
                        ? 'Update Event'
                        : 'Save Event' }}

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
