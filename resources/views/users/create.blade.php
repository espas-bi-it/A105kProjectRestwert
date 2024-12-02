@extends('layout')
@section('content')
<div class="container w-75 p-5">
@if ($errors->any())
    <div class="alert alert-danger mt-2">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif
    <form action="{{ route('users.store') }}" method="POST">
         @csrf
            <div class="container">
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Voller Name</label>
                            <input class="form-control" name="name" id="name" required>
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" required>
                            <label for="password">Passwort</label>
                            <input class="form-control border-gray-300 rounded" type="password" name="password" id="password" required>
                            <label for="role">Rolle</label>
                            <select class="form-control" name="role" id="role">
                                <option value="admin">Admin</option>
                                <option value="tv">TV</option>
                                <option selected value="teilnehmer">Teilnehmer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row pt-3 pb-3">
                        <div class="col">
                            <button class="btn btn-primary"  type="submit">Create User</button>
                        </div>
                        <div class="col">

                        </div>
                    </div>
            </div>
    </form>
</div>

@endsection
