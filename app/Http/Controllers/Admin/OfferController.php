<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClubStatus;
use App\Enums\Duration;
use App\Enums\OfferStatus;
use App\Enums\VatType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClubRequest;
use App\Http\Requests\Admin\CommonQuestionRequest;
use App\Http\Requests\Admin\CouponRequest;
use App\Http\Requests\Admin\CrudRequest;
use App\Http\Requests\Admin\OfferCompanyRequest;
use App\Http\Requests\Admin\OfferRequest;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\OfferCompany;
use App\Models\Service;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CouponTransformer;
use App\Transformers\Admin\CrudTransfromer;
use App\Transformers\Admin\OfferCompanyTransformer;
use App\Transformers\Admin\OfferTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{


    protected $model;
    protected $model_name;
    public $translated_model_name;

    public function __construct()
    {
        $this->model_name = 'Offer';
        $this->model = new Offer();
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
        $data['companies'] = OfferCompany::query()->get(['id']);
        return view('admin.offers.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        try {
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
                    'end_date' => $request->end_date,
                    'discount_value' => $request->discount_value,
                    'discount_type' => $request->discount_type,
                    'offer_company_id' => $request->company_id,
                    'added_by' => getAuthUser('admin')?->id,
                ]
            );
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
    public function update(OfferRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $offer = $this->model->findOrFail($id);
            $offer->update(
                [
                    'ar' => [
                        'name' => $request->name_ar,
                        'description' => $request->description_ar,
                    ],
                    'en' => [
                        'name' => $request->name_en,
                        'description' => $request->description_en,
                    ],
                    'end_date' => $request->end_date,
                    'discount_value' => $request->discount_value,
                    'discount_type' => $request->discount_type,
                    'offer_company_id' => $request->company_id,
                    'added_by' => getAuthUser('admin')?->id,
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
        $query = $this->model::query()->with('company');
        return DataTables::eloquent($query)
            ->setTransformer(OfferTransformer::class)
            ->orderColumn('name_ar', function ($query, $order) {
                $query->orderBy(DB::raw("(SELECT name FROM offer_translations WHERE offer_translations.offer_id = offers.id AND locale = 'ar')"), $order);
            })
            ->orderColumn('name_en', function ($query, $order) {
                $query->orderBy(DB::raw("(SELECT name FROM offer_translations WHERE offer_translations.offer_id = offers.id AND locale = 'en')"), $order);
            })
            ->orderColumn('company', function ($query, $order) {
                $query->whereHas('company', function ($company) use ($order) {
                    $company->whereHas('translations', function ($query) use ($order) {
                        $query->orderBy('name', $order);
                    });
                });
            })
            ->filterColumn('company', function ($query, $keyword) {
                $query->whereHas('company', function ($company) use ($keyword) {
                    $company->whereHas('translations', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%")->whereIn('locale', getAvilableLocales());
                    });
                });
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
                'status' => $request->status ? OfferStatus::ACTIVE->value : OfferStatus::INACTIVE->value,
            ]);
            $response = generateResponse(status: true, is_deleted: true, message: __('general.response_messages.update_success'));
        } catch (Throwable $e) {
            dd($e);
            $response = generateResponse(status: false);
        }
        return response()->json($response, $response['code']);
    }






}
