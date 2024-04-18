<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class DailyJournalReponse extends Model
{
    use HasFactory, SoftDeletes;
    const COIN_LIMIT_FOR_MEDAL = 63;
    const MIN_COIN_PER_RESPONSE = 2;
    const COIN_AFTER_450_CHARACTER = 1;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ["id"];
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function($model){
            $model->transactions()->delete();
        });
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'json_response' => 'json',
        'response_date' => 'date',
    ];
    /**
     * Scope a query to only include user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserFilter($query, $user_id = null)
    {
        return $query->when($user_id, function ($query) use ($user_id) {
            return $query->where('user_id', $user_id);
        });
    }
    public function transactions()
    {
        return $this->hasMany(DailyJournalResponseTransactions::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rewards()
    {
        return $this->morphMany(Reward::class, "rewardable");
    }

 public function scopeSetFilter($query, $set_id = null)
    {
            $question_set_id= DB::table('question_set_questions')->select('question_set_id')->where('question_id', $set_id)->get();
		    $question_set_id= json_decode($question_set_id); 
		return	$question_set_id= $question_set_id[0]->question_set_id;
		//return $results = DB::select('select name,category from question_sets where id = ?', [$question_set_id]);
    }
    /**
     * Scope a query to only include search
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search = null)
    {
        return $query->when($search, function ($query) use ($search) {
            return $query->whereHas("user", function ($user_query) use ($search) {
                return $user_query->where("name", "LIKE", "%{$search}%")
                    ->orWhere("email", "LIKE", "%{$search}%");
            });
        });
    }

    public function scopeDailySubmit($query,$userId)
     { 
      
        //$post = $query->where('created_at', '>=', Carbon::now()->subDay())->get()->toArray();
	
		$post = $query->where('user_id', $userId)->orderBy('created_at','DESC')->first();
		//print_r($post); die("hhghghgh");
		if(!empty($post)){
		$post =	$post->toArray();
	    $result = [];
		$question_set_id= $post['question_set_id'];
		if($question_set_id == ''){
			$default_question_set_id= DB::table('question_sets')->select('id','name')->where('category', 'Daily Journal')->limit(1)->get();
			$default_question_set_id= json_decode($default_question_set_id);
			$nextSetId= $default_question_set_id[0]->id;
			$nextSet= $default_question_set_id[0]->name;
			//print_r($post['user_id']);die("jjgjgjggj");
			//$result['user_id'] = $post[0]['user_id'];
			$result['user_id'] = $post['user_id'];
			$result['category'] = 'Daily Journal';
			$result['previous_set_id'] = 0;
			$result['previous_set_name'] = '';
			$result['completed_set_id'] = '';
			$result['next_set_id'] = $nextSetId;
			$result['next_set_name'] = $nextSet;
		}else{
		$results = DB::select('select name,category from question_sets where id = ?', [$question_set_id]);
		if(empty($results)){
		$results = DB::table('question_sets')->select('id','name')->where('category', 'Daily Journal')->limit(1)->get();
			}
		$category =  $results[0]->category;
		$all_question_set = DB::select('select id,name,category from question_sets where category = ?', [$category]);
		
		$nextSet = '';
		$nextSetId = '';
		$cat = '';
		$completedSet = '';
		
		foreach($all_question_set as $next){
			if($next->id <= $question_set_id){
			    $completedSet .= $next->id.',';
			}
			if($next->id != $question_set_id && $next->id >$question_set_id){
			    $nextSet = $next->name;
				$nextSetId = $next->id;
				$cat = $next->category;
				break;
			}
		}
		$completedSet = trim($completedSet,',');
	
		$result['user_id'] = $post['user_id'];
		$result['category'] = $cat;
		$result['previous_set_id'] = $question_set_id;
		$result['previous_set_name'] = $results[0]->name;
		$result['completed_set_id'] = $completedSet;
		$result['next_set_id'] = $nextSetId;
		$result['next_set_name'] = $nextSet;
		}
		//print_r($result);
		
		$if_user_cat_present = DB::table('user_question_set')->select('*')->where('user_id', $result['user_id'])->where('category', $result['category'])->get();
		if(empty($if_user_cat_present)){
			DB::table('user_question_set')->whereIn('id', $array_of_ids)->insert($result);
		}else{
			DB::table('user_question_set')->where('user_id', $result['user_id'])->where('category', $result['category'])->update($result);
		}
		
		return $result;
		}else{
			return false;
		}
		/*$res= $post[0]['json_response'];
		foreach($res as $que){
			
			if($que['type'] == 'Multiple Answer Choice'){
				foreach($que['answers'] as $opt){
				//echo $opt['text'];
				}
			}elseif($que['type'] == 'Rating Answer'){
				//echo $que['answers']['text'];
			}elseif($que['type'] == 'Text Answer'){
				//echo $que['answers']['text'];
			}
			
		}
		
         die("lllllllll");*/
   }

}
