@extends('college-admin::admin.includes.master')
@section('header-area')
    <style>
        .table thead th {
            border: none;
            color: #92400e;
            font-weight: 700;
        }

        .table tbody tr {
            transition: 0.3s;
        }

        .table tbody tr:hover {
            background: rgba(253, 230, 138, 0.15);
        }

        .card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
        }

        .btn-warning {
            background: linear-gradient(135deg, #facc15, #f59e0b);
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 class="fw-bold">{{ __('college-admin::messages.roles') }}</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>

                <li class="breadcrumb-item active">
                    Roles
                </li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-transparent border-0 d-flex justify-content-end align-center-end py-4">



                <a href="{{ route('admin.roles.create') }}" class="btn btn-warning rounded-pill px-4 fw-semibold shadow-sm">

                    <i class="bi bi-plus-circle me-2"></i>
                    {{ __('college-admin::messages.add_role') }}
                </a>

            </div>

            <div class="card-body">

                <x-data-table

    id="role-table"

    :columns="$columns"

    :ajax="route('admin.roles.index')"

/>

            </div>

        </div>

    </section>



@endsection
