@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>View Ticket Type</h5>
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Ticket Type:</label>
                <div class="col-sm-9">{{ $ticket->ticket_type ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Category:</label>
                <div class="col-sm-9">{{ $ticket->category->name ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Expected TAT:</label>
                <div class="col-sm-9">{{ $ticket->expected_tat ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Activity Type:</label>
                <div class="col-sm-9">{{ ucfirst($ticket->activity_type ?? '-') }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Duration Type:</label>
                <div class="col-sm-9">{{ ucfirst($ticket->duration_type ?? '-') }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Reason:</label>
                <div class="col-sm-9">{{ $ticket->reason ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Location:</label>
                <div class="col-sm-9">{{ $ticket->location->name ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Role:</label>
                <div class="col-sm-9">
                    {{ $ticket->role_type == 'user_involved' ? 'User Involved' : 'User Role' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Reopen Allowed:</label>
                <div class="col-sm-9">
                    {{ $ticket->reopen_allowed ? $ticket->reopen_allowed . ' Hours' : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">OTP Required:</label>
                <div class="col-sm-9">
                    {{ $ticket->otp_required ? 'Yes' : 'No' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Generate Email:</label>
                <div class="col-sm-9">
                    {{ $ticket->generate_email ? 'Yes' : 'No' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Change Asset Status:</label>
                <div class="col-sm-9">
                    {{ $ticket->change_asset_status ? 'Yes' : 'No' }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection