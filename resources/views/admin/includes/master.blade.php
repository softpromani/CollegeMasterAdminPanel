<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.includes.head')


@yield('header-area')
</head>
<body>

  @include('admin.includes.navbar')

  @include('admin.includes.sidebar')

   <main id="main" class="main">

    @yield('content')

   </main>

@include('admin.includes.footer')

@include('admin.includes.scripts')
@yield('script-area')
@stack('scripts')
</body>
</html>
