<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CrudRequest;
use App\Models\Client;
use App\Models\Service;
use App\Transformers\Admin\CrudTransfromer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class CommonCrudController extends Controller
{


    protected $model;
    protected $model_name;
    public $translated_model_name;
    public function __construct(Request $request)
    {
        $this->model_name = $request->model;
        if ($this->model_name != null) {
            if ($this->model_name == 'Service') {
                $this->model = new Service;
                $this->translated_model_name = 'services';
            } elseif ($this->model_name == 'Client') {
                $this->model = new Client;
                $this->translated_model_name = 'client';
            }
        } else {
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['model'] = $this->model_name;
        $data['translated_model_name'] = $this->translated_model_name;
        return view('admin.crud.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudRequest $request)
    {
        try {
            $web_img = SaveImage(strtolower($this->model_name) . '/web', $request->file('web_img'));
            $mobile_img = SaveImage(strtolower($this->model_name) . '/mobile', $request->file('mobile_img'));
            DB::beginTransaction();
            $this->model::create(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                    ],
                    'en' => [
                        'name' => $request->name_ar,
                    ],
                    'web_img' => $web_img,
                    'mobile_img' => $mobile_img,
                ]
            );
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', table_reload: true, table: '#myTable');
        } catch (Throwable $e) {
            dd($e);
            deleteImage($web_img);
            deleteImage($mobile_img);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function getTableData(Request $request)
    {
        $query = $this->model::query()
            ->leftJoin('service_translations AS translations_ar', function ($join) {
                $join->on('services.id', '=', 'translations_ar.service_id')
                    ->where('translations_ar.locale', '=', 'ar');
            })
            ->leftJoin('service_translations AS translations_en', function ($join) {
                $join->on('services.id', '=', 'translations_en.service_id')
                    ->where('translations_en.locale', '=', 'en');
            })
            ->select('services.id', 'translations_ar.name AS name_ar', 'translations_en.name AS name_en', 'services.created_at');

        if ($request->has('search') && $request->input('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->whereHas('translations', function ($q) use ($searchValue) {
                    $q->where('translations_ar.name', 'like', '%' . $searchValue . '%')
                        ->orWhere('translations_en.name', 'like', '%' . $searchValue . '%');
                }, 'translations_ar')
                    ->orWhereHas('translations', function ($q) use ($searchValue) {
                        $q->where('translations_ar.name', 'like', '%' . $searchValue . '%')
                            ->orWhere('translations_en.name', 'like', '%' . $searchValue . '%');
                    }, 'translations_en');
            });
        }

        return DataTables::of($query)->setTransformer(new CrudTransfromer($this->model_name))->make(true);
    }


}
