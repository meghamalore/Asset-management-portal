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
        <h4 class="fw-bold mb-0">List of Locations</h4>
    </div>
    <div class="card">
            <div class="card-body">
                <!-- TOGGLES -->
                {{-- <div class="mb-3 d-flex gap-2">

                    <!-- Default Section Toggle -->
                    <button id="defaultToggle" class="btn btn-primary btn-sm collapsed">
                        <i class="bx bx-chevron-right toggle-icon-default"></i>
                        Default Section
                    </button>

                    <!-- Financial Section Toggle -->
                    <!-- <button id="financialToggle" class="btn btn-warning btn-sm collapsed">
                        <i class="bx bx-chevron-right toggle-icon-financial"></i>
                        Financial Section
                    </button> -->

                </div> --}}


                <div class="table-responsive">

                    <table id="categoriesTable" class="table table-bordered">

                        <thead>

                            <!-- GROUP HEADER -->
                            <tr>

                                <th rowspan="2" class="action-column">Actions</th>

                                <!-- DEFAULT -->
                                <th colspan="7" class="text-center">

                                    <div class="d-flex justify-content-start align-items-center gap-2">

                                        <span>Default Section</span>

                                        <button type="button" id="defaultToggle"
                                            class="btn btn-sm p-0 border-0 bg-transparent">

                                            <i class="bx bx-chevron-left toggle-icon-default fs-5"></i>

                                        </button>

                                    </div>

                                </th>

                            </tr>

                            <!-- COLUMN HEADER -->
                            <tr>

                                <!-- DEFAULT SECTION -->
                                <th class="default-col">Location Name</th>
                                <th class="default-col">Sub Location Name</th>
                                <th class="default-col">Location Code</th>
                                <th class="default-col">Description</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($locations as $location)
                                <tr>
                                    <td class="text-center action-column">
                                        <div class="d-flex justify-content-center align-items-center gap-2">

                                            <!-- View -->
                                            <a href="{{ route('location.view', $location->id) }}" class="text-primary" title="View">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('location.edit', $location->id) }}" class="text-warning" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <!-- Delete -->
                                            <button type="submit" class="btn p-0 border-0 text-danger"
                                                title="Delete" id="deleteLocationBtn" data-id="{{ $location->id }}">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="default-col">
                                        {{ $location->name ?? '-' }}
                                    </td>
                                    <td class="default-col">
                                        @if($location->subLocation && $location->subLocation->count())
                                            {{ $location->subLocation->pluck('name')->implode(', ') }}
                                        @else
                                            <span class="text-muted">No Sub Locations</span>
                                        @endif
                                    </td>
                                    <td class="default-col">
                                        {{ $location->location_code ?? '-' }}
                                    </td>
                                    <td class="default-col">
                                        {{ $location->description ?? '-' }}
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
            
            // Row delete code
            $(document).on('click', '#deleteLocationBtn', function () {

                let id = $(this).data('id'); 

                if (!confirm('Are you sure you want to delete?')) {
                    showToast('Delete cancelled by user', 'warning');
                    return;
                }

                $.ajax({
                    url: "/destroy-location/" + id, 
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: "DELETE"
                    },

                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');
                            setTimeout(function () {
                                window.location.reload();
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
        
            var table = $('#conditionstatusTable').DataTable({
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

