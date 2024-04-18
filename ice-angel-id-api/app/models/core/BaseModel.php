<?php 

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    /**
     * Create a new Eloquent model instance, and set the default database connection.
     *
     * @param  array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->setConnection('api');
    }

}