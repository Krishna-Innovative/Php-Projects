<?php

use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'watchdog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('user_id', 'message_key', 'variables', 'hostname',);

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getKey(),
            'message' => trans($this->message_key, unserialize(base64_decode($this->variables))),
            'created_at' => $this->created_at,
            'hostname' => $this->hostname,
        ];
    }
}