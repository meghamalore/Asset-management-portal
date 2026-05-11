@extends('layouts.master')
@section('section-css')
<style> 
#toastContainer {
    z-index: 9999 !important;
}
</style>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">List of conditions</h4>
        {{-- <button type="button" class="btn btn-primary btn-sm"> --}}
            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exLargeModalCondition">
                <i class="bx bx-plus"></i> Add
            </a>
        {{-- </button> --}}
    </div>
    <div class="card">
        <div class="card-body"> 
            <div class="table-responsive">
                <table id="conditionstatusTable" class="table table-bordered">
                    <thead>
                        <!-- GROUP HEADER -->
                        <tr>
                            <th rowspan="2">Actions</th>
                            <th colspan="8">
                                Default Section
                            </th>
                        </tr>

                        <!-- COLUMN HEADER -->
                        <tr>
                            <th>Condition Name</th>
                            <th>Created Date</th>
                            {{-- <th>Modify Date</th> --}}
                            <th>Created By</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach($conditions as $condition)
                            <tr>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <!-- View -->
                                        {{-- <a href="{{ route('condition.status.view', $condition->id) }}" class="text-primary" title="View">
                                            <i class="bx bx-show"></i>
                                        </a> --}}

                                        <!-- Edit -->
                                        <a href="#" class="text-warning" title="Edit" id="editConditionBtn" data-id ="{{$condition->id}}"  data-name="{{ $condition->condition_name }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="submit" class="btn p-0 border-0 text-danger"
                                            title="Delete" id="deleteConditionBtn" data-id ="{{$condition->id}}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                {{-- <td>{{ $condition->status_type_id == 1 ? 'hold' : ($condition->status_type_id == 2 ? 'assigned' : ($condition->status_type_id == 3 ? 'open' : '-')) }}</td> --}}
                                <td>{{ $condition->condition_name ?? '-' }}</td>
                                <td>{{ $condition->created_at ? $condition->created_at->format('d/m/Y h:i a') : '-' }}</td>
                                {{-- <td>{{ $condition->updated_at ? $condition->updated_at->format('d/m/Y h:i a') : '-' }}</td> --}}
                                <td>{{ auth()->user()->name ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
{{-- add modal --}}
<div class="modal fade" id="exLargeModalCondition" tabindex="-1" aria-hidden="true">
    
    <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Condition</h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <form id="conditionForm">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Condition Name
                        </label>

                        <input type="text"
                            class="form-control force-validate"
                            name="condition_name" />

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button type="submit"
                        class="btn btn-primary btn-sm">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- edit modal --}}
<div class="modal fade" id="editConditionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="editConditionForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Condition</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_condition_id" name="id">

                    <div class="mb-3">
                        <label>Condition Name</label>
                        <input type="text"
                               class="form-control"
                               id="edit_condition_name"
                               name="condition_name">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
