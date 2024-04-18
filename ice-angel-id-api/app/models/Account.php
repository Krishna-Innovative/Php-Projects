<?php

use IceAngel\Traits\SecurityQuestions;

use Laravel\Cashier\BillableTrait;
use Laravel\Cashier\BillableInterface;

/**
 * Class Account Model
 *
 * An alias class to User in Account Group.
 */
class Account extends User implements BillableInterface{

    use SecurityQuestions;
    use BillableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes from cashier subscriptions.
     *
     * @var array
     */

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'middle_name', 'birth_date', 'nationality', 'gender',
        'phone', 'emergency_channels', 'photo', 'photoID', 'questions', 'twitter_screen_name',
        'security_question_1', 'security_question_2', 'security_answer_1', 'security_answer_2',
        'family_score', 'profile_score', 'language','features',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::created(function ($model) {
            $model->account_id = $model->id;
            $model->clearSecurityQuestionAnswer1Attribute();
            $model->clearSecurityQuestionAnswer2Attribute();
            $model->save();
        });

        static::deleted(function ($model) {
            DB::table('devices')->where('member_id', $model->account_id)->delete();
            DB::table('push_devices')->where('account_id', $model->account_id)->delete();
            DB::table('messages')->where('account_id', $model->account_id)->delete();
            DB::table('pending_requests')->where('requester_id', $model->account_id)->delete();
            DB::table('pending_requests')->where('requested_id', $model->account_id)->delete();
        });

        static::updating(function($model){

            if( is_null($model->attributes['security_question_1']) || is_null($model->attributes['security_question_2']) ){
                $model->clearSecurityQuestionAnswer1Attribute();
                $model->clearSecurityQuestionAnswer2Attribute();
            }

        });
        
