<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Enums\OfferStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class OfferUserTransformer extends TransformerAbstract
{
    public $offer;

    public function __construct($offer)
    {
        $this->offer = $offer;
    }

    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        return [
            'name' => $model->name,
            'ams' => $model->ams,
            'phone' => $model->phone,
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'action' => $this->getActionButtons($model)
        ];
    }



    /**
     * Action Buttons
     */
    public function getActionButtons($model)
    {
        return "<div class='d-flex'>
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.offer.destroy_user', ['user_id' => $model->id, 'offer_id' => $this->offer->id]) . "" . "' id='row-" . $model->id . "'
                data-model='" . "' data-message='" . __('general.confirm_delete_offer_user') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }





}
