@extends('layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header">
            <h5 class="mb-1">Asset QR Details</h5>
        </div>

        <div class="card-body">

            <!-- Asset Name -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Asset Name
                </label>

                <div class="col-sm-4">
                    <p class="mb-0">
                        {{ $qr->asset->asset_name ?? '-' }}
                    </p>
                </div>

            </div>

            <!-- Asset Code -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Asset Code
                </label>

                <div class="col-sm-4">
                    <p class="mb-0">
                        {{ $qr->asset_code ?? '-' }}
                    </p>
                </div>

            </div>

            <!-- QR Code -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    QR Code
                </label>

                <div class="col-sm-4">

                    <img src="{{ asset($qr->qr_code) }}" width="80">

                </div>

            </div>

            <!-- QR Data -->
            {{-- <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Barcode
                </label>

                <div class="col-sm-4">
                    <img src="{{ asset($qr->barcode) }}" width="80">
                </div>

            </div> --}}

            <!-- Actions -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Actions
                </label>

                <div class="col-sm-4">

                    <!-- Download QR -->
                    @if(!empty($qr->qr_code))
                        <a href="{{ asset($qr->qr_code) }}"
                        download
                        class="btn btn-primary btn-sm me-2">
                        
                            <i class="bx bx-download"></i> Download QR
                        </a>
                    @endif

                    <!-- Download Barcode -->
                    {{-- @if(!empty($qr->barcode))
                        <a href="{{ asset($qr->barcode) }}"
                        download
                        class="btn btn-dark btn-sm">
                        
                            <i class="bx bx-download"></i> Download Barcode
                        </a>
                    @endif --}}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection