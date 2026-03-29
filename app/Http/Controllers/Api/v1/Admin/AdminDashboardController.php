<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Admin\AdminDashboardResource;
use App\Queries\AdminDashboardQuery;

class AdminDashboardController extends Controller
{
    public function globalStats(AdminDashboardQuery $query)
    {
        $statistics = $query->globalInfo();

        return new AdminDashboardResource($statistics);
    }
}
