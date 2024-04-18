<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSetQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', "upated_at"];
	public function group_questions()
    {
		 
       return $this->hasMany(GroupQuestion::class);
		//return $this->hasMany(QuestionSetQuestion::class)->where('question_set_id', 21);
		
	
		
    }
	
	public function scopeDailyJournal($query)
    {
        return $query->where('question_category_id', QuestionCategory::$DAILY_JOURNAL_ID);
		
	//	return $query->where('question_set_id', 21);
		
		
    }
    public function scopeselfAssessment($query)
     {
        //return $query->where('question_category_id', QuestionCategory::$SELF_ASSESSMENT_ID);
		
		return $query->where('question_set_id', 29);
		
		
    }
	
	public function group_question_options()
    {
        return $this->hasMany(QuestionOption::class);
    }
    public function question()
    { 
        return $this->belongsTo(Question::class); 
    }
    public function prev_option()
    {
        return $this->belongsTo(QuestionOption::class, 'group_question_option_id', 'id');
    }
    public function prev_question()
    {
        return $this->belongsTo(GroupQuestion::class, 'prev_group_question_id', 'id');
    }
    public function options()
    {
        return $this->group_question_options();
    }
	public function questions()
    { 
        return $this->hasManyThrough(
            Question::class,
			QuestionSetQuestion::class,
          // GroupQuestion::class,
           // 'question_group_id',
            //"id",
			"question_id"
          // "id"
            
        );
    }
}
