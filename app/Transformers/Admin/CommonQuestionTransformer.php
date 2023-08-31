<?php

namespace App\Transformers\Admin;

use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class CommonQuestionTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        return [
            'question' => $model->getDisplayQuestionOrAnswer(),
            'answer' => $model->getDisplayQuestionOrAnswer('answer'),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'action' => $this->getActionButtons($model)
        ];
    }



    /**
     * Action Buttons
     */
    public function getActionButtons($model)
    {
        return "<div class='d-flex'><button class='btn-xs btn-success' data-toggle='modal'
            data-target='#create-edit-modal' data-question-ar='" . $model?->translate('ar')?->question . "'
            data-question-en='" . $model?->translate('en')?->question . "'  data-answer-ar='" . $model?->translate('ar')?->answer . "'
            data-answer-en='" . $model?->translate('en')?->answer . "'
            data-form-action='" . route('admin.faqs.update', $model->id) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.faqs.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->getDisplayQuestionOrAnswer() . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }

}
