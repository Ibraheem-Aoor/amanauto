<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClubStatus;
use App\Enums\Duration;
use App\Enums\VatType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClubRequest;
use App\Http\Requests\Admin\CommonQuestionRequest;
use App\Http\Requests\Admin\CouponRequest;
use App\Http\Requests\Admin\CrudRequest;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Admin;
use App\Models\BusinessSetting;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Coupon;
use App\Models\Service;
use App\Models\User;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CouponTransformer;
use App\Transformers\Admin\CrudTransfromer;
use App\Transformers\Admin\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{


    protected $model;
    public $translated_model_name;

    public function __construct()
    {
        $this->model = new Admin();
        $this->translated_model_name = __('backend.profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['translated_model_name'] = $this->translated_model_name;
        $data['auth_admin'] = getAuthUser('admin');
        return view('admin.profile.index', $data);
    }


    public function update(ProfileRequest $request)
    {
        try {
            $auth_admin = getAuthUser('admin');
            if ($request->hasFile('avatar_file')) {
                $request['avatar'] = saveImage('admin_avatar', $request->file('avatar_file'));
                $auth_admin->avatar != null ? deleteImage($auth_admin->avatar) : null;
            }
            $auth_admin->update($request->toArray());
            Artisan::call('cache:clear');
            $response = generateResponse(status: true, reload: true);
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }


}
