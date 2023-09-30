<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Duration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Download File From Storage.
     */
    public function downloadFile(Request $request)
    {
        try {
            return downloadFile($request->path);
        } catch (Throwable $e) {
            info('Admin File Downlaod Error:');
            info($e);
            session()->flash('error', __('general.response_messages.error'));
            return back();
        }
    }
}
