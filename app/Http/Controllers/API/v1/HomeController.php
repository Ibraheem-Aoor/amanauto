<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\ClientStatus;
use App\Enums\CommonQuestionStatus;
use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\ChangePasswordRequest;
use App\Http\Requests\API\v1\LoginRequest;
use App\Http\Requests\API\v1\OtpRequest;
use App\Http\Requests\API\v1\OtpVerfiyRequest;
use App\Http\Requests\API\v1\RegisterRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\CommonQuestionResource;
use App\Http\Resources\ServiceResource;
use App\Models\Client;
use App\Models\CommonQuestion;
use App\Models\Service;
use App\Models\User;
use App\Services\UltraMsgService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Str;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data['services'] = ServiceResource::collection(Service::query()->status(ServiceStatus::ACTIVE->value)->get());
            $data['entities'] = ClientResource::collection(Client::query()->status(ClientStatus::ACTIVE->value)->get());
            $data['common_questions'] = CommonQuestionResource::collection(CommonQuestion::query()->status(CommonQuestionStatus::ACTIVE->value)->get());
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
