@extends('admin.includes.master')

@section('header-area')
<style>

    .table thead th{
        border:none;
        color:#92400e;
        font-weight:700;
    }

    .table tbody tr{
        transition:.3s;
    }

    .table tbody tr:hover{
        background:rgba(253,230,138,.15);
    }

    .card{
        background:rgba(255,255,255,.75);
        backdrop-filter:blur(12px);
    }

    .btn-warning{
        background:linear-gradient(135deg,#facc15,#f59e0b);
        border:none;
    }

</style>
@endsection

@section('content')

<div class="pagetitle">

    <h1 class="fw-bold">
        Banner
    </h1>

    <nav>

        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li class="breadcrumb-item active">
                Banner
            </li>

        </ol>

    </nav>

</div>

<section class="section">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-transparent border-0 d-flex justify-content-end py-4">

            <a href="{{ route('admin.banner.create') }}"
                class="btn btn-warning rounded-pill px-4 fw-semibold shadow-sm">

                <i class="bi bi-plus-circle me-2"></i>

                Add Banner

            </a>

        </div>

        <div class="card-body">

            <x-data-table
                id="banner-table"
                :columns="$columns"
                :ajax="route('admin.banner.index')"
            />

        </div>

    </div>

</section>

@endsection
