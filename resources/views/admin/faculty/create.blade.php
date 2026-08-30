@extends('college-admin::admin.includes.master')
@section('title', isset($faculty) ? 'Edit Faculty' : 'Add Faculty')

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

{{ __('college-admin::messages.add_faculty') }}

    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <form
                action="{{ isset($faculty)
                    ? route('admin.faculty.update',$faculty->id)
                    : route('admin.faculty.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if(isset($faculty))
                    @method('PUT')
                @endif

                <div class="row">

                    <div class="col-md-4 mb-4">

                        <x-select-box
                            label="Department"
                            name="department_id"
                            :options="$departments"
                            optionValue="id"
                            optionLabel="department_name"
                            :selected="old('department_id',$faculty->department_id ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-select-box
                            label="Subject"
                            name="subject_department_id"
                            :options="$subjects"
                            optionValue="id"
                            optionLabel="subject_name"
                            :selected="old('subject_department_id',$faculty->subject_department_id ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Faculty Name"
                            name="name"
                            type="text"
                            :value="old('name',$faculty->name ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Email"
                            name="email"
                            type="email"
                            :value="old('email',$faculty->email ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Phone"
                            name="phone"
                            type="text"
                            :value="old('phone',$faculty->phone ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Designation"
                            name="designation"
                            type="text"
                            :value="old('designation',$faculty->designation ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-select-box
                            label="Status"
                            name="status"
                            :options="[
                                'Active',
                                'Inactive'
                            ]"
                            :selected="old('status',$faculty->status ?? '')"
                        />

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Profile Image"
                            name="profile_image"
                            type="file"
                        />

                        @if(isset($faculty) && $faculty->profile_image)

                            <img
                                src="{{ asset('storage/'.$faculty->profile_image) }}"
                                width="120"
                                class="rounded mt-3"
                            >

                        @endif

                    </div>

                    <div class="col-md-4 mb-4">

                        <x-input-box
                            label="Resume"
                            name="resume"
                            type="file"
                            :value="old('resume',$faculty->resume ?? '')"
                        />

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning
                    rounded-pill
                    px-5
                    fw-semibold"
                >

                    {{ isset($faculty)
                        ? 'Update Faculty'
                        : 'Save Faculty'
                    }}

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
