@extends('layout')

@section('content')
<div class="question-form">
    @if ($method == 'PUT')
        <h1 class="text-center">Modifer la question</h1>
    @else
        <h1 class="text-center">Créer une question</h1>
    @endif
    <form action="{{ $action }}" method="post">
        @csrf
        @if ($method == 'PUT')
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="content">Contenu de la question:</label>
            <input type="text" name="content" class="form-control" value="{{ @old('content', $question->content ?? '') }}" />
        </div>
        <div id="answers-container">
            @if (isset($question) && $question->answers)
                @foreach ($question->answers as $answer)
                    <div class="answer-field mb-2 d-flex align-items-center gap-2">
                        <input type="hidden" name="old-answers[{{ $loop->index }}][id]" value="{{ $answer->id }}">
                        <input type="text" name="old-answers[{{ $loop->index }}][content]"
                            value="{{ @old("old-answers.$loop->index.content", $answer->content) }}"
                            class="form-control" placeholder="Réponse">
                        <label class="d-flex align-items-center gap-1">
                            <input type="checkbox" name="old-answers[{{ $loop->index }}][is_correct]" value="1"
                            {{ @old("old-answers.$loop->index.is_correct", $answer->is_correct ? 1 : 0) ? 'checked' : '' }}>
                            Juste
                        </label>
                        <button type="button" class="btn btn-danger btn-sm remove-answer">Supprimer</button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="button" id="add-answer" class="btn btn-primary me-3">Ajouter une réponse</button>
            <button type="submit" class="btn btn-primary ms-3">
            @if ($method == 'PUT')
                Modifier
            @else
                Créer
            @endif
        </button>
        </div>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
    <a href="{{ route('home') }}">Retourner à la page d'accueil</a>
</div>
@endsection
@push('scripts')
@vite(['resources/js/questions-form.js'])
@endpush
