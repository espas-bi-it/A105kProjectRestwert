@extends('customers.layout')
@section('content')
<form method="POST" action="/customers/{{$customer->id}}">
@csrf
@method('PUT')
    <div>
        <label for="title"> Titel</label>
        <input name="title" id="title" value="{{$customer->title}}">
    </div>
    <div>
        <label for="band"> Band</label>
        <input name="band" id="Band" value="{{$customer->band}}">
    </div>
    <input type="submit" value="Eintragen">
</form>

@if ($errors->any())
<div>
    <ul>
@foreach ($errors->all() as $error)
<li> {{$error}}</li>    
@endforeach
    </ul>
</div>
@endif
@endsection