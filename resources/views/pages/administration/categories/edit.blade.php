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
                        <h4 class="mb-1">Update Category</h4>
                        <p class="text-muted mb-0">
                            Manage category details and financial information
                        </p>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </div>

                <!-- Form -->
                <form id="categoryForm">
                    @csrf

                    <div class="card-body">

                        <!-- Section Title -->
                        <div class="border-bottom pb-3 mb-4">
                            <h5 class="mb-1">
                                <i class="bx bx-category-alt me-1"></i>
                                Category Details
                            </h5>

                            <small class="text-muted">
                                Update category information and settings
                            </small>
                        </div>

                        <div class="row g-3">
                            <input type="hidden" value="{{ $category->id }}" id="category_id" name="category_id">

                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Category Name
                                </label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ $category->name }}"
                                    name="parent_category_name"
                                    placeholder="Enter category name">
                            </div>

                            <!-- Parent Category -->
                            {{-- <div class="col-md-6">
                                <label class="form-label">
                                    Parent Category
                                </label>

                                <select class="form-select"
                                        name="selective_category_id">

                                    <option value="">
                                        Select Category
                                    </option>

                                </select>
                            </div> --}}

                            <!-- Sub Category -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Sub Category
                                </label>

                                <input type="text"
                                    class="form-control"
                                    name="sub_category_name"
                                    placeholder="Enter sub category" value="{{ $category->subCategory->name }}">
                            </div>

                            <!-- Category Code -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Category Code
                                </label>

                                <input type="text"
                                    class="form-control"
                                    value="{{ $category->category_code }}"
                                    name="category_code"
                                    placeholder="Enter category code">
                            </div>

                            <!-- Transfer Duration -->
                            <div class="col-md-3">
                                <label class="form-label">
                                    Transfer Duration
                                </label>

                                <input type="text"
                                    class="form-control"
                                    name="trafs_duration"
                                    value="{{ $category->trafs_duration }}">
                            </div>

                            <!-- Duration Type -->
                            <div class="col-md-3">
                                <label class="form-label">
                                    Duration Type
                                </label>

                                <select class="form-select"
                                        name="trafs_duration_type">

                                    <option value="">Select</option>

                                    <option value="day"
                                        {{ $category->trafs_duration_type == 'day' ? 'selected' : '' }}>
                                        Day(s)
                                    </option>

                                    <option value="month"
                                        {{ $category->trafs_duration_type == 'month' ? 'selected' : '' }}>
                                        Month(s)
                                    </option>

                                    <option value="year"
                                        {{ $category->trafs_duration_type == 'year' ? 'selected' : '' }}>
                                        Year(s)
                                    </option>

                                </select>
                            </div>

                            <!-- Settings -->
                            <div class="col-md-6">

                                <label class="form-label d-block mb-3">
                                    Settings
                                </label>

                                <div class="card border shadow-none">

                                    <div class="card-body">

                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="is_link_asset"
                                                value="1"
                                                {{ $category->is_link_asset ? 'checked' : '' }}>

                                            <label class="form-check-label">
                                                Show in Linked Assets
                                            </label>
                                        </div>

                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="cascade"
                                                value="1"
                                                {{ $category->cascade ? 'checked' : '' }}>

                                            <label class="form-check-label">
                                                Cascade
                                            </label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="allow_auto"
                                                value="1"
                                                {{ $category->allow_auto ? 'checked' : '' }}>

                                            <label class="form-check-label">
                                                Allow Auto Extend
                                            </label>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer border-top text-end">

                        <button type="reset" class="btn btn-outline-secondary me-2">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i>
                            Update Category
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

        $('#categoryForm').validate({

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
                let id = $('#category_id').val();

                $.ajax({
                    url: "/categories/" + id, 
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
    });
</script>
@endsection
