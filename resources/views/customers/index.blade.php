@extends('customers.layout')
@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Eingetragen</th>
                <th>Anrede</th>
                <th>Vorname</th>
                <th>Name</th>
                <th>Adresse</th>
                <th>PLZ</th>
                <th>Ort</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($customers as $customer)
            <tbody>
                <td> {{$customer->incorporated == 0 ? "Nein" : "Ja" }}</td>
                <td>{{$customer->title}} </td> 
                <td>{{$customer->name}} </td>
                <td>{{$customer->surname}} </td>
                <td>{{$customer->address}} </td>
                <td>{{$customer->zip}} </td>
                <td>{{$customer->city}} </td>
                <td>{{$customer->email}} </td>
                <td><a href="{{url('customers', ['id' => $customer->id])}}">Eintrag bearbeiten</a></td>
                <!-- <td><form action="{{url('customers', ['id' => $customer->id])}}">
                    @csrf
                    <button> Eintrag bearbeiten </button>
                </form></td> -->



                <!-- <a href="{{url('customers', ['id' => $customer->id])}}"> -->
                <!-- 
                                <form action="{{url('customers', ['id' => $customer->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button> Eintrag löschen </button>
                                </form> -->

        @endforeach
        </tbody>
    </table>
</div>
@endsection