<?php

class Message extends \Illuminate\Database\Eloquent\Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id', 'type', 'message_placeholders', 'payload', 'pending_request_id',];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function ($message) {
            \Socket::pushFromServer('messages', ['data' => [$message->toArray()]], [$message->account_id]);
        });

        self::deleted(function ($message) {
            $data = $message->toArray();
            $data['deleted'] = true;

            \Socket::pushFromServer('messages', ['data' => [$data]], [$message->account_id]);
        });
    }

    /**
     * Returns the relationship between Message and Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->BelongsTo('Account', 'account_id', 'id');
    }

    /**
     * Change status of the messages for the given IDs.
     *
     * @param  array $ids
     * @return int
     */
    public static function setAsViewed($ids)
    {
        $count = 0;

        $instance = new static;

        $key = $instance->getKeyName();

        foreach ($instance->whereIn($key, $ids)->get() as $model) {
            $model->viewed = 1;
            $model->save();
            $count++;
        }

        return $count;
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [

            'id' => $this->getKey(),

            'type' => $this->type,

            'message' => trans('messages.' . $this->type, unserialize_base64_decode($this->message_placeholders)),

            'payload' => unserialize_base64_decode($this->payload),

            'viewed' => $this->viewed,

            'created_at' => $this->created_at,

        ];
    }
}