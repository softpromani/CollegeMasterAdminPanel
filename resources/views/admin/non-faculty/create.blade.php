@extends('admin.includes.master')

@section('title')
{{ isset($nonFaculty) ? 'Edit Non Faculty' : 'Create Non Faculty' }}
@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">

        {{ isset($nonFaculty)
            ? 'Edit Non Faculty'
            : 'Create Non Faculty' }}

    </h1>

</div>

<section class="section">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body mt-4">

<form
action="{{ isset($nonFaculty)
? route('admin.non-faculty.update',$nonFaculty->id)
: route('admin.non-faculty.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

@if(isset($nonFaculty))
@method('PUT')
@endif

<div class="row">

<div class="col-md-4 mb-4">

<x-input-box
label="Name"
name="name"
type="text"
:value="old('name',$nonFaculty->name ?? '')"
/>

</div>

<div class="col-md-4 mb-4">

<x-input-box
label="Email"
name="email"
type="email"
:value="old('email',$nonFaculty->email ?? '')"
/>

</div>

<div class="col-md-4 mb-4">

<x-input-box
label="Phone"
name="phone"
type="text"
:value="old('phone',$nonFaculty->phone ?? '')"
/>

</div>

<div class="col-md-4 mb-4">

<x-input-box
label="Designation"
name="designation"
type="text"
:value="old('designation',$nonFaculty->designation ?? '')"
/>

</div>

<div class="col-md-4 mb-4">

<x-input-box
label="Image"
name="image"
type="file"
/>

@if(isset($nonFaculty) && $nonFaculty->image)

<img
src="{{ asset('storage/'.$nonFaculty->image) }}"
width="120"
class="rounded mt-3">

@endif

</div>

</div>

<button
type="submit"
class="btn btn-warning rounded-pill px-5">

{{ isset($nonFaculty)
? 'Update Non Faculty'
: 'Save Non Faculty' }}

</button>

</form>

</div>

</div>

</section>

@endsection
