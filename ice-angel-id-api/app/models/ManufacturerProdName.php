<?php

use Illuminate\Database\Eloquent\Model;

class ManufacturerProdName extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'manufacturer_productname';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['manufacturername', 'productname', 'isactive',];

    /**
     * Get Accounts that haven't login in $time
     *
     * @param manufacturername,productname
     * @return \Illuminate\Database\Eloquent\model|static[]
     */
    public static function getmfprdname($mfname,$prodname)
    {
        return static::whereRaw("BINARY `manufacturername`= ?",[$mfname])->whereRaw("BINARY `productname`= ?",[$prodname])->first();
    }

}