<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        $current_subscribed_club = $model->getLastSubscribedClub();

        return [
            'name' => $model->name,
            'ams' => $model->ams,
            'phone' => $model->phone,
            'subscription' => $current_subscribed_club != null ? __('backend.subscribed') : __('backend.unsubscribed'),
            'current_club' => $model->club() != null ? $model->club()->name : __('backend.unsubscribed'),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            // 'action' => $this->getActionButtons($model),
        ];
    }


    /**
     * Action Buttons
     */
    public function getActionButtons($model)
    {
        return '';
    }



}
