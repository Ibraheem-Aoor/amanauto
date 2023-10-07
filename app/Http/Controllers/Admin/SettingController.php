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

class SettingController extends Controller
{


    protected $model;
    public $translated_model_name;

    public function __construct()
    {
        $this->model = new BusinessSetting();
        $this->translated_model_name = __('backend.general_settings');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['translated_model_name'] = $this->translated_model_name;
        return view('admin.settings.index', $data);
    }


    public function update(Request $request)
    {
        try {
            $settings = $request->toArray();
            foreach ($settings as $key => $setting) {
                BusinessSetting::query()->updateOrCreate(
                    [
                        'key' => $key,  
                    ],
                    [
                        'key' => $key,
                        'value' => ($setting instanceof UploadedFile) ? saveImage("settings/{$key}", $setting) : $setting,
                    ]
                );
            }
            Artisan::call('cache:clear');
            $response = generateResponse(status: true , reload:true);
        } catch (Throwable $e) {
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }


}
