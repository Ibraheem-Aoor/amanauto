<?php

namespace App\Http\Controllers\User;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = getAuthUser('web');
        $data['offers'] = $data['user']->offers()->status(OfferStatus::ACTIVE->value)->get();
        $data['club'] = $data['user']->club;
        $data['services'] = $data['club']?->services ?? [];
        return view('user.profile.index', $data);
    }
}
