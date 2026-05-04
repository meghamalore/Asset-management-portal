@extends('layouts.master')
@section('section-css')
    <style>
        .app-brand-logo {
            background-color: #000;
            padding: 8px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        
        .sorting {
            width: 13px !important;
        }
    
        th.collapsed {
            background: #dfe6ee;
            color: #555;
            font-weight: 500;
            opacity: 0.8;
        }
        #toastContainer {
            z-index: 9999 !important;
        }
        
        
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Asset List</h4>
        <!-- Basic Bootstrap Table -->
        <!-- Bordered Table -->
        <div class="card">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h5 class="card-header">Assets List</h5>
                </div>
                <div class="col-sm-3 my-auto">
                    <select id="viewSelect" class="form-select">
                        <option value="">Select Option</option>
                        @foreach($views as $view)
                            <option value="{{ $view->id }}">{{ $view->view_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 my-auto">
                    <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal"
                        data-bs-target="#exLargeModaldefaultview">
                        <span class="tf-icons bx bx-plus"></span>
                    </button>
                    <button type="button" id="deleteViewBtn" class="btn btn-icon btn-danger">
                        <span class="tf-icons bx bx-trash"></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <div class="demo-inline-spacing">
                        {{-- <button type="button" class="btn btn-icon btn-dark" data-bs-toggle="modal"
                            data-bs-target="#exLargeModalAddWidget">
                            <span class="tf-icons bx bx-bar-chart-alt-2"></span>
                        </button> --}}
                        <a href="{{ route('assets.export') }}" class="btn btn-icon btn-info">
                            <span class="tf-icons bx bx-download"></span>
                        </a>
                        <button type="button" id="refreshTableBtn" class="btn btn-icon refreshTableBtn btn-primary">
                            <span class="tf-icons bx bx-refresh"></span>
                        </button>
                        {{-- <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-grid-alt"></span>
                        </button> --}}
                    </div>
                </div>
            </div>
            <div class="row mb-3 mx-auto">
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#exLargeModalAddGenerateSticker">
                        <span class="tf-icons bx bx-barcode"></span>&nbsp; Generated Stickers
                    </button>
                </div> 
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary"  id="assetTrasfBtn">
                        <span class="tf-icons bx bx-transfer-alt"></span>&nbsp; Asset Transfer
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" id="disposeBtn" class="btn btn-outline-primary">
                        <span class="tf-icons bx bx-trash"></span>&nbsp; Discard or Sell
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" id="updateBtn" class="btn btn-outline-primary">
                        <span class="tf-icons bx bx-edit"></span>&nbsp; Update Asset
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" id="scheduleActivityBtn" class="btn btn-outline-primary" >
                        <span class="tf-icons bx bx-calendar"></span>&nbsp; Schedule Activity
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="assetTable" class="table table-bordered">

                        <thead>
                            <!-- GROUP HEADER -->
                            <tr>
                                <th rowspan="3"><input type="checkbox" id="selectAll"></th>
                                <th rowspan="3">Actions</th>

                                <th colspan="14" id="defaultToggle">
                                    Default Section
                                    <i class='bx bx-chevron-right toggle-icon'></i>
                                </th>

                                <th colspan="6" id="additionalToggle">
                                    Additional Section
                                    <i class='bx bx-chevron-right toggle-icon-add'></i>
                                </th>

                                <th colspan="8" id="purchaseToggle">
                                    Purchase Section
                                    <i class='bx bx-chevron-right toggle-icon-purchase'></i>
                                </th>

                                <th colspan="7" id="financialToggle">
                                    Financial Section
                                    <i class='bx bx-chevron-right toggle-icon-financial'></i>
                                </th>

                                <th colspan="4" id="allottedToggle">
                                    Allotted Information
                                    <i class='bx bx-chevron-right toggle-icon-allotted'></i>
                                </th>

                                <th colspan="5" id="warrantyToggle">
                                    Warranty Information
                                    <i class='bx bx-chevron-right toggle-icon-warranty'></i>
                                </th>

                            </tr>

                            <!-- COLUMN HEADER -->
                            <tr>
                                <th data-column="1">Asset Name</th>

                                <th data-column="2" class="default-extra">Image</th>
                                <th data-column="3" class="default-extra">Code</th>
                                <th data-column="4" class="default-extra">Category</th>
                                <th data-column="5" class="default-extra">Created</th>
                                <th data-column="6" class="default-extra">Location</th>
                                <th data-column="7" class="default-extra">Created By</th>
                                <th data-column="8" class="default-extra">Status</th>
                                <th data-column="9" class="default-extra">Scan Date</th>
                                <th data-column="10" class="default-extra">Scan By</th>
                                <th data-column="11" class="default-extra">Modified</th>
                                <th data-column="12" class="default-extra">Modified By</th>
                                <th data-column="13" class="default-extra">Parent</th>

                                <th data-column="14" class="additional-extra">Brand</th>
                                <th data-column="15" class="additional-extra">Model</th>
                                <th data-column="16" class="additional-extra">Linked Asset</th>
                                <th data-column="17" class="additional-extra">Description</th>
                                <th data-column="18" class="additional-extra">Serial No</th>
                                <th data-column="19" class="additional-extra">Upload Files</th>

                                <th data-column="20" class="purchase-extra">Vendor Name</th>
                                <th data-column="21" class="purchase-extra">PO Number</th>
                                <th data-column="22" class="purchase-extra">Invoice Date</th>
                                <th data-column="23" class="purchase-extra">Invoice No</th>
                                <th data-column="24" class="purchase-extra">Purchase Date</th>
                                <th data-column="25" class="purchase-extra">Purchase Price</th>
                                <th data-column="26" class="purchase-extra">Self Owned / Partner</th>
                                <th data-column="27" class="purchase-extra">Partner</th>

                                <th data-column="28" class="financial-extra">Capitalization Price</th>
                                <th data-column="29" class="financial-extra">End of Life</th>
                                <th data-column="30" class="financial-extra">Capitalization Date</th>
                                <th data-column="31" class="financial-extra">Depreciation %</th>
                                <th data-column="32" class="financial-extra">Accumulated Depreciation</th>
                                <th data-column="33" class="financial-extra">Scrap Value</th>
                                <th data-column="34" class="financial-extra">Income Tax Dep%</th>



                                <th data-column="35" class="allotted-extra">Department</th>
                                <th data-column="36" class="allotted-extra">Transferred To</th>
                                <th data-column="37" class="allotted-extra">Allotted Upto</th>
                                <th data-column="38" class="allotted-extra">Remarks</th>

                                <th data-column="39" class="warranty-extra">AMC Vendor</th>
                                <th data-column="40" class="warranty-extra">Warranty Vendor</th>
                                <th data-column="41" class="warranty-extra">Insurance Start Date</th>
                                <th data-column="42" class="warranty-extra">Insurance End Date</th>
                                <th data-column="43" class="warranty-extra">AMC Start Date</th>

                                <th>Condition</th>
                                <th>Model</th>
                            </tr>

                            <!-- FILTER -->
                            <tr>
                                @for ($i = 0; $i < 45; $i++) <th>
                                    <div class="filter-box">
                                        <input type="text">
                                        <i class='bx bx-filter filter-icon'></i>
                                    </div>
                                    </th>
                                @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($asset_data as $asset_datas)
                            <tr data-asset-id="{{ $asset_datas->id }}" data-asset-name="{{ $asset_datas->asset_name}}" data-asset-code="{{ $asset_datas->asset_code}}"  data-location-id="{{ $asset_datas->location->id ?? '' }}" data-asset-pur-price="{{ $asset_datas->purchaseInfo->purchase_price}}">

                                <td>
                                    <input type="checkbox" class="asset-checkbox" value="{{ $asset_datas->id }}">
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('assets.view', $asset_datas->id) }}" class="text-primary"><i class="bx bx-show" class="text-primary"></i></a>   
                                </td>

                                <td data-column="1">{{ $asset_datas->asset_name}}</td>

                                <!-- Default -->
                                <td class="default-extra" data-column="2">
                                    <img src="{{ asset('storage/' . $asset_datas->asset_image) }}"  height="50" width="50" alt="Asset Image">
                                </td>
                                <td data-column="3" class="default-extra">{{ $asset_datas->asset_code}}</td>
                                <td data-column="4" class="default-extra">{{ $asset_datas->category->name}}</td>
                                <td data-column="5" class="default-extra">{{ $asset_datas->created_at}}</td>
                                <td data-column="6" class="default-extra">HO</td>
                                <td data-column="7" class="default-extra">Admin</td>
                                <td data-column="8" class="default-extra">Active</td>
                                <td data-column="9" class="default-extra">2025-01-02</td>
                                <td data-column="10" class="default-extra">{{ $asset_datas->location->name ?? ''}}</td>
                                <td data-column="11" class="default-extra">2025-01-03</td>
                                <td data-column="12" class="default-extra">User</td>
                                <td data-column="13" class="default-extra">{{ $asset_datas->brand}}</td>

                                <!-- Additional -->
                                <td data-column="14" class="additional-extra">{{ $asset_datas->additionalInfo->brand}}</td>
                                <td data-column="15" class="additional-extra">{{ $asset_datas->additionalInfo->model}}</td>
                                <td data-column="16" class="additional-extra">Linked Asset</td>
                                <td data-column="17" class="additional-extra">{{ $asset_datas->additionalInfo->description}}</td>
                                <td data-column="18" class="additional-extra">{{ $asset_datas->additionalInfo->serial_no}}</td>
                                <td data-column="19" class="additional-extra">Upload Files</td>

                                <!-- Purchase -->
                                <td data-column="20" class="purchase-extra">-</td>
                                <td data-column="21" class="purchase-extra">{{ $asset_datas->purchaseInfo->asset_po_number}}</td>
                                <td data-column="22" class="purchase-extra">{{ $asset_datas->purchaseInfo->invoice_date}}</td>
                                <td data-column="23" class="purchase-extra">{{ $asset_datas->purchaseInfo->invoice_no}}</td>
                                <td data-column="24" class="purchase-extra">{{ $asset_datas->purchaseInfo->purchase_date}}</td>
                                <td data-column="25" class="purchase-extra">{{ $asset_datas->purchaseInfo->purchase_price}}</td>
                                <td data-column="26" class="purchase-extra">
                                    <select>
                                        <option>None</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </td>
                                <td data-column="27" class="purchase-extra">Partner</td>


                                {{-- //financial data --}}
                                <td data-column="28" class="financial-extra">{{ $asset_datas->finacialInfos->capitalization_price}}</td>
                                <td data-column="29" class="financial-extra">{{ $asset_datas->finacialInfos->end_of_life}}</td>
                                <td data-column="30" class="financial-extra">{{ $asset_datas->finacialInfos->capitalization_date}}</td>
                                <td data-column="31" class="financial-extra">{{ $asset_datas->finacialInfos->depreciation_percent}}</td>
                                <td data-column="32" class="financial-extra">{{ $asset_datas->finacialInfos->accumulated_depreciation}}</td>
                                <td data-column="33" class="financial-extra">{{ $asset_datas->finacialInfos->scrap_value}}</td>
                                <td data-column="34" class="financial-extra">{{ $asset_datas->finacialInfos->income_tax_depreciation_percent}}</td>

                                {{-- //allotted data --}}
                                <td data-column="35" class="allotted-extra">{{ $asset_datas->assetallotedInfos->department ?? ''}}</td>
                                <td data-column="36" class="allotted-extra">{{ $asset_datas->assetallotedInfos->transferred_to ?? ''}}</td>
                                <td data-column="37" class="allotted-extra">{{ $asset_datas->assetallotedInfos->allotted_upto ?? ''}}</td>
                                <td data-column="38" class="allotted-extra">{{ $asset_datas->assetallotedInfos->remark ?? ''}}t</td>

                                {{--  // warranty data --}}
                                <td data-column="39" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->amc_vendor ?? ''}}</td>
                                <td data-column="40" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->warranty_vendor  ?? ''}}</td>
                                <td data-column="41" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->insurance_start_date ?? ''}}</td>
                                <td data-column="42" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->insurance_start_end ?? ''}}</td>
                                <td data-column="43" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->amc_start_date ?? ''}}</td>

                                <!-- Existing -->
                                <td>Good</td>
                                <td>Dell</td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
        <!--/ Basic Bootstrap Table -->
    </div>

    <!-- Extra Large Defult view Modal -->
    <div class="modal fade" id="exLargeModaldefaultview" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="viewForm">
                <div class="modal-content">
                        <div class="modal-header position-relative">
                        <div class="w-100 text-center">
                            <h5 class="modal-title mb-1" id="exampleModalLabel4">Custom View</h5>
                            <small class="text-muted">
                                Create a view with filters, sorting, and selected columns
                            </small>
                        </div>
                        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label" >View Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="view_name" class="form-control force-validate" 
                                        placeholder="" />
                                </div>
                                <label class="col-sm-2 col-form-label" >Columns</label>
                                <div class="col-sm-4">    
                                    <select id="link" class="select3 form-select force-validate" data-placeholder="Select Columns"  name="columns[]" multiple>
                                        <!-- <option value="">Select Views</option> -->
                                        @foreach ($column_master as $column_masters)
                                        <option value="{{$column_masters->id }}">{{$column_masters->column_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Set as a default view?</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch">
                                        yes<input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="is_default" value="1"/>  
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label" >Private View</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch">
                                        yes<input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="is_private" value="1"/>  
                                    </div>
                                </div>
                                 <label class="col-sm-2 col-form-label" >Role Name</label>
                                <div class="col-sm-4">
                                    <select class="form-select multiselect force-validate">
                                        <option value="">Select Option</option>
                                        <option value="1">Owner</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Extra Large Widget Modal -->
    <div class="modal fade" id="exLargeModalAddWidget" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Add Widget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3 text-center">
                        Create a custom report, chart, or number & percentage widgets here. 
                        The charts and widgets created here will be shown in the dashboards. 
                        Edit a dashboard and add the widget to include it. 
                        Custom reports are available under the Reports menu → "Custom Reports".
                    </p>
                    <div class="row mb-3">
                        <div class="col mb-3">
                            <label for="nameExLarge" class="form-label">Widget Title</label>
                            <input type="text" id="nameExLarge" class="form-control" placeholder="Enter Name" />
                        </div>
                        <div class="col">
                            <label for="emailExLarge" class="form-label">Widget Description</label>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="emailExLarge" class="form-label">Widget Type</label>
                                <select id="country" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                </select>
                        </div>
                        <div class="col mb-3">
                            <label for="emailExLarge" class="form-label">Role</label>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra Small Widget Modal -->
    <div class="modal fade" id="exLargeModalAddGenerateSticker" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Select a template</h5>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <div class="form-check mt-3">
                            <input name="default-radio-1" class="form-check-input"type="radio" value="" id="defaultRadio1" />
                            <label class="form-check-label" for="defaultRadio1"> Standard QR Code </label>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="form-check mt-3">
                            <input name="default-radio-1" class="form-check-input"type="radio" value="" id="defaultRadio1" />
                            <label class="form-check-label" for="defaultRadio1"> Standard  Barcode </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Extra Large Asset Transfer Modal -->
    <div class="modal fade" id="exLargeModalAssetTraf" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Asset Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="assetTransferForm">
                    @csrf
                    <div class="modal-body">
                        <!-- Responsive Table -->
                        <div class="card">
                            <h6 class="card-header">Selected Assets</h6>
                            <div class="table-responsive text-nowrap mb-3">
                                <table class="table table-bordered transfer-table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Asset Code</th>
                                            <th>Asset Name</th>
                                            <th>Department</th>
                                            <th>Condition</th>
                                            <th>Current Owner</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Linked Asset</th>
                                            <th>Daily Cost of Equipment</th>
                                            <th>Total Cost NBV</th>
                                            <th>Total Cost Ticket</th>
                                            <th>Total Cost Activity</th>
                                            <th>Capitalization Price</th>
                                            <th>New Location</th>
                                        </tr>
                                    </thead>
                                    <tbody id="transferAssetsBody">
                                        <!-- Dynamic rows will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">New Location</label>
                                <div class="col-sm-4">
                                    <select id="globalLocation" class="form-select global-location">
                                        <option value="">Select Location</option>
                                        @foreach($location as $loc)
                                        <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Transfer Status</label>
                                <div class="col-sm-4">
                                    <select id="globalTransferStatus" class="form-select global-transfer-status">
                                        <option value="">Select Status</option>
                                        <option value="1">In Use</option>
                                        <option value="2">In Stock</option>
                                        <option value="3">Out for Repair</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Allotted Upto</label>
                                <div class="col-sm-4">
                                    <input id="globalAllotedUpto" class="form-control" type="date" />
                                </div>
                            </div>

                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Transfer To</label>
                                <div class="col-sm-4">
                                    <select id="globalTransferTo" class="form-select global-transfer-to">
                                        <option value="">Select User</option>
                                        <option value="James Smith">James Smith</option>
                                        <option value="Jennifer Miller">Jennifer Miller</option>
                                        <option value="Robert Johnson">Robert Johnson</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Transfer CC</label>
                                <div class="col-sm-4">
                                    <select class="form-select" name="transfer_cc">
                                        <option value="">Select</option>
                                        <option value="admin@example.com">Admin</option>
                                        <option value="manager@example.com">Manager</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Remark</label>
                                <div class="col-sm-4">
                                    <input type="text" id="globalRemark" class="form-control global-remark"
                                        placeholder="Enter Remark" />
                                </div>
                            </div>
                            {{-- <div class="row mb-3 mx-2 align-items-center">
                                <label class="col-sm-2 col-form-label">Upload Files</label>
                                <div class="col-sm-4">
                                    <label class="btn btn-sm btn-primary mb-0">
                                        <i class="bx bx-upload me-1"></i> Upload Files
                                        <input type="file" id="fileUpload" name="files[]" multiple hidden>
                                    </label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>

    <!-- Extra Large Asset Disposal Modal -->
    <div class="modal fade" id="exLargeModalAssetDisposal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Asset Disposal Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="assetDispoForm">
                    @csrf
                    <div class="modal-body">
                        <div id="assetSections"></div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Reason</label>
                            <div class="col-sm-4">
                                    <select id="country" name="reason" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="lost">Lost</option>
                                        <option value="stolen">Stolen</option>
                                        <option value="write_off">Write-off</option> 
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Discard Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="date"
                                    placeholder="" value="{{ date('Y-m-d') }}" />
                            </div>
                            <label class="col-sm-2 col-form-label" >Vendor Name</label>
                            <div class="col-sm-4">
                                    <select id="country" name="vendor_name" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="acme">Acme Inc (S00081)</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Remarks</label>
                            <div class="col-sm-4">
                                <input type="text" name="remark" class="form-control"  />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Tax Group</label>
                            <div class="col-sm-4">
                                    <select name="tax_group" class="select2 form-select">
                                        <option value="18">Gst 18%</option>
                                    </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Upload Files</label>
                            <div class="col-sm-4">
                                        <label class="btn btn-sm btn-primary mb-0">
                                            <i class="bx bx-upload me-1"></i> Upload Files
                                            <input type="file" id="fileUpload" name="files[]" multiple hidden>
                                        </label>
                                        <!-- Loader shown during file processing -->
                                        <div id="fileLoader" class="mt-2 d-none">
                                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <span class="ms-2 text-muted small">Uploading...</span>
                                        </div>
                                        <!-- Container for multiple uploaded filenames -->
                                        <div id="fileList" class="mt-2"></div>
                                        <input type="hidden" id="uploadedFilesData" name="uploaded_files">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Extra Large Schedule Activity -->
    <div class="modal fade" id="exLargeModalScheduleActivity" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Schedule Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="scheduleActivityForm">
                    
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Asset</label>
                                <div class="col-sm-4">
                                    <select id="link_asset_schedule" class="select2 form-select" name="link_asset[]" multiple>
                                        @foreach($asset_list as $asset_lists)
                                        <option value="{{ $asset_lists->id }}">{{ $asset_lists->asset_name
                                            }}({{$asset_lists->asset_code}})</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text">The selected assets will be linked to this asset. The selected
                                        assets are the child assets and this will be the parent asset</small>
                                </div>
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-4">
                                    <input type="text" name="location" class="form-control force-validate" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Activity Type</label>
                                <div class="col-sm-4">
                                    <select class="form-select force-validate multiselect" name="activity_type">
                                        <option value="">Select Option</option>
                                        <option value="calibration">Calibration</option>
                                        <option value="inspection">Inspection</option>
                                        <option value="warranty_expiry">Warranty Expiry</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-4">
                                    <input type="text" name="description" class="form-control force-validate" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Asset Category</label>
                                <div class="col-sm-4">
                                    <input type="text" name="categoty" class="form-control force-validate" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">User group</label>
                                <div class="col-sm-4">
                                    <select id="country" class="select2 form-select force-validate" name="user_group">
                                        <option value="">Select</option>
                                        <option value="maintenance_group">Maintenance Group</option>
                                        <option value="it_helpdesk">IT Helpdesk</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Assigned To</label>
                                <div class="col-sm-4">
                                    <select id="country" name="assigned_to" class="select2 form-select force-validate">
                                        <option value="">Select</option>
                                        <option value="1">dust (dust@dustvalue.com)</option>
                                        <option value="2">James Smith (james.smith@test.com)</option>
                                        <option value="3">Jennifer Miller (jennifer.miller@test.com)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Occurs</label>
                                <div class="col-sm-4">
                                    <select id="country" name="occurs" class="select2 form-select force-validate">
                                        <option value="">Select</option>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="one_time">One Time</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Start Date</label>
                                {{-- <small>First activity's due date will be the start date of the schedule</small> --}}
                                <div class="col-sm-4">
                                    <input type="date" class="form-control force-validate" name="start_date" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Activity Reminders</label>
                                <div class="col-sm-4">
                                    <select id="country" name="activity_remiders" class="select2 form-select force-validate">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">End Date</label>
                                {{-- <small>First activity's due date will be the start date of the schedule</small> --}}
                                <div class="col-sm-4">
                                    <input type="date" name="end_date" class="form-control force-validate" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Email Based On</label>
                                <div class="col-sm-4">
                                    <select id="country" name="email_based_on" class="select2 form-select force-validate">
                                        <option value="">Select</option>
                                        <option value="user_involved">User Involved</option>
                                        <option value="user">User(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Grace/Execution Period Before</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control force-validate" name="grace_before" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">Grace/Execution Period After</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control force-validate" name="grace_after" placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label">CC</label>
                                <div class="col-sm-4">
                                    <select id="country" class="select2 form-select force-validate" name="cc">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="accordion mt-3" id="accordionActivityDetails">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#accordionFour" aria-expanded="true" aria-controls="accordionFour">
                                            Activity Details
                                        </button>
                                    </h2>
                                    <div id="accordionFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionActivityDetails">
                                        <div class="accordion-body">
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Vendor Name </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control force-validate" name="vendor_name" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Amount</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="full_name_icon">
                                                            <i class="bx bx-rupee"></i>
                                                        </span>
                                                        <input type="text" name="amount" class="form-control force-validate" id="full_name"
                                                            aria-label="Full Name" aria-describedby="full_name_icon" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Extra Large Update Asset -->
    <div class="modal fade" id="exLargeModalUpdateAsset" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Update Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateAssetForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="asset_id" name="asset_id">
                        <div class="row">
                            <div class="col-md mb-4 mb-md-0">
                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                                Asset Details
                                            </button>
                                        </h2>
                                        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" >Asset Name</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" 
                                                                placeholder="" name="asset_name" id="asset_name"/>
                                                        </div>
                                                        <label class="col-sm-2 col-form-label" >Asset Image</label>
                                                        <div class="col-sm-4">
                                                            <input class="form-control" type="file" name="image" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Asset
                                                            Code</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="asset_code" name="asset_code"/>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Category <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="form-select" id="category_id" name="categ_id">
                                                                <option value="">Select</option>
                                                                @foreach ($categories as $categ)
                                                                <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- <div class="col-sm-4">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#exLargeModalCategory">
                                                                &#43;
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Sub Category <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="form-select"  name="sub_category_id" id="sub_category_id">
                                                                <option value="">Select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" >Location <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select id="location_id" name="location" class="form-select">
                                                                <option value="">Select</option>
                                                                @foreach ($location as $locations)
                                                                <option value="{{ $locations->id }}">{{ $locations->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- <div class="col-sm-4">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#exLargeModalLocation">
                                                                &#43;
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Sub Location <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="form-select"  name="sub_location_id" id="sub_location_id">
                                                                <option value="">Select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" >Status <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select id="status_id" name="status" class=" form-select">
                                                                <option value="">Select Status</option>
                                                                @foreach ($status as $statuses)
                                                                <option value="{{ $statuses->id }}">{{ $statuses->status_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- <div class="col-sm-4">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#exLargeModalStatus">
                                                                &#43;
                                                            </button>
                                                        </div> --}}
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" >CWIP Invoice Id</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" 
                                                                placeholder="" name="cwip_invoice_id" id="cwip_invoice_id"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
                                                Additional Information
                                            </button>
                                        </h2>
                                        <div id="accordionTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Condition</label>
                                                    <div class="col-sm-4">
                                                        <select id="condition" name="condition" class=" form-select force-validate">
                                                            <option value="">Select</option>
                                                            <option value="damaged">Damaged</option>
                                                            <option value="good">Good</option>
                                                            <option value="poor">Poor</option>
                                                            <option value="new">New</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Brand</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="brand" id="brand" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Model</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="model" id="model" />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Link Asset</label>
                                                    <div class="col-sm-4">
                                                        <select id="link_asset" class="select2 form-select" name="link_asset[]" multiple>
                                                            <option></option>
                                                            @foreach($asset_list as $asset_lists)
                                                                <option value="{{ $asset_lists->id }}">
                                                                    {{ $asset_lists->asset_name }} ({{ $asset_lists->asset_code }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small class="form-text">The selected assets will be linked to this asset. The selected assets are the child assets and this will be the parent asset</small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Description</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="description" id="description"/>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Serial No</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="serial_no" id="serial_no" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                             <label class="col-sm-2 col-form-label">Upload Files</label>
                                            <small class="form-text">Additional Documents (For Insurance / Maintenance / Replacements, etc.)</small>
                                            <div class="col-sm-4">
                                                <label class="btn btn-sm btn-primary mb-0">
                                                    <i class="bx bx-upload me-1"></i> Upload Files
                                                    <input type="file" id="fileUpload" name="files[]" multiple hidden>
                                                </label>
                                                <!-- Loader shown during file processing -->
                                                <div id="fileLoader" class="mt-2 d-none">
                                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <span class="ms-2 text-muted small">Uploading...</span>
                                                </div>
                                                <!-- Container for multiple uploaded filenames -->
                                                <div id="fileList" class="mt-2"></div>
                                                <input type="file" id="fileUpload" name="files[]" multiple hidden>
                                            </div> 
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionThree" aria-expanded="true" aria-controls="accordionThree">
                                                Purchase Information
                                            </button>
                                        </h2>
                                        <div id="accordionThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Vendor Name</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="vendor_name" id="vendor_name"  />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Po Number</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control force-validate" type="text" id="po_number" name="po_number" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Invoice Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" name="invoice_date" type="date" id="invoice_date" />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Invoice No</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" name="invoice_no" type="text" id="invoice_no" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Purchase Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" name="purchase_date" id="purchase_date"/>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Purchase Price</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="full_name_icon">
                                                                <i class="bx bx-rupee"></i>
                                                            </span>
                                                            <input
                                                                type="text"
                                                                name="purchase_price"
                                                                class="form-control"
                                                                id="purchase_price"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Self Owned / Partner</label>
                                                    <div class="col-sm-4">
                                                        <div class="form-check form-switch mb-2">
                                                            <input class="form-check-input" type="checkbox" id="is_self_owned"/>
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionFour" aria-expanded="true" aria-controls="accordionFour">
                                                Financial Information
                                            </button>
                                        </h2>
                                        <div id="accordionFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Capitalization Price</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="full_name_icon">
                                                                <i class="bx bx-rupee"></i>
                                                            </span>
                                                            <input
                                                                type="text"
                                                                name="capitalization_price"
                                                                class="form-control"
                                                                id="capitalization_price"
                                                            />
                                                        </div>
                                                    </div> 
                                                    <label class="col-sm-2 col-form-label" >End Of Life</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" id="end_of_life" name="end_of_life"/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Capitalization Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" name="capitalization_date" id="capitalization_date"/>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Depreciation%</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="depreciation" id="depreciation" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Accumulated
                                                        Depreciation</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="full_name_icon">
                                                                <i class="bx bx-rupee"></i>
                                                            </span>
                                                            <input
                                                                type="text"
                                                                name="accumulated_depreciation"
                                                                class="form-control"
                                                                id="accumulated_depreciation"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Scrap Value</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="scrap_value" id="scrap_value" />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Income Tax
                                                        Depreciation%</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" id="income_tax_depreciation" name="income_tax_depreciation"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionFive" aria-expanded="true" aria-controls="accordionFive">
                                                Allotted Information
                                            </button>
                                        </h2>
                                        <div id="accordionFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Department</label>
                                                    <div class="col-sm-4">
                                                        <select id="department" name="department" class="form-select force-validate">
                                                            <option value="">Select</option>
                                                            <option value="hr">HR</option>
                                                            <option value="accounting">Accounting</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Transferred
                                                        To<span style="color:#f1416c; font-size:18px;">*</span></label>
                                                    <div class="col-sm-4">
                                                        <select id="transf_to" name="transf_to" class="form-select force-validate">
                                                            <option value="">Select</option>
                                                            <option value="dust">dust</option>
                                                            <option value="james_smith">James smith</option>
                                                            <option value="jennifer_miller">Jennifer Miller</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Allotted Upto</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" name="allotted_upto" id="allotted_upto"  />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Remarks</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text"  name="remarks" id="remarks"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#accordionSix" aria-expanded="true" aria-controls="accordionSix">
                                                Warranty Information
                                            </button>
                                        </h2>
                                        <div id="accordionSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >AMC Vendor</label>
                                                    <div class="col-sm-4">
                                                        <select id="amc_vendor" name="amc_vendor" class="form-select">
                                                            <option value="">Select</option>
                                                            <option value="amc_imc">Acme Inc.(S00081)</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Warranty
                                                        Vendor</label>
                                                    <div class="col-sm-4">
                                                        <select id="warranty_vendor" name="warranty_vendor" class="form-select">
                                                            <option value="">Select</option>
                                                            <option value="warranty_vendor">Acme Inc.(S00081)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >Insurance Start
                                                        Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" name="insurance_start_date" type="date"  id="insurance_start_date" name="insurance_start_date"/>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Insurance End
                                                        Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text" name="insurance_end_date" id="insurance_end_date" name="insurance_end_date"/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >AMC Start
                                                        Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" id="amc_start_date" name="amc_start_date" />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Warranty End
                                                        Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" id="warranty_end_date" name="warranty_end_date"/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" >AMC End Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" name="amc_end_date" id="amc_end_date"  />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Warranty Start
                                                        Date</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="date" name="warranty_start_date" id="warranty_start_date" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 justify-content-start">
                                    <div class="col-sm-10">
                                        <button type="Submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Extra Large Update Category Modal -->
    <div class="modal fade" id="exLargeModalUpdateCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="categoryForm">
                @csrf
                <div class="modal-body">
                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionSeven" aria-expanded="true" aria-controls="accordionSeven">
                                    Category Details
                                </button>
                            </h2>
                            <div id="accordionSeven" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Category Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Enter Category Name" name="parent_category_name">
                                                <select class="form-select" name="selective_category_id">
                                                    <option value="">Select Categories</option>
                                                    <option value=""></option> 
                                                </select>
                                            </div>
                                            {{-- <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary">
                                                    &#10006;
                                                </button>
                                            </div> --}}
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Show Category in
                                                Inventory Module</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="is_inventory" value="1"/>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Sub Category</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="category_name"
                                                    placeholder="Enter Category Name" name="sub_category_name"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Show this category
                                                assets in Linked Assets</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="is_link_asset" value="1"/>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label" >Category Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="category_code" name="category_code" 
                                                    placeholder="Enter Category Code" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Default Transfer
                                                Duration</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" 
                                                    placeholder="" name="trafs_duration"/>
                                            </div>
                                            <div class="col-sm-2">
                                                <select id="country" class="form-select" name="trafs_duration_type">
                                                    <option value="">Select</option>
                                                    <option value="day">Day(s)</option>
                                                    <option value="month">Month(s)</option>
                                                    <option value="year">Year(s)</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label" >Cascade</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="cascade" value="1" />
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Allow Auto
                                                Extend</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="allow_auto" value="1" />
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionEight" aria-expanded="true" aria-controls="accordionEight">
                                    Financial Information
                                </button>
                            </h2>
                            <div id="accordionEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">End of Life</label>
                                        <div class="col-sm-2">
                                            <input class="form-control force-validate" type="text" id="end_of_life" name="end_of_life"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="form-select force-validate" id="end_of_life_type" name="end_of_life_type">
                                                <option value="">Select</option>
                                                <option value="day">Day(s)</option>
                                                <option value="month">Month(s)</option>
                                                <option value="year">Year(s)</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Depreciation %</label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text"  id="depreciation" name="depreciation"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Scrap Value</label>
                                        <div class="col-sm-2">
                                            <input class="form-control force-validate" type="text" id="scrap_value" name="scrap_value"/>
                                        </div>
                                        {{-- <div class="col-sm-2">
                                        <select id="scrap_value_type" class="form-select force-validate" name="scrap_value_type">
                                            <option value="">Select</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Amount">Amount</option>
                                        </select>
                                        </div> --}}

                                        <label class="col-sm-2 col-form-label" >Income Tax
                                            Depreciation%</label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text"  id="income_tax_depreciation" name="income_tax_depreciation"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionnine" aria-expanded="true" aria-controls="accordionnine">
                                    Default Activity Schedules For Assets In This Category
                                </button>
                            </h2>
                            <div id="accordionnine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div id="addition-container">
                                        <div class="addition">
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Details</label>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Assignee
                                                    Based On</label>
                                                <div class="col-sm-4">
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input force-validate" name="assign_based" type="radio" value="1"
                                                            id="assign_based" />
                                                        <label class="form-check-label"> Users Involved
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input force-validate" type="radio" name="assign_based" value="2"
                                                            id="assign_based" />
                                                        <label class="form-check-label"> User Role
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input force-validate" type="radio" name="assign_based" value="3"
                                                            id="assign_based" />
                                                        <label class="form-check-label" for="defaultCheck1"> User group
                                                        </label>
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 col-form-label " >User
                                                    Type</label>
                                                <div class="col-sm-4">
                                                    <select id="user_type" name="user_type" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="Created by">Created by</option>
                                                        <option value="Asset Transferred From User">Asset Transferred From User</option>
                                                        <option value="Location Head-Primary Location">Location Head-Primary Location</option>
                                                        <option value="Alternate Category Head 1">Alternate Category Head 1</option>
                                                        <option value="Category Head">Category Head</option>
                                                        <option value="Alternate Location Head 1">Alternate Location Head 1</option>
                                                        <option value="Department Head">Department Head</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Assignee
                                                    Role</label>
                                                <div class="col-sm-4">
                                                    <select id="assign_role" class="form-select force-validate" name="assign_role">
                                                        <option value="">Select</option>
                                                        <option value="Owner">Owner</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label"
                                                    >Assignee</label>
                                                <div class="col-sm-4">
                                                    <select id="assignee" name="assignee" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="Australia">test</option>
                                                        <option value="Bangladesh">Admin</option>
                                                        <option value="Belarus">James Smith</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Activity
                                                    Type</label>
                                                <div class="col-sm-4">
                                                    <select id="activity_type" name="activity_type[]" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="Calibration">Calibration</option>
                                                        <option value="Inspection">Inspection</option>
                                                        <option value="Warranty Expiry">Warranty Expiry</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label"
                                                    >Occurs</label>
                                                <div class="col-sm-4">
                                                    <select id="occurs" name="occurs[]" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="daily">Daily</option>
                                                        <option value="weekly">Weekly</option>
                                                        <option value="monthly">Monthly</option>
                                                        <option value="yearly">Yearly</option>
                                                        <option value="one_time">One Time</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Start
                                                    Schedule After (Days)</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control force-validate" type="text" name="start_schedule_after[]"  />
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Activity
                                                    Reminders</label>
                                                <div class="col-sm-4">
                                                    <select id="activity_reminder" name="activity_reminder[]" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="1">One</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Schedule Based On</label>
                                                <div class="col-sm-4">
                                                    <select id="schedule_based_on" class="form-select force-validate" name="schedule_based_on[]">
                                                        <option value="">Select</option>
                                                        <option value="created_date">Created Date</option>
                                                        <option value="capitalization_date">Capitalization Date</option>
                                                        <option value="Purchase_date">Purchase Date</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Custom
                                                    Days</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control force-validate" type="text" id="custom_days"  name="custom_days[]" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <button type="button" id="addBtns" class="btn btn-primary">
                                                &#43;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionten" aria-expanded="true" aria-controls="accordionten">
                                    Category Name Localization
                                </button>
                            </h2>
                            <div id="accordionten" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" >Category Name
                                            Localization</label>
                                    </div>
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label" ></label>
                                        <div class="col-sm-4">
                                        </div> --}}
                                        <label class="col-sm-2 col-form-label" ></label>
                                        <div class="col-sm-4">
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Category
                                            Name</label>
                                        <div class="col-sm-4">
                                            <label class=" col-form-label" >Language</label>
                                        </div>
                                    </div>
                                    <div id="addition-container-two">
                                        <div class="addition-two">
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <button type="button" id="addBtnLocal" class="btn btn-primary">
                                                        &#43;
                                                    </button>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control force-validate " type="text" name="category_name[]" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select id="language" class="form-select force-validate" name="language[]">
                                                        <option value="">Select</option>
                                                        <option value="marathi">Marathi</option>
                                                        <option value="hindi">Hindi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Extra Large Update Asset Modal -->
    <div class="modal fade" id="exLargeModalMultiUpdateAsset" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="tf-icons bx bx-edit"></span>&​nbsp; Bulk Update Assets
                        <span id="selectedCountBadge" class="badge bg-primary ms-2">0 assets selected</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" tabindex="-1">
                    
                    <!-- Unsaved Changes Alert -->
                    <div id="unsavedBadge" class="alert alert-warning alert-dismissible fade show mb-3" style="display: none;">
                        <span class="tf-icons bx bx-error-circle"></span>
                        <strong>You have unsaved changes!</strong> Click "Save Changes" to persist your edits.
                        <button type="button" class="btn-close" onclick="$('#unsavedBadge').hide();"></button>
                    </div>

                    <!-- Update Actions -->
                    <div class="card mb-3">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center bg-light">
                            <div class="text-muted small fw-bold">
                                <i class="bx bx-info-circle"></i> 
                                Click any cell to edit. Fields with dropdown/date support will show popup.
                            </div>
                            <div class="d-flex gap-2">
                                <div class="btn-group">
                                    <input type="file" id="excelUploadInput" accept=".xlsx,.xls,.csv" style="display: none;">
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="$('#excelUploadInput').click()">
                                        <i class="bx bx-upload"></i> Upload Excel
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btnDownloadExcel">
                                        <i class="bx bx-download"></i> Download
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-info" id="btnSelectFields">
                                        <i class="bx bx-grid-small"></i> Select Fields
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">

                            <!-- Bulk Update Table -->
                            <div class="table-responsive" style="max-height: 500px; overflow: auto;">
                                <table class="table table-bordered table-sm bulk-update-table" id="bulkUpdateTable">
                                    <thead class="bg-light sticky-top">
                                        <tr id="bulkUpdateHeaderRow">
                                            <th class="first-col">#</th>
                                            <th class="second-col">Asset Code</th>
                                            <th>Asset Name</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>CWIP Invoice Id</th>
                                            <th>Condition</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Linked Asset</th>
                                            <th>Description</th>
                                            <th>Serial No</th>
                                            <th>Vendor Name</th>
                                            <th>PO Number</th>
                                            <th>Invoice Date</th>
                                            <th>Invoice No</th>
                                            <th>Purchase Date</th>
                                            <th>Purchase Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulkUpdateBody">
                                        <tr class="text-center text-muted">
                                            <td colspan="40" class="py-4">
                                                <i class="bx bx-info-circle fs-4 d-block mb-2"></i>
                                                Select assets and click "Update Asset" to load data
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Footer Actions inside card -->
                            <div class="d-flex justify-content-between align-items-center mt-3 p-3">
                                <div class="text-muted small">
                                    <i class="bx bx-info-circle"></i> Max 100 assets can be edited at once
                                </div>
                                <div id="saveStatus" class="text-muted small"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="btnCloseBulkUpdate">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="btnSaveBulkUpdate" disabled>
                        <i class="bx bx-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('section-js')
<script>
    $(document).ready(function () {

        $('#refreshTableBtn').on('click', function () {
            location.reload();
        });

        $('#link_asset').select2({
            dropdownParent: $('#exLargeModalUpdateAsset'),
            placeholder: "Select Asset",
            allowClear: true,
            width: '100%'
        }).next('.select2-container').css('width', '100%');
        

        $('#link_asset_schedule').select2({
            dropdownParent: $('#exLargeModalScheduleActivity'),
            placeholder: "Select Asset",
            allowClear: true,
            width: '100%'
        }).next('.select2-container').css('width', '100%');


        $('#assetDispoForm').validate({

            ignore: ":hidden:not(.force-validate)",
            errorElement: 'span',
            errorClass: 'text-danger',

            highlight: function (element) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },

            errorPlacement: function (error, element) {
                if (element.hasClass('select2')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {

                let formData = new FormData(form);

                $.ajax({
                    url: "{{ route('disposal.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#assetForm button[type="submit"]').prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm"></span> Saving...');
                    },

                    success: function (response) {
                        if (response.status) {
                            showToast(response.message, 'success');

                            $('#assetForm')[0].reset();
                            $('.select2').val(null).trigger('change');
                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                showToast(value[0], 'error');
                            });
                        } else {
                            showToast('Something went wrong!', 'error');
                        }
                    },

                    complete: function () {
                        $('#assetForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
                    }
                });
            }
        });

        //  Select2 Init
        $('.select3').select2({
            placeholder: "Select Columns",
            allowClear: true,
            width: '100%',
            dropdownParent: $('#exLargeModaldefaultview')
        });

        //  Toast Function (FIXED)
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
                <div class="toast text-white ${bgClass} border-0 show" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bx ${icon} me-2"></i> ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;

            let container = $('#toastContainer');

            if (container.length === 0) {
                console.error('Toast container missing!');
                return;
            }

            let toastElement = $(toastHTML);
            container.append(toastElement);

            let toast = new bootstrap.Toast(toastElement[0], { delay: 3000 });
            toast.show();

            toastElement.on('hidden.bs.toast', function () {
                $(this).remove();
            });
        }

        //  Insert Form Validation + AJAX
        $('#viewForm').validate({

            ignore: ":hidden:not(.force-validate)",

            rules: {
                view_name: {
                    required: true,
                    minlength: 3
                },
                'columns[]': {
                    required: true
                },
                role_id: {
                    required: function () {
                        return !$('[name="is_private"]').is(':checked');
                    }
                }
            },

            messages: {
                view_name: {
                    required: "Please enter view name",
                    minlength: "View name must be at least 3 characters"
                },
                'columns[]': {
                    required: "Please select at least one column"
                },
                role_id: {
                    required: "Please select role for public view"
                }
            },

            errorElement: 'span',
            errorClass: 'text-danger',

            highlight: function (element) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },

            errorPlacement: function (error, element) {
                if (element.hasClass('select3')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {

                let formData = new FormData(form);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('custom-view.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#viewForm button[type="submit"]').prop('disabled', true)
                            .html(`<span class="spinner-border spinner-border-sm me-2"></span> Saving...`);
                    },

                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');

                            form.reset();
                            $('.select3').val(null).trigger('change');

                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    error: function (xhr) {

                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (field, messages) {
                                showToast(messages[0], 'error');
                            });
                        } else {
                            showToast(xhr.responseJSON?.message || 'Something went wrong!', 'error');
                        }
                    },

                    complete: function () {
                        $('#viewForm button[type="submit"]').prop('disabled', false)
                            .html('Submit');
                    }
                });
            }
        });

        //  DELETE VIEW
        $(document).on('click', '#deleteViewBtn', function () {

            let viewId = $('#viewSelect').val();

            if (!viewId) {
                showToast('Please select a view to delete', 'warning');
                return;
            }

            if (!confirm('Are you sure you want to delete this view?')) {
                showToast('Delete cancelled by user', 'warning');
                return;
            }

            $.ajax({
                url: "{{ route('custom-view.destroy', ':id') }}".replace(':id', viewId),

                //  IMPORTANT FIX
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: "DELETE"
                },

                success: function (response) {

                    if (response.status) {
                        showToast(response.message, 'success');

                        // remove from dropdown
                        $('#viewSelect option[value="' + viewId + '"]').remove();
                        $('#viewSelect').val('').trigger('change');

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

        /*****Implementing the custom table view feature*****/
        function getAssetTable() {
            // Reuse shared DataTable instance only when it is a valid API object.
            if (window.assetTable && typeof window.assetTable.columns === 'function') {
                return window.assetTable;
            }
 
            // Recover gracefully if a stale/non-API object was assigned.
            window.assetTable = null;
 
            if ($.fn.DataTable && $.fn.DataTable.isDataTable('#assetTable')) {
                const api = $('#assetTable').DataTable();
                if (api && typeof api.columns === 'function') {
                    window.assetTable = api;
                    return window.assetTable;
                }
            }
 
            return null;
        }
 
        function updateGroupHeaderVisibility(visibleColumnIds) {
            const groups = [
                { id: '#defaultToggle', cols: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] },
                { id: '#additionalToggle', cols: [14, 15, 16, 17, 18, 19] },
                { id: '#purchaseToggle', cols: [20, 21, 22, 23, 24, 25, 26, 27] },
                { id: '#financialToggle', cols: [28, 29, 30, 31, 32, 33, 34] },
                { id: '#allottedToggle', cols: [35, 36, 37, 38] },
                { id: '#warrantyToggle', cols: [39, 40, 41, 42, 43] },
                { id: '#otherToggle', cols: [44, 45] }
            ];
 
            groups.forEach(group => {
                const count = group.cols.filter(col => visibleColumnIds.has(col)).length;
                $(group.id).toggle(count > 0).attr('colspan', Math.max(count, 1));
            });
        }
 
        function applyColumnVisibilityByIds(selectedColumns) {
            const table = getAssetTable();
            if (!table || typeof table.columns !== 'function') return;
 
            const selectedColumnIds = new Set((selectedColumns || []).map(col => parseInt(col, 10)).filter(Boolean));
            // Keep checkbox + Actions always visible (avoid relying on hardcoded indices).
            const alwaysVisibleIndexes = new Set();
            table.columns().every(function (idx) {
                const header = this.header();
                if (!header) return;
                const $header = $(header);
                if ($header.find('#selectAll').length) alwaysVisibleIndexes.add(idx);
                if ($header.text().trim().toLowerCase() === 'actions') alwaysVisibleIndexes.add(idx);
            });
            // Fallback (older structure): first 2 columns.
            alwaysVisibleIndexes.add(0);
            alwaysVisibleIndexes.add(1);
            const visibleColumnIds = new Set();
 
            // Start with only fixed columns visible.
            const totalColumns = table.columns().indexes().toArray();
            totalColumns.forEach(index => {
                table.column(index).visible(alwaysVisibleIndexes.has(index), false);
            });
 
            function getColumnIndexByDataColumn(colId) {
                let matchIndex = null;
                table.columns().every(function (idx) {
                    const header = this.header();
                    const headerColumn = parseInt($(header).data('column'), 10);
                    if (!Number.isNaN(headerColumn) && headerColumn === colId) {
                        matchIndex = idx;
                    }
                });
                return matchIndex;
            }
 
            // Show selected mapped columns.
            selectedColumnIds.forEach(colId => {
                const index = getColumnIndexByDataColumn(colId);
                if (index !== null) {
                    table.column(index).visible(true, false);
                    visibleColumnIds.add(colId);
                }
            });
 
            updateGroupHeaderVisibility(visibleColumnIds);
            table.columns.adjust().draw(false);
        }
 
        function showAllColumns() {
            const table = getAssetTable();
            if (!table || typeof table.columns !== 'function') return;
 
            table.columns().visible(true, false);
            const allColumnIds = new Set();
 
            $('#assetTable thead tr:eq(1) th[data-column]').each(function () {
                allColumnIds.add(parseInt($(this).data('column'), 10));
            });
 
            updateGroupHeaderVisibility(allColumnIds);
            table.columns.adjust().draw(false);
        }
 
        $(document).on('change', '#viewSelect', function () {
 
            let viewId = $(this).val();
            let selectedText = $('#viewSelect option:selected').text().trim().toLowerCase();
 
            if (!viewId) {
                showAllColumns();
                return;
            }
 
            $.ajax({
                url: "{{ url('custom-view') }}/" + viewId,
                type: "GET",
 
                success: function (response) {
                    let selectedColumns = response.columns || [];
 
                    // Force fixed behavior for requested views.
                    if (selectedText === 'assetname') {
                        // Asset-related set (default section)
                        selectedColumns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
                    } else if (selectedText === 'department') {
                        // Department-related set (allotted information)
                        selectedColumns = [35, 36, 37, 38];
                    } else if (selectedText === 'insurance start date') {
                        selectedColumns = [39, 40, 41, 42, 43];
                    } else if (selectedText === 'amcvendor') {
                        selectedColumns = [39, 40, 41, 42, 43];
                    }
 
                    applyColumnVisibilityByIds(selectedColumns);
 
                },
 
                error: function () {
                    showToast('Failed to load view', 'error');
                }
            });
 
        });
 
        // Apply selected view after page refresh/load.
        if ($('#viewSelect').val()) {
            $('#viewSelect').trigger('change');
        } else {
            showAllColumns();
        }
        /*****Implementing the custom table view feature*****/

        let locations = @json($location);
        let subLocations = @json($sub_location);

        function getLocationOptions(selectedId = '') {
            let options = '<option value="">Select</option>';

            locations.forEach(loc => {
                let selected = loc.id == selectedId ? 'selected' : '';
                options += `<option value="${loc.id}" ${selected}>${loc.name}</option>`;
            });

            return options;
        }

        function getSubLocationOptions(selectedId = '') {
            let options = '<option value="">Select</option>';

            subLocations.forEach(sub => {
                let selected = sub.id == selectedId ? 'selected' : '';
                options += `<option value="${sub.id}" ${selected}>${sub.name}</option>`;
            });

            return options;
        }

        $('#disposeBtn').on('click', function () {

            let checked = $('.asset-checkbox:checked');

            if (checked.length === 0) {
                showToast('Please select at least one asset');
                return;
            }

            let container = $('#assetSections');
            container.html(''); // clear old

            let index = 1;

            checked.each(function () {

                let row = $(this).closest('tr');

                let name = row.data('asset-name');
                let code = row.data('asset-code');
                let price = row.data('asset-pur-price');
                let locationId = row.data('location-id');
                let subLocationId = row.data('sub-location-id');

                let section = `
                <div class="card mb-3">
                    <h6 class="card-header">Section ${index}</h6>

                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label">Asset Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="assets[${index}][asset_code]" value="${code}">
                        </div>

                        <label class="col-sm-2 col-form-label">Asset Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="assets[${index}][asset_name]" value="${name}">
                        </div>
                    </div>

                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label">Sold value</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control sold_value"  name="assets[${index}][sold_value]">
                        </div>

                        <label class="col-sm-2 col-form-label">Purchase Price</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control pur_price" name="assets[${index}][purchase_price]" value="${price}">
                        </div>
                    </div>

                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label">Price Difference</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control price_diff" name="assets[${index}][price_difference]" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-4">
                            <select class="form-select location" name="assets[${index}][location_id]">
                                ${getLocationOptions(locationId)}
                            </select>
                        </div>

                        <label class="col-sm-2 col-form-label">Sub Location</label>
                        <div class="col-sm-4">
                            <select class="form-select sub_location" name="assets[${index}][sub_location_id]">
                                ${getSubLocationOptions(subLocationId)}
                            </select>
                        </div>
                    </div>
                </div>
                `;

                container.append(section);

                // Set selected values
                container.find('.location').last().val(locationId);
                container.find('.sub_location').last().val(subLocationId);

                index++;
            });

            // Open modal
            let modal = new bootstrap.Modal(document.getElementById('exLargeModalAssetDisposal'));
            modal.show();
        });

        $('#updateBtn').on('click', function () {

            let checked = $('.asset-checkbox:checked'); //  define it
           
            if (checked.length === 0) {
                showToast('Please select at least one asset');
                return;
            }

            if (checked.length > 1) {
                new bootstrap.Modal(document.getElementById('exLargeModalMultiUpdateAsset')).show();
                return;
            }

            let id = checked.val(); //  now works
            loadAssetData(id);
        });

        function loadAssetData(id) {

            $.ajax({
                url: '/get-asset-details/' + id,
                type: 'GET',

                success: function (res) {

                    //  Asset Details
                    $('#asset_id').val(res.asset.id);
                    $('#asset_name').val(res.asset.asset_name);
                    $('#asset_code').val(res.asset.asset_code);
                    $('#cwip_invoice_id').val(res.asset.cwip_invoice_id);
                    
                    $('#category_id').val(res.asset.category_id).trigger('change');
                    $('#sub_category_id').val(res.asset.sub_category_id).trigger('change');

                    $('#location_id').val(res.asset.location_id).trigger('change');
                    $('#sub_location_id').val(res.asset.sub_location_id).trigger('change');

                    $('#status_id').val(res.asset.status_id).trigger('change');

                    //  Additional Info
                    $('#brand').val(res.additional.brand);
                    $('#condition').val(res.additional.condition);
                    $('#model').val(res.additional.model);
                    $('#serial_no').val(res.additional.serial_no);
                    $('#description').val(res.additional.description);

                    //  Purchase Info
                    $('#vendor_name').val(res.purchase.vendor_name);
                    $('#po_number').val(res.purchase.po_number);
                    $('#invoice_date').val(res.purchase.invoice_date);
                    $('#invoice_no').val(res.purchase.invoice_no);
                    $('#purchase_date').val(res.purchase.purchase_date);
                    $('#purchase_price').val(res.purchase.purchase_price);
                    $('#is_self_owned').prop('checked', res.purchase.is_self_owned == 1);


                    //  Financial Info
                    $('#capitalization_price').val(res.financial.capitalization_price);
                    $('#capitalization_date').val(res.financial.capitalization_date);
                    $('#depreciation').val(res.financial.depreciation_percent);
                    $('#end_of_life').val(res.financial.end_of_life);
                    $('#scrap_value').val(res.financial.scrap_value);
                    $('#income_tax_depreciation').val(res.financial.income_tax_depreciation_percent);
                    $('#accumulated_depreciation').val(res.financial.accumulated_depreciation);

                    //  Alloted Info
                    $('#department').val(res.assetallotedInfos.department);
                    $('#transf_to').val(res.assetallotedInfos.transferred_to);
                    $('#allotted_upto').val(res.assetallotedInfos.allotted_upto);
                    $('#remarks').val(res.assetallotedInfos.remarks);

                    //  Warranty Info
                    $('#amc_vendor').val(res.assetwarrantyInfos.amc_vendor);
                    $('#warranty_vendor').val(res.assetwarrantyInfos.warranty_vendor);
                    $('#insurance_start_date').val(res.assetwarrantyInfos.insurance_start_date);
                    $('#insurance_end_date').val(res.assetwarrantyInfos.insurance_end_date);
                    $('#amc_start_date').val(res.assetwarrantyInfos.amc_start_date);
                    $('#amc_end_date').val(res.assetwarrantyInfos.amc_end_date);
                    $('#warranty_end_date').val(res.assetwarrantyInfos.warranty_end_date);
                    $('#warranty_start_date').val(res.assetwarrantyInfos.warranty_start_date);

                    // ================= LINKED ASSETS (MULTI SELECT) =================
                    if (res.linked_assets) {
                        let ids = res.linked_assets.map(item => item.id);
                        $('#link_asset').val(ids).trigger('change'); // select2
                    }

                     // ================= FILES SHOW =================
                    $('#fileList').html('');

                    if (res.files && res.files.length > 0) {

                        res.files.forEach(function(file) {

                            let fileName = file.file_path.split('/').pop();
                            let fileUrl = '/storage/' + file.file_path;

                            let fileHtml = `
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bx bx-file me-2 text-primary"></i>
                                    <a href="${fileUrl}" target="_blank">${fileName}</a>
                                </div>
                            `;

                            $('#fileList').append(fileHtml);
                        });

                    } else {
                        $('#fileList').html('<small class="text-muted">No files uploaded</small>');
                    }

                    
                    new bootstrap.Modal(document.getElementById('exLargeModalUpdateAsset')).show();
                }
            });
        }

        // scheduleActivityBtn
         $('#scheduleActivityBtn').on('click', function () {

            let checked = $('.asset-checkbox:checked');

            if (checked.length === 0) {
                showToast('Please select at least one asset');
                return;
            }

            let selectedIds = [];

            checked.each(function () {
                selectedIds.push($(this).val());
            });

            $('#link_asset_schedule').val(selectedIds).trigger('change');

            $('#exLargeModalScheduleActivity').modal('show');
        });


        $(document).on('keyup change', '.sold_value, .pur_price', function () {

            let card = $(this).closest('.card'); // current section

            let sold = parseFloat(card.find('.sold_value').val()) || 0;
            let purchase = parseFloat(card.find('.pur_price').val()) || 0;

            let diff = purchase - sold;

            card.find('.price_diff').val(diff.toFixed(2));
        });

        // ================ FILE UPLOAD JS LOGIC START ====================

        // Array to store uploaded file data
        let uploadedFiles = [];

        document.getElementById('fileUpload').addEventListener('change', function() {
            var files = this.files;
            var fileLoader = document.getElementById('fileLoader');
            var fileList = document.getElementById('fileList');
            var hiddenInput = document.getElementById('uploadedFilesData');

            if (files.length > 0) {
                // Show loader
                fileLoader.classList.remove('d-none');

                // Simulate upload process (2 seconds)
                setTimeout(function() {
                    // Hide loader
                    fileLoader.classList.add('d-none');

                    // Loop through all selected files and add to array
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var fileId = Date.now() + '_' + i; // Unique ID for each file

                        // Add to uploaded files array
                        uploadedFiles.push({
                            id: fileId,
                            name: file.name,
                            size: file.size
                        });

                        // Create file item HTML with remove button
                        var fileItem = document.createElement('div');
                        fileItem.className = 'd-flex align-items-center mb-1';
                        fileItem.id = 'file_' + fileId;
                        fileItem.innerHTML =
                            '<i class="bx bx-file text-primary me-2"></i>' +
                            '<span class="text-success small fw-semibold flex-grow-1">' + file.name + '</span>' +
                            '<button type="button" class="btn btn-sm btn-link text-danger p-0 ms-2" onclick="removeFile(\'' + fileId + '\')">' +
                            '<i class="bx bx-trash"></i>' +
                            '</button>';
                        fileList.appendChild(fileItem);
                    }

                    // Update hidden input with file data (for form submission)
                    hiddenInput.value = JSON.stringify(uploadedFiles);

                    // Clear input so same files can be selected again if needed
                    document.getElementById('fileUpload').value = '';
                }, 2000);
            }
        });

        // Function to remove a file from the list
        window.removeFile = function(fileId) {
            // Remove from DOM
            var fileElement = document.getElementById('file_' + fileId);
            if (fileElement) {
                fileElement.remove();
            }

            // Remove from array
            uploadedFiles = uploadedFiles.filter(function(file) {
                return file.id !== fileId;
            });

            // Update hidden input
            document.getElementById('uploadedFilesData').value = JSON.stringify(uploadedFiles);
        };
        // ==================== FILE UPLOAD JS LOGIC END ====================

         // for add page sub categories

        $('#category_id').on('change', function () {

            let categoryId = $(this).val();

            if (categoryId) {

                $.ajax({
                    url: "/get-subcategories/" + categoryId, // route
                    type: "GET",

                    success: function (response) {

                        let subCategory = $('#sub_category_id');
                        subCategory.empty();
                        subCategory.append('<option value="">Select</option>');

                        $.each(response, function (key, value) {
                            subCategory.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        // refresh select2
                        subCategory.trigger('change');
                    }
                });

            } else {
                $('#sub_category_id').empty().append('<option value="">Select</option>');
            }
        });

        $('#location_id').on('change', function () {

            let locationId = $(this).val();
            if (locationId) {

                $.ajax({
                    url: "/get-sublocation/" + locationId, // route
                    type: "GET",

                    success: function (response) {
                        console.log(response);
                        let subLocations = $('#sub_location_id');
                        subLocations.empty();
                        subLocations.append('<option value="">Select</option>');

                        $.each(response, function (key, value) {
                            subLocations.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        // refresh select2
                        subLocations.trigger('change');
                    }
                });

            } else {
                $('#sub_location_id').empty().append('<option value="">Select</option>');
            }
        });

        $('#updateAssetForm').validate({

            submitHandler: function (form) {

                let id = $('#asset_id').val();
                let formData = new FormData(form);

                let btn = $('#updateAssetForm button[type="submit"]');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/update-asset/' + id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    //  BEFORE SEND
                    beforeSend: function () {
                        btn.prop('disabled', true);
                        btn.html(`<span class="spinner-border spinner-border-sm me-2"></span> Updating...`);
                    },

                    //  SUCCESS
                    success: function (response) {

                        if (response.status) {

                            showToast(response.message, 'success');

                            $('#exLargeModalUpdateAsset').modal('hide');

                            location.reload(); 

                            $('#updateAssetForm')[0].reset();

                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    //  ERROR
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

                    //  COMPLETE
                    complete: function () {
                        btn.prop('disabled', false);
                        btn.html('Save changes'); // restore text
                    }
                });
            }
        });


        // Asset Transfer Functionality - With Table View

        $('#assetTrasfBtn').on('click', function() {


            let checked = $('.asset-checkbox:checked'); //  define it

            if (checked.length === 0) {
                showToast('Please select at least one asset');
                return;
            }

            let tbody = $('#transferAssetsBody');

            tbody.html(''); // clear old

            let index = 1;

            checked.each(function() {

                let row = $(this).closest('tr');

                let assetId = row.data('asset-id');

                let name = row.data('asset-name');

                let code = row.data('asset-code');

                let locationId = row.data('location-id');

                let subLocationId = row.data('sub-location-id');

                // Get values from the rowcondition

                let department = row.find('.allotted-extra').eq(0).text().trim() || '-';

                let condition = row.find('.condition').eq(0).text().trim() || '-';

                let currentOwner = row.find('.allotted-extra').eq(1).text().trim() || 'Admin';

                let location = row.find('.default-extra').eq(4).text().trim() || '-';

                let status = row.find('.default-extra').eq(6).text().trim() || 'Active';

                let linkedAsset = row.find('.additional-extra').eq(2).text().trim() || '-';

                let capitalizationPrice = row.find('.financial-extra').eq(0).text().trim() || '0';

                let tableRow = `
        <tr data-asset-index="${index}">
        <td>

                            ${index}
        <input type="hidden" name="assets[${index}][asset_id]" value="${assetId}">
        </td>
        <td>

                            ${code}
        <input type="hidden" name="assets[${index}][asset_code]" value="${code}">
        </td>
        <td>

                            ${name}
        <input type="hidden" name="assets[${index}][asset_name]" value="${name}">
        </td>
        <td>${department}</td>
        <td>${condition}</td>
        <td>${currentOwner}</td>
        <td>${location}</td>
        <td>${status}</td>
        <td>${linkedAsset}</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>${capitalizationPrice}</td>
        <td>
        <select class="form-select form-select-sm new-location" name="assets[${index}][location_id]" data-index="${index}">
            <option value="">Select Location</option>
            @foreach($location as $loc)
                <option value="{{ $loc->id }}" ${locationId == {{ $loc->id }} ? 'selected' : ''}>{{ $loc->name }}</option>
            @endforeach
        </select>
        <select class="form-select form-select-sm transfer-status" name="assets[${index}][transfer_status]" data-index="${index}" style="display: none;">
        <option value="">Select Status</option>
        <option value="In Use">In Use</option>
        <option value="In Stock">In Stock</option>
        <option value="Out for Repair">Out for Repair</option>
        </select>
        <select class="form-select form-select-sm transferred-to" name="assets[${index}][transferred_to]" data-index="${index}" style="display: none;">
        <option value="">Select User</option>
        <option value="James Smith">James Smith</option>
        <option value="Jennifer Miller">Jennifer Miller</option>
        <option value="Robert Johnson">Robert Johnson</option>
        </select>
        <input type="hidden" class="form-control form-control-sm allotted_upto" name="assets[${index}][allotted_upto]" data-index="${index}" placeholder="Alloted Date">
        <input type="hidden" class="form-control form-control-sm remarks" name="assets[${index}][remarks]" data-index="${index}" placeholder="Enter remarks">
        </td>
        </tr>

                `;

                tbody.append(tableRow);
                index++;

            });

            // Apply global settings to all rows

            applyGlobalSettings();

            // Open modal
            let modal = new bootstrap.Modal(document.getElementById('exLargeModalAssetTraf'));
            modal.show();

        });
        
        // Function to apply global settings

        function applyGlobalSettings() {

            // Global Location

            $('#globalLocation').off('change').on('change', function() {

                let value = $(this).val();

                $('.new-location').val(value).trigger('change');

            });

            // Global Sub Location

            /*$('#globalSubLocation').off('change').on('change', function() {

                let value = $(this).val();

                $('.new-sublocation').val(value).trigger('change');

            });*/

            // Global Transfer Status

            $('#globalTransferStatus').off('change').on('change', function() {

                let value = $(this).val();

                $('.transfer-status').val(value);

            });

            // Global Transfer To

            $('#globalTransferTo').off('change').on('change', function() {

                let value = $(this).val();

                $('.transferred-to').val(value);

            });

            // Global Remark

            $('#globalRemark').off('keyup').on('keyup', function() {

                let value = $(this).val();

                $('.remarks').val(value);

            });

            $('#globalAllotedUpto').off('change').on('change', function() {

                let value = $(this).val();

                $('.allotted_upto').val(value);

            });

        }
        
        // Asset Transfer Form Submission

        $('#assetTransferForm').validate({

            ignore: [],

            errorElement: 'span',

            errorClass: 'text-danger',

            highlight: function(element) {

                $(element).addClass('is-invalid');

            },

            unhighlight: function(element) {

                $(element).removeClass('is-invalid');

            },

            submitHandler: function(form) {

                let formData = new FormData(form);

                $.ajax({

                    url: "{{ route('asset.transfer') }}",

                    type: "POST",

                    data: formData,

                    processData: false,

                    contentType: false,

                    beforeSend: function() {

                        $('#assetTransferForm button[type="submit"]').prop('disabled', true)

                            .html('<span class="spinner-border spinner-border-sm"></span> Transferring...');

                    },

                    success: function(response) {

                        if (response.status) {

                            showToast(response.message, 'success');

                            $('#exLargeModalAssetTraf').modal('hide');

                            $('#assetTransferForm')[0].reset();

                            $('#transferAssetsBody').html('');

                            // Reset global selectors

                            $('#globalLocation, #globalSubLocation, #globalTransferStatus, #globalTransferTo').val('');

                            $('#globalRemark').val('');

                            // Reload page after 2 seconds

                            setTimeout(function() {

                                location.reload();

                            }, 2000);

                        } else {

                            showToast(response.message, 'error');

                        }

                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {

                                showToast(value[0], 'error');

                            });

                        } else {

                            showToast(xhr.responseJSON?.message || 'Something went wrong!', 'error');

                        }

                    },

                    complete: function() {

                        $('#assetTransferForm button[type="submit"]').prop('disabled', false)

                            .html('Save changes');

                    }

                });

            }

        });

        // Asset Schedule Form Submission

        $('#scheduleActivityForm').validate({
            ignore: [], // IMPORTANT for select2

            rules: {
                'link_asset[]': {
                    required: true
                },
                location: {
                    required: true
                },
                activity_type: {
                    required: true
                },
                user_group: {
                    required: true
                },
                assigned_to: {
                    required: true
                },
                occurs: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                email_based_on: {
                    required: true
                },
                grace_before: {
                    number: true
                },
                grace_after: {
                    number: true
                },
                amount: {
                    number: true,
                    min: 0
                }
            },

            messages: {
                'link_asset[]': {
                    required: "Please select at least one asset"
                },
                location: {
                    required: "Location is required"
                },
                activity_type: {
                    required: "Select activity type"
                },
                user_group: {
                    required: "Select user group"
                },
                assigned_to: {
                    required: "Select assigned user"
                },
                occurs: {
                    required: "Select occurrence type"
                },
                start_date: {
                    required: "Start date is required"
                },
                end_date: {
                    required: "End date is required"
                },
                email_based_on: {
                    required: "Select email option"
                },
                grace_before: {
                    number: "Must be a number"
                },
                grace_after: {
                    number: "Must be a number"
                },
                amount: {
                    number: "Amount must be number",
                    min: "Amount cannot be negative"
                }
            },

            errorElement: 'span',
            errorClass: 'text-danger',

            highlight: function (element) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },

            errorPlacement: function (error, element) {

                // Select2 fix
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {

                let formData = new FormData(form);
                let btn = $('#scheduleActivityForm button[type="submit"]');

                $.ajax({
                    url: "{{ route('schedule.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        btn.prop('disabled', true);
                        btn.html(`<span class="spinner-border spinner-border-sm me-2"></span> Saving...`);
                    },

                    success: function (res) {
                        if (res.status) {
                            showToast(res.message, 'success');

                            $('#scheduleActivityForm')[0].reset();
                            $('.select2').val(null).trigger('change');

                            $('#exLargeModalScheduleActivity').modal('hide');
                        } else {
                            showToast(res.message, 'error');
                        }
                    },

                    error: function (xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, value) {
                                showToast(value[0], 'error');
                            });
                        } else {
                            showToast('Something went wrong', 'error');
                        }
                    },

                    complete: function () {
                        btn.prop('disabled', false);
                        btn.html('Save changes');
                    }
                });
            }
        });
        // multi update js

        // ==================== BULK UPDATE SYSTEM ====================

const BULK_UPDATE_MAX_ASSETS = 100;
let selectedAssetIds = [];
let editedData = [];
let originalData = [];
let hasUnsavedChanges = false;
let currentDropdownContext = null;
let isSavingBulkUpdate = false;
let visibleFields = null; // null = show all fields

const FIELD_CONFIG = {
    'asset_name': { type: 'text', label: 'Asset Name', editable: true, required: true },
    'sub_category': { type: 'text', label: 'Sub Category', editable: true },
    'sub_location': { type: 'text', label: 'Sub Location', editable: true },
    'cwip_invoice_id': { type: 'text', label: 'CWIP Invoice ID', editable: true },
    'brand': { type: 'text', label: 'Brand', editable: true },
    'model': { type: 'text', label: 'Model', editable: true },
    'description': { type: 'text', label: 'Description', editable: true },
    'serial_no': { type: 'text', label: 'Serial No', editable: true },
    'vendor_name': { type: 'text', label: 'Vendor Name', editable: true },
    'asset_po_number': { type: 'text', label: 'PO Number', editable: true },
    'invoice_date': { type: 'date', label: 'Invoice Date', editable: true },
    'invoice_no': { type: 'text', label: 'Invoice No', editable: true },
    'purchase_date': { type: 'date', label: 'Purchase Date', editable: true },
    'purchase_price': { type: 'number', label: 'Purchase Price', editable: true },
    'is_self_owned': { type: 'dropdown', label: 'Self Owned', editable: true, options: ['Yes', 'No'] },
    'capitalization_price': { type: 'number', label: 'Capitalization Price', editable: true },
    'end_of_life': { type: 'date', label: 'End of Life', editable: true },
    'capitalization_date': { type: 'date', label: 'Capitalization Date', editable: true },
    'depreciation_percent': { type: 'number', label: 'Depreciation %', editable: true },
    'accumulated_depreciation': { type: 'number', label: 'Accumulated Dep', editable: true },
    'scrap_value': { type: 'number', label: 'Scrap Value', editable: true },
    'income_tax_depreciation_percent': { type: 'number', label: 'Income Tax Dep %', editable: true },
    'department': { type: 'dropdown', label: 'Department', editable: true, options: ['IT', 'HR', 'Finance', 'Operations', 'Sales', 'Marketing'] },
    'transferred_to': { type: 'text', label: 'Transferred To', editable: true },
    'allotted_upto': { type: 'date', label: 'Allotted Upto', editable: true },
    'remarks': { type: 'text', label: 'Remarks', editable: true },
    'amc_vendor': { type: 'text', label: 'AMC Vendor', editable: true },
    'warranty_vendor': { type: 'text', label: 'Warranty Vendor', editable: true },
    'insurance_start_date': { type: 'date', label: 'Insurance Start', editable: true },
    'insurance_end_date': { type: 'date', label: 'Insurance End', editable: true },
    'amc_start_date': { type: 'date', label: 'AMC Start', editable: true },
    'amc_end_date': { type: 'date', label: 'AMC End', editable: true },
    'warranty_start_date': { type: 'date', label: 'Warranty Start', editable: true },
    'warranty_end_date': { type: 'date', label: 'Warranty End', editable: true },
    'category': { type: 'dropdown', label: 'Category', editable: true, source: 'categories' },
    'location': { type: 'dropdown', label: 'Location', editable: true, source: 'locations' },
    'status': { type: 'dropdown', label: 'Status', editable: true, source: 'statuses' },
    'condition': { type: 'dropdown', label: 'Condition', editable: true, options: ['New', 'Good', 'Fair', 'Poor', 'Damaged'] },
};

let dropdownData = {
    locations: @json($location ?? []),
    subLocations: @json($sub_location ?? [])
};

// Handle Update Asset button click
$(document).on('click', '[data-bs-target="#exLargeModalMultiUpdateAsset"]', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    if (isSavingBulkUpdate) {
        showToast('Please wait, previous save is still processing...', 'warning');
        return;
    }

    let checked = $('.asset-checkbox:checked');
    if (checked.length === 0) {
        showToast('Please select at least one asset to update', 'warning');
        return;
    }
    if (checked.length > BULK_UPDATE_MAX_ASSETS) {
        showToast(`Maximum ${BULK_UPDATE_MAX_ASSETS} assets can be edited at once`, 'error');
        return;
    }

    let assetIds = [];
    checked.each(function() {
        let row = $(this).closest('tr');
        let assetId = row.data('asset-id') || row.find('td:eq(3)').text();
        if (assetId) assetIds.push(assetId);
    });

    $('#bulkUpdateBody').html('<tr><td colspan="40" class="text-center py-4"><div class="spinner-border"></div><p class="mt-2">Loading assets...</p></td></tr>');

    let modal = new bootstrap.Modal(document.getElementById('exLargeModalMultiUpdateAsset'));
    modal.show();

    $.ajax({
        url: "{{ route('assets.bulk-fetch') }}?_t=" + new Date().getTime(),
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            asset_ids: assetIds
        },
        success: function(response) {
            if (response.status && response.assets) {
                selectedAssetIds = assetIds;
                editedData = JSON.parse(JSON.stringify(response.assets));
                originalData = JSON.parse(JSON.stringify(response.assets));
                visibleFields = null; // Reset to show all columns
                $('#selectedCountBadge').text(`${selectedAssetIds.length} assets selected`);
                renderBulkUpdateGrid();
                hasUnsavedChanges = false;
                $('#unsavedBadge').hide();
                $('#btnSaveBulkUpdate').prop('disabled', true);
            } else {
                showToast('Failed to load assets', 'error');
            }
        },
        error: function(xhr) {
            showToast('Error loading assets: ' + xhr.statusText, 'error');
        }
    });
});

// Render the grid
function renderBulkUpdateGrid() {
    const allFields = [
        { key: 'asset_name', label: 'Asset Name', required: true },
        { key: 'category', label: 'Category' },
        { key: 'sub_category', label: 'Sub Category' },
        { key: 'location', label: 'Location' },
        { key: 'sub_location', label: 'Sub Location' },
        { key: 'status', label: 'Status' },
        { key: 'condition', label: 'Condition' },
        { key: 'brand', label: 'Brand' },
        { key: 'model', label: 'Model' },
        { key: 'description', label: 'Description' },
        { key: 'serial_no', label: 'Serial No' },
        { key: 'vendor_name', label: 'Vendor' },
        { key: 'asset_po_number', label: 'PO Number' },
        { key: 'invoice_date', label: 'Invoice Date' },
        { key: 'purchase_date', label: 'Purchase Date' },
        { key: 'purchase_price', label: 'Purchase Price' },
        { key: 'department', label: 'Department' },
        { key: 'allotted_upto', label: 'Allotted Upto' },
        { key: 'remarks', label: 'Remarks' },
        { key: 'insurance_start_date', label: 'Insurance Start' },
        { key: 'insurance_end_date', label: 'Insurance End' },
        { key: 'warranty_start_date', label: 'Warranty Start' },
        { key: 'warranty_end_date', label: 'Warranty End' }
    ];

    let fieldsToShow = allFields;
    if (visibleFields && visibleFields.length > 0) {
        fieldsToShow = allFields.filter(f => f.required || visibleFields.includes(f.key));
    }

    let headerHtml = '<th class="first-col">#</th><th class="second-col">Asset Code</th>';
    fieldsToShow.forEach(f => { headerHtml += `<th>${f.label}</th>`; });
    $('#bulkUpdateHeaderRow').html(headerHtml);

    let html = '';
    editedData.forEach((asset, index) => {
        html += `<tr data-row-index="${index}">
            <td class="first-col">${index + 1}</td>
            <td class="second-col">${asset.asset_code || ''}</td>`;
        fieldsToShow.forEach(f => {
            let value = asset[f.key] || '';
            if (f.key === 'is_self_owned') value = asset[f.key] ? 'Yes' : 'No';
            html += `<td class="editable-cell" data-field="${f.key}">${value}</td>`;
        });
        html += `</tr>`;
    });
    $('#bulkUpdateBody').html(html);
}

// Field selection popup
$('#btnSelectFields').on('click', function() {
    let fields = [
        { key: 'asset_name', label: 'Asset Name (Required)', required: true },
        { key: 'category', label: 'Category' },
        { key: 'location', label: 'Location' },
        { key: 'status', label: 'Status' },
        { key: 'condition', label: 'Condition' },
        { key: 'brand', label: 'Brand' },
        { key: 'vendor_name', label: 'Vendor' },
        { key: 'purchase_price', label: 'Purchase Price' },
        { key: 'department', label: 'Department' }
    ];

    let html = `
        <div id="fieldSelectionPopup" class="dropdown-popup-overlay" style="z-index:10000;">
            <div class="dropdown-popup" style="width:350px;">
                <div class="dropdown-popup-header">
                    <h6>Select Fields to Display</h6>
                    <button type="button" class="btn-close" onclick="$('#fieldSelectionPopup').remove();"></button>
                </div>
                <div class="dropdown-popup-body">
                    ${fields.map(f => `
                        <div class="form-check">
                            <input class="form-check-input field-checkbox" type="checkbox" value="${f.key}" id="field_${f.key}" ${f.required ? 'checked' : ''}>
                            <label class="form-check-label" for="field_${f.key}">${f.label}</label>
                        </div>
                    `).join('')}
                </div>
                <div class="dropdown-popup-footer">
                    <div class="btn-group me-auto">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('.field-checkbox').prop('checked', true);">Select All</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('.field-checkbox').prop('checked', false); $('.field-checkbox').first().prop('checked', true);">Clear All</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="$('#fieldSelectionPopup').remove();">Cancel</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="applyFieldSelection()">Apply</button>
                </div>
            </div>
        </div>
    `;
    $('body').append(html);
    $('#fieldSelectionPopup').fadeIn(150);
});

window.applyFieldSelection = function() {
    visibleFields = $('.field-checkbox:checked').map(function() { return $(this).val(); }).get();
    $('#fieldSelectionPopup').remove();
    showToast(`Showing ${visibleFields.length} columns. Refreshing grid...`, 'success');
    renderBulkUpdateGrid();
};

// Save button
$('#btnSaveBulkUpdate').on('click', function() {
    $(this).blur();
    $('#exLargeModalMultiUpdateAsset .modal-body').focus();

    let changes = [];
    editedData.forEach((asset, index) => {
        let assetChanges = {};
        Object.keys(asset).forEach(field => {
            let oldVal = originalData[index][field];
            let newVal = asset[field];
            if (newVal !== oldVal) {
                assetChanges[field] = { old: oldVal, new: newVal };
            }
        });
        if (Object.keys(assetChanges).length > 0) {
            changes.push({ asset_id: asset.id || asset.asset_code, changes: assetChanges });
        }
    });

    if (changes.length === 0) {
        showToast('No changes to save', 'info');
        return;
    }

    isSavingBulkUpdate = true;
    $('[data-bs-target="#exLargeModalMultiUpdateAsset"]').prop('disabled', true);
    $('#btnSaveBulkUpdate').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Saving...');

    $.ajax({
        url: "{{ route('assets.bulkUpdate') }}",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            changes: changes
        },
        success: function(response) {
            if (response.status) {
                showToast(response.message, 'success');
                hasUnsavedChanges = false;
                $('#unsavedBadge').hide();
                $('#btnSaveBulkUpdate').prop('disabled', true).html('Save Changes');
                $('.row-changed').removeClass('row-changed');
                originalData = JSON.parse(JSON.stringify(editedData));

                setTimeout(function() {
                    let modalEl = document.getElementById('exLargeModalMultiUpdateAsset');
                    let modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                    setTimeout(function() {
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }, 350);
                }, 1500);

                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                showToast(response.message || 'Failed to save', 'error');
                $('#btnSaveBulkUpdate').prop('disabled', false).html('Save Changes');
                isSavingBulkUpdate = false;
                $('[data-bs-target="#exLargeModalMultiUpdateAsset"]').prop('disabled', false);
            }
        },
        error: function(xhr) {
            showToast('Save failed: ' + (xhr.responseJSON?.message || xhr.statusText), 'error');
            $('#btnSaveBulkUpdate').prop('disabled', false).html('Save Changes');
            isSavingBulkUpdate = false;
            $('[data-bs-target="#exLargeModalMultiUpdateAsset"]').prop('disabled', false);
        }
    });
});
 
    });
</script>
@endsection



