<!DOCTYPE html>
<html lang="en">
<head>
@include('college-admin::admin.includes.head')


@yield('header-area')
</head>
<body>

  @include('college-admin::admin.includes.navbar')

  @include('college-admin::admin.includes.sidebar')

   <main id="main" class="main">

    @yield('content')

   </main>

@include('college-admin::admin.includes.footer')

@include('college-admin::admin.includes.scripts')
@yield('script-area')
@stack('scripts')

@include('sweetalert::Alert')
</body>
</html>
