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
                        <h5 class="mb-0">Add Ticket Type</h5>
                    </div>
                    <div class="card-body">
                        <form id="ticketTypeForm">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Type</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="ticket_type" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                                <div class="col-sm-4">
                                    <select  class="form-select" name="category_id">
                                        <option value="">Select</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Expected TAT</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="expected_tat" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Activity Type</label>
                                <div class="col-sm-4">
                                    <select  class="form-select" name="activity_type">
                                        <option value="">Select</option>
                                        <option value="calibration">Calibration</option>
                                        <option value="inspection">Inspection</option>
                                        <option value="warranty_expiry">Warranty Expiry</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Type Duration</label>
                                <div class="col-sm-4">
                                    <select  class="form-select" name="duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Days</option>
                                        <option value="hours">Hours</option>
                                        <option value="minutes">Minutes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Reason</label>
                                <div class="col-sm-4">
                                    <textarea name="reason" id="basic-default-message" class="form-control"></textarea>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Location</label>
                                <div class="col-sm-4">
                                    <select  class="form-select" name="location_id">
                                        <option value="">Select</option>
                                        @foreach ($location as $locations)
                                        <option value="{{ $locations->id }}">{{ $locations->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Role</label>
                                <div class="col-sm-4">
                                    <select  class="form-select" name="role_type">
                                        <option value="">Select</option>
                                        <option value="user_involved">User Involved</option>
                                        <option value="user_role">User Role</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Re-Open Allowed Till</label>
                                <div class="col-sm-4">
                                    <select  class="form-select" name="reopen_allowed">
                                        <option value="">Select</option>
                                        <option value="24">24 Hours</option>
                                        <option value="48">48 Hours</option>
                                        <option value="72">72 Hours</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >OTP Required</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="otp_required"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" >Generate Forwarding Email</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="generate_email"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Change Asset Status if Ticket is Raised with This Ticket Type</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="change_asset_status"/>
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

        $('#ticketTypeForm').validate({

            ignore: ":hidden:not(.force-validate)",

            rules: {
                ticket_type: {
                    required: true,
                    minlength: 3
                },
                category_id: {
                    required: true
                },
                expected_tat: {
                    required: true,
                    digits: true
                },
                activity_type: {
                    required: true
                },
                duration_type: {
                    required: true
                },
                reason: {
                    required: true,
                    minlength: 5
                },
                location_id: {
                    required: true
                },
                role_type: {
                    required: true
                },
                reopen_allowed: {
                    required: true
                }
            },

            messages: {
                ticket_type: {
                    required: "Ticket Type is required",
                    minlength: "Ticket Type must be at least 3 characters"
                },
                category_id: {
                    required: "Please select Category"
                },
                expected_tat: {
                    required: "Expected TAT is required",
                    digits: "Only numbers allowed"
                },
                activity_type: {
                    required: "Please select Activity Type"
                },
                duration_type: {
                    required: "Please select Duration Type"
                },
                reason: {
                    required: "Reason is required",
                    minlength: "Reason must be at least 5 characters"
                },
                location_id: {
                    required: "Please select Location"
                },
                role_type: {
                    required: "Please select Role"
                },
                reopen_allowed: {
                    required: "Please select Re-open duration"
                }
            },

            errorElement: 'span',
            errorClass: 'text-danger',

            highlight: function (element) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function (form) {

                let formData = new FormData(form);

                $.ajax({
                    url: "{{ route('store.ticket.type') }}",
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