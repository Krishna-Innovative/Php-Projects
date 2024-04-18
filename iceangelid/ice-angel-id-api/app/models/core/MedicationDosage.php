<?php

use Illuminate\Support\Facades\Config;

class MedicationDosage extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medication_dosages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_zh', 'name_pinyin', 'abbr',];

    /**
     * Get the country's localized title.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }
} 