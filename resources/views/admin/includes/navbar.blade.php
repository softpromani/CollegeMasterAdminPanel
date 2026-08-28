<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
      <img src="{{ asset('vendor/college-admin/assets/img/logo.jpg') }}" alt="Logo" class="rounded-circle me-2" style="max-height: 36px;">
      <span class="d-none d-lg-block fw-bold text-dark">{{ config('college-admin.name', 'College Master Admin') }}</span>
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

      <!-- Live Contact Inquiries Notifications Dropdown -->
      @php
        $unreadInquiriesCount = \CollegeAdmin\Models\Contact::where('status', 'unread')->count();
        $recentInquiries = \CollegeAdmin\Models\Contact::latest()->take(5)->get();
      @endphp
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          @if($unreadInquiriesCount > 0)
            <span class="badge bg-danger badge-number">{{ $unreadInquiriesCount }}</span>
          @endif
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            @if($unreadInquiriesCount > 0)
              You have {{ $unreadInquiriesCount }} new {{ Str::plural('inquiry', $unreadInquiriesCount) }}
              <a href="{{ route('admin.contact-inquiries.index') }}"><span class="badge rounded-pill bg-danger p-2 ms-2">View all</span></a>
            @else
              <span>No new inquiries</span>
            @endif
          </li>
          @forelse($recentInquiries as $inquiry)
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="notification-item">
              <a href="{{ route('admin.contact-inquiries.index') }}" class="d-flex align-items-start text-decoration-none text-dark w-100 p-2">
                <i class="bi bi-chat-left-dots text-primary me-2 fs-5 flex-shrink-0"></i>
                <div class="overflow-hidden">
                  <h4 class="mb-1 text-dark fs-6 fw-bold text-truncate">{{ $inquiry->name }}</h4>
                  <p class="text-muted small mb-1 text-truncate">{{ $inquiry->subject ?? Str::limit($inquiry->message, 30) }}</p>
                  <span class="text-muted small">{{ $inquiry->created_at?->diffForHumans() ?? 'Recently' }}</span>
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
                <p class="text-muted small mb-0">No contact messages received.</p>
              </div>
            </li>
          @endforelse
          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer text-center py-2">
            <a href="{{ route('admin.contact-inquiries.index') }}" class="fw-semibold text-primary text-decoration-none">
              <i class="bi bi-envelope-open me-1"></i> Show all inquiries & notifications
            </a>
          </li>
        </ul><!-- End Notification Dropdown Items -->
      </li><!-- End Notification Nav -->

      <!-- Language Switcher Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon d-flex align-items-center gap-1 text-decoration-none" href="#" data-bs-toggle="dropdown" title="Change Language">
          <span class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold" style="font-size: 11px;">
            {{ strtoupper(app()->getLocale()) }}
          </span>
          <i class="bi bi-translate text-secondary fs-6"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow p-2 shadow-sm rounded-3">
          <li class="dropdown-header text-start pb-2">
            <span class="fw-bold small text-muted">Select Language</span>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 rounded-2 {{ app()->getLocale() == 'en' ? 'active bg-primary text-white' : '' }}" 
               href="{{ route('admin.lang.switch', 'en') }}">
              <span class="fi fi-gb"></span> English (EN)
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 rounded-2 {{ app()->getLocale() == 'hi' ? 'active bg-primary text-white' : '' }}" 
               href="{{ route('admin.lang.switch', 'hi') }}">
              <span class="fi fi-in"></span> Hindi (हिन्दी)
            </a>
          </li>
        </ul>
      </li><!-- End Language Switcher -->

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{ asset('vendor/college-admin/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name ?? 'Administrator' }}</span>
        </a><!-- End Profile Image Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ Auth::user()->name ?? 'Administrator' }}</h6>
            <span>College Admin</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.index') }}">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.system.updates') }}">
              <i class="bi bi-arrow-repeat text-primary"></i>
              <span>System & Updates</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button class="dropdown-item d-flex align-items-center" type="submit">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </form>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->