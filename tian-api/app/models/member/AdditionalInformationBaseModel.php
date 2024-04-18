<?php

use Illuminate\Database\Eloquent\Model;

class AdditionalInformationBaseModel extends Model {

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['member'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $attributes = $model->getDirty();
            unset($attributes['updated_at']);

            $name = get_called_class();

            foreach ($attributes as $attribute => $value) {
                static::$dispatcher->fire("eloquent.attribute.saved.{$attribute}: {$name}", [$model->member, $model, $attribute]);
            }
        });

        static::deleted(function (AdditionalInformationBaseModel $model) {
            $member = $model->member()->getResults();

            $member->contacts()->each(function ($contact) use ($member, $model) {
                $permissions = MemberContactPermission::findByRelation($member->id, $contact['id']);

                if (isset($permissions)){
                    $permissions->deletePermissionFromCollection($model->collectionPath, $model->id);
                }
            });
        });
    }

    /**
     * The model belongs to a Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('Member', 'member_id', 'id');
    }

    /**
     * Default permissions to access all member's information
     *
     * @return array
     */
    public function defaultPermissions()
    {
        $fields = $this->getFillable();
        array_shift($fields);

        return [
            'id' => $this->getKey(),
            'fields' => $fields,
        ];
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $fields = $this->getFillable();
        array_shift($fields);

        $data = [];

        $data['id'] = $this->getKey();

        foreach ($fields as $field) {
            if (in_array($field, array_keys($this->attributes))) {
                $data[$field] = $this->$field;
            }
        }

        return $data;
    }

    /**
     * Set a date field
     *
     * @param $attribute
     * @param $value
     */
    public function saveDate($attribute, $value)
    {
        if (!is_null($value) && is_array($value)) {
            $year = isset($value['year']) && ($value['year'] > 0) ? $value['year'] : null;
            $month = isset($value['month']) && ($value['month'] > 0) ? $value['month'] : null;
            $day = isset($value['day']) && ($value['day'] > 0) ? $value['day'] : null;

            if (is_null($year)){
                $this->attributes[$attribute] = null;
            }else{
                $date = \Carbon\Carbon::create($year, $month, $day, 0);
                $this->attributes[$attribute] = is_null($month) ? (string)$date->year.'-00-00' : (is_null($day) ?
                    implode('-', array($date->year, $date->month, '00')) : (string)$date);
            }
        }
        else {
            $this->attributes[$attribute] = null;
        }
    }

    /**
     * load formatted date field
     *
     * @param $value
     * @return array|object
     */
    public function iCEAngelFormattedDate($value)
    {
        if (!is_null($value)) {

              if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/", $value, $parts))
              {
                     $date = (object)array('year' => intval($parts[1]), 'month' => intval($parts[2]), 'day' => intval($parts[3]));

                     if (checkdate($date->month, $date->day, $date->year)){
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value);
                    }

                    return ['year' => $date->year, 'month' => $date->month ?: null, 'day' => $date->day ?: null];
              }
        }

        return ['year' => null, 'month' => null, 'day' => null];
    }
}