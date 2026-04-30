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
        <h4 class="fw-bold mb-0">List of Ticket Status</h4>
        {{-- <button type="button" class="btn btn-primary btn-sm"> --}}
            <a href="{{ route('add.ticket.status') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus"></i> Add
            </a>
        {{-- </button> --}}
    </div>
    <div class="card">
        <div class="card-body"> 
            <div class="table-responsive">
                <table id="ticketStatusTable" class="table table-bordered">
                    <thead>
                        <!-- GROUP HEADER -->
                        <tr>
                            {{-- <th rowspan="3"><input type="checkbox" id="selectAll"></th> --}}
                            <th rowspan="2">Actions</th>

                            <th colspan="8">
                                Default Section
                            </th>
                        </tr>

                        <!-- COLUMN HEADER -->
                        <tr>
                            <!-- These 13 + 2 rowspan = 15 total -->
                            <th>Status Type</th>
                            <th>Auto Close Hours</th>
                            <th>Sub Status</th>
                            <th>Is Default</th>
                            <th>Edit Based On </th>
                            <th>Auto Checkout </th>
                            <th>Tat Count</th>
                            <th>Created Date</th>
                        </tr>

                        <!-- FILTER -->
                        {{-- <tr>
                            @for ($i = 0; $i < 8; $i++)
                                <th>
                                <input type="text">
                                </th>
                            @endfor
                        </tr> --}}
                    </thead>

                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <!-- View -->
                                        <a href="#" class="text-primary" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('ticket.status.edit', $ticket->id) }}" class="text-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="submit" class="btn p-0 border-0 text-danger"
                                            title="Delete" id="deleteStatusBtn" data-id ="{{$ticket->id}}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>{{ $ticket->status_type_id == 1 ? 'hold' : ($ticket->status_type_id == 2 ? 'assigned' : ($ticket->status_type_id == 3 ? 'open' : '-')) }}</td>
                                <td>{{ $ticket->auto_close_hours ?? '-' }}</td>
                                <td>{{ $ticket->sub_status ?? '-' }}</td>
                                <td>{{ $ticket->is_default ? 'Yes' : 'No' }}</td>
                                <td>{{ $ticket->edit_based_on ?? '-' }}</td>
                                <td>{{ $ticket->auto_checkout ? 'Yes' : 'No' }}</td>
                                <td>{{ $ticket->tat_count ?? '-' }}</td>
                                <td>{{ $ticket->created_at ? $ticket->created_at->format('Y-m-d') : '-' }}</td>
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

            // Row delete code
            $(document).on('click', '#deleteStatusBtn', function () {

                let id = $(this).data('id'); 

                if (!confirm('Are you sure you want to delete?')) {
                    showToast('Delete cancelled by user', 'warning');
                    return;
                }

                $.ajax({
                    url: "/destroy-ticket-status/" + id, 
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: "DELETE"
                    },

                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');

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
        
            //  table structure code
            $('#defaultToggle').addClass('collapsed');
        
            var table = $('#ticketStatusTable').DataTable({
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
        
        });
</script>
@endsection

