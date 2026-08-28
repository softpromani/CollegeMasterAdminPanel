@extends('college-admin::admin.includes.master')
@section('title', 'System & Package Updates')

@section('content')
<div class="pagetitle d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold mb-1"><i class="bi bi-arrow-repeat text-warning me-2"></i>System & Package Updates</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Updates & System</li>
            </ol>
        </nav>
    </div>
    
    <div class="d-flex gap-2">
        <form action="{{ route('admin.system.check-updates') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                <i class="bi bi-arrow-clockwise me-1"></i> Check for Updates
            </button>
        </form>
    </div>
</div>

<section class="section updates-manager">
    <div class="row g-4">
        
        <!-- Left: Version Status Card -->
        <div class="col-lg-8">
            <!-- Update Status Box -->
            @if(!empty($updateInfo['has_update']))
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-warning bg-opacity-10 border border-warning">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex gap-3">
                                <div class="p-3 bg-warning text-dark rounded-circle shadow-sm">
                                    <i class="bi bi-rocket-takeoff-fill fs-2"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold text-dark mb-1">New Version Available: v{{ $updateInfo['latest_version'] }}</h4>
                                    <p class="text-secondary mb-2">
                                        Current Installed Version: <span class="badge bg-secondary">v{{ $updateInfo['current_version'] }}</span> 
                                        &rarr; Latest Available: <span class="badge bg-success">v{{ $updateInfo['latest_version'] }}</span>
                                    </p>
                                    @if(!empty($updateInfo['release_notes']))
                                        <div class="p-3 bg-white rounded-3 border mb-3">
                                            <h6 class="fw-bold text-dark mb-1">Release Highlights:</h6>
                                            <div class="small text-muted" style="white-space: pre-line;">{{ $updateInfo['release_notes'] }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-3 border-top border-warning-subtle">
                            <div>
                                <small class="text-muted">You can update assets and migrations directly or via Composer.</small>
                            </div>
                            <div class="d-flex gap-2">
                                @if(!empty($updateInfo['release_url']))
                                    <a href="{{ $updateInfo['release_url'] }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        <i class="bi bi-github me-1"></i> GitHub Release
                                    </a>
                                @endif
                                <form action="{{ route('admin.system.run-update') }}" method="POST" onsubmit="return confirm('Do you want to run the package updater now? This will refresh assets, run migrations, and clear caches.');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-4 shadow-sm">
                                        <i class="bi bi-download me-1"></i> 1-Click Update Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle">
                                <i class="bi bi-patch-check-fill fs-2"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1 text-dark">Your Package is Up to Date!</h4>
                                <p class="text-muted mb-0">
                                    You are running the latest version of <strong>College Master Admin (v{{ $currentVersion }})</strong>.
                                </p>
                            </div>
                        </div>
                        <form action="{{ route('admin.system.run-update') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3" title="Re-sync assets and re-run migrations">
                                <i class="bi bi-arrow-repeat me-1"></i> Re-sync Assets & DB
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- How to Upgrade Guide Card -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-terminal me-2 text-primary"></i>Command Line Upgrade Guide</h5>
                    <p class="text-muted small mb-0">For major production updates, you can also update via your terminal:</p>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-secondary">Step 1: Pull latest Composer code</label>
                        <div class="p-3 bg-dark text-white rounded-3 font-monospace small">
                            composer update softpromani/college-admin
                        </div>
                    </div>

                    <div>
                        <label class="form-label small fw-bold text-uppercase text-secondary">Step 2: Synchronize assets & migrations</label>
                        <div class="p-3 bg-dark text-white rounded-3 font-monospace small">
                            php artisan college-admin:update
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Environment & System Diagnostic Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-cpu me-2 text-warning"></i>System Information</h5>
                    <p class="text-muted small mb-0">Environment and server diagnostics</p>
                </div>
                <div class="card-body p-4">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Package Version</span>
                            <span class="badge bg-warning text-dark fw-bold">v{{ $currentVersion }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Laravel Framework</span>
                            <span class="fw-semibold text-dark">{{ $systemInfo['laravel_version'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">PHP Version</span>
                            <span class="fw-semibold text-dark">{{ $systemInfo['php_version'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Database Engine</span>
                            <span class="badge bg-light text-dark border text-uppercase">{{ $systemInfo['database_driver'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Environment</span>
                            <span class="badge bg-info-subtle text-info text-capitalize">{{ $systemInfo['app_environment'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Debug Mode</span>
                            <span class="badge {{ $systemInfo['app_debug'] == 'Enabled' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                {{ $systemInfo['app_debug'] }}
                            </span>
                        </li>
                    </ul>

                    <div class="mt-4 p-3 bg-light rounded-3 text-center">
                        <small class="text-muted d-block mb-2">Package Repository</small>
                        <a href="https://github.com/softpromani/CollegeMasterAdminPanel" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                            <i class="bi bi-github me-1"></i> softpromani/college-admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
