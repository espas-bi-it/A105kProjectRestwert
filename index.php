@extends('layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th class="col-0">Eingetragen</th>
                <th class="col-0">Anrede</th>
                <th class="col-1">Vorname</th>
                <th class="col-1">Name</th>
                <th class="col-2">Adresse</th>
                <th class="col-0">PLZ</th>
                <th class="col-2">Ort</th>
                <th class="col-2">Email</th>
                <th class="col-2">Eingetragen am</th>
                <th class="col-1"></th>
            </tr>
        </thead>
        @foreach ($customers as $customer)
            <tbody>
                <td class="align-middle"> {{ $customer->incorporated == 0 ? 'Nein' : 'Ja' }}</td>
                <td class="align-middle">{{ $customer->title }} </td>
                <td class="align-middle">{{ $customer->name }} </td>
                <td class="align-middle">{{ $customer->surname }} </td>
                <td class="align-middle">{{ $customer->address }} </td>
                <td class="align-middle">{{ $customer->zip }} </td>
                <td class="align-middle">{{ $customer->city }} </td>
                <td class="align-middle">{{ $customer->email }} </td>
                <td class="align-middle">{{ $customer->created_at }} </td>
                <td class="align-middle"> 
                    <button class="btn"> <a type="" href="{{ url('customers', ['id' => $customer->id]) }}">Eintrag
                            bearbeiten</a></button>
                </td>

                <!--
                                                                    <form action="{{ url('customers', ['id' => $customer->id]) }}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button> Eintrag löschen </button>
                                                                    </form> -->
        @endforeach
        </tbody>
    </table>
@endsection

@section('pagination')
    {{ $customers->links() }}
@endsection
