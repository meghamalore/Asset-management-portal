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
            <h4 class="fw-bold mb-0">List of Barcode & QR Code</h4>
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
                                <th>Asset Name</th>
                                <th>Asset Code</th>
                                <th>QR Code</th>
                                <th>Barcode Code</th>
                                <th>Created Date</th>
                            </tr>

                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <!-- View -->
                                        <a href="#" class="text-primary" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a href="#" class="text-warning" title="Edit" id="editConditionBtn">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="submit" class="btn p-0 border-0 text-danger" title="Delete"
                                            id="deleteConditionBtn">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                {{-- <td>{{ $condition->updated_at ? $condition->updated_at->format('d/m/Y h:i a') : '-' }}</td> --}}
                                <td></td>
                            </tr>
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
                    <h5 class="modal-title">Generate QR Code & Bar Code</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form id="qrBarcodeForm">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Asset Name
                            </label>

                            <select class="form-select" name="asset_id" id="assetSelect">

                                <option value="">Select Asset</option>

                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}" data-code="{{ $asset->asset_code }}">

                                        {{ $asset->asset_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Asset Code
                            </label>

                            <input type="text" class="form-control" id="assetCode" name="asset_code" readonly />

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">

                            Close

                        </button>

                        <button type="submit" class="btn btn-primary btn-sm">

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
                            <input type="text" class="form-control" id="edit_condition_name" name="condition_name">
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

    $('#assetSelect').on('change', function () {

        let assetCode = $(this).find(':selected').data('code');
        $('#assetCode').val(assetCode ?? '');

    });

    $('#qrBarcodeForm').validate({

        ignore: ":hidden:not(.force-validate)",

        rules: {
            asset_id: {
                required: true
            },
            asset_code: {
                required: true
            }
        },

        messages: {  
            asset_id: {
                required: "Please enter the asset name."
            },
            asset_code: {
                required: "Please enter the asset code."
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
            url: "{{ route('store.qr') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            //  BEFORE SEND
            beforeSend: function () {

                // Disable submit button
                $('#qrBarcodeForm button[type="submit"]').prop('disabled', true);

                // Change button text (optional)
                $('#qrBarcodeForm button[type="submit"]').html(
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
                $('#qrBarcodeForm button[type="submit"]').prop('disabled', false);

                // Restore button text
                $('#qrBarcodeForm button[type="submit"]').html('Submit');
            }
        });
        }
    });
</script>
@endsection