@section('section-js')
<script>
        $(document).ready(function() {

            // Show Toast
            function showToast(message, type = 'success') {

                let bgClass = 'bg-success';
                let icon = 'bx-check-circle';

                if (type === 'error') {
                    bgClass = 'bg-danger';
                    icon = 'bx-error-circle';
                } else if (type === 'warning') {
                    bgClass = 'bg-warning';
                    icon = 'bx-error';
                }

                let toastHTML = `
                    <div class="bs-toast toast fade ${bgClass}" role="alert">
                        <div class="toast-header">
                            <i class="bx ${icon} me-2"></i>
                            <div class="me-auto fw-semibold">Notification</div>
                            <small>Now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;

                let container = $('#toastContainer');
                let toastElement = $(toastHTML);

                container.append(toastElement);

                let toast = new bootstrap.Toast(toastElement[0], {
                    delay: 3000
                });

                toast.show();

                // remove after hidden
                toastElement.on('hidden.bs.toast', function () {
                    $(this).remove();
                });
            }

            // Row delete code
            $(document).on('click', '#deleteConditionBtn', function () {

                let id = $(this).data('id'); 

                if (!confirm('Are you sure you want to delete?')) {
                    showToast('Delete cancelled by user', 'warning');
                    return;
                }

                $.ajax({
                    url: "/destroy-condition/" + id, 
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: "DELETE"
                    },

                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');

                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    error: function (xhr) {
                        console.log(xhr);
                        showToast(xhr.responseJSON?.message || 'Delete failed!', 'error');
                    }
                });

            });

            $(document).on('click', '#editConditionBtn', function () {

                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#edit_condition_id').val(id);
                $('#edit_condition_name').val(name);

                $('#editConditionModal').modal('show');
            });

            $('#editConditionForm').validate({

                ignore: ":hidden:not(.force-validate)",

                errorElement: 'span',
                errorClass: 'text-danger',

                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },

                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },

                errorPlacement: function (error, element) {
                    if (element.hasClass('select2')) {
                        error.insertAfter(element.next('.select2-container'));
                    } else if (element.closest('.input-group').length) {
                        error.insertAfter(element.closest('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },

                submitHandler: function (form) {

                    let formData = new FormData(form);
                    let id = $('#edit_condition_id').val();

                    $.ajax({
                        url: "/condition/" + id,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend: function () {
                            $('#ticketForm button[type="submit"]').prop('disabled', true)
                                .html('<span class="spinner-border spinner-border-sm"></span> Saving...');
                        },

                        success: function (response) {
                            if (response.status) {
                                showToast(response.message, 'success');
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else {
                                showToast(response.message, 'error');
                            }
                        },

                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function (key, value) {
                                    showToast(value[0], 'error');
                                });
                            } else {
                                showToast('Something went wrong!', 'error');
                            }
                        },

                        complete: function () {
                            $('#ticketForm button[type="submit"]').prop('disabled', false)
                                .html('Send');
                        }
                    });
                }
            });
        
            //  table structure code
            $('#defaultToggle').addClass('collapsed');
        
            var table = $('#conditionstatusTable').DataTable({
                orderCellsTop: true,
                autoWidth: false,   //  important
                scrollX: true       //  optional but recommended
            });
        
            //  ONLY THIS (no extra logic)
            let defaultCols = table.columns('.default-extra').indexes().toArray();
        
            let defaultOpen = false;
        
            // DEFAULT
            $('#defaultToggle').on('click', function() {
        
                let isVisible = table.column(defaultCols[0]).visible(); //  check current state
        
                table.columns(defaultCols).visible(!isVisible, false);
        
                table.columns.adjust().draw(false);
        
                $(this).toggleClass('collapsed', isVisible);
        
                $('.toggle-icon')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });


            $('#conditionForm').validate({

                ignore: ":hidden:not(.force-validate)",

                rules: {
                    condition_name: {
                        required: true
                    }
                },

                messages: {  
                    condition_name: {
                        required: "Please enter the condition name."
                    }
                },

                submitHandler: function (form) {
                    let formData = new FormData(form);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                    url: "{{ route('store.condition') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    //  BEFORE SEND
                    beforeSend: function () {

                        // Disable submit button
                        $('#conditionForm button[type="submit"]').prop('disabled', true);

                        // Change button text (optional)
                        $('#conditionForm button[type="submit"]').html(
                            `<span class="spinner-border spinner-border-sm me-2"></span> Saving...`
                        );
                    },

                    //  SUCCESS
                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');

                            $('#conditionForm')[0].reset();
                            location.reload();
                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    //  ERROR
                    error: function (xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (field, messages) {
                                showToast(messages[0], 'error'); // replaced toastr
                            });

                        } else {
                            showToast(xhr.responseJSON.message || 'Something went wrong!', 'error');
                        }
                    },

                    //  AFTER COMPLETE (always runs)
                    complete: function () {

                        // Enable button again
                        $('#conditionForm button[type="submit"]').prop('disabled', false);

                        // Restore button text
                        $('#conditionForm button[type="submit"]').html('Submit');
                    }
                });
                }
            });
        
        });
</script>
@endsection

