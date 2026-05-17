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
            @include('layouts.messages')
            <div class="card mb-4">

                <!-- HEADER -->
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Import Assets</h5>

                    <!-- Download Sample Button -->
                </div>

                <!-- BODY -->
                <div class="card-body">

                    <!-- Download Button -->
                    <div class="mb-3 d-flex gap-2">

                        <!-- Download Template -->
                        <a href="{{ route('assets.sample.download') }}" class="btn btn-success btn-sm">
                            <i class="bx bx-download me-1"></i> Download Template
                        </a>

                        <a href="{{ route('asset.download.latest') }}" class="btn btn-info btn-sm">
                            <i class="bx bx-download me-1"></i> Download Last Uploaded File
                        </a>

                    </div>

                    <!-- Form -->
                    <form action="{{ route('asset.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row align-items-end g-3">

                            <!-- File Input -->
                            <div class="col-md-6">
                                <label class="form-label">Upload Excel File</label>
                                <input type="file" name="file" class="form-control" required>
                                @error('file')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-upload me-1"></i> Submit
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            @if(session('failures'))

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Row</th>
                        <th>Field</th>
                        <th>Error</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach(session('failures') as $failure)

                    <tr>
                        <td>{{ $failure['row'] }}</td>

                        <td>{{ $failure['attribute'] }}</td>

                        <td>{{ $failure['errors'] }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <!-- PREVIEW TABLE -->

            <div class="card mt-4" id="previewCard">

                <div class="card-header">

                    <h5 class="mb-0">
                        Excel Preview
                    </h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped align-middle">

                        <thead>

                            <tr>

                                <th>Asset Name</th>

                                <th>Asset Code</th>

                                <th>Category</th>

                                <th>Location</th>

                                <th>Status</th>

                                <th>CWIP Invoice Id</th>

                                <th>Condition</th>

                                <th>Brand</th>

                                <th>Model</th>

                                <th>Linked Asset</th>

                                <th>Description</th>

                                <th>Serial No</th>

                                <th>Vendor Name</th>

                                <th>PO Number</th>

                                <th>Invoice Date</th>

                                <th>Invoice No</th>

                                <th>Purchase Date</th>

                                <th>Purchase Price</th>

                                <th>Self Owned / Partner</th>

                                <th>Partner</th>

                                <th>Capitalization Price</th>

                                <th>End Of Life</th>

                                <th>Capitalization Date</th>

                                <th>Depreciation %</th>

                                <th>Scrap Value</th>

                                <th>Accumulated Depreciation</th>

                                <th>Income Tax Depreciation %</th>

                                <th>Department</th>

                                <th>Transferred To</th>

                                <th>Allotted Upto</th>

                                <th>Remarks</th>

                                <th>AMC Vendor</th>

                                <th>Warranty Vendor</th>

                                <th>Insurance Start Date</th>

                                <th>Insurance End Date</th>

                                <th>AMC Start Date</th>

                                <th>Warranty End Date</th>

                                <th>AMC End Date</th>

                                <th>Warranty Start Date</th>

                            </tr>

                        </thead>

                        <tbody id="previewTableBody">

                            <tr>

                                <td colspan="39" class="text-center">

                                    No Data Found

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('section-js')
<script>
    function loadPreviewData()
    {
        $.ajax({

            url: "{{ route('excel.preview') }}",

            type: "GET",

            success: function(response)
            {
                let tbody = $('#previewTableBody');

                tbody.html('');

                if (!response.status || response.data.length === 0)
                {
                    tbody.append(`
                        <tr>
                            <td colspan="39" class="text-center">
                                No Data Found
                            </td>
                        </tr>
                    `);

                    return;
                }

                $.each(response.data, function(index, row)
                {
                    tbody.append(`
                        <tr>

                            <td>${row.asset_name ?? ''}</td>

                            <td>${row.asset_code ?? ''}</td>

                            <td>${row.category ?? ''}</td>

                            <td>${row.location ?? ''}</td>

                            <td>${row.status ?? ''}</td>

                            <td>${row.mac_address ?? ''}</td>

                            <td>${row.serial_no ?? ''}</td>

                        </tr>
                    `);
                });
            }
        });
    }

    // Page load
    $(document).ready(function ()
    {
        loadPreviewData();
    });
</script>
@endsection
