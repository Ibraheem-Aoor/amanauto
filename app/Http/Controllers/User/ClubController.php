<?php

namespace App\Http\Controllers\User;

use App\Enums\ClubStatus;
use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $data['clubs'] = Club::query()->status(ClubStatus::ACTIVE->value)->get();
        return view('user.clubs.index', $data);
    }


    public function show($id)
    {
        $data['club'] = Club::query()->with(['services'])->find(decrypt($id));
        return view('user.clubs.show', $data);
    }
}
