<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:255',
            'old-answers' => 'nullable|array',
            'old-answers.*.id' => 'required|integer|exists:answers,id',
            'old-answers.*.content' => 'required|string|max:255',
            'old-answers.*.is_correct' => 'nullable|boolean',
            'new-answers' => 'nullable|array',
            'new-answers.*.content' => 'required|string|max:255',
            'new-answers.*.is_correct' => 'nullable|boolean',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $oldAnswers = $this->input('old-answers', []);
            $newAnswers = $this->input('new-answers', []);

            // Compter le total des réponses (anciennes et nouvelles)
            $totalAnswers = count($oldAnswers) + count($newAnswers);

            // Vérifier qu'il y a au moins 2 réponses
            if ($totalAnswers < 2) {
                $validator->errors()->add('answers', 'Il doit y avoir au moins deux réponses.');
            }
        });
    }
}
