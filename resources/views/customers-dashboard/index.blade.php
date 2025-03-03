@extends('layout')
@section('content')
<div class="navbar-sticky-item">
    @include    ('components.sort-filter-settings')
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-2">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif    
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="reorder-buttons">{{ __('fields.actions') }}</th>
                <th>{{ __('fields.incorporated') }}</th>
                <th>{{ __('fields.name') }}</th>
                <th>{{ __('fields.surname') }}</th>
                <th>{{ __('fields.address') }}</th>
                <th>{{ __('fields.zip') }}</th>
                <th>{{ __('fields.city') }}</th>
                <th>{{ __('fields.email') }}</th>
                <th>{{ __('fields.created_at') }}</th>
            </tr>
        </thead>
        <tbody>
        <!-- Table Entries -->
    @foreach     ($customers as $customer)
            <tr>
                <td class="align-middle custom-ellipsis reorder-buttons"> 
                    <div class="action-buttons">
                        <a href="{{ url('customers', ['id' => $customer->id]) }}">
                            <img src="{{ asset('image/edit.png') }}" alt="{{ __('buttons.edit') }}" class="button-icon" title="{{ __('buttons.edit') }}">
                        </a>
                        @if(Auth::user()->hasAdminPermissions())
                            <button form="delete-form-{{ $customer->id }}" type="button" data-user-id="{{ $customer->id }}" class="open-modal" title="{{ __('buttons.delete') }}">
                                <img src="{{ asset('image/delete.png') }}" alt="{{ __('buttons.delete') }}" class="button-icon">
                            </button>
                            <form id="delete-form-{{ $customer->id }}" action="{{ url('customers', ['id' => $customer->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf    
                            </form>
                        @endif    
                    </div>
                </td>
                <td class="align-middle custom-ellipsis">{{ $customer->incorporated == 0 ? __('fields.no') : __('fields.yes') }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->name }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->surname }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->address }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->zip }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->city }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->email }}</td>
                <td class="align-middle custom-ellipsis">{{ $customer->created_at->format('d. M. Y') }}</td>
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

<!-- Custom JavaScript for Modal -->
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
