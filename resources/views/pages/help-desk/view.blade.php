@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Ticket Details</h5>
        </div>

        <div class="card-body">

            <!-- Parent Ticket -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Parent Ticket</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->ticket_number }}</p>
                </div>
            </div>

            <!-- Ticket Type -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Ticket Type</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->ticketType->ticket_type ?? '-' }}</p>
                </div>
            </div>

            <!-- Customer -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Customer Name</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->customer_name ?? '-' }}</p>
                </div>
            </div>

            <!-- Location + Asset -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Location</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->location->name ?? '-' }}</p>
                </div>

                <label class="col-sm-2 fw-bold">Asset</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->asset->asset_name ?? '-' }}</p>
                </div>
            </div>

            <!-- Department -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Department</label>
                <div class="col-sm-4">
                    <p class="mb-0">
                        {{ $ticket->department->name ?? '-' }}
                        ({{ $ticket->department->code ?? '' }})
                    </p>
                </div>
            </div>

            <!-- Assigned + Group -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Assigned To</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->assigned_to ?? '-' }}</p>
                </div>

                <label class="col-sm-2 fw-bold">Ticket Group</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->ticket_group ?? '-' }}</p>
                </div>
            </div>

            <!-- Priority -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Priority</label>
                <div class="col-sm-4">
                    <span class="badge 
                        {{ $ticket->priority == 'high' ? 'bg-danger' : 
                        ($ticket->priority == 'medium' ? 'bg-warning' : 'bg-success') }}">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                </div>
            </div>

            <!-- Reported -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Reported Date</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->reported_date ?? '-' }}</p>
                </div>

                <label class="col-sm-2 fw-bold">Reported By</label>
                <div class="col-sm-4">
                    <p class="mb-0">{{ $ticket->reported_by ?? '-' }}</p>
                </div>
            </div>

            <!-- Description -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Description</label>
                <div class="col-sm-10">
                    <p class="mb-0">{{ $ticket->description ?? '-' }}</p>
                </div>
            </div>

            <!-- Notify -->
            <div class="row mb-3">
                <label class="col-sm-2 fw-bold">Notify Reported By</label>
                <div class="col-sm-4">
                    <span class="badge {{ $ticket->notify_reported_by ? 'bg-success' : 'bg-secondary' }}">
                        {{ $ticket->notify_reported_by ? 'Yes' : 'No' }}
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection