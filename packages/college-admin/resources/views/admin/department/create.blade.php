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

       {{ __('messages.add_department') }}

    </h1>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body mt-4">

            <form
                action="{{ isset($department)
                    ? route('admin.department.update',$department->id)
                    : route('admin.department.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if(isset($department))
                    @method('PUT')
                @endif

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <x-input-box
                            label="Department Name"
                            name="department_name"
                            type="text"
                            placeholder="Enter Department Name"
                            :value="old('department_name',$department->department_name ?? '')"
                        />

                    </div>

                    <div class="col-md-6 mb-4">

                        <x-input-box
                            label="Department Image"
                            name="department_image"
                            type="file"
                        />
                          @if(isset($department) && $department->department_image)

                    <img
                        src="{{ asset('storage/'.$department->department_image) }}"
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

                    {{ isset($department)
                        ? 'Update Department'
                        : 'Save Department' }}

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
