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
                        <h5 class="mb-0">Generate Ticket</h5>
                    </div>
                    <div class="card-body">
                        <form id="ticketForm">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Parent Ticket</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="ticket_number" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Ticket Type</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="ticket_type_id">
                                        <option value="">Select</option>
                                        @foreach($ticket_type as $ticket_types)
                                            <option value="{{ $ticket_types->id }}">{{ $ticket_types->ticket_type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Ticket Status</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="status_id">
                                        <option value="">Select</option>
                                        @foreach($ticket_status as $status)
                                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Customer Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="customer_name"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="location_id">
                                        <option value="">Select Location</option>
                                        @foreach($location as $locations)
                                            <option value="{{$locations->id}}">{{ $locations->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Asset</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="asset_id">
                                        <option value="">Select Asset</option>
                                        @foreach($asset as $assets)
                                            <option value="{{$assets->id}}">{{ $assets->asset_code }} ( {{$assets->asset_name}} )</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="department_id">
                                        <option value="">Select</option>
                                        @foreach($department as $departments)
                                            <option value="{{$departments->id}}">
                                                {{$departments->name}} ({{$departments->code}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Assigned To</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="assigned_to">
                                        <option value="">Select</option>
                                        @foreach ($user as $users)
                                            @if($users->id != auth()->id())
                                                <option value="{{ $users->id }}"
                                                    {{ old('assigned_to', $ticket->assigned_to ?? '') == $users->id ? 'selected' : '' }}>
                                                    {{ $users->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Ticket Group</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="ticket_group">
                                        <option value="">Select</option>
                                        <option value="maintanance_group">Maintainance Group</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Priority</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="priority">
                                        <option value="">Select</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Reported Date</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="date" name="reported_date" />
                                </div>

                                <label class="col-sm-2 col-form-label">Reported By</label>
                                 <div class="col-sm-4">
                                    <select class="form-select" name="reported_by">
                                        <option value="">Select</option>
                                        <option value="{{ auth()->id() }}"
                                            {{ old('reported_by', $ticket->reported_by ?? auth()->id()) == auth()->id() ? 'selected' : '' }}>
                                            {{ auth()->user()->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Notify Reported By</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="notify_reported_by" value="1">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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

        $('#ticketForm').validate({

            ignore: ":hidden:not(.force-validate)",

            rules: {
                    ticket_type_id: {
                        required: true
                    },
                    customer_name: {
                        required: true,
                        minlength: 3
                    },
                    location_id: {
                        required: true
                    },
                    asset_id: {
                        required: true
                    },
                    department_id: {
                        required: true
                    },
                    assigned_to: {
                        required: true
                    },
                    priority: {
                        required: true
                    },
                    ticket_group: {
                        required: true
                    },
                    reported_date: {
                        required: true,
                        date: true
                    },
                    reported_by: {
                        required: true
                    },
                    description: {
                        required: true,
                        minlength: 5
                    }
            },

            messages: {
                ticket_type_id: {
                    required: "Please select ticket type"
                },
                customer_name: {
                    required: "Customer name is required",
                    minlength: "Minimum 3 characters required"
                },
                location_id: {
                    required: "Please select location"
                },
                asset_id: {
                    required: "Please select asset"
                },
                department_id: {
                    required: "Please select department"
                },
                assigned_to: {
                    required: "Please select assigned user"
                },
                priority: {
                    required: "Please select priority"
                },
                ticket_group: {
                    required: "Please select ticket group"
                },
                reported_date: {
                    required: "Please select reported date",
                    date: "Enter valid date"
                },
                reported_by: {
                    required: "Please select reporter"
                },
                description: {
                    required: "Description is required",
                    minlength: "Minimum 5 characters required"
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
                    url: "{{ route('store.help.desk') }}",
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

                            $('#ticketForm')[0].reset();
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
                        $('#ticketForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
                    }
                });
            }
        });
    });
</script>
@endsection
