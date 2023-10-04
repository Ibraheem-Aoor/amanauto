<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Enums\OfferStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;
use Str;

class ContactTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        return [
            'subject' => $model->subject?->name,
            'user' => $model->user?->name,
            'ams' => $model->user?->ams,
            'details' => Str::limit($model->details, 35, '...'),
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
            data-target='#show-modal' data-subject='" . $model?->subject?->name . "' data-details='" . $model->details . "' data-user-name='" . $model->user?->name . "' data-ams='" . $model->user?->ams . "'><i class='fa fa-eye'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.help_center.contacts.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' ><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }

}
