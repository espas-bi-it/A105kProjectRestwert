@extends('customers.layout')
@section('content')
<ul>
    @foreach ($customers as $customer)
        <li><a href="{{url('customers', ['id'=>$customer->id])}}"> 
            {{$customer->title}} von {{$customer->band}}
        </li>
    @endforeach
</ul>
@endsection