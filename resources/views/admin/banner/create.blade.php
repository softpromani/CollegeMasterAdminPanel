@extends('college-admin::admin.includes.master')
@section('title')
<?php echo isset($banner) ? "Edit Banner" : "Create Banner"; ?>
@endsection

@section('header-area')

<style>

    .card{
        background:rgba(255,255,255,.75);
        backdrop-filter:blur(12px);
    }

</style>

@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

    {{ __('college-admin::messages.add_banner') }}

    </h1>

    <nav>

        <ol class="breadcrumb">

            <li class="breadcrumb-item">

                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>

            </li>

            <li class="breadcrumb-item">

                <a href="{{ route('admin.banner.index') }}">
                    Banner
                </a>

            </li>

            <li class="breadcrumb-item active">

                {{ isset($banner) ? 'Edit' : 'Create' }}

            </li>

        </ol>

    </nav>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <form
                action="{{ isset($banner)
                    ? route('admin.banner.update',$banner->id)
                    : route('admin.banner.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if(isset($banner))
                    @method('PUT')
                @endif

                <div class="row align-items-end">

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Title 1"
                            name="title_1"
                            type="text"
                            placeholder="Enter Title 1"
                            :value="old('title_1',$banner->title_1 ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Title 2"
                            name="title_2"
                            type="text"
                            placeholder="Enter Title 2"
                            :value="old('title_2',$banner->title_2 ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Link (URL)"
                            name="url"
                            type="text"
                            placeholder="Enter URL"
                            :value="old('url',$banner->url ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Banner Image"
                            name="image"
                            type="file"
                        />

                    </div>

                    @if(isset($banner) && $banner->image)

                        <div class="col-md-4 mb-4">

                            <label class="form-label fw-semibold">

                                Current Image

                            </label>

                            <div>

                                <img
                                    src="{{ asset('storage/'.$banner->image) }}"
                                    width="180"
                                    class="img-thumbnail rounded"
                                >

                            </div>

                        </div>

                    @endif

                </div>

                <button
                    type="submit"
                    class="btn btn-warning rounded-pill px-5 shadow-sm fw-semibold"
                >

                    <i class="bi bi-check-circle me-2"></i>

                    {{ isset($banner)
                        ? 'Update Banner'
                        : 'Save Banner'
                    }}

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
