@extends('customers.layout')
@section('content')
<ul>
    {{$customer->title}} von {{$customer->band}}
</ul>
@endsection