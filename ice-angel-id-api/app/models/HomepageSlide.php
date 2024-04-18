<?php

class HomepageSlide extends \Illuminate\Database\Eloquent\Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'homepage_slides';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('image_url', 'title_en', 'title_zh', 'caption_en', 'caption_zh', 'url_en', 'url_zh');

}