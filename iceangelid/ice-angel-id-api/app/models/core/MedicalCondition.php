<?php

use Illuminate\Support\Facades\Config;

class MedicalCondition extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_conditions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_zh', 'name_pinyin',];

    /**
     * Get the medical condition's localized name.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }
} 