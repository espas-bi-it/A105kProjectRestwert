@extends('layout') <!-- Use your app's layout -->

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Rolle</th>
                <th>Actions</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <form id="updateUser-{{ $user->id }}" action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        <td>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </td>
                        <td>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                        </td>
                        <td>
                        <div></div>
                        @if ($user->email !== Auth::user()->email)
                            <select name="role" class="form-select">
                                <option value="Admin" {{ $user->role === "Admin" ? 'selected' : '' }}>Admin</option>
                                <option value="TV" {{ $user->role === "TV" ? 'selected' : '' }}>TV</option>
                                <option value="Teilnehmer" {{ $user->role === "Teilnehmer" ? 'selected' : '' }}>Teilnehmer</option>
                            </select>
                        @else
                            <select name="role" class="form-select" disabled readonly>
                                <option value="" selected>{{$user->role}}</option>
                                <option value="" >Teilnehmer</option>

                            </select>
                        @endif
                        </td>
                        @unless ($user->email === Auth::user()->email)
                        <td>
                            <!-- Make the button associate with the specific form -->
                            <button type="submit" form="updateUser-{{ $user->id }}" class="btn btn-primary">Update</button>
                        </td>
                    </form>
                        <td>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                <button type="button" data-user-id="{{ $user->id }}" class="btn btn-danger open-modal">
                                    Eintrag löschen
                                </button>
                            </form>
                        </td>
                    @endunless
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
