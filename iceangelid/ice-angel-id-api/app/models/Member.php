<?php

/**
 * Class Member Model
 *
 * An alias class to User in Member Group.
 */
class Member extends User {

    use AdditionalInformationTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'first_name', 'last_name', 'middle_name', 'birth_date', 'nationality', 'gender', 'photo', 'photoID', 'phone', 'account_id', 'use_account_email', 'use_account_phone',];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            DB::table('pending_requests')->where('requester_id', $model->getKey())->delete();
            DB::table('member_contacts')->where('member_id', $model->getKey())->delete();
            DB::table('member_contact_permissions')->where('member_id', $model->getKey())->delete();
            DB::table('member_shared_profiles')->where('member_id', $model->getKey())->delete();

            $model->devices()->get()->each(function ($device) {
                DB::table('push_devices')->where('device_id', $device->id)->delete();
            });
            $model->devices()->delete();
            $model->alerts()->delete();
            $model->deleteAdditionalInformation();
        });
    }

    /**
     * Override the validate method to allow empty email and password
     *
     * @return bool
     * @throws ValidationException
     */
    public function validate()
    {
        if ($this->isDirty('email') && (!is_null($this->email)) && ($count = $this->whereEmail($this->email)->count()) && ($count > 0)) {
            throw new ValidationException('ValidationException', trans('validation.unique', ['attribute' => 'email address']));
        }

        return true;
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
     * Returns the relationship between Member and Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('Account', 'account_id', 'id');
    }

    /**
     * Returns the Member's contacts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function contacts($pending = true)
    {
        $contacts = $this->belongsToMany('Account', 'member_contacts', 'member_id', 'contact_id')->get()->map(function ($contact) {
            return [
                'id' => $contact->id,

                'first_name' => $contact->first_name,

                'last_name' => $contact->last_name,

                'middle_name' => $contact->middle_name,

                'email' => $contact->email,

                'phone' => $contact->phone,

                'photo' => $contact->photo,

                'status' => 'accepted',
            ];
        });

        if ($pending){

            $this->hasMany('PendingRequest', 'requester_id', 'id')->where('type', 'contact')->get()->each(function ($request) use ($contacts) {

                $contacts->push([
                    'id' => $request->requested_id,

                    'first_name' => $request->contact_name,

                    'last_name' => null,

                    'middle_name' => null,

                    'email' => $request->email,

                    'phone' => unserialize_base64_decode($request->phone),

                    'photo' => null,

                    'status' => 'pending',
                ]);

            });

        }

        return $contacts;
    }

    /**
     * Check if the given account is one of the member's contacts
     *
     * @param int $contactId
     * @return bool
     */
    public function hasContact($accountId)
    {
        return !!DB::table('member_contacts')
            ->where('member_id', $this->getKey())
            ->where('contact_id', $accountId)
            ->count();
    }

    /**
     * Returns the relationship between Alert and Member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alerts()
    {
        return $this->hasMany('Alert', 'member_id', 'id');
    }

    /**
     * Device relationship for the Member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany('Device', 'member_id', 'id');
    }

    /**
     * Get the latest alerts.
     *
     * @return mixed
     */
    public function recentAlerts()
    {
        return $this->alerts()->latest()->last48Hours()->get();
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [

            'id' => $this->id,

            'ice_id' => $this->ice_id,

            'first_name' => $this->first_name,

            'last_name' => $this->last_name,

            'middle_name' => $this->middle_name,

            'fullname' => $this->fullname(),

            'email' => $this->use_account_email ? $this->account->email : $this->email,

            'birth_date' => $this->birth_date,

            'gender' => $this->gender,

            'nationality' => (int)$this->nationality,

            'phone' => $this->phone,

            'account_id' => $this->account_id,

            'additional_information' => $this->getAdditionalInformation(),

            'contacts' => $this->contacts()->toArray(),

            'photo' => $this->photo,

            'photoID' => $this->photoID,

            'devices' => $this->devices()->getResults(),

            'profile_score' => $this->profile_score,

            'use_account_email' => (bool)$this->use_account_email,

            'use_account_phone' => (bool)$this->use_account_phone,

        ];
    }

    /**
     * Find member by his ICE Angel id.
     *
     * @param $iceId
     */
    public static function findByIceId($iceId)
    {
        if (!is_null($model = static::where('ice_id', $iceId)->first())) {
            return $model;
        }

        throw (new \Illuminate\Database\Eloquent\ModelNotFoundException)->setModel(get_called_class());
    }

    /**
     * Find member by his ICE Angel id.
     *
     * @param $iceId
     */
    public static function findByEmail($email)
    {
        if (!is_null($model = static::where('email', $email)->first())) {
            return $model;
        }

        return null;
    }

    /**
     * Generate a link to register an account with data base65 encoded
     *
     * @return string
     */
    public function generateTransferLink($email)
    {
        $data = [
            'id' => $this->id,

            'first_name' => $this->first_name,

            'last_name' => $this->last_name,

            'middle_name' => $this->middle_name,

            'email' => $email,

            'birth_date' => $this->birth_date,

            'gender' => $this->gender,

            'nationality' => (int)$this->nationality,

            'phone' => $this->phone,

            'photo' => $this->photo,
        ];

        return web_app_url('register', $this->account->language, ['query' => '?data=' . base64_encode(http_build_query($data))]);
    }

    /**
     * Get Members with profile updated in the last $time.
     *
     * @param \Carbon\Carbon $time
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function findUpdatedAfter($time)
    {
        return static::where('updated_at', '>=', $time)->get();
    }
} 
