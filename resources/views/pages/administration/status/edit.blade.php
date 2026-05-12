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
            <div class="col-12">
                <div class="card shadow-sm">

                    @php
                        $selectedCategories = $status->categories->pluck('id')->toArray();
                        $selectedSubCategories = $status->subCategories->pluck('id')->toArray();
                    @endphp

                    <form id="statusForm">
                        @csrf

                        <div class="card">

                            <div class="card-header">
                                <h4 class="mb-0">Update Status</h4>
                            </div>

                            <div class="card-body">

                                <!-- STATUS INFORMATION -->
                                <div class="accordion mt-3" id="accordionExample">

                                    <div class="card accordion-item active">

                                        <h2 class="accordion-header">

                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionThirteen">

                                                Status Information
                                            </button>

                                        </h2>

                                        <div id="accordionThirteen" class="accordion-collapse collapse show">

                                            <div class="accordion-body">

                                                <!-- STATUS TYPE + STATUS NAME -->
                                                <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label">
                                                        Status Type
                                                    </label>

                                                    <div class="col-sm-4">

                                                        <select class="form-select force-validate" name="status_type">

                                                            <option value="">Select</option>

                                                            <option value="allotted_status"
                                                                {{ $status->status_type == 'allotted_status' ? 'selected' : '' }}>
                                                                Allotted Assets
                                                            </option>

                                                            <option value="unalloted_status"
                                                                {{ $status->status_type == 'unalloted_status' ? 'selected' : '' }}>
                                                                Unallotted Assets
                                                            </option>

                                                            <option value="discarded_assets"
                                                                {{ $status->status_type == 'discarded_assets' ? 'selected' : '' }}>
                                                                Discarded Assets
                                                            </option>

                                                        </select>

                                                    </div>

                                                    <label class="col-sm-2 col-form-label">
                                                        Status Name
                                                    </label>

                                                    <div class="col-sm-4">
                                                        <input type="hidden" value="{{ $status->id }}" id="status_id" name="status_id">

                                                        <input class="form-control force-validate" type="text"
                                                            name="status_name" value="{{ $status->status_name }}" />

                                                    </div>

                                                </div>

                                                <!-- NEXT STATUS + CATEGORY -->
                                                <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label">
                                                        Next Status
                                                    </label>

                                                    <div class="col-sm-4">

                                                        <select class="form-select force-validate" name="next_status">

                                                            <option value="">Select</option>

                                                            <option value="in_use"
                                                                {{ $status->next_status == 'in_use' ? 'selected' : '' }}>
                                                                In Use
                                                            </option>

                                                            <option value="lost"
                                                                {{ $status->next_status == 'lost' ? 'selected' : '' }}>
                                                                Lost
                                                            </option>

                                                            <option value="out_for_repair"
                                                                {{ $status->next_status == 'out_for_repair' ? 'selected' : '' }}>
                                                                Out for Repair
                                                            </option>

                                                            <option value="stolen"
                                                                {{ $status->next_status == 'stolen' ? 'selected' : '' }}>
                                                                Stolen
                                                            </option>

                                                            <option value="write_off"
                                                                {{ $status->next_status == 'write_off' ? 'selected' : '' }}>
                                                                Write-off
                                                            </option>

                                                        </select>

                                                    </div>

                                                    <label class="col-sm-2 col-form-label">
                                                        Only visible for categories
                                                    </label>

                                                    <div class="col-sm-4">

                                                        <div class="border rounded p-2"
                                                            style="max-height: 250px; overflow-y:auto;">

                                                            @foreach ($categories as $category)
                                                                <!-- CATEGORY -->
                                                                <div class="mb-2">

                                                                    <div class="form-check">

                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="categories[]" value="{{ $category->id }}"
                                                                            id="cat{{ $category->id }}"
                                                                            {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>

                                                                        <label class="form-check-label fw-bold"
                                                                            for="cat{{ $category->id }}">

                                                                            {{ $category->name }}

                                                                        </label>

                                                                    </div>

                                                                    <!-- SUB CATEGORY -->
                                                                    <div class="ms-4 mt-1">

                                                                        @foreach ($category->subCategories as $sub)
                                                                            <div class="form-check">

                                                                                <input class="form-check-input"
                                                                                    type="checkbox" name="sub_categories[]"
                                                                                    value="{{ $sub->id }}"
                                                                                    id="sub{{ $sub->id }}"
                                                                                    {{ in_array($sub->id, $selectedSubCategories) ? 'checked' : '' }}>

                                                                                <label class="form-check-label small"
                                                                                    for="sub{{ $sub->id }}">

                                                                                    {{ $sub->name }}

                                                                                </label>

                                                                            </div>
                                                                        @endforeach

                                                                    </div>

                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- HOLD/PAUSE -->
                                                <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label">
                                                        Hold/Pause Activity
                                                    </label>

                                                    <div class="col-sm-4">

                                                        <div class="form-check form-switch mb-2">

                                                            <input class="form-check-input force-validate" type="checkbox"
                                                                name="hold_pause_activity" value="1"
                                                                {{ $status->hold_pause_activity == 1 ? 'checked' : '' }} />

                                                            <label class="form-check-label">
                                                                Yes
                                                            </label>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- FOOTER -->
                            <div class="card-footer text-end">

                                <button type="submit" class="btn btn-primary">

                                    Update Status

                                </button>

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
@endsection
@section('section-js')
    <script>
        $(document).ready(function() {

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
                toastElement.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            $('#statusForm').validate({

                ignore: ":hidden:not(.force-validate)",

                errorElement: 'span',
                errorClass: 'text-danger',

                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },

                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },

                errorPlacement: function(error, element) {
                    if (element.hasClass('select2')) {
                        error.insertAfter(element.next('.select2-container'));
                    } else if (element.closest('.input-group').length) {
                        error.insertAfter(element.closest('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },

                submitHandler: function(form) {

                    let formData = new FormData(form);
                    let id = $('#status_id').val();

                    $.ajax({
                        url: "/update-status/" + id,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend: function() {
                            $('#statusForm button[type="submit"]').prop('disabled', true)
                                .html(
                                    '<span class="spinner-border spinner-border-sm"></span> Saving...'
                                );
                        },

                        success: function(response) {
                            if (response.status) {
                                showToast(response.message, 'success');
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                            } else {
                                showToast(response.message, 'error');
                            }
                        },

                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    showToast(value[0], 'error');
                                });
                            } else {
                                showToast('Something went wrong!', 'error');
                            }
                        },

                        complete: function() {
                            $('#statusForm button[type="submit"]').prop('disabled', false)
                                .html('Send');
                        }
                    });
                }
            });
        });
    </script>
@endsection
