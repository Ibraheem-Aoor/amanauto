<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClubStatus;
use App\Enums\Duration;
use App\Enums\SubscriptionStatus;
use App\Enums\VatType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClubRequest;
use App\Http\Requests\Admin\CommonQuestionRequest;
use App\Http\Requests\Admin\CouponRequest;
use App\Http\Requests\Admin\CrudRequest;
use App\Http\Requests\Admin\SubjectRequest;
use App\Http\Requests\Admin\SubscribtionConfirmRequest;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Coupon;
use App\Models\Subject;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CouponTransformer;
use App\Transformers\Admin\CrudTransfromer;
use App\Transformers\Admin\SubjectTransformer;
use App\Transformers\Admin\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{


    protected $model;

    public function __construct()
    {
        $this->model = new Subject();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.help_center.subjects.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->model::create([
                'ar' => [
                    'name' => $request->get('name_ar')
                ],
                'en' => [
                    'name' => $request->get('name_en')
                ],
                'added_by' => getAuthUser('admin')->id,
            ]);
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
    public function update(SubjectRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->model->findOrFail($id);
            $coupon->update(
                [
                    'ar' => [
                        'name' => $request->get('name_ar')
                    ],
                    'en' => [
                        'name' => $request->get('name_en')
                    ],
                    'added_by' => getAuthUser('admin')->id,
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
        $query = $this->model::query();
        return DataTables::eloquent($query)
            ->setTransformer(SubjectTransformer::class)
            ->filterColumn('name_ar', function ($query, $keyword) {
                $query->whereHas('translations', function ($translations) use ($keyword) {
                    $translations->where('locale', 'ar')
                        ->where('name', 'like', '%' . $keyword . '%');
                });

            })
            ->orderColumn('name_ar', function ($query, $order) {
                $query->whereHas('translations', function ($translations) use ($order) {
                    $translations->where('locale', 'ar')->orderBy('name', $order);
                });
            })
            ->filterColumn('name_en', function ($query, $keyword) {
                $query->whereHas('translations', function ($translations) use ($keyword) {
                    $translations->where('locale', 'en')
                        ->where('name', 'like', '%' . $keyword . '%');
                });
            })->orderColumn('name_en', function ($query, $order) {
            $query->whereHas('translations', function ($translations) use ($order) {
                $translations
                    ->where('locale', 'en')->orderBy('name', $order);
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
     * Confirm Subscribtion VIN
     */
    public function confirmSubscribtion(SubscribtionConfirmRequest $request)
    {
        try {
            $subscribtion = Subscription::query()->find($request->subscribtion_id);
            $subscribtion->update([
                'vin' => $request->vin,
            ]);
            $response = generateResponse(status: true, reset_form: true, table_reload: true, table: "#myTable", modal_to_hide: "#confirm-vin-modal");
        } catch (Throwable $e) {
            $response = generateResponse(status: false);
        }
        return response()->json($response);
    }

}
