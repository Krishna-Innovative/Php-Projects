<?php

namespace App\Http\Livewire\QuestionSet;

use App\Models\QuestionCategory;
use App\Models\QuestionSet;
use Livewire\Component;

class CreateQuestionSet extends Component
{
    public $category;
    public $name;
    public $order;
    public function store()
    {
        $this->validate([
            'name'     => 'required|max:255',
            'order'    => 'required|numeric',
            'category' => 'required',
        ]);
        try {
            $category = QuestionCategory::find($this->category);
            $group    = QuestionSet::create([
                'name'                 => $this->name,
                'order'                => $this->order,
                'question_category_id' => $this->category,
                'category'             => $category->name,
            ]);
            return redirect()->route('questions-set.index');
            $this->emit('swalalert', ['title' => '', 'subtitle' => 'Added New Habit.', 'type' => 'success']);
        } catch (\Throwable $th) {
            
            $this->emit('swalalert', ['title' => '', 'subtitle' => 'Something went wrong.', 'type' => 'error']);
        }

    }
    public function render()
    {
        $categories = QuestionCategory::select('id', 'name')->get();
        return view('livewire.question-set.create-question-set', [
            'categories' => $categories,
        ]);
    }
}
