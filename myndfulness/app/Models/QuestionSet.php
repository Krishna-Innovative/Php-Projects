<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', "updated_at"];
    public function set_questions()
    {
        return $this->hasMany(SetQuestion::class);
    }

    /**
     * Scope a query to only include onboarding
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnboarding($query)
    {
        return $query->where('question_category_id', QuestionCategory::$ONBOARDING_ID);
    }
    /**
     * Scope a query to only include daily journal
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDailyJournal($query)
    {
        return $query->where('question_category_id', QuestionCategory::$DAILY_JOURNAL_ID);
    }
    /**
     * Scope a query to only include self assessment
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSelfAssessment($query)
    {
        return $query->where('question_category_id', QuestionCategory::$SELF_ASSESEMENT_ID);
    }
    public function questions()
    {
        return $this->hasManyThrough(
            Question::class,
            SetQuestion::class,
            'question_set_id',
            "id",
            "id",
            "question_id"
        );
    }
}
