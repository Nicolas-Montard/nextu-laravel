@extends('layout')

@section('content')
    <div class="w-75 mx-auto">
        <h1 class="text-center mt-5">Créer un compte</h1>
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="mt-3">
                <label for="name">Nom:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>
            @error('email')
                {{ $message }}
            @enderror
            <div class="mt-3">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
            @error('email')
                {{ $message }}
            @enderror
            <div class="mt-3">
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            @error('password')
                {{ $message }}
            @enderror
            <div class="mt-3">
                <label for="password_confirmation">Confirmer le mot de passe:</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            @error('password_confirmation')
                {{ $message }}
            @enderror
            <div class="mt-4 d-flex justify-content-center">
                <button class="btn btn-primary" type="submit">Créer un compte</button>
            </div>
        </form>
    </div>
@endsection
