<?php

use Illuminate\Support\Facades\Config;

class Surgery extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surgeries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_zh', 'name_pinyin',];

    /**
     * Get the surgery's localized name.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }
} 