<?php

class Plans extends \Illuminate\Database\Eloquent\Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_zh', 'name_pinyin','member_count'];


    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [

            'id' => $this->getKey(),

            'name_en' => $this->name_en,

            'name_zh' => $this->name_zh,

            'name_pinyin' => $this->name_pinyin,

            'member_count' => $this->member_count,

        ];
    }
    

}