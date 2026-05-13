@extends('layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header">

            <h5 class="mb-1">Location Details</h5>

        </div>

        <div class="card-body">

            <!-- Category Name -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Location Name
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $location->name ?? '-' }}
                    </p>

                </div>

            </div>

            <!-- Sub Category -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Sub Locations
                </label>

                <div class="col-sm-4">

                    @if($location->subLocation && $location->subLocation->count())

                        @foreach($location->subLocation as $sub)

                            <span class="badge bg-primary me-1 mb-1">
                                {{ $sub->name }}
                            </span>

                        @endforeach

                    @else

                        <p class="mb-0">-</p>

                    @endif

                </div>

            </div>

            <!-- Category Code -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Location Code
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $location->location_code ?? '-' }}
                    </p>

                </div>

            </div>

             <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Description
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $location->description ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection 