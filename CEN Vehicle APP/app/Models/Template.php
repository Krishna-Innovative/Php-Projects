<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\UserTemplate;
class Template extends Model
{
    use HasFactory,Searchable;
    protected $table = 'templates';

    protected $fillable = [
        'name',
        'description',
        'form_count',
        'createdby'
    ];
    public function user()
    {
        return $this->belongsTo(Driver::class);
    }

    public function user_template() 
    {
        return $this->hasMany(UserTemplate::class);
    }
    /*
    User=>user
    comment-> user_template
    post=> template */
    // public function template(): BelongsToMany
    // {
    //     return $this->belongsToMany(::class, 'role_user', 'user_id', 'template_id');
    // }
    
}
