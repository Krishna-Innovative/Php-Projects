<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;
use App\Models\QuestionSet;
use Illuminate\Http\Request;

class QuestionSetController extends Controller
{
    public function index()
    {
        return view('pages.set-questions.sets');
    }
     public function getSets()
    {
        $data = QuestionSet::get();
        return response()->json($data);
    }
    public function add()
    {
        return view('pages.set-questions.add-set');
    }
    public function storeGroup(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|max:255',
            'order' => 'required|numeric',
        ]);
        try {
            $group = QuestionSet::create([
                'name' => $request->name,
                'order' => $request->order,
                'category' => $request->category
            ]);
            return redirect()->route('set-questions.index',['group_id' => $group->id]);
        } catch (Exception $e) {
            return response()->json(400);
        }
    }
}
