@extends('layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header">

            <h5 class="mb-1">Category Details</h5>

            

        </div>

        <div class="card-body">

            <!-- Category Name -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Category Name
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $category->name ?? '-' }}
                    </p>

                </div>

            </div>

            <!-- Sub Category -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Sub Category
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $category->subCategory->name ?? '-' }}
                    </p>

                </div>

            </div>

            <!-- Category Code -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Category Code
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $category->category_code ?? '-' }}
                    </p>

                </div>

            </div>

            <!-- Transfer Duration -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Transfer Duration
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ $category->trafs_duration ?? '-' }} Hours
                    </p>

                </div>

                <label class="col-sm-2 fw-bold">
                    Duration Type
                </label>

                <div class="col-sm-4">

                    <p class="mb-0">
                        {{ ucfirst($category->trafs_duration_type ?? '-') }}
                    </p>

                </div>

            </div>

            <!-- Settings -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Linked Assets
                </label>

                <div class="col-sm-4">

                    <span class="badge {{ $category->is_link_asset ? 'bg-success' : 'bg-secondary' }}">
                        {{ $category->is_link_asset ? 'Enabled' : 'Disabled' }}
                    </span>

                </div>

                <label class="col-sm-2 fw-bold">
                    Cascade
                </label>

                <div class="col-sm-4">

                    <span class="badge {{ $category->cascade ? 'bg-success' : 'bg-secondary' }}">
                        {{ $category->cascade ? 'Enabled' : 'Disabled' }}
                    </span>

                </div>

            </div>

            <!-- Allow Auto -->
            <div class="row mb-3">

                <label class="col-sm-2 fw-bold">
                    Allow Auto Extend
                </label>

                <div class="col-sm-4">

                    <span class="badge {{ $category->allow_auto ? 'bg-success' : 'bg-secondary' }}">
                        {{ $category->allow_auto ? 'Enabled' : 'Disabled' }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection 