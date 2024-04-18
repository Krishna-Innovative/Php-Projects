<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    use HasFactory;
    protected $table = 'user_template';

    public function user()
    {
        $this->belongsTo('App\Driver');
    }

    public function templates()
    {
        $this->belongsTo('App\Template');
    }
}
