@extends('college-admin::admin.includes.master')

@section('content')

<style>
    .profile-cover {
        height: 150px;
        border-radius: 20px;
        background: linear-gradient(135deg, #696cff 0%, #5f61e6 100%);
        position: relative;
        overflow: hidden;
    }

    .profile-cover::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .profile-cover::after {
        content: "";
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .profile-avatar {
        position: relative;
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        border: 6px solid #fff;
        top: -75px;
        background: #fff;
    }

    .profile-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .stat-card {
        border: none;
        border-radius: 15px;
        transition: all .3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .info-table tr th {
        width: 35%;
        color: #566a7f;
        font-weight: 600;
        padding: 14px 0;
    }

    .info-table tr td {
        padding: 14px 0;
        color: #697a8d;
    }

    .profile-btn {
        border-radius: 10px;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Profile Header -->
    <div class="card profile-card shadow-sm mb-4">

        <div class="profile-cover"></div>

        <div class="card-body text-center">

            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-user.png') }}"
                 alt="Profile"
                 class="profile-avatar shadow">

            <h3 class="mb-2">
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </h3>

            <p class="text-muted mb-2">
                {{ Auth::user()->email }}
            </p>

            <span class="badge bg-label-primary px-3 py-2">
                Administrator
            </span>

            <div class="mt-1">
           <a href="#" class="btn btn-primary profile-btn me-2"
   data-bs-toggle="modal"
   data-bs-target="#editProfileModal">
    <i class="bx bx-edit-alt me-1"></i>
    Edit Profile
</a>

<a href="#" class="btn btn-outline-warning profile-btn"
   data-bs-toggle="modal"
   data-bs-target="#changePasswordModal">
    <i class="bx bx-lock-alt me-1"></i>
    Change Password
</a>
            </div>

        </div>

    </div>

    <!-- Statistics -->

    <div class="row">

        <!-- Personal Information -->
        <div class="col-lg-8 mb-4">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Personal Information
                    </h5>
                </div>

                <div class="card-body">

                    <table class="table table-borderless info-table">

                        <tr>
                            <th>Full Name</th>
                            <td>
                                {{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}
                            </td>
                        </tr>

                        <tr>
                            <th>Email Address</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>

                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ Auth::user()->phone ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <th>User Role</th>
                            <td>

                                    {{ Auth::user()->role->name ?? 'N/A' }}

                            </td>
                        </tr>

                        <tr>
                            <th>Account Created</th>
                            <td>
                                {{ Auth::user()->created_at->format('d M Y') }}
                            </td>
                        </tr>

                    </table>

                </div>
            </div>

        </div>

        <!-- Account Status -->
        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Account Status
                    </h5>
                </div>

                <div class="card-body text-center">

                    <i class="bx bx-user-check fs-1 text-success"></i>

                    <h5 class="mt-3">
                        Active Account
                    </h5>

                    <span class="badge bg-success">
                        Active
                    </span>

                    <hr>

                    <p class="text-muted mb-1">
                        Last Login
                    </p>

                    <strong>
                        {{ now()->format('d M Y h:i A') }}
                    </strong>

                </div>

            </div>



        </div>

    </div>

</div>




<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Profile
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                First Name
                            </label>

                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   value="{{ Auth::user()->first_name }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Last Name
                            </label>

                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   value="{{ Auth::user()->last_name }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ Auth::user()->email }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Mobile
                            </label>

                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ Auth::user()->phone }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Profile Image
                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-primary">
                        Update Profile
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>





<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.password.update') }}"
                  method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        Change Password
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">
                            Current Password
                        </label>

                        <input type="password"
                               name="current_password"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            New Password
                        </label>

                        <input type="password"
                               name="password"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-warning">
                        Change Password
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
