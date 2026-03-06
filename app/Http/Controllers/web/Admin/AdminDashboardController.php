<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Queries\AdminDashboardQuery;

class AdminDashboardController extends Controller
{
    public function index(AdminDashboardQuery $query)
    {
        $statistics = $query->globalInfo();

        return view('admin.dashboard', compact('statistics'));
    }
}
