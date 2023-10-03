<?php
namespace App\Services;

use App\Enums\ClubStatus;
use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Models\Club;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use Throwable;

class SubscriptionService
{

    protected User $user;
    protected Club $club;

    public function __construct($club_id)
    {
        if(str_starts_with(request()->path(), 'api')){
            $decrypted = Crypt::decryptString(urldecode(request()->auth_token));
            $token = PersonalAccessToken::findToken($decrypted);
            $this->user=$token->tokenable;
        }
        else{
            $this->user =  getAuthUser('web');
        }

        $this->club = Club::query()->findOrFail(decrypt($club_id));
    }



    /**
     * confirm user subscription after successfull payment.
     * @param encrypted club_id
     */
    public function confirmUserSubscription()
    {
        $this->user->club_id = $this->club->id;
        $this->user->save();
        $subscription = $this->LogUserClubSubscription();
        return $subscription;
    }


    /**
     * Log User New Subscription into db
     */
    protected function LogUserClubSubscription()
    {
        $user_id=$this->user->id;
        $name="subscriptions/{$user_id}";
        $img_vehicle=Cache::get('img_vehicle_' . $name);
        $user_subscription_type = $this->getUserSubscriptionType();
        return Subscription::query()->create([
            'user_id' => $this->user->id,
            'club_id' => $this->club->id,
            'type' => $user_subscription_type,
            'duration' => $this->club->getDurationOriginalAttribute(),
            'status' => SubscriptionStatus::PENDING->value, //pending till vin is set
            'img_vehicle' => $img_vehicle,
            'end_date'    =>  getSubscriptionEndDate($this->club),
        ]);
    }


    /**
     * return type of the subscription
     */
    protected function getUserSubscriptionType()
    {
        $last_subscribed_club = $this->user->getCurrentSubscription();
        if ($last_subscribed_club == null) {
            return SubscriptionType::SUBSCRIBE->value;
        } elseif ($last_subscribed_club->price > $this->club->price) {
            return SubscriptionType::DOWNGRADE->value;
        } else {
            return SubscriptionType::UPGRADE->value;
        }
    }

}
