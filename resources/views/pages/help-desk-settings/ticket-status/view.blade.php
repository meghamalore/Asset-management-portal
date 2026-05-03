@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">View Ticket Status</h5>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Ticket Status Type:</label>
                        <div class="col-sm-9">
                            @if($ticket->status_type_id == 1)
                                Hold
                            @elseif($ticket->status_type_id == 2)
                                Assigned
                            @elseif($ticket->status_type_id == 3)
                                Open
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Ticket Sub Status:</label>
                        <div class="col-sm-9">
                            {{ $ticket->sub_status ?? '-' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Auto Close Hours:</label>
                        <div class="col-sm-9">
                            {{ $ticket->auto_close_hours ?? '-' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Is Default:</label>
                        <div class="col-sm-9">
                            {{ $ticket->is_default ? 'Yes' : 'No' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Edit Based On:</label>
                        <div class="col-sm-9">
                            @if($ticket->edit_based_on == 'user_involved')
                                User Involved
                            @elseif($ticket->edit_based_on == 'user_role')
                                User Role
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Auto Check-Out:</label>
                        <div class="col-sm-9">
                            {{ $ticket->auto_checkout ? 'Yes' : 'No' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">TAT Count:</label>
                        <div class="col-sm-9">
                            {{ $ticket->tat_count ? 'Yes' : 'No' }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection