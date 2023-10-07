<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionNotification extends Notification
{
    use Queueable;
    public $subscription;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['trans-database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'ar' => [
                'data' => [
                    'title' => trans('notifications.thanks_for_subscribe', [], 'ar'),
                    'body' => trans('notifications.subscribe_success', ['club_nmae' => $this->subscription?->club?->translate('ar')->name], 'ar'),
                    'end_date' => $this->subscription->end_date,
                ],
            ],
            'en' => [
                'data' => [
                    'title' => trans('notifications.thanks_for_subscribe', [], 'en'),
                    'body' => trans('notifications.subscribe_success', ['club_nmae' => $this->subscription?->club?->translate('en')->name], 'en'),
                    'end_date' => $this->subscription->end_date,
                ]
            ],
        ];
    }
}
