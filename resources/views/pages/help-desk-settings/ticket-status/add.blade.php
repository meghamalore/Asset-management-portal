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
                        <form id="ticketStatusForm">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Status</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="ticket_sub_status" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Hour(s) for Auto Closer</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="auto_close_hours" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Is Default</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="is_default"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Edit button to be displayed based On</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="edit_based_on">
                                        <option value="">Select</option>
                                        <option value="user_involved">User Involved</option>
                                        <option value="user_role">User Role</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Auto Check-Out on This Ticket Status</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="auto_checkout"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" >Tat Count</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="tat_count"/>
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

        $('#ticketStatusForm').validate({

            ignore: ":hidden:not(.force-validate)",

            rules: {
                ticket_sub_status: {
                    required: true
                },
                auto_close_hours: {
                    required: true,
                    maxlength: 255
                },
                is_default: {
                    required: true
                },
                edit_based_on: {
                    required: true
                },
                auto_checkout: {
                    required: true
                },
                tat_count: {
                    required: true
                },
            },

            messages: {
                is_default: {
                    required: "Please enter sub status",
                },
                ticket_sub_status: {
                    required: "Please enter sub status",
                },
                auto_close_hours: {
                    required: "Please enter auto close hours"
                },
                edit_based_on: {
                    required: "Please select edit option"
                },
                auto_checkout: {
                    required: "Please select edit option"
                },
                tat_count: {
                    required: "Please select edit option"
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

                $.ajax({
                    url: "{{ route('store-ticket-status') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#ticketStatusForm button[type="submit"]').prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm"></span> Saving...');
                    },

                    success: function (response) {
                        if (response.status) {
                            showToast(response.message, 'success');

                            $('#ticketStatusForm')[0].reset();
                            $('.select2').val(null).trigger('change');
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
                        $('#ticketStatusForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
                    }
                });
            }
        });
    });
</script>
@endsection
