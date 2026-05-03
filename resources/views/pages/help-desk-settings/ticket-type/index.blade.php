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
        <h4 class="fw-bold mb-0">List of Ticket Types</h4>
        {{-- <button type="button" class="btn btn-primary btn-sm"> --}}
            <a href="{{ route('add.ticket.type')}}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus"></i> Add
            </a>
        {{-- </button> --}}
    </div>
    <div class="card">
        <div class="card-body"> 
            <div class="table-responsive">
                <table id="ticketTypeTable" class="table table-bordered">
                    <thead>

                        <!-- GROUP HEADER -->
                        <tr>
                            <th rowspan="2">Actions</th>
                            <th colspan="13" id="defaultToggle">
                                Default Section
                                <i class='bx bx-chevron-right toggle-icon'></i>
                            </th>
                        </tr>

                        <!-- COLUMN HEADER -->
                        <tr>
                            <th>Ticket Type</th>
                            <th>Category</th>
                            <th>Expected TAT</th>
                            <th>Activity Type</th>
                            <th>Ticket Type Duration</th>
                            <th>Reason</th>
                            <th>Created Date</th>
                            <th>Location</th>
                            <th>Role</th>
                            <th>Reopen Allowed Till</th>
                            <th>OTP Required</th>
                            <th>Generate Forwarding Email</th>
                            <th>Change Asset Status</th>
                        </tr>

                        <!-- FILTER ROW -->
                        {{-- <tr>
                            <!-- Skip Actions column -->
                            @for ($i = 0; $i < 13; $i++)
                                <th>
                                    <input type="text" class="form-control form-control-sm" placeholder="Search">
                                </th>
                            @endfor
                        </tr> --}}

                    </thead>

                    <tbody>
                        @foreach ($ticket_type as $ticket_types)
                            <tr>
                                <!-- Actions -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <a href="{{ route('ticket.type.view', $ticket_types->id) }}" class="text-primary" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="{{ route('ticket.type.edit', $ticket_types->id) }}" class="text-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <button type="button" class="btn p-0 border-0 text-danger"
                                            title="Delete" id="deleteTypeBtn" data-id ="{{$ticket_types->id}}">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    </div>
                                </td>

                                <!-- 13 columns -->
                                <td>{{ $ticket_types->ticket_type ?? '-' }}</td>

                                <td>{{ $ticket_types->category->name ?? '-' }}</td>

                                <td>{{ $ticket_types->expected_tat ?? '-' }}</td>

                                <td>{{ ucfirst(str_replace('_', ' ', $ticket_types->activity_type)) ?? '-' }}</td>

                                <td>{{ ucfirst($ticket_types->duration_type) ?? '-' }}</td>

                                <td>{{ $ticket_types->reason ?? '-' }}</td>

                                <td>{{ $ticket_types->created_at ? $ticket_types->created_at->format('d-m-Y') : '-' }}</td>

                                <td>{{ $ticket_types->location->name ?? '-' }}</td>

                                <td>{{ ucfirst(str_replace('_', ' ', $ticket_types->role_type)) ?? '-' }}</td>

                                <td>
                                    {{ $ticket_types->reopen_allowed == 'custom' 
                                        ? 'Custom' 
                                        : ($ticket_types->reopen_allowed ? $ticket_types->reopen_allowed . ' Hours' : '-') 
                                    }}
                                </td>

                                <td>
                                    {{ $ticket_types->otp_required ? 'Yes' : 'No' }}
                                </td>

                                <td>
                                    {{ $ticket_types->generate_email ? 'Yes' : 'No' }}
                                </td>

                                <td>
                                    {{ $ticket_types->change_asset_status ? 'Yes' : 'No' }}
                                </td>
                            </tr>
                        @endforeach       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>

@endsection
@section('section-js')
<script>
        $(document).ready(function() {

            // Show Toast
            function showToast(message, type = 'success') {

                let bgClass = 'bg-success';
                let icon = 'bx-check-circle';

                if (type === 'error') {
                    bgClass = 'bg-danger';
                    icon = 'bx-error-circle';
                } else if (type === 'warning') {
                    bgClass = 'bg-warning';
                    icon = 'bx-error';
                }

                let toastHTML = `
                    <div class="bs-toast toast fade ${bgClass}" role="alert">
                        <div class="toast-header">
                            <i class="bx ${icon} me-2"></i>
                            <div class="me-auto fw-semibold">Notification</div>
                            <small>Now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;

                let container = $('#toastContainer');
                let toastElement = $(toastHTML);

                container.append(toastElement);

                let toast = new bootstrap.Toast(toastElement[0], {
                    delay: 3000
                });

                toast.show();

                // remove after hidden
                toastElement.on('hidden.bs.toast', function () {
                    $(this).remove();
                });
            }
        
            $('#defaultToggle').addClass('collapsed');
        
            var table = $('#ticketTypeTable').DataTable({
                orderCellsTop: true,
                autoWidth: false,   //  important
                scrollX: true       //  optional but recommended
            });
        
            //  ONLY THIS (no extra logic)
            let defaultCols = table.columns('.default-extra').indexes().toArray();
        
            let defaultOpen = false;
        
            // DEFAULT
            $('#defaultToggle').on('click', function() {
        
                let isVisible = table.column(defaultCols[0]).visible(); //  check current state
        
                table.columns(defaultCols).visible(!isVisible, false);
        
                table.columns.adjust().draw(false);
        
                $(this).toggleClass('collapsed', isVisible);
        
                $('.toggle-icon')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);
            });

            // Row delete code
            $(document).on('click', '#deleteTypeBtn', function () {

                let id = $(this).data('id'); 

                if (!confirm('Are you sure you want to delete?')) {
                    showToast('Delete cancelled by user', 'warning');
                    return;
                }

                $.ajax({
                    url: "/destroy-ticket-type/" + id, 
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: "DELETE"
                    },

                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    error: function (xhr) {
                        console.log(xhr);
                        showToast(xhr.responseJSON?.message || 'Delete failed!', 'error');
                    }
                });

            });
        
        });
</script>
@endsection