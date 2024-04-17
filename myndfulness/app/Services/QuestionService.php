<?php
namespace App\Services;

use App\Models\QuestionGroup;
use App\Models\QuestionSetQuestion;
use Illuminate\Database\Eloquent\Builder;
use DB;
class QuestionService
{
    public static function onBoardingQuestion()
    {
        $query = QuestionGroup::query()
            ->onboarding();
        return (new self)->getQuestions($query);
    }
    public static function dailyJournalQuestions()
    {
        $query = QuestionGroup::query()
            ->dailyJournal();
        return (new self)->getQuestions($query);
    }
    public static function selfAssessmentQuestions()
    {
        $query = QuestionGroup::query()
            ->selfAssessment();
        return (new self)->getQuestions($query);
    }
    private function getQuestions(Builder $builder): array
    { 
        $returnArray = [];
        $groups      = $builder
            ->with("group_questions.question", "group_questions.options.option:id,question_id,text")
            ->orderBy("order")
            ->get();
        // return $groups;
        $pages = [];
        foreach ($groups as $group) {
            $questions = [];
            foreach ($group->group_questions as $question_group) {
                $question                                    = $question_group->question->toArray();
                $question_group->question->group_question_id = $question_group->id;
                $question_group->question->options           = $question_group->options;
                $question["group_question_id"]               = $question_group->id;
                $question["options"]                         = $question_group->options;
                $questions[$question_group->id]              = $question;
            }
			
            $pages[] = [
                "page"              => $group->order,
                "first_question_id" => collect($questions)->first()["group_question_id"],
                "question"          => $questions,
            ];
		
        }
			
			//die("hhghg");
        $returnArray["total_page"] = sizeof($pages);
        $returnArray["pages"]      = $pages;
        return $returnArray;
    }

    public static function dailyJournalNextQuestions($set_id)
    {
        $query = QuestionSetQuestion::query()
            ->dailyJournal();
		
        return (new self)->nextSetQuestions($query,$set_id);
    }
	
	 public static function selfAssessmentNextQuestions($set_id)
    {
        $query = QuestionSetQuestion::query()
            ->selfAssessment();
        return (new self)->nextSetQuestions($query,$set_id);
    }
	
	public function nextSetQuestions(Builder $builder,$set_id): array
    { 
		$question_set_id= DB::table('question_set_questions')->select('question_id')->where('question_set_id', $set_id)->get();
		$question_set_id= json_decode(json_encode($question_set_id),true);
		$question_id= DB::table('question_set_questions')->select('id')->where('question_set_id', $set_id)->get();
		$question_id= json_decode(json_encode($question_id),true);
		$que_id = [];
		$pages = [];
	    $i=1;
		
		//echo $set_id;	 print_r($question_set_id);die("hghghghgh");
		if(!empty($question_set_id)){
		foreach($question_set_id as $que){ 
			$question = DB::table('questions')->select('*')->where('id', $que)->get();
			$questionsOption = DB::table('question_options')->select('*')->where('question_id', $que)->get();
			$b =[];
			$question = json_decode($question);
						 
			
			foreach($questionsOption as $opt){
				$a['option_id'] =$opt->id;
				$a["option"]    = json_decode(json_encode($opt),true);
				array_push($b,$a);
			}
			$questions = [];
			

			    $questions["id"]                 =$question[0]->id;
			    $questions['question']           =$question[0]->question;
			    $questions['explanation']        =$question[0]->explanation;
			    $questions['type']               =$question[0]->type;
			   
			    $question["group_question_id"]   =$question[0]->id;
			   
                $questions["options"]            = $b;//json_decode(json_encode($questionsOption),true);
                $pages[] = [
                "page"              => $i,//$question[0]->order,
                "first_question_id" => $question[0]->id,//collect($questions)->first()["group_question_id"],
                "question"          => $questions,
                ]; 
            
										  
			array_push($que_id,$questions);
			$i++;
			} 
		}else{
			//$pages[] = []; 
		}
		
		
        $returnArray["total_page"] = sizeof($pages);
        $returnArray["pages"]      = $pages;
		
        return $returnArray;
		
      
	}
}
