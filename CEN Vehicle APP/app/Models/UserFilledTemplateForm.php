<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFilledTemplateForm extends Model
{
    use HasFactory;
    protected $table = 'user_filled_template_form';

    protected $fillable = [
        'user_id',
        'template_id',
        'iscompleted',
        'form_number',
        'pdf'
    ];
}
