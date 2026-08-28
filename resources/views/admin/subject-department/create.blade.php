@extends('college-admin::admin.includes.master')

@section('header-area')
    <style>
        .card {
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(12px);
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">

        <h1 class="fw-bold">

          {{ __('messages.add_subject') }}
        </h1>

        <nav>

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="{{ route('admin.subject-department.index') }}">
                        Subject Department
                    </a>

                </li>

                <li class="breadcrumb-item active">

                    {{ isset($subject) ? 'Edit' : 'Create' }}

                </li>

            </ol>

        </nav>

    </div>

    <section class="section">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body mt-4">

                <form action="{{ isset($subject) ? route('admin.subject-department.update', $subject->id)
                        : route('admin.subject-department.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if (isset($subject))
                        @method('PUT')
                    @endif

                    <div class="row align-items-end">

                        <div class="col-md-4 mb-4">

                            <x-select-box label="Department" name="department_id" :options="$departments" optionValue="id"
                                optionLabel="department_name" :selected="old('department_id', $subject->department_id ?? '')" />

                        </div>
                        <div class="col-md-4 mb-4">
                            <x-input-box label="Subject Name" name="subject_name" type="text"
                                placeholder="Enter Subject Name" :value="old('subject_name', $subject->subject_name ?? '')" />

                        </div>
                        <div class="col-md-4 mb-4">
                            <x-input-box label="Subject Image" name="image" type="file" />

                            @if (isset($subject) && $subject->image)
                                <img src="{{ asset('storage/' . $subject->image) }}" width="120" class="rounded mt-3">
                            @endif

                        </div>

                    </div>

                    <button type="submit" class="btn btn-warning rounded-pill px-5 shadow-sm fw-semibold">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ isset($subject) ? 'Update Banner' : 'Save Banner' }}

                    </button>

                </form>

            </div>

        </div>

    </section>
@endsection
