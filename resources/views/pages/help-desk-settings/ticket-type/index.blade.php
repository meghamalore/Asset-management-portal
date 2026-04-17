@extends('layouts.master')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Ticket Type</h4>
        <button type="button" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add
        </button>
    </div>
    <div class="card">
        <div class="card-body"> 
            <div class="table-responsive">
                <table id="ticketTypeTable" class="table table-bordered">
                    <thead>
                        <!-- GROUP HEADER -->
                        <tr>
                            {{-- <th rowspan="3"><input type="checkbox" id="selectAll"></th> --}}
                            <th rowspan="3">Actions</th>

                            <th colspan="13" id="defaultToggle">
                                Default Section
                                <i class='bx bx-chevron-right toggle-icon'></i>
                            </th>
                        </tr>

                        <!-- COLUMN HEADER -->
                        <tr>
                            <!-- These 13 + 2 rowspan = 15 total -->
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
                        <tr>
                            @for ($i = 0; $i < 11; $i++)
                                <th>
                                    <input type="text">
                                </th>
                            @endfor
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            {{-- <td><input type="checkbox"></td> --}}
                            <td>Actions</td>

                            <!-- 13 columns -->
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>HO</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>2025-01-02</td>
                            <td></td>
                            <td>2025-01-03</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('section-js')
<script>
        $(document).ready(function() {
        
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
        
        });
    </script>
@endsection