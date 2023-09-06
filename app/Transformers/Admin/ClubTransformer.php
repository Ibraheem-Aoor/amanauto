<?php

namespace App\Transformers\Admin;

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
            'duration' => $model->duration,
            'times' => $model->times,
            'services' => $model->services_count,
            'status' => $model->status,
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
            . "' data-services='" . json_encode($model->getServicesIds()) . "' " . "' data-price='" . $model->price . "'" . "' data-color='" . $model->color .
            "'" . "' data-duration='" . $model->duration . "'" . "'" . "' data-duration_type='" . $model->duration_type . "'" . "' data-times='" . $model->getTimesOriginalAttribute() . "'
            data-form-action='" . route('admin.clubs.update', $model->id) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.clubs.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }

}
