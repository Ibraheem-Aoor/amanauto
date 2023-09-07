<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class ClubTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        return [
            'name' => $model->name,
            'price' => $model->price,
            'duration' => $model->getDurationOriginalAttribute(),
            'times' => $model->times,
            'services' => $model->services_count,
            'status' => $this->getStatusColumn($model),
            'is_coming_soon' => $this->getSoonColumn($model),
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
            data-target='#create-edit-modal' data-name_ar='" . $model->translate('ar')->name . "' data-name_en='" . $model->translate('en')->name . "'
            data-description_ar='" . $model->translate('ar')->description . "' data-description_en='" . $model->translate('en')->description . "'"
            . "' data-services='" . json_encode($model->getServicesIds()) . "' " . "' data-price='" . $model->price . "'" . "' data-vat='" . $model->vat . "'" . "' data-vat_type='" . $model->vat_type . "'" . "' data-color='" . $model->color .
            "'" . "' data-duration='" . $model->getDurationOriginalAttribute() . "'" . "'" . "' data-duration_type='" . $model->duration_type . "'" . "' data-times='" . $model->getTimesOriginalAttribute() . "'
            data-form-action='" . route('admin.clubs.update', $model->id) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.clubs.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }

    public function getStatusColumn($model)
    {
        $checked = $model->status == ClubStatus::ACTIVE->value ? 'checked' : '';
        return '<div class="custom-control custom-switch text-center">
        <input type="checkbox" class="custom-control-input" id="service-' . $model->id . '"  name="status"' . $checked . ' onchange="toggleStatus($(this));" value="' . $model->id . '">
            <label class="custom-control-label" for="service-' . $model->id . '"></label>
            </div>';
    }
    public function getSoonColumn($model)
    {
        $checked = $model->is_coming_soon ? 'checked' : '';
        return '<div class="custom-control custom-switch text-center">
        <input type="checkbox" class="custom-control-input" id="soon-' . $model->id . '"  name="status"' . $checked . ' onchange="toggleSoon($(this));" value="' . $model->id . '">
            <label class="custom-control-label" for="soon-' . $model->id . '"></label>
            </div>';
    }


}
