@extends('layout')
@section('content')
    <div class="navbar-sticky-item">
        @include('components.sort-filter-settings')
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="col-1">Eingetragen</th>
                    <th class="col-1">Vorname</th>
                    <th class="col-1">Nachname</th>
                    <th class="col-2">Adresse</th>
                    <th class="col-1">PLZ</th>
                    <th class="col-1">Ort</th>
                    <th class="col-2">Email</th>
                    <th class="col-2">Datum</th>
                    <th class="col-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td class="align-middle">{{ $customer->incorporated == 0 ? 'Nein' : 'Ja' }}</td>
                        <td class="align-middle">{{ $customer->name }}</td>
                        <td class="align-middle">{{ $customer->surname }}</td>
                        <td class="align-middle">{{ $customer->address }}</td>
                        <td class="align-middle">{{ $customer->zip }}</td>
                        <td class="align-middle">{{ $customer->city }}</td>
                        <td class="align-middle">{{ $customer->email }}</td>
                        <td class="align-middle">{{ $customer->created_at->format('d. M. Y') }}</td>
                        <td class="align-middle">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <!-- Edit Button -->
                                <a href="{{ url('customers', ['id' => $customer->id]) }}">
                                    <img src="{{ asset('image/edit.png') }}" alt="Bearbeiten" class="icon-img">
                                </a>
                                <button form="delete" type="submit" style="border: none; background: none;" title="Löschen">
                                    <img src="{{ asset('image/delete.png') }}" alt="Löschen" class="icon-img">
                                </button>
                                <!-- Delete Button -->
                                @if(Auth::check() && Auth::user()->role === 'Admin')
                                    <form name="delete" id="delete" action="{{ url('customers', ['id' => $customer->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection

@section('pagination')
    {{ $customers->links() }}
@endsection
