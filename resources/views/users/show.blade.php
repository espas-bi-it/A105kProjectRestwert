@extends('layout')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger mt-2" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    </div>
@endif
<form id="updateUser-{{ $user->id }}" action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    <div class="container mt-3">
        <div class="form-row">
            <div class="col">
                <label for="name"> {{ __('fields.name') }}*</label>
                <input id="name" name="name" class="form-control" value="{{ $user->name }}">
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="email"> {{ __('fields.email') }}*</label>
                <input id="email" name="email" class="form-control" value="{{ $user->email }}" id="email" >
            </div>
            <div class="col">
                <label for="role"> {{ __('fields.role') }}*</label>
                <select id="role" name="role" class="form-control">
                    <option value="Admin" {{ $user->role === "Admin" ? 'selected' : '' }}>Admin</option>
                    <option value="TV" {{ $user->role === "TV" ? 'selected' : '' }}>TV</option>
                    <option value="Teilnehmer" {{ $user->role === "Teilnehmer" ? 'selected' : '' }}>Teilnehmer</option>
                </select>
            </div>
        </div>
    </div>
    <br>

    <hr class="m-3">
    </hr>

    @if(Auth::check() && Auth::user()->role === 'Admin' || Auth::check() && Auth::user()->role === 'TV')
    <div class="container mt-1 my-3">
        <input class="btn btn-primary" type="submit" value="{{ __('buttons.save') }}"></input>
        <button class="btn"> <a type="" href="{{ URL::previous() }}">{{ __('buttons.back') }}</a></button>
    </div>
    @else
    <div class="container mt-1 my-3">
        <button class="btn btn-primary"> <a href="{{ URL::previous() }}">{{ __('buttons.back') }}</a></button>
    </div>
    @endif
</form>
@endsection
