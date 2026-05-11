@extends('layouts.master')
@section('section-css')
    <style>
        #toastContainer {
            z-index: 9999 !important;
        }
        #categoriesTable .action-column {
            width: 120px !important;
            min-width: 120px !important;
            max-width: 120px !important;
            white-space: nowrap;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">List of category Status</h4>
        <button type="button" class="btn btn-primary btn-sm">
            <a href="{{ route('add.category.status') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus"></i> Add
            </a>
        </button>
    </div> --}}
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
                    <button id="financialToggle" class="btn btn-warning btn-sm collapsed">
                        <i class="bx bx-chevron-right toggle-icon-financial"></i>
                        Financial Section
                    </button>

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

                                <!-- FINANCIAL -->
                                <th colspan="6" class="text-center">

                                    <div class="d-flex justify-content-start align-items-center gap-2">

                                        <span>Financial Section</span>

                                        <button type="button" id="financialToggle"
                                            class="btn btn-sm p-0 border-0 bg-transparent">

                                            <i class="bx bx-chevron-left toggle-icon-financial fs-5"></i>

                                        </button>

                                    </div>

                                </th>

                            </tr>

                            <!-- COLUMN HEADER -->
                            <tr>

                                <!-- DEFAULT SECTION -->
                                <th class="default-col">Parent Category</th>
                                <th class="default-col">Show Category</th>
                                <th class="default-col">Sub Category Name</th>
                                <th class="default-col">Category-wise Assets</th>
                                <th class="default-col">Category Code</th>
                                <th class="default-col">Default Transfer Duration</th>
                                <th class="default-col">Cascade</th>

                                <!-- FINANCIAL SECTION -->
                                <th class="financial-col">End Of Life</th>
                                <th class="financial-col">Depreciation %</th>
                                <th class="financial-col">Scrap Value</th>
                                <th class="financial-col">Created By</th>
                                <th class="financial-col">Income Tax Depreciation %</th>
                                <th class="financial-col">Created Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($categories as $category)
                                <tr>

                                    <td class="text-center action-column">
                                        <div class="d-flex justify-content-center align-items-center gap-2">

                                            <!-- View -->
                                            <a href="#" class="text-primary" title="View">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('categories.edit', $category->id) }}" class="text-warning" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <!-- Delete -->
                                            <button type="submit" class="btn p-0 border-0 text-danger"
                                                title="Delete" id="deletecategoryBtn" data-id ="{{ $category->id }}">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- DEFAULT SECTION -->
                                    <td class="default-col">
                                        {{ $category->name ?? '-' }}
                                    </td>

                                    <td class="default-col">
                                        {{ $category->is_inventory == 1 ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="default-col">
                                        @foreach($category->subCategories as $subCategory)
                                            {{ $subCategory->name }}
                                        @endforeach
                                    </td>
                                    <td class="default-col">
                                        {{ $category->is_asset_link == 1 ? 'Yes' : 'No' }}
                                    </td>

                                    <td class="default-col">
                                        {{ $category->category_code ?? '-' }}
                                    </td>

                                    <td class="default-col">
                                        {{ $category->trafs_duration ?? '-' }}
                                    </td>

                                    <td class="default-col">
                                        {{ $category->cascade ?? '-' }}
                                    </td>

                                    <!-- FINANCIAL SECTION -->
                                    <td class="financial-col">
                                        {{ $category->end_of_life ?? '-' }}
                                    </td>

                                    <td class="financial-col">
                                        {{ $category->depreciation_percentage ?? '-' }}
                                    </td>

                                    <td class="financial-col">
                                        {{ $category->scrap_value ?? '-' }}
                                    </td>

                                    <td class="financial-col">
                                        {{ $category->created_by ?? '-' }}
                                    </td>

                                    <td class="financial-col">
                                        {{ $category->income_tax_depreciation_percentage ?? '-' }}
                                    </td>

                                    <td class="financial-col">
                                        {{ $category->created_at ? $category->created_at->format('Y-m-d') : '-' }}
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
                toastElement.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            // Row delete code
            $(document).on('click', '#deletecategoryBtn', function() {

                let id = $(this).data('id');

                if (!confirm('Are you sure you want to delete?')) {
                    showToast('Delete cancelled by user', 'warning');
                    return;
                }

                $.ajax({
                    url: "/destroy-category-status/" + id,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: "DELETE"
                    },

                    success: function(response) {

                        if (response.status) {
                            showToast(response.message, 'success');

                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    error: function(xhr) {
                        console.log(xhr);
                        showToast(xhr.responseJSON?.message || 'Delete failed!', 'error');
                    }
                });

            });

            // DEFAULT SECTION
            // keep first column visible, hide remaining columns

            var table = $('#categoriesTable').DataTable({
                orderCellsTop: true,
                autoWidth: false,
                scrollX: true,
                columnDefs: [
                    {
                        targets: 0,
                        width: "120px"
                    }
                ]
            });


            // ONLY actual columns
            let defaultCols = table.columns('.default-col').indexes().toArray();
            let financialCols = table.columns('.financial-col').indexes().toArray();

            // keep first column visible
            let defaultHideCols = defaultCols.slice(1);
            let financialHideCols = financialCols.slice(1);

            $('#defaultToggle').on('click', function() {

                let isVisible = table.column(defaultHideCols[0]).visible();

                // hide/show remaining columns
                table.columns(defaultHideCols).visible(!isVisible, false);

                table.columns.adjust().draw(false);

                $('.toggle-icon-default')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);

            });

            $('#financialToggle').on('click', function() {

                let isVisible = table.column(financialHideCols[0]).visible();

                // hide/show remaining columns
                table.columns(financialHideCols).visible(!isVisible, false);

                table.columns.adjust().draw(false);

                $('.toggle-icon-financial')
                    .toggleClass('bx-chevron-right', !isVisible)
                    .toggleClass('bx-chevron-left', isVisible);

            });

        });
    </script>
@endsection
