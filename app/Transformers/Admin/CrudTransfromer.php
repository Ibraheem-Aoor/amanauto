<?php

namespace App\Transformers\Admin;

use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class CrudTransfromer extends TransformerAbstract
{


    protected $model_class;
    public function __construct($model_class)
    {
        $this->model_class = $model_class;

    }


    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
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
            data-target='#create-edit-modal' data-name-ar='" . $model->translate('ar')->name . "' data-description-ar='" . $model->translate('ar')->description . "'
                data-description-en='" . $model->translate('en')->description . "'
            data-name-en='" . $model->translate('en')->name . "' data-web-img='" . getImageUrl($model->web_img) . "' data-mobile-img='" . getImageUrl($model->mobile_img) . "'
            data-form-action='" . route('admin.crud.update', $model->id) . "?model=" . $this->model_class . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.crud.destroy', $model->id) . "?model=" . $this->model_class . "' id='row-" . $model->id . "' data-model='" . $this->model_class . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }

}
