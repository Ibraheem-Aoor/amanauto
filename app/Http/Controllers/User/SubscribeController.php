<?php

namespace App\Http\Controllers\User;

use App\Enums\ClubStatus;
use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index(Request $request , $club)
    {
        $data['club'] = Club::query()->findOrFail(decrypt($club));
        return view('user.subscribe.index', $data);
    }
}
