<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommonQuestionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CrudRequest;
use App\Models\Client;
use App\Models\Service;
use App\Transformers\Admin\CrudTransfromer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
        $this->model_name == 'Service' ? $data['services_page'] = true : $data['entities_page'] = true;
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
            $web_img = saveImage(strtolower($this->model_name) . '/web', $request->file('web_img'));
            $mobile_img = saveImage(strtolower($this->model_name) . '/mobile', $request->file('mobile_img'));
            DB::beginTransaction();
            $this->model::create(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                        'description' => $request->description_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                        'description' => $request->description_en,
                    ],
                    'web_img' => $web_img,
                    'mobile_img' => $mobile_img,
                    'added_by' => getAuthUser('admin')->id,
                ]
            );
            DB::commit();
            Artisan::call('cache:clear');
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
        } catch (Throwable $e) {
            dd($e);
            deleteImage($web_img);
            deleteImage($mobile_img);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrudRequest $request, $id)
    {
        try {
            $target = $this->model::query()->findOrFail($id);
            $images = $this->updateImages($request, $target);
            DB::beginTransaction();
            $target->update(
                [
                    'ar' => [
                        'description' => $request->description_ar,
                        'name' => $request->name_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                        'description' => $request->description_en,

                    ],
                    'web_img' => $images['web_img'],
                    'mobile_img' => $images['mobile_img'],
                ]
            );
            DB::commit();
            Artisan::call('cache:clear');
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }

    /**
     * Update Images when update model
     */
    protected function updateImages($request, $target)
    {
        if ($request->hasFile('web_img')) {
            $images['web_img'] = saveImage(strtolower($this->model_name) . '/web', $request->file('web_img'));
            deleteImage($target->web_img);
        } else {
            $images['web_img'] = $target->web_img;
        }
        if ($request->hasFile('mobile_img')) {
            $images['mobile_img'] = saveImage(strtolower($this->model_name) . '/mobile', $request->file('mobile_img'));
            deleteImage($target->mobile_img);
        } else {
            $images['mobile_img'] = $target->mobile_img;
        }
        return $images;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $target = $this->model->findOrFail($id);
            deleteImage($target->web_img);
            deleteImage($target->mobile_img);
            $target->delete();
            Artisan::call('cache:clear');
            $response = generateResponse(status: true, is_deleted: true, row_to_delete: $id, message: __('general.response_messages.deleted_successflly'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }


    /**
     *
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query();

        return DataTables::eloquent($query)
            ->setTransformer(new CrudTransfromer($this->model_name))
            ->orderColumn('name_ar', function ($query, $order) {
                $query->orderBy(DB::raw("(SELECT name FROM service_translations WHERE service_translations.service_id = services.id AND locale = 'ar')"), $order);
            })
            ->orderColumn('name_en', function ($query, $order) {
                $query->orderBy(DB::raw("(SELECT name FROM service_translations WHERE service_translations.service_id = services.id AND locale = 'en')"), $order);
            })
            ->filterColumn('name_ar', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%")->where('locale', 'ar');
                });
            })
            ->filterColumn('name_en', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%")->where('locale', 'en');
                });
            })
            ->make(true);
    }


}
