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
</div>
@endsection

