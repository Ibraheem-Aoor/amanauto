<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClubStatus;
use App\Enums\Duration;
use App\Enums\VatType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\AboutPageRequest;
use App\Http\Requests\Admin\ClubRequest;
use App\Http\Requests\Admin\CommonQuestionRequest;
use App\Http\Requests\Admin\CouponRequest;
use App\Http\Requests\Admin\CrudRequest;
use App\Models\BusinessSetting;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Coupon;
use App\Models\Page;
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

class PageController extends Controller
{

    /**
     * About Us Page.
     */
    public function showAboutPageIndex()
    {
        $data['translated_model_name'] = __('backend.pages.about_us');
        $data['page'] = Page::query()->whereType('about_us')->first();
        return view('admin.pages.about_us', $data);
    }


    public function updateAboutUsPage(AboutPageRequest $request)
    {
        try {
            Page::query()->updateOrCreate([
                'type' => 'about_us',
            ], [
                'type' => 'about_us',
                'added_by' => getAuthUser('admin')?->id,
                'ar' => [
                    'content' => $request->get('content_ar'),
                    'title' => 'من نحن',
                ],
                'en' => [
                    'content' => $request->get('content_en'),
                    'title' => 'About Us',
                ],
            ]);
            $response = generateResponse(status: true, );
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }


}
