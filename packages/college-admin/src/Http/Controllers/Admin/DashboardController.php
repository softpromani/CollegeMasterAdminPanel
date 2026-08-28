<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Models\Banner;
use CollegeAdmin\Models\Event;
use CollegeAdmin\Models\Notice;
use CollegeAdmin\Models\User;

class DashboardController extends Controller
{
   public function dashboard()
{
    $totalUsers   = User::count();
    $totalNotices = Notice::count();
    $totalEvents  = Event::count();
    $totalBanners = Banner::count();

    return view('college-admin::admin.dashboard', compact(
        'totalUsers',
        'totalNotices',
        'totalEvents',
        'totalBanners'
    ));

}
}
