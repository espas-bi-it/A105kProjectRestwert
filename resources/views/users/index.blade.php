@extends('layout') <!-- Use your app's layout -->
@section('content')
<div class="navbar-sticky-item">
    @include('components.sort-settings')
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif    
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th  >{{ __('fields.user_name') }}</th>
                <th >{{ __('fields.email') }}</th>
                <th >{{ __('fields.role') }}</th>
                <th class="reorder-buttons col-1">{{ __('fields.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach    ($users as $user)
            @if     ($user->email !== Auth::user()->email)
                <tr>
                    <td class="align-middle custom-ellipsis-small ">{{ $user->name }}</td>
                    <td class="align-middle custom-ellipsis-small ">{{ $user->email }}</td>
                    <td class="align-middle custom-ellipsis-small">{{ $user->role }}</td>
                    <td class="align-middle custom-ellipsis-small col-1 reorder-buttons">
                        <div class="action-buttons">
                        @if    (Auth::user()->hasAdminPermissions() || $user->role != 'Admin')
                            <!-- Edit Button -->    
                            <a href="{{ url('users', ['id' => $user->id]) }}" title="{{ __('buttons.edit') }}">
                                <img src="{{ asset('image/edit.png') }}" alt="{{ __('buttons.edit') }}" class="button-icon">
                            </a>
                            <button form="delete-form-{{ $user->id }}" type="button" data-user-id="{{ $user->id }}" class="open-modal" style="border: none; background: none;" title="{{ __('buttons.delete') }}">
                                <img src="{{ asset('image/delete.png') }}" alt="{{ __('buttons.delete') }}" class="button-icon">
                            </button>
                                <!-- Delete Button -->
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf    
                            </form>
                        @endif    
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
                <h5 class="modal-title" id="confirmModalLabel">{{ __('buttons.confirm_delete') }}</h5>
                <button type="button" class="btn-close" id="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('buttons.customer_confirm_text') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelDelete">{{ __('buttons.cancel') }}</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">{{ __('buttons.delete') }}</button>
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
