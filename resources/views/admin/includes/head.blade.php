  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

 <title>{{ config('college-admin.branding.app_name', 'College Master Admin') }} | @yield('title', 'Dashboard')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/jpeg" href="{{ asset(config('college-admin.branding.favicon_path', 'vendor/college-admin/assets/img/logo.jpg')) }}">
  <link rel="shortcut icon" type="image/jpeg" href="{{ asset(config('college-admin.branding.favicon_path', 'vendor/college-admin/assets/img/logo.jpg')) }}">
  <link rel="apple-touch-icon" href="{{ asset(config('college-admin.branding.favicon_path', 'vendor/college-admin/assets/img/logo.jpg')) }}">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/college-admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/college-admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/college-admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/college-admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/college-admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/college-admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/college-admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('vendor/college-admin/assets/css/style.css') }}" rel="stylesheet">
<!-- DataTables CSS -->
<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet"
href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

  <style>
body {
  background: #fffaf0;
  position: relative;
  overflow-x: hidden;
}

/* Animated Grid Lines */
body::before {

  content: "";

  position: fixed;
  inset: 0;

  background-image:
    linear-gradient(rgba(251,191,36,0.10) 1px, transparent 1px),
    linear-gradient(90deg, rgba(249,115,22,0.10) 1px, transparent 1px);

  background-size: 60px 60px;

  animation: moveGrid 12s linear infinite;

  z-index: -1;
}

/* Floating Gradient Blob */
body::after {

  content: "";

  position: fixed;

  width: 450px;
  height: 450px;

  border-radius: 50%;

  background: radial-gradient(circle,
              rgba(251,191,36,0.30),
              rgba(249,115,22,0.12),
              transparent);

  top: 50%;
  left: 50%;

  transform: translate(-50%, -50%);

  filter: blur(70px);

  animation: pulseBlob 8s ease-in-out infinite;

  z-index: -1;
}

/* Grid Movement */
@keyframes moveGrid {

  0% {
    transform: translate(0, 0);
  }

  100% {
    transform: translate(60px, 60px);
  }
}

/* Blob Animation */
@keyframes pulseBlob {

  0% {
    transform: translate(-50%, -50%) scale(1);
  }

  50% {
    transform: translate(-50%, -50%) scale(1.25);
  }

  100% {
    transform: translate(-50%, -50%) scale(1);
  }
}

#header {
  background: rgba(255, 255, 255, 0.75);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);

  box-shadow: 0 4px 20px rgba(0,0,0,0.08);

  border-bottom: 1px solid rgba(255,255,255,0.2);

  padding: 12px 20px;

  transition: all 0.3s ease;
}

