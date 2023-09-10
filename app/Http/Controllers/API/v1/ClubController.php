<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\ClubStatus;
use App\Enums\CommonQuestionStatus;
use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\ChangePasswordRequest;
use App\Http\Requests\API\v1\LoginRequest;
use App\Http\Requests\API\v1\OtpRequest;
use App\Http\Requests\API\v1\OtpVerfiyRequest;
use App\Http\Requests\API\v1\RegisterRequest;
use App\Http\Resources\Club\AllClubResource;
use App\Http\Resources\Club\ClubResource;
use App\Http\Resources\CommonQuestionResource;
use App\Http\Resources\ServiceResource;
use App\Models\Club;
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

class ClubController extends Controller
{

    /**
     * retrive all active clubs
     */
    public function index()
    {
        try {
            $data['clubs'] = AllClubResource::collection(Club::query()->status(ClubStatus::ACTIVE->value)->get());
            $message = __('general.response_messages.success');
            $response = generateApiResoponse(true, 201, $data, $message);
        } catch (Throwable $e) {
            $data = [];
            $message = __('general.response_messages.error');
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }

    /**
     * return   Club Details
     */
    public function show(Request $request, $id)
    {
        try {
            $relations = $request->has('relations') && $request->query('relations') != null ? explode(',', $request->query('relations', null)) : [];
            $data['club'] = new ClubResource(Club::query()->with($relations)->find(decrypt($id)));
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
