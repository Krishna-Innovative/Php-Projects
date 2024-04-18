<?php 

use Illuminate\Support\Facades\Config;

class AllergySeverity extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allergy_severities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_zh', 'name_pinyin',];

    /**
     * Get the severity's localized name.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }
}