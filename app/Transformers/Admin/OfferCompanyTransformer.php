<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class OfferCompanyTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        return [
            'name_ar' => $model->translate('ar')->name,
            'name_en' => $model->translate('en')->name,
            'location' => "<a href='" . $model->location_url . "' target='_blank'><i class='fa fa-map'></i></a>",
            'offers' => $model->offers_count,
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
            data-target='#create-edit-modal' data-name-ar='" . $model->translate('ar')->name . "' data-name-en='" . $model->translate('en')->name . "' data-location='" . $model->location_url . "'
            data-form-action='" . route('admin.offer-company.update', $model->id) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.offer-company.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }



}
