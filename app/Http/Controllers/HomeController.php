<?php

namespace App\Http\Controllers;

use App\Enums\CommonQuestionStatus;
use App\Http\Requests\User\ContactRequest;
use App\Models\Client;
use App\Models\CommonQuestion;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Service;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Throwable;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['entities'] = $this->getCachedData('entities', Client::class);
        $data['services'] = $this->getCachedData('services', Service::class);
        $data['common_questions'] = $this->getCachedData('common_questions', CommonQuestion::class);
        return view('home', $data);
    }


    /**
     * cache data
     */
    protected function getCachedData($key, $model)
    {
        return Cache::rememberForever($key, function () use ($model) {
            return $model::query()->get();
        });
    }

    /**
     * Downlaod Terms & Conditions File
     */
    public function downloadTermsFile()
    {
        try {
            return Storage::disk('public')->download((getSetting('terms_file')));
        } catch (Throwable $e) {
            session()->flash('error', __('general.response_messages.error'));
            return back();
        }
    }



    public function aboutUs()
    {
        $data['page'] = Page::query()->whereType('about_us')->first();
        return view('user.pages.index', $data);
    }


    public function showCotnactUs()
    {
        try {
            $data['faqs'] = CommonQuestion::query()->status(CommonQuestionStatus::ACTIVE->value)->get();
            $data['subjects'] = Subject::query()->get();
        } catch (Throwable $e) {
            session()->flash('error', __('general.response_messages.error'));
        }
        return view('user.help_center.contact', $data);
    }

    public function submit(ContactRequest $request)
    {
        try {
            $request['user_id'] =   getAuthUser('web')?->id;
            Contact::query()->create($request->toArray());
            $response = generateResponse(status: true , redirect:route('home'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }

    public function showFaqs()
    {
        $data['faqs'] = CommonQuestion::query()->status(CommonQuestionStatus::ACTIVE->value)->get();
        return view('user.help_center.faqs' , $data);
    }
}
