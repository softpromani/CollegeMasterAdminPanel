  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
        <img src="{{ asset(config('college-admin.branding.logo_path', 'vendor/college-admin/assets/img/logo.jpg')) }}" alt="Logo">
        <span class="d-none d-lg-block">{{ config('college-admin.branding.app_name', 'College Admin') }}</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        @php
          $recentNotices = \CollegeAdmin\Models\Notice::latest()->take(4)->get();
        @endphp

        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            @if($recentNotices->count() > 0)
              <span class="badge bg-primary badge-number">{{ $recentNotices->count() }}</span>
            @endif
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              @if($recentNotices->count() > 0)
                You have {{ $recentNotices->count() }} recent {{ Str::plural('notice', $recentNotices->count()) }}
                <a href="{{ route('admin.notice.index') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
              @else
                No recent notifications
              @endif
            </li>
            @forelse($recentNotices as $recentNotice)
              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="notification-item">
                <a href="{{ route('admin.notice.index') }}" class="d-flex align-items-start text-decoration-none text-dark w-100">
                  <i class="bi bi-megaphone text-primary me-2 fs-5"></i>
                  <div>
                    <h4 class="mb-1 text-dark fs-6">{{ Str::limit($recentNotice->title, 30) }}</h4>
                    <p class="text-muted small mb-0">{{ $recentNotice->created_at?->diffForHumans() ?? 'Recently' }}</p>
                  </div>
                </a>
              </li>
            @empty
              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="notification-item">
                <i class="bi bi-info-circle text-muted me-2 fs-5"></i>
                <div>
                  <h4 class="mb-1 text-dark fs-6">All caught up!</h4>
                  <p class="text-muted small mb-0">No new notices posted.</p>
                </div>
              </li>
            @endforelse
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer text-center py-2">
              <a href="{{ route('admin.notice.index') }}" class="fw-semibold text-primary text-decoration-none">
                <i class="bi bi-megaphone me-1"></i> Show all notices
              </a>
            </li>
          </ul>
        </li><!-- End Notification Nav -->

      <li class="nav-item dropdown">

    <a class="nav-link nav-icon position-relative"
       href="#"
       data-bs-toggle="dropdown">

        <i class="bi bi-translate fs-5"></i>

        <span class="badge bg-warning badge-number">
            {{ strtoupper(app()->getLocale()) }}
        </span>

    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

        <li class="dropdown-header fw-bold">
            Select Language
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2"
               href="{{ route('admin.language.switch', 'en') }}">

                <i class="bi bi-globe text-primary"></i>

                <span>English</span>

                @if(app()->getLocale() == 'en')
                    <i class="bi bi-check-lg ms-auto text-success"></i>
                @endif

            </a>
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2"
               href="{{ route('admin.language.switch', 'hi') }}">

                <i class="bi bi-translate text-danger"></i>

                <span>हिन्दी</span>

                @if(app()->getLocale() == 'hi')
                    <i class="bi bi-check-lg ms-auto text-success"></i>
                @endif

            </a>
        </li>

    </ul>

</li>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ (Auth::user() && Auth::user()->image) ? asset('storage/' . Auth::user()->image) : asset('vendor/college-admin/assets/img/profile-img.jpg') }}"
                 alt="Profile"
                 class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()?->first_name }}</span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()?->first_name }} {{ Auth::user()?->last_name }}</h6>
              <span>{{ Auth::user()?->role?->name ?? 'Admin' }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.index')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center border-0 bg-transparent text-danger">
                  <i class="bi bi-box-arrow-right text-danger"></i>
                  <span>Sign Out</span>
                </button>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
