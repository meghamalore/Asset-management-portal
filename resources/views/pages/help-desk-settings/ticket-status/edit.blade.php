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
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ticket Status</h5>
                    </div>
                    <div class="card-body">
                        <form id="editTicketStatusForm">
                            @csrf
                            <div class="row mb-3">
                                <input type="hidden" value="{{ $ticket->id }}" id="ticket_id" name="ticket_id">
                                {{-- <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Status Type</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="status_type_id">
                                        <option value="">Select</option>
                                        <option value="1" {{ $ticket->status_type_id == 1 ? 'selected' : '' }}>Hold</option>
                                        <option value="2" {{ $ticket->status_type_id == 2 ? 'selected' : '' }}>Assigned</option>
                                        <option value="3" {{ $ticket->status_type_id == 3 ? 'selected' : '' }}>Open</option>
                                    </select>
                                </div> --}}
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Status</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" value="{{ $ticket->status }}" type="text" name="ticket_sub_status"  />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Hour(s) for Auto Closer</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" value="{{ $ticket->auto_close_hours }}" type="text" name="auto_close_hours" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Is Default</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input value="1" {{ $ticket->is_default ? 'checked' : '' }} class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="is_default"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Edit button to be displayed based On</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="edit_based_on">
                                        <option value="">Select</option>
                                        <option value="user_involved" {{ $ticket->edit_based_on === 'user_involved' ? 'selected' : '' }}>User Involved</option>
                                        <option value="user_role" {{ $ticket->edit_based_on === 'user_role' ? 'selected' : '' }}>User Role</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Auto Check-Out on This Ticket Status</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="auto_checkout" value ="1" {{ $ticket->auto_checkout ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" >Tat Count</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="tat_count" value ="1" {{ $ticket->tat_count ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="reset" class="btn btn-danger">
                                        Cancel
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>

@endsection
@section('section-js')
<script>
    $(document).ready(function () {

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

        $('#editTicketStatusForm').validate({

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
                }else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {

                let formData = new FormData(form);
                let id = $('#ticket_id').val();

                $.ajax({
                    url: "/ticket-status/" + id, 
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#editTicketStatusForm button[type="submit"]').prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm"></span> Saving...');
                    },

                    success: function (response) {
                        if (response.status) {
                            showToast(response.message, 'success');
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
                        $('#editTicketStatusForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
                    }
                });
            }
        });
    });
</script>
@endsection
