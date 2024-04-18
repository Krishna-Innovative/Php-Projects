<?php
use Illuminate\Support\Facades\Config;

class OrganDonorStatus extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organ_donor_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_en', 'status_zh', 'status_pinyin',];

    /**
     * Get the organ donor status's localized name.
     *
     * @return string
     */
    public function getStatus()
    {
        return Config::get('app.locale') == 'zh' ? $this->status_zh : $this->status_en;
    }

}