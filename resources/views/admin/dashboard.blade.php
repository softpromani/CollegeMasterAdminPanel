@extends('college-admin::admin.includes.master')

@section('header-area')
<style>

.dashboard-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    background:#fff;
    transition:.3s;
    box-shadow:0 5px 25px rgba(0,0,0,.08);
}

.dashboard-card:hover{
    transform:translateY(-5px);
}

.card-icon{
    width:65px;
    height:65px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    color:#fff;
}

.bg-users{
    background:linear-gradient(135deg,#696cff,#5f61e6);
}

.bg-notice{
    background:linear-gradient(135deg,#ffb74d,#fb8c00);
}

.bg-events{
    background:linear-gradient(135deg,#26c6da,#00acc1);
}

.bg-banner{
    background:linear-gradient(135deg,#66bb6a,#43a047);
}

.dashboard-card h2{
    font-size:34px;
    font-weight:700;
    margin-bottom:0;
}

.dashboard-card p{
    margin:0;
    color:#6c757d;
}

.welcome-card{
    border:none;
    border-radius:25px;
    overflow:hidden;
    background:linear-gradient(135deg,#696cff,#5f61e6);
    color:white;
}

.welcome-card h2{
    font-weight:700;
}

.summary-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}


.quick-action-card{
    display: block;
    text-decoration: none;
    background: #fff;
    border-radius: 18px;
    padding: 25px 20px;
    text-align: center;
    transition: all .3s ease;
    border: 1px solid #f3f4f6;
    box-shadow: 0 5px 20px rgba(0,0,0,.05);
    height: 100%;
}

.quick-action-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,.12);
}

.quick-action-icon{
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    font-size: 30px;
    color: #fff;
}

.users-bg{
    background: linear-gradient(135deg,#696cff,#5f61e6);
}

.notice-bg{
    background: linear-gradient(135deg,#ffb74d,#f57c00);
}

.event-bg{
    background: linear-gradient(135deg,#26c6da,#00acc1);
}

.banner-bg{
    background: linear-gradient(135deg,#66bb6a,#43a047);
}

.quick-action-title{
    margin-top: 18px;
    font-size: 18px;
    font-weight: 700;
    color: #374151;
}

.quick-action-desc{
    font-size: 13px;
    color: #9ca3af;
    margin-bottom: 0;
}

.quick-actions-header{
    border-bottom: 1px solid #f1f5f9;
}

</style>
@endsection

@section('content')

<div class="pagetitle">
    <h1>{{ __('messages.dashboard') }}</h1>
</div>

<section class="section dashboard">
    @php
        $updateInfo = \CollegeAdmin\Services\VersionChecker::check();
    @endphp

    @if(!empty($updateInfo['has_update']))
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-between p-3 rounded-4 shadow-sm border-warning-subtle mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-arrow-up-circle-fill fs-3 text-warning me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1 fw-bold text-dark">Package Update Available!</h5>
                    <p class="mb-0 text-secondary">
                        A new version <strong>v{{ $updateInfo['latest_version'] }}</strong> is available (Current: <code>v{{ $updateInfo['current_version'] }}</code>).
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                @if(!empty($updateInfo['release_url']))
                    <a href="{{ $updateInfo['release_url'] }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                        <i class="bi bi-journal-text me-1"></i> Release Notes
                    </a>
                @endif
                <span class="badge bg-warning text-dark p-2 px-3 rounded-pill fw-semibold">
                    Run <code>composer update</code> &amp; <code>php artisan college-admin:update</code>
                </span>
            </div>
        </div>
    @endif


    <!-- Welcome Card -->
    <div class="card welcome-card mb-4">
        <div class="card-body p-4">
            <h2>
                Welcome,
                {{ Auth::user()?->first_name ?? Auth::user()?->name ?? 'Admin' }}
                {{ Auth::user()?->last_name ?? '' }}
            </h2>

            <p class="mb-0">
                Manage your website content, notices, events and banners from one place.
            </p>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row">

        <!-- Users -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p>Total Users</p>
                            <h2>{{ $totalUsers }}</h2>
                        </div>

                        <div class="card-icon bg-users">
                            <i class="bi bi-people"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Notices -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p>Total Notices</p>
                            <h2>{{ $totalNotices }}</h2>
                        </div>

                        <div class="card-icon bg-notice">
                            <i class="bi bi-megaphone"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Events -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p>Total Events</p>
                            <h2>{{ $totalEvents }}</h2>
                        </div>

                        <div class="card-icon bg-events">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Banners -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p>Total Banners</p>
                            <h2>{{ $totalBanners }}</h2>
                        </div>

                        <div class="card-icon bg-banner">
                            <i class="bi bi-images"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Summary Section -->
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white quick-actions-header">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-lightning-charge-fill text-warning me-2"></i>
            Quick Actions
        </h5>
    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.user.index') }}"
                   class="quick-action-card">

                    <div class="quick-action-icon users-bg">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <h6 class="quick-action-title">
                        Users
                    </h6>

                    <p class="quick-action-desc">
                        Manage system users
                    </p>

                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.notice.index') }}"
                   class="quick-action-card">

                    <div class="quick-action-icon notice-bg">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>

                    <h6 class="quick-action-title">
                        Notices
                    </h6>

                    <p class="quick-action-desc">
                        Publish notices
                    </p>

                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.event.index') }}"
                   class="quick-action-card">

                    <div class="quick-action-icon event-bg">
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>

                    <h6 class="quick-action-title">
                        Events
                    </h6>

                    <p class="quick-action-desc">
                        Manage events
                    </p>

                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.banner.index') }}"
                   class="quick-action-card">

                    <div class="quick-action-icon banner-bg">
                        <i class="bi bi-images"></i>
                    </div>

                    <h6 class="quick-action-title">
                        Banners
                    </h6>

                    <p class="quick-action-desc">
                        Update website banners
                    </p>

                </a>
            </div>

        </div>

    </div>

</div>

</section>

@endsection
