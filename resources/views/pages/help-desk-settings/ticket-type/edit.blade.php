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
                        <h5 class="mb-0">Edit Ticket Type</h5>
                    </div>
                    <div class="card-body">
                        <form id="ticketTypeForm">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Ticket Type</label>
                                <div class="col-sm-4">
                                <input type="hidden" value="{{ $ticket->id }}" id="ticket_type_id" name="ticket_type_id">
                                    <input class="form-control force-validate" type="text" name="ticket_type"
                                        value="{{ $ticket->ticket_type ?? '' }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="category_id">
                                        <option value="">Select</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}"
                                                {{ ($ticket->category_id ?? '') == $categories->id ? 'selected' : '' }}>
                                                {{ $categories->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Expected TAT</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="expected_tat"
                                        value="{{ $ticket->expected_tat ?? '' }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Activity Type</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="activity_type">
                                        <option value="">Select</option>
                                        <option value="calibration" {{ ($ticket->activity_type ?? '') == 'calibration' ? 'selected' : '' }}>Calibration</option>
                                        <option value="inspection" {{ ($ticket->activity_type ?? '') == 'inspection' ? 'selected' : '' }}>Inspection</option>
                                        <option value="warranty_expiry" {{ ($ticket->activity_type ?? '') == 'warranty_expiry' ? 'selected' : '' }}>Warranty Expiry</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Ticket Type Duration</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="duration_type">
                                        <option value="">Select</option>
                                        <option value="day" {{ ($ticket->duration_type ?? '') == 'day' ? 'selected' : '' }}>Days</option>
                                        <option value="hours" {{ ($ticket->duration_type ?? '') == 'hours' ? 'selected' : '' }}>Hours</option>
                                        <option value="minutes" {{ ($ticket->duration_type ?? '') == 'minutes' ? 'selected' : '' }}>Minutes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Reason</label>
                                <div class="col-sm-4">
                                    <textarea name="reason" class="form-control">{{ $ticket->reason ?? '' }}</textarea>
                                </div>

                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="location_id">
                                        <option value="">Select</option>
                                        @foreach ($location as $locations)
                                            <option value="{{ $locations->id }}"
                                                {{ ($ticket->location_id ?? '') == $locations->id ? 'selected' : '' }}>
                                                {{ $locations->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="role_type">
                                        <option value="">Select</option>
                                        <option value="user_involved" {{ ($ticket->role_type ?? '') == 'user_involved' ? 'selected' : '' }}>User Involved</option>
                                        <option value="user_role" {{ ($ticket->role_type ?? '') == 'user_role' ? 'selected' : '' }}>User Role</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Re-Open Allowed Till</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="reopen_allowed">
                                        <option value="">Select</option>
                                        <option value="24" {{ ($ticket->reopen_allowed ?? '') == '24' ? 'selected' : '' }}>24 Hours</option>
                                        <option value="48" {{ ($ticket->reopen_allowed ?? '') == '48' ? 'selected' : '' }}>48 Hours</option>
                                        <option value="72" {{ ($ticket->reopen_allowed ?? '') == '72' ? 'selected' : '' }}>72 Hours</option>
                                        <option value="custom" {{ ($ticket->reopen_allowed ?? '') == 'custom' ? 'selected' : '' }}>Custom</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">OTP Required</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" name="otp_required"
                                            {{ ($ticket->otp_required ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                </div>

                                <label class="col-sm-2 col-form-label">Generate Forwarding Email</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" name="generate_email"
                                            {{ ($ticket->generate_email ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Change Asset Status</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" name="change_asset_status"
                                            {{ ($ticket->change_asset_status ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
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

        $('#ticketTypeForm').validate({

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
                let id = $('#ticket_type_id').val();

                $.ajax({
                    url: "/ticket-type/" + id, 
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#ticketTypeForm button[type="submit"]').prop('disabled', true)
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
                        $('#ticketTypeForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
                    }
                });
            }
        });
    });
</script>
@endsection