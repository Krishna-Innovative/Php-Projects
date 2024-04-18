<?php

use Illuminate\Support\Facades\Config;

class Page extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_en', 'title_zh', 'body_en', 'body_zh', 'slug',];

    /**
     * Get the page localized title.
     *
     * @return string
     */
    public function getTitle()
    {
        return Config::get('app.locale') == 'zh' ? $this->title_zh : $this->title_en;
    }

    /**
     * Get the page localized body.
     *
     * @return string
     */
    public function getBody()
    {
        return Config::get('app.locale') == 'zh' ? $this->body_zh : $this->body_en;
    }

}