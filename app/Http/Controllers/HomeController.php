<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CommonQuestion;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
}
