<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Enums\OfferStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class SubjectTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        $locale = app()->getLocale();
        return [
            'name_ar' => $model->translate('ar')->name,
            'name_en' => $model->translate('en')->name,
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
            data-target='#create-edit-modal' data-name-ar='" . $model->translate('ar')->name . "' data-name-en='" . $model->translate('en')->name . "'
            data-form-action='" . route('admin.help_center.subjects.update', $model->id) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.help_center.subjects.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }


    public function getStatusColumn($model)
    {
        $checked = $model->status == OfferStatus::ACTIVE->value ? 'checked' : '';
        return '<div class="custom-control custom-switch text-center">
        <input type="checkbox" class="custom-control-input" id="service-' . $model->id . '"  name="status"' . $checked . ' onchange="toggleStatus($(this));" value="' . $model->id . '">
            <label class="custom-control-label" for="service-' . $model->id . '"></label>
            </div>';
    }


}
