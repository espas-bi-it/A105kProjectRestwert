@extends('layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th class="col-0">Eingetragen</th>
                <th class="col-0">Anrede</th>
                <th class="col-1">Vorname</th>
                <th class="col-1">Nachname</th>
                <th class="col-2">Adresse</th>
                <th class="col-0">PLZ</th>
                <th class="col-2">Ort</th>
                <th class="col-2">Email</th>
                <th class="col-2">Angemeldet am</th>
                <th class="col-0"></th>
                <th class="col-0"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td class="align-middle">{{ $customer->incorporated == 0 ? 'Nein' : 'Ja' }}</td>
                    <td class="align-middle">{{ $customer->title }}</td>
                    <td class="align-middle">{{ $customer->name }}</td>
                    <td class="align-middle">{{ $customer->surname }}</td>
                    <td class="align-middle">{{ $customer->address }}</td>
                    <td class="align-middle">{{ $customer->zip }}</td>
                    <td class="align-middle">{{ $customer->city }}</td>
                    <td class="align-middle">{{ $customer->email }}</td>
                    <td class="align-middle">{{ $customer->created_at->format('d. M. Y') }}</td>
                    <td class="align-middle">

                        <!-- Edit Button -->
                        <a href="{{ url('customers', ['id' => $customer->id]) }}" class="btn btn-primary">
                            Eintrag bearbeiten
                        </a>

                        <!-- Delete Button -->
                            <form action="{{ url('customers', ['id' => $customer->id]) }}" method="POST" style="display:inline-block;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Eintrag löschen
                                </button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('pagination')
    {{ $customers->links() }}
@endsection
