<?php


namespace App\Channels;

use App\Models\Notification as ModelsNotification;
use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Notification;


class TranslateDatabaseNotificationChannel extends DatabaseChannel
{

    public function send($notifiable, Notification $notification)
    {
        return ModelsNotification::create(
            $this->buildPayload($notifiable, $notification)
        );
    }

    protected function buildPayload($notifiable, Notification $notification)
    {
        $data=[
            'id' => $notification->id,
            'type' => method_exists($notification, 'databaseType')
                        ? $notification->databaseType($notifiable)
                        : get_class($notification),
            'notifiable_type'=>get_class($notifiable),
            'notifiable_id'=>$notifiable->id,
            'read_at' => null,
        ];
        $data=array_merge($data,$this->getData($notifiable, $notification));
        return $data;
    }


}
