@extends('layout')

@section('content')
    <div class="w-75 mx-auto">
        <h1 class="text-center mt-5">Se connecter</h1>
        <form action="{{ route('auth.do-login') }}" method="POST">
            @csrf
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
            <div>
                {{session('fail')}}
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary mt-4" type="submit">Se connecter</button>
            </div>
        </form>
    </div>
    @endsection
