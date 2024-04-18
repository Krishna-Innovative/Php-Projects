<?php

class Coupon extends \Illuminate\Database\Eloquent\Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'partner_id', 'account_id'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Returns the relationship between Coupon and Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('Account', 'account_id', 'id');
    }

    public static function exists($code){

        return static::where('code', '=', $code)->exists();
    }


    public static function findByPrefix($prefix){

        return static::where('code', 'LIKE', $prefix . '%')->whereNotNull('account_id');
    }


    public static function countByPrefix($prefix){

        return static::findByPrefix($prefix)->whereNotNull('account_id')->count();
    }

    public static function countByPrefixDate($prefix, $date){

        return static::findByPrefix($prefix)->whereDate('created_at', '>=', $date)->whereNotNull('account_id')->count();
    }

 /**
     * Find coupon by code
     *
     * @param $code
     */
    public static function findByCode($code)
    {
        if (!is_null($model = static::where('code', $code)->first())) {
            return $model;
        }

        return null;
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

            'code' => $this->code,

            'partner_id' => $this->partner_id,

            'account_id' => $this->account_id,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at

        ];
    }
}