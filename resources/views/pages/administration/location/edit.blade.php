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

                <!-- Header -->
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Update Location</h4>
                    </div>
                </div>

                <!-- Form -->
                <form id="locationForm">
                    @csrf

                    <div class="card-body">

                        <!-- Section Title -->
                        <div class="border-bottom pb-3 mb-4">
                            <h5 class="mb-1">
                                <i class="bx bx-category-alt me-1"></i>
                                Location Details
                            </h5>
                        </div>

                        <div class="row g-3">
                            <input type="hidden" value="{{ $location->id }}" id="location_id" name="location_id">

                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Location Name
                                </label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ $location->name }}"
                                    name="parent_location_name"
                                    placeholder="Enter category name">
                            </div>

                            <!-- Sub Locations -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Sub Locations
                                </label>

                                <div class="border rounded p-2" style="max-height: 200px; overflow-y:auto;">

                                    @if($location->subLocation && $location->subLocation->count())

                                        @foreach($location->subLocation as $sub)

                                            <div class="form-check mb-1">

                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    name="sub_locations[]"
                                                    value="{{ $sub->name }}"
                                                    id="subLocation{{ $sub->id }}"
                                                    checked>

                                                <label class="form-check-label"
                                                    for="subLocation{{ $sub->id }}">

                                                    {{ $sub->name }}

                                                </label>

                                            </div>

                                        @endforeach

                                    @endif

                                </div>

                            </div>

                            <!-- Category Code -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Location Code
                                </label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ $location->location_code }}"
                                    name="location_code"
                                    placeholder="Enter category code">
                            </div>

                            <!-- Transfer Duration -->
                            <div class="col-md-3">
                                <label class="form-label">
                                    Description
                                </label>

                                <textarea
                                    class="form-control"
                                    name="description"
                                    placeholder="Enter description">{{ $location->description }}</textarea>
                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer border-top text-end">

                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i>
                            Update Location
                        </button>

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

        $('#locationForm').validate({

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
                let id = $('#location_id').val();

                $.ajax({
                    url: "/update-location/" + id, 
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#locationForm button[type="submit"]').prop('disabled', true)
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
                        $('#locationForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
                    }
                });
            }
        });
    });
</script>
@endsection
