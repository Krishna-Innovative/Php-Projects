<?php 

use Illuminate\Support\Facades\Config;

class AllergyCategory extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allergy_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_zh', 'name_pinyin',];

    /**
     * Get the category's localized name.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }

    /**
     * Get allergies belongs to the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allergies()
    {
        return $this->hasMany('Allergy', 'category_id', 'id');
    }
}