<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = getAuthUser('web');
        $data['offers'] = $data['user']->offers;
        $data['club'] = $data['user']->club();
        $data['services'] = $data['club']?->services ?? [];
        return view('user.profile.index', $data);
    }
}
