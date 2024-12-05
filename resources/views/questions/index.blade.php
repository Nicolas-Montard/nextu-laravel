@extends('layout')

@section("title', 'Page d'accueil")

@section('content')
<div class="question-index">
    @if (!$questions->isEmpty())
        @foreach ($questions as $question)
            <div class="container my-4">
                <h2 class="mb-4">{{ $question->content }}</h2>
                <div class="row justify-content-start">
                    @foreach ($question->answers as $answer)
                        @if ($answer->is_correct)
                            <div class="col-3 mb-4 answer">
                                <div class="inner d-flex align-items-center answer-true">
                                    {{ $answer->content }}
                                </div>
                            </div>
                        @else
                            <div class="col-3 mb-4 answer ">
                                <div class="inner d-flex align-items-center">
                                    {{ $answer->content }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @auth
                    <div class="d-flex justify-content-end me-5">
                        <a href="{{ route("questions.edit",["question" => $question->id]) }}" class="me-3">
                            <button class="btn btn-primary text-white px-3">Editer</button>
                        </a>
                        <form action="{{route("questions.destroy",["question" => $question->id])}}" method="POST" onsubmit="return confirm('Voulez vous vraiment supprimer la question ?');">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger text-white px-3 me-3">Supprimer</button>
                        </form>
                    </div>
                @endauth
            </div>
        @endforeach
    @endif
    <div class="d-flex justify-content-center mt-5">
        {{ $questions->links() }}
    </div>
    @auth
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route("questions.create") }}">
                <button class="btn btn-primary text-white px-3">Créer une question</button>
            </a>
        </div>
    @endauth
</div>
@endsection
