<?php

use Illuminate\Support\Facades\Config;

class SecurityQuestion extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'security_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_en', 'title_zh', 'title_pinyin',];

    /**
     * Get the security question localized title.
     *
     * @return string
     */
    public function getTitle()
    {
        return Config::get('app.locale') == 'zh' ? $this->title_zh : $this->title_en;
    }
}