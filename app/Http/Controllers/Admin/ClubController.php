<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClubStatus;
use App\Enums\Duration;
use App\Enums\VatType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClubRequest;
use App\Http\Requests\Admin\CommonQuestionRequest;
use App\Http\Requests\Admin\CrudRequest;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Service;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CrudTransfromer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ClubController extends Controller
{


    protected $model;
    protected $model_name;
    public $translated_model_name;

    public function __construct()
    {
        $this->model_name = 'Club';
        $this->model = new Club();
        $this->translated_model_name = __('backend.clubs.clubs');
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
        $data['duration_types'] = Duration::getNames();
        $data['vat_types'] = VatType::getNames();
        $data['services'] = Service::query()->get();
        return view('admin.clubs.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClubRequest $request)
    {
        try {
            DB::beginTransaction();
            $club = $this->model::create(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                        'description' => $request->description_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                        'description' => $request->description_en,
                    ],
                    'price' => $request->price,
                    'vat' => $request->vat,
                    'vat_type' => $request->vat_type,
                    'color' => $request->color,
                    'duration' => $request->duration,
                    'duration_type' => $request->duration_type,
                    'times' => $request->times,
                    'added_by' => getAuthUser('admin')->id,
                    'status' => ClubStatus::ACTIVE,
                ]
            );
            $club->services()->sync($request->services);
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', reset_form: true, table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
        } catch (Throwable $e) {
            dd($e);
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
    public function update(ClubRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $club = $this->model->findOrFail($id);
            $club->update(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                        'description' => $request->description_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                        'description' => $request->description_en,
                    ],
                    'prev_price' => $club->price,
                    'price' => $request->price,
                    'vat' => $request->vat,
                    'vat_type' => $request->vat_type,
                    'color' => $request->color,
                    'duration' => $request->duration,
                    'duration_type' => $request->duration_type,
                    'times' => $request->times,
                    'status' => ClubStatus::ACTIVE,
                ]
            );
            $club->services()->sync($request->services);
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', reset_form: true, table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
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
            $target->delete();
            $response = generateResponse(status: true, is_deleted: true, row_to_delete: $id, message: __('general.response_messages.deleted_successflly'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }


    /**
     *  DataTable
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query()->withCount('services');
        $lang = app()->getLocale();
        return DataTables::eloquent($query)
            ->setTransformer(ClubTransformer::class)
            ->orderColumn('name', function ($query, $order) use ($lang) {
                $query->orderBy(DB::raw("(SELECT name FROM club_translations WHERE club_translations.club_id = clubs.id AND locale = '{$lang}')"), $order);
            })
            ->orderColumn('services', function ($query, $order) {
                $query->orderBy('services_count', $order);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%")->whereIn('locale', getAvilableLocales());
                });
            })
            ->make(true);
    }



    /**
     * Toggle Status for club
     */
    public function changeStatus(Request $request)
    {
        try {
            $target = $this->model->findOrFail($request->id);
            $target->update([
                'status' => $request->status ? ClubStatus::ACTIVE->value : ClubStatus::INACTIVE->value,
            ]);
            $response = generateResponse(status: true, is_deleted: true, message: __('general.response_messages.update_success'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }

    /**
     * Toggle Status for club
     */
    public function changeSoon(Request $request)
    {
        try {
            $target = $this->model->findOrFail($request->id);
            $target->update([
                'is_coming_soon' => $request->status,
            ]);
            $response = generateResponse(status: true, is_deleted: true, message: __('general.response_messages.update_success'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }




}