        parent::boot();
    }

    /**
     * Set the Account holder default language
     *
     * @param string $value
     */
    public function setLanguageAttribute($value)
    {
        if (in_array($value, Config::get('app.supported_languages'))) {
            $this->attributes['language'] = $value;
        }
        else {
            $this->attributes['language'] = Config::get('app.locale');
        }
    }

    /**
     * Checks if the provided user reset password code is
     * valid without actually resetting the password.
     *
     * @param  string $resetCode
     * @return bool
     */
    public function checkResetPasswordCode($resetCode)
    {
        if ($this->updated_at->lt(\Carbon\Carbon::now()->subHours(48))) {
            return false;
        }

        return parent::checkResetPasswordCode($resetCode);
    }

    /**
     * Returns the relationship between users and groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot, 'user_id');
    }

    /**
     * Returns the relationship between Account and Members.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('Member', 'account_id', 'id');
    }

    /**
     * Returns the Account's guardians.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guardians()
    {

        $guardians = $this->belongsToMany('Account', 'account_guardians', 'account_id', 'guardian_id')->get()->map(function ($guardian) {
            return [
                'id' => $guardian->id,

                'first_name' => $guardian->first_name,

                'last_name' => $guardian->last_name,

                'middle_name' => $guardian->middle_name,

                'email' => $guardian->email,

                'phone' => $guardian->phone,

                'photo' => $guardian->photo,

                'status' => 'accepted',
            ];
        });

        $this->hasMany('PendingRequest', 'requester_id', 'id')->where('type', 'guardian')->get()->each(function ($request) use ($guardians) {

            $guardians->push([
                'id' => $request->requested_id,

                'first_name' => null,

                'last_name' => null,

                'middle_name' => null,

                'email' => $request->email,

                'photo' => null,

                'status' => 'pending',
            ]);

        });

        return $guardians;
    }

    /**
     * Returns the guardian relation between Accounts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guardianFor()
    {
        return $this->belongsToMany('Account', 'account_guardians', 'guardian_id', 'account_id')->withTimestamps();
    }

    /**
     * Returns the contact relation between Account and Members.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactFor()
    {
	return $this->belongsToMany('Member', 'member_contacts', 'contact_id', 'member_id')->withTimestamps();
    }

    /**
     * Returns Members contacts.
     *
     * @return \Illuminate\Support\Collection
     */
    public function contacts()
    {
        $contacts = new \Illuminate\Support\Collection();

        $this->members()->get()->each(function ($member) use ($contacts) {

            $member->contacts()->each(function ($contact) use ($contacts) {

                if (($contact['status'] == 'accepted') && ($contact['id'] != $this->getKey())) {

                    $contacts[$contact['id']] = $contact;

                }

            });

        });

        return $contacts->values();
    }

    /**
     * Returns Members contacts with pending request too.
     *
     * @return \Illuminate\Support\Collection
     */
    public function contactsWithPendingRequest()
    {
        $contacts = new \Illuminate\Support\Collection();

        $this->members()->get()->each(function ($member) use ($contacts) {
            if($member['id'] == $this->getKey()){
                $member->contacts()->each(function ($contact) use ($contacts) {

                    if ($contact['id'] != $this->getKey()) {

                        $contacts[$contact['id']] = $contact;

                    }

                });
            }
        });

        return $contacts->values();
    }

    /**
     * Returns the relationship between Account and Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('Message', 'account_id', 'id');
    }

    /**
     * Returns all account's members plans.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plans()
    {
        return $this->BelongsTo('Plans', 'plan_id', 'id');
    }

    /**
     * Returns messages filtered by viewed flag
     *
     * @return int
     */
    public function viewedMessages($viewed = 0)
    {
        return $this->messages()->where('viewed', $viewed);
    }


    /**
     * Returns the relationship between Account and PushDevice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pushDevices()
    {
        return $this->hasMany('PushDevice', 'account_id', 'id');
    }

    /**
     * Returns all account's members alerts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function alerts()
    {
        return $this->hasManyThrough('Alert', 'Member', 'account_id', 'member_id');
    }

    /**
     * Get friends' alerts
     *
     * @return mixed
     */
    public function friendsAlerts()
    {
        return $this->contactFor()->get()->map(function ($friend) {

            return $friend->recentAlerts();

        })->filter(function ($alert) {

            return !is_null($alert);

        });
    }

    /**
     * Set and serialize the Emergency Channels
     *
     * @param $value
     * @throws ValidationException
     */
    public function setEmergencyChannelsAttribute($value)
    {
        try {

            $this->attributes['emergency_channels'] = base64_encode(serialize($value));

        } catch (Exception $e) {

            throw new ValidationException('ValidationException', $e->getMessage());

        }

    }

    /**
     * Get un-serialized Emergency Channels.
     *
     * @param $value
     * @return mixed|array
     */
    public function getEmergencyChannelsAttribute($value)
    {
        $items = unserialize_base64_decode($value);

        $channels = new \IceAngel\Support\Helpers\EmergencyChannels($items);

        if (isset($this->attributes['facebook_psid']) && !empty($this->attributes['facebook_psid'])){
                $channels->setMessengerChannel();
        }

        return $channels;
    }

    /**
     * Enable push notifications as Account Emergency Channel if not already enabled
     */
    public function enablePushNotificationsAsEmergencyChannel()
    {
        if (!$this->emergency_channels->hasTypePushNotification()) {
            $this->emergency_channels = $this->emergency_channels->enablePushNotifications()->toArray();

            $this->save();
        }
    }

    public function checkSubscriptionDate(){
        
        $end_subscription_date = null;
        if($this->subscribed()){
           \Requests::register_autoloader();
            $url = "https://api.stripe.com/v1/subscriptions/".$this->getStripeSubscription();
            $headers = array();
            $data = array();
            $options = array('auth' => array(Config::get('services.stripe.secret'), ''));
            $charge = \Requests::post($url, $headers, $data, $options);
            $chargeResponse = \json_decode($charge->body); 
            $end_subscription_date = \Carbon\Carbon::createFromTimestamp($chargeResponse->current_period_end)->format('Y-m-d H:i:s');              
        }
        return $end_subscription_date;
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        if (Sentry::getUser() && (Sentry::getUser()->id == $this->getKey())) {

            $end_subscription = $this->onGracePeriod() ? $this->subscription_ends_at : null;

            if (!is_null($end_subscription)){

                $end_subscription =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $end_subscription);

                $end_subscription = array('year' => $end_subscription->year, 'month' => $end_subscription->month, 'day' => $end_subscription->day);

            }

            $features = $this->features ? json_decode($this->features, true) : '';

	    /* $phone = $this->phone;

            $phonenumber = $phone['number'];
            
            $numarray = explode(" ",$phonenumber);

            $phone['number'] = $numarray[1]; */

            return [

                'id' => $this->id,

                'ice_id' => $this->ice_id,

                'first_name' => $this->first_name,

                'last_name' => $this->last_name,

                'middle_name' => $this->middle_name,

                'email' => $this->email,

                'birth_date' => $this->birth_date,

                'gender' => $this->gender,

                'nationality' => (int)$this->nationality,

                'phone' => $this->phone,

                'security_question_1' => $this->getSecurityQuestion1(),

                'security_question_2' => $this->getSecurityQuestion2(),

                'emergency_channels' => $this->emergency_channels,

                'members' => $this->members,

                'guardians_count' => $this->guardians()->count(),

                'friends_count' => $this->guardianFor()->count() + $this->contactFor()->count(),

                'photo' => $this->photo,

                'photoID' => $this->photoID,

                'family_score' => $this->family_score,

                'profile_score' => $this->profile_score,

                'is_partner' => $this->is_partner,

                'plans' => $this->is_partner ? $this->plans ? $this->plans : Plans::where(['is_default'=> 1])->get() :'',

                'average_profile_score' => $this->getMembersAverageProfileScore(),

                'language' => $this->language,

                'is_premium' => $this->is_lifetime || $this->subscribed(),

                'subscription_ends_at'  => $this->is_lifetime ? null : $end_subscription,
		
		'password_update' => $this->pass_update,

		'terms_conditions' => $this->terms_conditions,

        'request'=> $features && $features['request'] ? $features['request'] : 0,


            ];
        }

        // Returns public profile that can be shared with other users.
        return [

            'id' => $this->id,

            'ice_id' => $this->ice_id,

            'first_name' => $this->first_name,

            'last_name' => $this->last_name,

            'middle_name' => $this->middle_name,

            'email' => $this->email,

            'phone' => $this->phone,

            'photo' => $this->photo,

            'account_id' => $this->account_id,

            'is_partner' => $this->is_partner,

            'is_premium' => $this->is_lifetime || $this->subscribed(),

        ];

    }

    /**
     * Retrieve the question by a given number.
     *
     * @param int $num The question number
     * @return string
     */
    public function getQuestion($num = 1)
    {
        if ($num > 2) {
            throw new \InvalidArgumentException('Question number cannot be greater than 2');
        }

        return $this->questions['question' . $num]['id'];
    }

    /**
     * Retrieve the question's anwser by a given number.
     *
     * @param int $num The question number
     * @return string
     */
    public function getQuestionAnswer($num = 1)
    {
        if ($num > 2) {
            throw new \InvalidArgumentException('Question number cannot be greater than 2');
        }

        return $this->questions['question' . $num]['answer'];
    }

    /**
     * Get the average members profile score
     *
     * @return float
     */
    public function getMembersAverageProfileScore()
    {
        $membersCount = $this->members()->count();
        $sumMembersScore = $this->members()->get(['profile_score'])->reduce(function ($carry, $member) {
            $carry += $member->profile_score ?: 0;

            return $carry;
        });

        return round($sumMembersScore / $membersCount, 2);
    }

    /**
     * Check if the account allows to send email when the given event occur
     *
     * @param string $event
     * @return bool
     */
    public function canSendNotificationEmail($event = '')
    {
        // @TODO: to be implemented
        return true;
    }

    /**
     * Check if the Account holder has members.
     * The Account's member profile is excluded
     *
     * @return bool
     */
    public function hasMembers()
    {
        return !!$this->members()->where('id', '<>', $this->getKey())->count();
    }

    /**
     * Check if the Account holder has ecp.
     * The Account's member profile is excluded
     *
     * @return bool
     */
    public function hasContactsWithPendingRequest()
    {
        return !!$this->contactsWithPendingRequest()->count();
    }
    
    /**
     * Check if the Account has Friends in Need
     *
     * @return bool
     */
    public function hasFriendsInNeed()
    {
        return !!$this->contactFor()->count() || !!$this->guardianFor()->count();
    }

    /**
     * Check if the Account has Guardians
     *
     * @return bool
     */
    public function hasGuardians()
    {
        return !!$this->guardians()->count();
    }

    /**
     * Get Accounts that haven't login in $time
     *
     * @param \Carbon\Carbon $time
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function findLastLoginBefore($time)
    {
        return static::whereNotNull('last_login')
            ->where('last_login', '<=', $time)
            ->where('updated_at', '<=', $time)
            ->get();
    }

     /**
     * Check if the Account has Guardians
     *
     * @return bool
     */
    public function haveSecurityQuestionsChanged($data)
    {
        return  $this->attributes['security_question_1'] != $data['security_question_1'] ||
                $this->attributes['security_question_2'] != $data['security_question_2'] ||
                (isset($data['security_answer_1']) && $this->attributes['security_answer_1'] != $data['security_answer_1']) ||
                (isset($data['security_answer_2']) && $this->attributes['security_answer_2'] != $data['security_answer_2']);
    }

} 
