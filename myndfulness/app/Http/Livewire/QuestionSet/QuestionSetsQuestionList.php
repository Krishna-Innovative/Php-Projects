<?php

namespace App\Http\Livewire\QuestionSet;

use App\Models\GroupQuestion;
use App\Models\GroupQuestionOption;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\QuestionGroup;
use App\Models\QuestionSet;
use App\Models\Question;
use DB;

class QuestionsetsQuestionList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search; 
    public $name;
    protected $listeners = ['updated','confirmDelete','confirmDelete_question'];

    public function confirmDelete($group_id){ 
        DB::beginTransaction();
        try {
            $group = QuestionSet::find($group_id);
            $group_questions = GroupQuestion::where('question_group_id',$group_id)->get();
            foreach($group_questions as $gq){
                $gq->delete();
            }
            $group_name = $group->name;
            $group->delete();
        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('swalalert',['title' => '','subtitle' => 'Something went wrong.','type' => 'error']);
        }
        DB::commit();
        $this->emit('swalalert',['title' => '','subtitle' => "Deleted Habit {$group_name}.",'type' => 'success']);
    }
	public function confirmDelete_question($group_id){
		
       DB::beginTransaction();
		
        try {
			DB::table('question_set_questions')->where('question_id', $group_id)->delete(); 

        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('swalalert',['title' => '','subtitle' => 'Something went wrong.','type' => 'error']);
        }
        DB::commit();
        $this->emit('swalalert',['title' => '','subtitle' => "Deleted question.",'type' => 'success']); 
    }
    public function updated()
    {
        $this->resetPage();
    }
     public function mount($name)
    {
        $this->id = $name;
    }
    public function render()
    {
	    $id = $this->id;
        $query = Question::query();
		$query =  DB::table('questions')
       ->select('questions.question','questions.id as id')
       ->join('question_set_questions','question_set_questions.question_id','=','questions.id')
       ->where('question_set_questions.question_set_id' ,'=',  $id)
       ->orderBy('question_set_questions.id', 'ASC')
        ->get();
			return view('livewire.question-set.questionsets-question-list',[
            'groups' => $query
        ]);
    }
}
