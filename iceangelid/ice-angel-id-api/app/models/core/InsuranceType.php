<?php

use Illuminate\Support\Facades\Config;

class InsuranceType extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insurance_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_en', 'status_zh', 'status_pinyin',];

    /**
     * Get the insurance type's localized title.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }
} 