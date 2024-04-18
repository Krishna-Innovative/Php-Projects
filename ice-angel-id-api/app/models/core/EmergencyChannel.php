<?php 

use Illuminate\Support\Facades\Config;

class EmergencyChannel extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emergency_channels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_en', 'title_zh', 'code',];

    /**
     * Get the emergency channel localized title.
     *
     * @return string
     */
    public function getTitle()
    {
        return Config::get('app.locale') == 'zh' ? $this->title_zh : $this->title_en;
    }

}