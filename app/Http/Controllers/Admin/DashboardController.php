<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Duration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
