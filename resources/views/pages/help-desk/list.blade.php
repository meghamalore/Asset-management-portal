@extends('layouts.master')
@section('section-css')
<style> 
#toastContainer {
    z-index: 9999 !important;
}

/* modal css */

/* Scroll inside modal */
#bulkEditModal .modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

/* Sticky header */
#bulkEditModal thead th {
    position: sticky;
    top: 0;
    background: #f8f9fa;
    z-index: 2;
}

/* Prevent text wrapping */
#bulkEditModal table th,
#bulkEditModal table td {
    white-space: nowrap;
}
</style>
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Ticket</h4>
    <div class="card">
        <div class="card-body">

                <div class="d-flex justify-content-end align-items-center gap-2 mb-3">

                    <a href="{{ route('ticket.export') }}" class="btn btn-success">
                        <i class="bx bx-export me-1"></i> Export Excel
                    </a>

                    <button id="bulkEditBtn" class="btn btn-primary">
                        <i class="bx bx-edit-alt me-1"></i> Edit Tickets
                    </button>

                </div>

            <div class="table-responsive">
                <table id="ticketTables" class="table table-bordered">
                    <thead>
                        <!-- GROUP HEADER -->
                        <tr>
                            <th rowspan="2"><input type="checkbox" id="selectAll" ></th>
                            <th rowspan="2">Actions</th>

                            <th colspan="11">
                                Default Section
                            </th>
                        </tr>

                        <!-- COLUMN HEADER -->
                        <tr>
                            <th>Parent Ticket</th>
                            <th>Ticket Type</th>
                            <th>Location</th>
                            <th>Asset</th>
                            <th>Assigned To</th>
                            <th>Ticket Group</th>
                            <th>Priority</th>
                            <th>Reported Date</th>
                            <th>Reported By</th>
                            <th>Description</th>
                            <th>Notify Reported By</th>
                        </tr>

                        <!-- FILTER -->
                        <!-- <tr>
                            @for ($i = 0; $i < 11; $i++)
                                <th>
                                    <input type="text" class="form-control form-control-sm">
                                </th>
                            @endfor
                        </tr> -->
                    </thead>

                    <tbody>
                        @foreach($ticket_data as $ticket)
                        <tr>
                            <td><input type="checkbox" class="rowCheckbox" value="{{ $ticket->id }}"></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    <!-- View -->
                                    <a href="{{ route('ticket.view', $ticket->id) }}" class="text-primary" title="View">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="text-warning" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <!-- Delete -->
                                    <button type="submit" class="btn p-0 border-0 text-danger"
                                        title="Delete" id="deleteTicketBtn" data-id ="{{$ticket->id}}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>{{ $ticket->ticketType->ticket_type ?? '-' }}</td>
                            <td>{{ $ticket->location->name ?? '-' }}</td>
                            <td>{{ $ticket->asset->asset_name ?? '-' }}</td>
                            <td>{{ $ticket->assigned_to ?? '-' }}</td>
                            <td>{{ $ticket->ticket_group ?? '-' }}</td>
                            <td>{{ $ticket->priority ?? '-' }}</td>
                            <td>{{ $ticket->reported_date ?? '-' }}</td>
                            <td>{{ $ticket->reported_by ?? '-' }}</td>
                            <td>{{ $ticket->description ?? '-' }}</td>
                            <td>{{ $ticket->notify_reported_by ? 'Yes' : 'No' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
<div class="modal fade" id="bulkEditModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Edit Tickets
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form id="bulkEditForm">
                    @csrf

                    <!-- RESPONSIVE TABLE WRAPPER -->
                    <div class="table-responsive">

                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light text-nowrap">
                                <tr>
                                    <th>Parent Ticket</th>
                                    <th>Ticket Type</th>
                                    <th>Location</th>
                                    <th>Asset</th>
                                    <th>Assigned To</th>
                                    <th>Ticket Group</th>
                                    <th>Customer Name</th>
                                    <th>Priority</th>
                                    <th>Reported Date</th>
                                    <th>Reported By</th>
                                    <th>Description</th>
                                    <th>Notify</th>
                                </tr>
                            </thead>

                            <tbody id="bulkEditTableBody">
                                <!-- Dynamic rows -->
                            </tbody>
                        </table>

                    </div>

                    <!-- FOOTER BUTTON -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bx bx-save me-1"></i> Update All
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

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
            $(document).on('click', '#deleteTicketBtn', function () {

                let id = $(this).data('id'); 

                if (!confirm('Are you sure you want to delete?')) {
                    showToast('Delete cancelled by user', 'warning');
                    return;
                }

                $.ajax({
                    url: "/destroy-ticket/" + id, 
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
                            }, 1000);
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
        
            var table = $('#ticketTables').DataTable({
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

            //  table structure code end

            $(document).on('click', '#bulkEditBtn', function () {

                let ids = [];

                $('.rowCheckbox:checked').each(function () {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    alert('Select at least one record');
                    return;
                }

                $.ajax({
                    url: '/ticket/multiple-records-fetch',
                    type: 'GET',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: ids
                    },
                    success: function (res) {

                        let html = '';

                        res.tickets.forEach(function (t) {

                            html += `
                            <tr>
                                <!-- Parent Ticket -->
                                <td>
                                    ${t.ticket_number}
                                    <input type="hidden" name="ids[]" value="${t.id}">
                                </td>

                                <!-- Ticket Type -->
                                <td>
                                    <select name="ticket_type_id[]" class="form-select">
                                        ${res.ticket_types.map(type => `
                                            <option value="${type.id}" ${t.ticket_type_id == type.id ? 'selected' : ''}>
                                                ${type.ticket_type}
                                            </option>
                                        `).join('')}
                                    </select>
                                </td>

                                <!-- Location -->
                                <td>
                                    <select name="location_id[]" class="form-select">
                                        ${res.locations.map(loc => `
                                            <option value="${loc.id}" ${t.location_id == loc.id ? 'selected' : ''}>
                                                ${loc.name}
                                            </option>
                                        `).join('')}
                                    </select>
                                </td>

                                <!-- Asset -->
                                <td>
                                    <select name="asset_id[]" class="form-select">
                                        ${res.asset.map(a => `
                                            <option value="${a.id}" ${t.asset_id == a.id ? 'selected' : ''}>
                                                ${a.asset_name}
                                            </option>
                                        `).join('')}
                                    </select>
                                </td>

                                <!-- Assigned To -->
                                <td>
                                    <input type="text" name="assigned_to[]" 
                                        class="form-control" 
                                        value="${t.assigned_to ?? ''}">
                                </td>

                                <!-- Ticket Group -->
                                <td>
                                    <input type="text" name="ticket_group[]" 
                                        class="form-control" 
                                        value="${t.ticket_group ?? ''}">
                                </td>

                                <!-- Customer Name -->
                                <td>
                                    <input type="text" name="customer_name[]" 
                                        class="form-control" 
                                        value="${t.customer_name ?? ''}">
                                </td>

                                <!-- Priority -->
                                <td>
                                    <select name="priority[]" class="form-select">
                                        <option value="low" ${t.priority=='low'?'selected':''}>Low</option>
                                        <option value="medium" ${t.priority=='medium'?'selected':''}>Medium</option>
                                        <option value="high" ${t.priority=='high'?'selected':''}>High</option>
                                    </select>
                                </td>

                                <!-- Reported Date -->
                                <td>
                                    <input type="date" name="reported_date[]" 
                                        class="form-control" 
                                        value="${t.reported_date ?? ''}">
                                </td>

                                <!-- Reported By -->
                                <td>
                                    <input type="text" name="reported_by[]" 
                                        class="form-control" 
                                        value="${t.reported_by ?? ''}">
                                </td>

                                <!-- Description -->
                                <td>
                                    <input type="text" name="description[]" 
                                        class="form-control" 
                                        value="${t.description ?? ''}">
                                </td>

                                <!-- Notify -->
                                <td class="text-center">
                                    <input type="checkbox" name="notify_reported_by[${t.id}]" value="1"
                                        ${t.notify_reported_by ? 'checked' : ''}>
                                </td>
                            </tr>
                            `;
                        });

                        $('#bulkEditTableBody').html(html);
                        $('#bulkEditModal').modal('show');
                    }
                });

            });


            $('#bulkEditForm').validate({
                submitHandler: function (form) {

                    let formData = new FormData(form);

                    // ✅ DEBUG (check IDs coming or not)
                    // console.log(formData.getAll('ids[]'));

                    let btn = $('#bulkEditForm button[type="submit"]');

                    $.ajax({
                        url: '/ticket/multiple-records-update',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend: function () {
                            btn.prop('disabled', true);
                            btn.html(`<span class="spinner-border spinner-border-sm me-2"></span> Updating...`);
                        },

                        success: function (res) {
                            if (res.status) {
                                showToast(res.message, 'success');
                                location.reload();
                            } else {
                                showToast(res.message, 'error');
                            }
                        },

                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function (field, messages) {
                                    showToast(messages[0], 'error');
                                });
                            } else {
                                showToast(xhr.responseJSON?.message || 'Something went wrong!', 'error');
                            }
                        },

                        complete: function () {
                            btn.prop('disabled', false);
                            btn.html('Update Records');
                        }
                    });
                }
            });
        
        });
</script>
@endsection
