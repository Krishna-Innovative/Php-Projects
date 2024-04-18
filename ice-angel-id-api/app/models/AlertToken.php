<?php

use Illuminate\Database\Eloquent\Model;

/**
 * Class AlertToken
 *
 * @deprecated
 */
class AlertToken extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alert_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['alert_id', 'token'];

    /**
     * Define relationship between Alert and Token.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alert()
    {
        return $this->belongsTo('Alert', 'alert_id');
    }

    /**
     * Generates a random token.
     *
     * @param int $length
     * @return string
     */
    public static function generateToken($length = 40)
    {
        return str_random($length);
    }

    /**
     * Define byToken query scope.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $token
     * @return mixed
     */
    public function scopeByToken($query, $token)
    {
        return $query->whereToken($token);
    }

    /**
     * Get the last 48 hours.
     *
     * @param $query
     * @return mixed
     */
    public function scopeLast48Hours($query)
    {

        return $query->where('created_at', '>', \Carbon\Carbon::now()->subDays(2));

    }

} 