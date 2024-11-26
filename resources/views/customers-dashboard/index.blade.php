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
                <th class="col-0">Datum</th>
                <th class="col-1"></th>
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
                        @if(Auth::check() && Auth::user()->role === 'TV' || Auth::check() && Auth::user()->role === 'Admin')
                            <a href="{{ url('customers', ['id' => $customer->id]) }}" class="btn btn-primary" style="display:block">
                                Eintrag bearbeiten
                            </a>
                        @endif

                        <!-- Delete Button -->
                        @if(Auth::check() && Auth::user()->role === 'Admin')
                            <!-- Show admin content here -->
                            <form action="{{ url('customers', ['id' => $customer->id]) }}" method="POST" style="display:grid">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" style="display:block">
                                    Eintrag löschen
                                </button>
                            </form>
                        @endif
                        <!-- Show Button -->
                        @if(Auth::check() && Auth::user()->role === 'Benutzer')
                            <a href="{{ url('customers', ['id' => $customer->id]) }}" class="btn btn-primary" style="display:block">
                                Eintrag anzeigen
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('pagination')
    {{ $customers->links() }}
@endsection
