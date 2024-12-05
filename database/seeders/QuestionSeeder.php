<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::factory(60)
        ->create()
        ->each(function ($question) {
            Answer::factory(3)->create([
                'question_id' => $question->id,
            ]);
            Answer::factory()->correct()->create([
                'question_id' => $question->id,
            ]);
        });
    }
}
