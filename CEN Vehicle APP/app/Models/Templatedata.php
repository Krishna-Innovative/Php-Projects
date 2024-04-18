<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Templatedata extends Model
{
    use HasFactory;
    protected $table = 'template_data';

    protected $fillable = [
        'template_id',
        'form_id',
        'section',
        'section_name',
        'title',
        'type',
        'field_type_response',
        'isrequired',
        'notes',
        'photos',
        'video',
        'document',
        'list',
        'isactive'
    ];
}
