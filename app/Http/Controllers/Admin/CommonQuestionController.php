<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommonQuestionRequest;
use App\Http\Requests\Admin\CrudRequest;
use App\Models\Client;
use App\Models\CommonQuestion;
use App\Models\Service;
use App\Transformers\Admin\CommonQuestionTransformer;
use App\Transformers\Admin\CrudTransfromer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class CommonQuestionController extends Controller
{


    protected $model;
    protected $model_name;
    public $translated_model_name;

    public function __construct()
    {
        $this->model_name = 'CommonQuestion';
        $this->model = new CommonQuestion();
        $this->translated_model_name = __('backend.faqs');
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
        return view('admin.faqs.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommonQuestionRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->model::create(
                [
                    'ar' => [
                        'question' => $request->question_ar,
                        'answer' => $request->answer_ar,
                    ],
                    'en' => [
                        'question' => $request->question_en,
                        'answer' => $request->answer_en,
                    ],
                    'added_by' => getAuthUser('admin')->id,
                ]
            );
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
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
    public function update(CommonQuestionRequest $request, $id)
    {
        try {
            $target = $this->model::query()->findOrFail($id);
            DB::beginTransaction();
            $target->update(
                [
                    'ar' => [
                        'question' => $request->question_ar,
                        'answer' => $request->answer_ar,
                    ],
                    'en' => [
                        'question' => $request->question_en,
                        'answer' => $request->answer_en,
                    ],
                ]
            );
            DB::commit();
            $response = generateResponse(status: true, modal_to_hide: '#create-edit-modal', table_reload: true, table: '#myTable', message: __('general.response_messages.create_success'));
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
        $lang = app()->getLocale();
        return DataTables::eloquent($query)
            ->setTransformer(CommonQuestionTransformer::class)
            ->orderColumn('question', function ($query, $order) use ($lang) {
                $query->orderBy(DB::raw("(SELECT question FROM common_question_translations WHERE common_question_translations.common_question_id = common_questions.id AND locale = '{$lang}')"), $order);
            })
            ->orderColumn('answer', function ($query, $order) use ($lang) {
                $query->orderBy(DB::raw("(SELECT answer FROM common_question_translations WHERE common_question_translations.common_question_id = common_questions.id AND locale = '{$lang}')"), $order);
            })
            ->filterColumn('question', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword) {
                    $query->where('question', 'like', "%$keyword%")->whereIn('locale', getAvilableLocales());
                });
            })
            ->filterColumn('answer', function ($query, $keyword) {
                $query->whereHas('translations', function ($query) use ($keyword ) {
                    $query->where('answer', 'like', "%$keyword%")->whereIn('locale', getAvilableLocales());
                });
            })
            ->make(true);
    }





}