/* Logo */
.logo span {
  font-size: 24px;
  font-weight: 700;

  background: linear-gradient(135deg, #facc15, #f59e0b);

  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Logo Image */
.logo img {
  max-height: 42px;

  filter: drop-shadow(0 0 8px rgba(250, 204, 21, 0.5));
}

/* Sidebar Toggle */
.toggle-sidebar-btn {
  font-size: 28px;
  color: #f59e0b;

  transition: 0.3s;
}

.toggle-sidebar-btn:hover {
  color: #d97706;
  transform: rotate(90deg);
}

/* Search Bar */
.search-form input {
  border-radius: 12px 0 0 12px !important;
  border: 1px solid rgba(245, 158, 11, 0.2);

  padding: 10px 15px;
  background: rgba(255,255,255,0.7);
}

.search-form button {
  border-radius: 0 12px 12px 0 !important;

  background: linear-gradient(135deg, #facc15, #f59e0b);

  border: none;
  color: white;

  padding: 0 18px;

  transition: 0.3s;
}

.search-form button:hover {
  transform: scale(1.05);
}

/* Nav Icons */
.header-nav .nav-icon {
  width: 42px;
  height: 42px;

  border-radius: 12px;

  display: flex;
  align-items: center;
  justify-content: center;

  background: rgba(250, 204, 21, 0.12);

  color: #f59e0b;

  transition: 0.3s;
}

.header-nav .nav-icon:hover {
  background: linear-gradient(135deg, #facc15, #f59e0b);

  color: white;

  transform: translateY(-3px);
}

/* Notification Badge */
.badge-number {
  background: linear-gradient(135deg, #facc15, #f59e0b) !important;

  box-shadow: 0 0 10px rgba(250, 204, 21, 0.6);
}

/* Profile */
.nav-profile img {
  width: 42px;
  height: 42px;

  border: 2px solid #facc15;

  box-shadow: 0 0 12px rgba(250, 204, 21, 0.5);
}

/* Username */
.nav-profile span {
  color: #111827;
  font-weight: 600;
}

/* Dropdown */
.dropdown-menu {
  border: none;
  border-radius: 18px;

  overflow: hidden;

  box-shadow: 0 10px 40px rgba(0,0,0,0.12);

  backdrop-filter: blur(14px);
}

/* Dropdown Header */
.dropdown-header {
  background: linear-gradient(135deg, #facc15, #f59e0b);

  color: white;
}

/* Dropdown Items */
.dropdown-item {
  transition: 0.3s;
}

.dropdown-item:hover {
  background: rgba(250, 204, 21, 0.12);

  color: #f59e0b;

  padding-left: 24px;
}

/* Notification Items */
.notification-item:hover,
.message-item:hover {
  background: rgba(250, 204, 21, 0.08);
}

/* Smooth Animation */
#header,
.nav-icon,
.dropdown-menu,
.search-form button {
  transition: all 0.3s ease;
}



/* =========================
   PREMIUM YELLOW SIDEBAR
========================= */

.sidebar {
  background: rgba(255, 255, 255, 0.78);

  backdrop-filter: blur(18px);
  -webkit-backdrop-filter: blur(18px);

  border-right: 1px solid rgba(255,255,255,0.2);

  box-shadow: 4px 0 25px rgba(0,0,0,0.08);

  padding-top: 20px;

  transition: all 0.3s ease;
}

/* Sidebar Scroll */
.sidebar::-webkit-scrollbar {
  width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #facc15, #f59e0b);
  border-radius: 20px;
}

/* Nav Links */
.sidebar-nav .nav-link {
  margin: 6px 12px;
  border-radius: 14px;

  color: #374151;
  font-weight: 600;

  display: flex;
  align-items: center;

  transition: all 0.3s ease;

  background: transparent;
}

/* Hover */
.sidebar-nav .nav-link:hover {
  background: linear-gradient(135deg, #facc15, #f59e0b);

  color: white !important;

  transform: translateX(6px);

  box-shadow: 0 8px 18px rgba(245, 158, 11, 0.25);
}

/* Active Link */
.sidebar-nav .nav-link:not(.collapsed) {
  background: linear-gradient(135deg, #facc15, #f59e0b);

  color: white;

  box-shadow: 0 8px 18px rgba(245, 158, 11, 0.25);
}

/* Icons */
.sidebar-nav .nav-link i {
  font-size: 18px;
  margin-right: 10px;

  transition: 0.3s;
}

/* Icon Hover Animation */
.sidebar-nav .nav-link:hover i {
  transform: scale(1.15) rotate(5deg);
}

/* Submenu */
.sidebar-nav .nav-content {
  margin-left: 14px;
  padding-left: 12px;

  border-left: 2px dashed rgba(245, 158, 11, 0.3);
}

/* Submenu Links */
.sidebar-nav .nav-content a {
  border-radius: 10px;

  margin: 4px 0;

  color: #6b7280;

  transition: all 0.3s ease;
}

/* Submenu Hover */
.sidebar-nav .nav-content a:hover {
  background: rgba(250, 204, 21, 0.15);

  color: #f59e0b;

  padding-left: 10px;
}

/* Active Submenu */
.sidebar-nav .nav-content a.active {
  background: rgba(250, 204, 21, 0.18);

  color: #f59e0b;

  font-weight: 600;
}

/* Circle Icon */
.sidebar-nav .nav-content i {
  font-size: 10px;
}

/* Sidebar Heading */
.sidebar-nav .nav-heading {
  font-size: 12px;
  font-weight: 700;

  text-transform: uppercase;

  color: #f59e0b;

  margin: 20px 18px 10px;

  letter-spacing: 1px;
}

/* Chevron */
.sidebar-nav .bi-chevron-down {
  transition: 0.3s ease;
}

/* Rotate Chevron */
.sidebar-nav .nav-link:not(.collapsed) .bi-chevron-down {
  transform: rotate(180deg);
}

/* Smooth Animation */
.sidebar,
.sidebar-nav .nav-link,
.sidebar-nav .nav-content a,
.sidebar-nav .nav-link i {
  transition: all 0.3s ease;
}

        /* INPUT COMPONENT */

        .custom-input {


            border-radius: 15px !important;

            border: 1px solid #fde68a !important;

            box-shadow: none !important;

            padding-left: 15px;

            font-size: 0.875rem;

            background: rgba(255, 255, 255, 0.85);
        }

        .custom-input:focus {
            border-color: #f59e0b !important;

            box-shadow: 0 0 0 0.20rem rgba(245, 158, 11, 0.15) !important;
        }

        /* TEXTAREA */

        .custom-textarea {
            border-radius: 18px !important;

            border: 1px solid #fde68a !important;

            box-shadow: none !important;

            padding: 16px;

            background: rgba(255, 255, 255, 0.85);
        }

        .custom-textarea:focus {
            border-color: #f59e0b !important;

            box-shadow: 0 0 0 0.20rem rgba(245, 158, 11, 0.15) !important;
        }

        /* INPUT GROUP */

        .input-group-text {
            border: 1px solid #fde68a !important;

            border-right: none !important;

            border-radius: 18px 0 0 18px !important;

            background: linear-gradient(135deg, #facc15, #f59e0b);

            color: white;

            width: 40px;

            justify-content: center;

            font-size: 18px;
        }

        .input-group .form-control,
        .input-group .form-select {
            border-left: none !important;
        }

        /* BUTTON */

        .btn-warning {
            background: linear-gradient(135deg, #facc15, #f59e0b);
            border: none;
            color: white;
        }

        .btn-warning:hover,
        .btn-warning:focus {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: white;
        }

        /* Standardized Action Buttons in Tables */
        .table .d-flex .btn-sm,
        .table td a.btn-sm,
        .table td button.btn-sm {
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            min-height: 32px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 8px !important;
            font-size: 13px !important;
            line-height: 1 !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease-in-out;
        }

        .table .d-flex .btn-sm:hover,
        .table td a.btn-sm:hover,
        .table td button.btn-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .table td form {
            display: inline-flex !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* FILE INPUT */

        input[type="file"] {
            padding: 5px !important;
        }

        /* LABEL */

        .form-label {
            font-size: 15px;
            color: #2d2d2d;
        }


  </style>
