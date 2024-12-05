<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::simplePaginate(20);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.form', ['action'=>route('questions.store'), 'method'=> 'POST']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionFormRequest $request)
    {
        $validatedData = $request->validated();

        $question = Question::create([
            'content' => $validatedData['content'],
        ]);

        if (isset($validatedData['new-answers'])) {
            foreach ($validatedData['new-answers'] as $answerData) {
                $question->answers()->create([
                    'content' => $answerData['content'],
                    'is_correct' => $answerData['is_correct'] ?? false,
                ]);
            }
        }
        return redirect()->route('home')->with('success', "La question a été créer");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('questions.form', ["question"=>$question, 'action'=>route('questions.update', $question->id), 'method'=> 'PUT']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionFormRequest $request, Question $question)
    {
        $validatedData = $request->validated();

        // Mise à jour du contenu de la question
        $question->update([
            'content' => $validatedData['content'],
        ]);

        if (isset($validatedData['old-answers'])) {
            $updatedAnswerIds = array_map(fn($answer) => $answer['id'], $validatedData['old-answers']);
            $question->answers()->whereNotIn('id', $updatedAnswerIds)->delete();
        } else{
            $question->answers()->delete();
        }

        if (isset($validatedData['old-answers'])) {
            foreach ($validatedData['old-answers'] as $answerData) {
                $answer = Answer::find($answerData['id']);
                $answer->update([
                    'content' => $answerData['content'],
                    'is_correct' => $answerData['is_correct'] ?? false,
                ]);
            }
        }
        if (isset($validatedData['new-answers'])) {
            foreach ($validatedData['new-answers'] as $answerData) {
                $question->answers()->create([
                    'content' => $answerData['content'],
                    'is_correct' => $answerData['is_correct'] ?? false,
                ]);
            }
        }
        return redirect()->route("home")->with('success', "La question a été mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('home')->with('success', "La question a été supprimé");
    }
}
