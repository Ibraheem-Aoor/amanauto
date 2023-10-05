<?php

namespace App\Http\Controllers\User;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Throwable;

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

    public function show()
    {
        $data['user'] = getAuthUser('web');
        $data['club'] = $data['user']->club;
        return view('user.profile.show', $data);
    }

    public function offersDocs()
    {
        $user = getAuthUser('web');
        $data['offers'] = $user->offers()->status(OfferStatus::ACTIVE->value)->paginate(0);
        return view('user.profile.documents_offers', $data);
    }

    public function subscriptionDocs()
    {
        $user = getAuthUser('web');
        $data['subscriptions'] = $user->subscriptions()->paginate(4);
        return view('user.profile.documents_subscriptions', $data);
    }
    /**
     * security: password change
     */
    public function showPasswordIndex()
    {
        return view('user.profile.password');
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        try {
            $user = getAuthUser('web');
            $user->update([
                'password' => $request->password,
            ]);
            $response = generateResponse(status: true , redirect:route('profile.index'));
        } catch (Throwable $e) {
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }
}
