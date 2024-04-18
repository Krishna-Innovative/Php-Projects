<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTemplateResponse extends Model
{
    use HasFactory;
    protected $table = 'user_template_response';
    protected $fillable = [
        'user_id',
        'template_id',
        'form_id',
        'section',
        'section_name',
        'title',
        'type',
        'isrequired',
        'field_type_response',
        'field_value',
        'notes',
        'photos',
        'video',
        'document',
        'isactive',
        'isLive',
        'savedOnDate',
        'signature',
    ];

    public function user()
    {
        $this->belongsTo('App\Driver');
    }

    public function templates()
    {
        $this->belongsTo('App\Template');
    }
}
