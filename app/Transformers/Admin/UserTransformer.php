<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Enums\SubscriptionType;
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
        $current_subscribed_club = $model->getCurrentSubscription();
        return [
            'name' => $model->name,
            'ams' => $model->ams,
            'phone' => $model->phone,
            'subscription' => $current_subscribed_club != null ? __('backend.subscribed') : __('backend.unsubscribed'),
            'current_club' => $model->club != null ? $model->club->name : __('backend.unsubscribed'),
            'subscribtion_type' => $this->getSubscribtionTypeBadge($current_subscribed_club),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'action' => $this->getActionButtons($model, $current_subscribed_club),
        ];
    }


    /**
     * Action Buttons
     */
    public function getActionButtons($model, $subscribtion)
    {
        return "<div class='d-flex'><button class='btn-xs btn-success' data-toggle='modal'
            data-target='#create-edit-modal' data-club-name='" . $subscribtion?->club?->name . "' data-subscrobtion-date='" . $subscribtion?->created_at->format('Y-m-d H:i:s') .
            "' data-paid-amount='" . $subscribtion?->getPayment()?->amount . " " . getSystemCurrency() . "'
            " . "' data-file-download='" . route('admin.file.download', ['path' => getImageUrl($subscribtion->img_vehicle)]) . "'
            " . "' data-subscribtion-id='" . $subscribtion->id . "'
            " . "' data-vin='" . $subscribtion->vin . "'
            data-file-view='" . getImageUrl($subscribtion->img_vehicle) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button>";
    }


    /**
     * Get Subscribtion type in a badge
     */
    public function getSubscribtionTypeBadge($current_subscribed_club)
    {
        $text = $current_subscribed_club != null ? __('general.' . $current_subscribed_club->type) : __('backend.unsubscribed');
        if ($current_subscribed_club?->type == SubscriptionType::UPGRADE->value) {
            $badge_type = 'success';
        } elseif ($current_subscribed_club?->type == SubscriptionType::SUBSCRIBE->value) {
            $badge_type = 'primary';
        } else {
            $badge_type = 'secondary';
        }
        return "<span class='badge badge-{$badge_type}'>{$text}</span>";
    }

}
