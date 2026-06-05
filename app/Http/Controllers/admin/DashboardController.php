<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Notice;
use App\Models\User;

class DashboardController extends Controller
{
   public function dashboard()
{
    $totalUsers   = User::count();
    $totalNotices = Notice::count();
    $totalEvents  = Event::count();
    $totalBanners = Banner::count();

    return view('admin.dashboard', compact(
        'totalUsers',
        'totalNotices',
        'totalEvents',
        'totalBanners'
    ));

}
}
