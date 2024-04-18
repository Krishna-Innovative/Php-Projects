<?php 

use Illuminate\Support\Facades\Config;

class Allergy extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allergies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'name_en', 'name_zh', 'name_pinyin',];

    /**
     * Get the allergy's localized name.
     *
     * @return string
     */
    public function getName()
    {
        return Config::get('app.locale') == 'zh' ? $this->name_zh : $this->name_en;
    }

    /**
     * Get the allergy's category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('AllergyCategory', 'category_id', 'id');
    }
}