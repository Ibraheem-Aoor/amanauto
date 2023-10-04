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
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Subject;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use App\Transformers\Admin\ClubTransformer;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\ContactTransformer;
use App\Transformers\Admin\CouponTransformer;
use App\Transformers\Admin\CrudTransfromer;
use App\Transformers\Admin\SubjectTransformer;
use App\Transformers\Admin\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{


    protected $model;

    public function __construct()
    {
        $this->model = new Contact();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.help_center.contacts.index');
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
        $query = $this->model::query()->with(['subject', 'user']);
        $locale = app()->getLocale();
        return DataTables::eloquent($query)
            ->setTransformer(ContactTransformer::class)
            ->filterColumn('subject', function ($query, $keyword) use ($locale) {
                $query->whereHas('subject', function ($subject) use ($keyword, $locale) {
                    $subject->whereHas('translations', function ($translations) use ($keyword, $locale) {
                        $translations->where('locale', $locale)
                            ->where('name', 'like', '%' . $keyword . '%');
                    });
                });

            })
            ->orderColumn('subject', function ($query, $order) use ($locale) {
                $query->whereHas('subject', function ($subject) use ($order, $locale) {
                    $subject->whereHas('translations', function ($translations) use ($order, $locale) {
                        $translations->where('locale', $locale)->orderBy('name', $order);
                    });
                });
            })
            ->filterColumn('user', function ($query, $keyword) use ($locale) {
                $query->whereHas('user', function ($user) use ($keyword, $locale) {
                    $user->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->filterColumn('ams', function ($query, $keyword) use ($locale) {
                $query->whereHas('user', function ($user) use ($keyword, $locale) {
                    $user->where('ams', 'like', '%' . $keyword . '%');
                });
            })
            ->make(true);
    }




}
