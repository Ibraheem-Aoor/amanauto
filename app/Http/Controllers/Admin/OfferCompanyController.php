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
use App\Http\Requests\Admin\OfferCompanyRequest;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Coupon;
use App\Models\OfferCompany;
use App\Models\Service;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CouponTransformer;
use App\Transformers\Admin\CrudTransfromer;
use App\Transformers\Admin\OfferCompanyTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class OfferCompanyController extends Controller
{


    protected $model;
    protected $model_name;
    public $translated_model_name;

    public function __construct()
    {
        $this->model_name = 'Offer Company';
        $this->model = new OfferCompany();
        $this->translated_model_name = __('backend.offers.offer_companies');
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
        $data['discount_types'] = VatType::getNames();
        return view('admin.offer_companies.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferCompanyRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->model::create(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                    ],
                    'location_url' => $request->location_url
                ]
            );
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', reset_form: true, table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
        } catch (Throwable $e) {
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
    public function update(OfferCompanyRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->model->findOrFail($id);
            $coupon->update(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                    ],
                    'location_url' => $request->location_url
                ]
            );
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', reset_form: true, table_reload: true, table: '#myTable', message: __('general.response_messages.update_success'));
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
        $query = $this->model::query()->withCount('offers');
        return DataTables::eloquent($query)
            ->setTransformer(OfferCompanyTransformer::class)
            ->orderColumn('name_ar', function ($query, $order) {
                $query->orderBy(DB::raw("(SELECT name FROM offer_company_translations WHERE offer_company_translations.offer_company_id = offer_companies.id AND locale = 'ar')"), $order);
            })
            ->orderColumn('name_en', function ($query, $order) {
                $query->orderBy(DB::raw("(SELECT name FROM offer_company_translations WHERE offer_company_translations.offer_company_id = offer_companies.id AND locale = 'en')"), $order);
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






}
