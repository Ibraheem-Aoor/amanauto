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



    public function showPage(Request $request)
    {
        $page = $request->query('page');
        $data['page_settings'] = $this->getPageSettings($page);
        $data['page'] = $page;
        return view('admin.pages.' . $page, $data);
    }


    protected function getPageSettings($page)
    {
        switch ($page) {
            case 'home':
                $data['slogan_1'] = getSetting('home_page_slogan_1');
                $data['short_intro'] = getSetting('home_page_short_intro');
                $data['slogan_2'] = getSetting('home_page_slogan_2');
                $data['entities_title'] = getSetting('home_page_entities_title');
                $data['services_title'] = getSetting('home_page_services_title');
                $data['subscription_steps_title'] = getSetting('home_page_subscription_steps_title');
                $data['faqs_title'] = getSetting('home_page_faqs_title');
                break;
            case 'offers':
                $data['offers_page_intro_image']       =   getSetting('offers_page_intro_image');
                $data['offers_page_no_offers_text']       =   getSetting('offers_page_no_offers_text');
                break;
        }
        return $data;
    }

    /**
     * Update Static Text & images for a page(General).
     */
    public function updatePage(Request $request)
    {
        try {
            $settings = $request->toArray();
            $lang = app()->getLocale();
            foreach ($settings as $key => $setting) {
                if ($setting) {

                    BusinessSetting::query()->updateOrCreate(
                        [
                            'key' => $key,
                            'lang' => $lang,
                        ],
                        [
                            'key' => $key,
                            'lang' => $lang,
                            'value' => ($setting instanceof UploadedFile) ? saveImage("settings/{$key}", $setting) : $setting,
                        ]
                    );
                }
            }
            Artisan::call('cache:clear');
            $response = generateResponse(status: true, reload: true);
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }


}
