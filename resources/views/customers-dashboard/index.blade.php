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
                                @if(Auth::check() && Auth::user()->role === 'Admin')
                                <!-- Delete Button -->
                                <button form="delete-form-{{ $customer->id }}" type="button" data-user-id="{{ $customer->id }}" class="open-modal" style="border: none; background: none;" title="Löschen">
                                    <img src="{{ asset('image/delete.png') }}" alt="Löschen" class="icon-img">
                                </button>
                                <form id="delete-form-{{ $customer->id }}" action="{{ url('customers', ['id' => $customer->id]) }}" method="POST">
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
    <!-- Modal -->
    <div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1050;">
        <div id="modal-dialog" class="modal-dialog" style="margin: auto; position: relative; top: 50%; transform: translateY(-50%); width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" id="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelDelete">Cancel</button>
                    <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
<!-- Custom JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('overlay');
        const closeModalButton = document.getElementById('closeModal');
        const cancelDeleteButton = document.getElementById('cancelDelete');
        const confirmDeleteButton = document.getElementById('confirmDelete');

        let currentForm = null; // To keep track of which form should be submitted

        // Open modal when delete button is clicked
        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', function () {
                currentForm = document.getElementById('delete-form-' + this.dataset.userId);
                overlay.style.display = 'block';
            });
        });

        // Close the modal
        const closeModal = () => {
            overlay.style.display = 'none';
            currentForm = null; // Reset the form reference
        };

        closeModalButton.addEventListener('click', closeModal);
        cancelDeleteButton.addEventListener('click', closeModal);

        // Confirm delete
        confirmDeleteButton.addEventListener('click', () => {
            if (currentForm) {
                currentForm.submit();
            }
        });
    });
</script>

@endsection


@section('pagination')
    {{ $customers->links() }}
@endsection
