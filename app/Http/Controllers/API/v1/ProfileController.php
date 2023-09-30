<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\ClubStatus;
use App\Enums\CommonQuestionStatus;
use App\Enums\OfferStatus;
use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\ChangePasswordRequest;
use App\Http\Requests\API\v1\LoginRequest;
use App\Http\Requests\API\v1\OtpRequest;
use App\Http\Requests\API\v1\OtpVerfiyRequest;
use App\Http\Requests\API\v1\RegisterRequest;
use App\Http\Resources\Club\ClubResource;
use App\Http\Resources\CommonQuestionResource;
use App\Http\Resources\Offer\AllOffersResource;
use App\Http\Resources\Offer\OfferResource;
use App\Http\Resources\ServiceResource;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
use App\Services\UltraMsgService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Str;

class ProfileController extends Controller
{

    /**
     * retrive all active offers
     */
    public function index()
    {
        try {
            $user = getAuthUser('sanctum');
            $data['offers'] = AllOffersResource::collection($user->offers()->status(OfferStatus::ACTIVE->value)->with('company')->limit(3)->get());
            $data['services'] = ServiceResource::collection($user->club->services()->status(ServiceStatus::ACTIVE->value)->limit(3)->get());
            $message = __('general.response_messages.success');
            $response = generateApiResoponse(true, 201, $data, $message);
        } catch (Throwable $e) {
            dd($e);
            $data = [];
            $message = __('general.response_messages.error');
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }


}
