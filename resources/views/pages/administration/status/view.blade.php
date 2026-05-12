@extends('layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">

        <div class="col-xxl">

            <div class="card mb-4">

                <!-- HEADER -->
                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        View Status
                    </h5>

                    {{-- <a href="{{ route('status.index') }}"
                       class="btn btn-sm btn-outline-secondary">

                        <i class="bx bx-arrow-back"></i>
                        Back

                    </a> --}}

                </div>

                <!-- BODY -->
                <div class="card-body">

                    <!-- STATUS TYPE -->
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Status Type:
                        </label>

                        <div class="col-sm-9">

                            {{
                                $status->status_type == 'allotted_status'
                                    ? 'Allotted Assets'
                                    : ($status->status_type == 'unalloted_status'
                                        ? 'Unallotted Assets'
                                        : ($status->status_type == 'discarded_assets'
                                            ? 'Discarded Assets'
                                            : '-'))
                            }}

                        </div>

                    </div>

                    <!-- STATUS NAME -->
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Status Name:
                        </label>

                        <div class="col-sm-9">

                            {{ $status->status_name ?? '-' }}

                        </div>

                    </div>

                    <!-- NEXT STATUS -->
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Next Status:
                        </label>

                        <div class="col-sm-9">

                            {{ ucwords(str_replace('_', ' ', $status->next_status)) ?? '-' }}

                        </div>

                    </div>

                    <!-- HOLD / PAUSE -->
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Hold/Pause Activity:
                        </label>

                        <div class="col-sm-9">

                            {{ $status->hold_pause_activity ? 'Yes' : 'No' }}

                        </div>

                    </div>

        
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Categories & Sub Categories:
                        </label>

                        <div class="col-sm-9">

                            @forelse($status->categories as $category)

                                <div class="border rounded p-2 mb-2 bg-light">

                                    <!-- CATEGORY -->
                                    <div class="mb-2">

                                        <span class="badge bg-primary fs-6">

                                            {{ $category->name }}

                                        </span>

                                    </div>

                                    <!-- RELATED SUB CATEGORIES -->
                                    <div class="ms-2">

                                        @php
                                            $matchedSubs = $category->subCategories
                                                ->whereIn(
                                                    'id',
                                                    $status->subCategories->pluck('id')
                                                );
                                        @endphp

                                        @if($matchedSubs->count())

                                            @foreach($matchedSubs as $sub)

                                                <span class="badge bg-info me-1 mb-1">

                                                    {{ $sub->name }}

                                                </span>

                                            @endforeach

                                        @else

                                            <span class="text-muted small">

                                                No Sub Categories

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            @empty

                                <span class="text-muted">

                                    No Categories Selected

                                </span>

                            @endforelse

                        </div>

                    </div>

                    <!-- CREATED AT -->
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Created At:
                        </label>

                        <div class="col-sm-9">

                            {{ $status->created_at?->format('d M Y h:i A') ?? '-' }}

                        </div>

                    </div>

                    <!-- UPDATED AT -->
                    <div class="row mb-3">

                        <label class="col-sm-3 fw-bold">
                            Updated At:
                        </label>

                        <div class="col-sm-9">

                            {{ $status->updated_at?->format('d M Y h:i A') ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection