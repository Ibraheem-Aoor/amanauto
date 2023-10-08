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
use App\Http\Requests\Admin\SubscribtionConfirmRequest;
use App\Models\Client;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Coupon;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CouponTransformer;
use App\Transformers\Admin\CrudTransfromer;
use App\Transformers\Admin\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    protected $model;
    protected $model_name;
    public $translated_model_name;

    public function __construct()
    {
        $this->model_name = 'User';
        $this->model = new User();
        $this->translated_model_name = __('backend.users.all_users');
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
        request()->query('view_subscriptions', null) ? ($data['users_subscriptions_page'] = true) : ($data['users_page'] = true);
        return view('admin.users.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->model::create($request->toArray());
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
    public function update(CouponRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->model->findOrFail($id);
            $coupon->update($request->toArray());
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
        $query->where(function ($query) use ($request) {
            $query->when($request->has('view_subscriptions'), function ($result) {
                $result->whereHas('subscriptions');
            });
        });
        return DataTables::eloquent($query)
            ->setTransformer(UserTransformer::class)
            ->orderColumn('subscription', function ($query, $order) {
                $query->whereHas('subscriptions')
                    ->orWhereDoesntHave('subscriptions')
                    ->orderBy('club_id', $order);
            })
            ->orderColumn('current_club', function ($query, $order) {
                $query->whereHas('subscriptions')
                    ->orWhereDoesntHave('subscriptions')
                    ->orderBy('club_id', $order);
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
