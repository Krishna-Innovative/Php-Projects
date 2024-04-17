<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($group_question) {
            $group_question->set_question_options()->delete();
        });
    }
    public function group_question_options()
    {
        return $this->hasMany(SetQuestionOption::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function prev_option()
    {
        return $this->belongsTo(SetQuestionOption::class, 'group_question_option_id', 'id');
    }
    public function prev_question()
    {
        return $this->belongsTo(SetQuestion::class, 'prev_group_question_id', 'id');
    }
    public function options()
    {
        return $this->set_question_options();
    }
}
