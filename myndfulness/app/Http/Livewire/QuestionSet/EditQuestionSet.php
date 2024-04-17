<?php

namespace App\Http\Livewire\QuestionSet;

use App\Models\QuestionCategory;
use App\Models\QuestionGroup;
use App\Models\QuestionSet;
use Livewire\Component;

class EditQuestionSet extends Component
{
    public $category;
    public $name;
    public $order;
    public $group;
    public $old_name;

    protected $listeners = ['setQset'];
    public function setQset(QuestionSet $group)
    {
        $this->group    = $group;
        $this->old_name = $group->name;
        $this->order    = $group->order;
        $this->category = $group->question_category_id;
        $this->name     = $group->name;
    }
    public function store()
    {
        $this->validate([
            'name'     => 'required|max:255',
            'order'    => 'required|numeric',
            'category' => 'required',
        ]);
        try {
            $category = QuestionCategory::find($this->category);
            $this->group->update([
                'name'                 => $this->name,
                'order'                => $this->order,
                'question_category_id' => $this->category,
                'category'             => $category->name,
            ]);
            $this->emitTo('question-set.question-sets-list', 'updated');
            $this->emit('closeModal');
            $this->emit('swalalert', ['title' => '', 'subtitle' => "Updated Group {$this->old_name}.", 'type' => 'success']);
        } catch (\Throwable $th) {
            $this->emit('swalalert', ['title' => '', 'subtitle' => 'Something went wrong.', 'type' => 'error']);
        }

    }
    public function render()
    {
        $categories = QuestionCategory::select('id', 'name')->get();
        return view('livewire.question-set.edit-question-set', [
            'categories' => $categories,
        ]);
    }
}
