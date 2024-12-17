@extends('layout') <!-- Use your app's layout -->
@section('content')
<div class="navbar-sticky-item">
    @include('components.sort-settings')
</div>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th class="col-5">Anzeigename</th>
                <th class="col-5">Email</th>
                <th class="col-1">Rolle</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @if ($user->email !== Auth::user()->email)
                <tr>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->role }}</td>
                    <td class="align-middle">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <!-- Edit Button -->    
                            <a href="{{ url('users', ['id' => $user->id]) }}" title="Bearbeiten">
                                <img src="{{ asset('image/edit.png') }}" alt="Bearbeiten" class="icon-img">
                            </a>
                            <button form="delete-form-{{ $user->id }}" type="button" data-user-id="{{ $user->id }}" class="open-modal" style="border: none; background: none;" title="Löschen">
                                <img src="{{ asset('image/delete.png') }}" alt="Löschen" class="icon-img">
                            </button>
                                <!-- Delete Button -->
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1050;">
    <div id="modal-dialog" class="modal-dialog" style="margin: auto; position: relative; top: 50%; transform: translateY(-50%); width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Löschung bestätigen</h5>
                <button type="button" class="btn-close" id="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sind Sie sicher, dass Sie diesen Benutzer löschen möchten? Diese Aktion kann nicht rückgängig gemacht werden.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelDelete">Abbrechen</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Löschen</button>
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
    {{ $users->links() }}
@endsection
