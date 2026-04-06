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
                        <button type="button" class="btn btn-icon btn-dark" data-bs-toggle="modal"
                            data-bs-target="#exLargeModalAddWidget">
                            <span class="tf-icons bx bx-bar-chart-alt-2"></span>
                        </button>
                        <button type="button" class="btn btn-icon btn-warning">
                            <span class="tf-icons bx bx-export"></span>
                        </button>
                        <button type="button" class="btn btn-icon btn-danger">
                            <span class="tf-icons bx bx-refresh"></span>
                        </button>
                        <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons bx bx-grid-alt"></span>
                        </button>
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
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#exLargeModalAssetTraf">
                        <span class="tf-icons bx bx-transfer-alt"></span>&nbsp; Asset Transfer
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#exLargeModalAssetDisposal">
                        <span class="tf-icons bx bx-trash"></span>&nbsp; Discard or Sell
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#exLargeModalUpdateAsset">
                        <span class="tf-icons bx bx-edit"></span>&nbsp; Update Asset
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#exLargeModalScheduleActivity">
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

                            <th data-column="2"class="default-extra">Image</th>
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
                            <th data-column="15"class="additional-extra">Model</th>
                            <th data-column="16"class="additional-extra">Linked Asset</th>
                            <th data-column="17"class="additional-extra">Description</th>
                            <th data-column="18"class="additional-extra">Serial No</th>
                            <th data-column="19"class="additional-extra">Upload Files</th>

                            <th data-column="20"class="purchase-extra">Vendor Name</th>
                            <th data-column="21"class="purchase-extra">PO Number</th>
                            <th data-column="22"class="purchase-extra">Invoice Date</th>
                            <th data-column="23"class="purchase-extra">Invoice No</th>
                            <th data-column="24"class="purchase-extra">Purchase Date</th>
                            <th data-column="25"class="purchase-extra">Purchase Price</th>
                            <th data-column="26"class="purchase-extra">Self Owned / Partner</th>
                            <th data-column="27"class="purchase-extra">Partner</th>

                            <th data-column="28"class="financial-extra">Capitalization Price</th>
                            <th data-column="29"class="financial-extra">End of Life</th>
                            <th data-column="30"class="financial-extra">Capitalization Date</th>
                            <th data-column="31"class="financial-extra">Depreciation %</th>
                            <th data-column="32"class="financial-extra">Accumulated Depreciation</th>
                            <th data-column="33"class="financial-extra">Scrap Value</th>
                            <th data-column="34"class="financial-extra">Income Tax Dep%</th>



                            <th data-column="1"class="allotted-extra">Department</th>
                            <th data-column="1"class="allotted-extra">Transferred To</th>
                            <th data-column="1"class="allotted-extra">Allotted Upto</th>
                            <th data-column="1"class="allotted-extra">Remarks</th>

                            <th data-column="1"class="warranty-extra">AMC Vendor</th>
                            <th data-column="1"class="warranty-extra">Warranty Vendor</th>
                            <th data-column="1"class="warranty-extra">Insurance Start Date</th>
                            <th data-column="1"class="warranty-extra">Insurance End Date</th>
                            <th data-column="1"class="warranty-extra">AMC Start Date</th>

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
                        @foreach($asset_data as $asset_datas) <tr data-asset-name="Asset" data-asset-code="AST00">

                            <td>
                                <input type="checkbox" class="asset-checkbox">
                            </td>

                            <td>
                                <a href="" class="text-primary"><i class="bx bx-show" class="text-primary"></i></a>
                                <a href="" class="text-primary"><i class="bx bx-edit"></i></a>
                                <a href="" class="text-primary"><i class="bx bx-dots-vertical-rounded"></i></a>
                            </td>

                            <td data-column="1">{{ $asset_datas->asset_name}}</td>

                            <!-- Default -->
                            <td class="default-extra" data-column="2">
                                <img src="{{ asset('storage/' . $asset_datas->asset_image) }}"  height="50" width="50" alt="Asset Image">
                            </td>
                            <td data-column="3" class="default-extra">{{ $asset_datas->asset_code}}</td>
                            <td data-column="4" class="default-extra">{{ $asset_datas->category->name}}</td>
                            <td data-column="5" class="default-extra">{{ $asset_datas->created_at}}</td>
                            <td data-column="1" class="default-extra">HO</td>
                            <td data-column="1" class="default-extra">Admin</td>
                            <td data-column="1" class="default-extra">Active</td>
                            <td data-column="1" class="default-extra">2025-01-02</td>
                            <td data-column="1" class="default-extra">{{ $asset_datas->location->name}}</td>
                            <td data-column="1" class="default-extra">2025-01-03</td>
                            <td data-column="1" class="default-extra">User</td>
                            <td data-column="1" class="default-extra">{{ $asset_datas->brand}}</td>

                            <!-- Additional -->
                            <td data-column="1" class="additional-extra">{{ $asset_datas->additionalInfo->brand}}</td>
                            <td data-column="1" class="additional-extra">{{ $asset_datas->additionalInfo->model}}</td>
                            <td data-column="1" class="additional-extra">Linked Asset</td>
                            <td data-column="1" class="additional-extra">{{ $asset_datas->additionalInfo->description}}</td>
                            <td data-column="1" class="additional-extra">{{ $asset_datas->additionalInfo->serial_no}}</td>
                            <td data-column="1" class="additional-extra">Upload Files</td>

                            <!-- Purchase -->
                            <td data-column="1" class="purchase-extra">-</td>
                            <td data-column="1" class="purchase-extra">{{ $asset_datas->purchaseInfo->asset_po_number}}</td>
                            <td data-column="1" class="purchase-extra">{{ $asset_datas->purchaseInfo->invoice_date}}</td>
                            <td data-column="1" class="purchase-extra">{{ $asset_datas->purchaseInfo->invoice_no}}</td>
                            <td data-column="1" class="purchase-extra">{{ $asset_datas->purchaseInfo->purchase_date}}</td>
                            <td data-column="1" class="purchase-extra">{{ $asset_datas->purchaseInfo->purchase_price}}</td>
                            <td data-column="1" class="purchase-extra">
                                <select>
                                    <option>None</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </td>
                            <td data-column="1" class="purchase-extra">Partner</td>


                            {{-- //financial data --}}
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->capitalization_price}}</td>
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->end_of_life}}</td>
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->capitalization_date}}</td>
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->depreciation_percent}}</td>
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->accumulated_depreciation}}</td>
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->scrap_value}}</td>
                            <td data-column="1" class="financial-extra">{{ $asset_datas->finacialInfos->income_tax_depreciation_percent}}</td>

                            {{-- //allotted data --}}
                            <td data-column="1" class="allotted-extra">{{ $asset_datas->assetallotedInfos->department ?? ''}}</td>
                            <td data-column="1" class="allotted-extra">{{ $asset_datas->assetallotedInfos->transferred_to ?? ''}}</td>
                            <td data-column="1" class="allotted-extra">{{ $asset_datas->assetallotedInfos->allotted_upto ?? ''}}</td>
                            <td data-column="1" class="allotted-extra">{{ $asset_datas->assetallotedInfos->remark ?? ''}}t</td>

                            {{--  // warranty data --}}
                            <td data-column="1" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->amc_vendor ?? ''}}</td>
                            <td data-column="1" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->warranty_vendor  ?? ''}}</td>
                            <td data-column="1" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->insurance_start_date ?? ''}}</td>
                            <td data-column="1" class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->insurance_start_end ?? ''}}</td>
                            <td class="warranty-extra">{{ $asset_datas->assetwarrantyInfos->amc_start_date ?? ''}}</td>

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
                                <label class="col-sm-2 col-form-label" for="asset_name">View Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="view_name" class="form-control force-validate" id="asset_name"
                                        placeholder="Enter Asset Name" />
                                </div>
                                <label class="col-sm-2 col-form-label" for="asset_name">Columns</label>
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
                                 <label class="col-sm-2 col-form-label" for="asset_name">Role Name</label>
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
                <div class="modal-body">
                    <!-- Responsive Table -->
                        <div class="card">
                            <h6 class="card-header">Details</h6>
                            <div class="table-responsive text-nowrap mb-5">
                                <table class="table">
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                        <td>Table cell</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label" for="asset_name">New Location</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="asset_name"
                                        placeholder="Enter Asset Name" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label" for="asset_name">Transfer Status</label>
                                <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label class="col-sm-2 col-form-label" for="asset_name">Asset Name</label>
                                <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="asset_name">Remark</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="asset_name"
                                        placeholder="Enter Asset Name" />
                                </div>
                            </div>
                            <div class="row mb-3 mx-2 align-items-center">
                                <label class="col-sm-2 col-form-label">Upload Files</label>
                                <div class="col-sm-4">
                                    <label class="btn btn-primary mb-0">
                                        <i class="bx bx-upload me-1"></i> Upload File
                                        <input type="file" hidden>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <!--/ Responsive Table -->
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

    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>


    <!-- Extra Large Asset Disposal Modal -->
    <div class="modal fade" id="exLargeModalAssetDisposal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Asset Disposal Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <h6 class="card-header">Section 1</h6>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset Code</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Sold value</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                            <label class="col-sm-2 col-form-label" >Purchase Price</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Price Difference</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Remark</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                            <label class="col-sm-2 col-form-label" >Net Book Value(Current date)</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Location</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
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
                        <h6 class="card-header">Section 2</h6>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset Code</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Sold value</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                            <label class="col-sm-2 col-form-label" >Purchase Price</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Price Difference</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Remark</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                            <label class="col-sm-2 col-form-label" >Net Book Value(Current date)</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="full_name_icon">
                                        <i class="bx bx-rupee"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        id="full_name"
                                        aria-label="Full Name"
                                        aria-describedby="full_name_icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Location</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
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
                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label" for="asset_name">Reason</label>
                        <div class="col-sm-4">
                                <select id="country" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                </select>
                        </div>
                    </div>
                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label" for="asset_name">Discard Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="asset_name"
                                placeholder="Enter Asset Name" />
                        </div>
                        <label class="col-sm-2 col-form-label" for="asset_name">Vendor Name</label>
                        <div class="col-sm-4">
                                <select id="country" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                </select>
                        </div>
                    </div>
                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label" for="asset_name">Remarks</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="asset_name" />
                        </div>
                    </div>
                    <div class="row mb-3 mx-2">
                        <label class="col-sm-2 col-form-label" for="asset_name">Tax Group</label>
                        <div class="col-sm-4">
                                <select id="country" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Upload Files</label>
                        <div class="col-sm-4">
                            <label class="btn btn-primary mb-0">
                                <i class="bx bx-upload me-1"></i> Upload File
                                <input type="file" hidden>
                            </label>
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

    <!-- Extra Large Schedule Activity -->
    <div class="modal fade" id="exLargeModalScheduleActivity" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Schedule Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_name">Location</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" >Activity Type</label>
                            <div class="col-sm-4">
                                <select class="form-select multiselect">
                                    <option value="">Select Option</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label" >Description</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />   
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset Category</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">User group</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Upload Files</label>
                            <div class="col-sm-4">
                                <label class="btn btn-primary mb-0">
                                    <i class="bx bx-upload me-1"></i> Upload File
                                    <input type="file" hidden>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Assigned To</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Occurs</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_name">Start Date</label>
                            {{-- <small>First activity's due date will be the start date of the schedule</small> --}}
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Activity Reminders</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_name">End Date</label>
                            {{-- <small>First activity's due date will be the start date of the schedule</small> --}}
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Email Based On</label>
                            <div class="col-sm-4">
                                    <select id="country" class="select2 form-select">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Grace/Execution Period Before</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">Grace/Execution Period After</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_name">CC</label>
                            <div class="col-sm-4">
                                <select id="country" class="select2 form-select">
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
                        <div id="accordionFour" class="accordion-collapse collapse" data-bs-parent="#accordionActivityDetails">
                            <div class="accordion-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Vendor Name </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="asset_name" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Amount</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="full_name_icon">
                                                <i class="bx bx-rupee"></i>
                                            </span>
                                            <input
                                                type="text"
                                                name="full_name"
                                                class="form-control"
                                                id="full_name"
                                                aria-label="Full Name"
                                                aria-describedby="full_name_icon"
                                            />
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
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
                                            <form>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="asset_name">Asset Name</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="asset_name"
                                                            placeholder="Enter Asset Name" />
                                                    </div>
                                                    <label class="col-sm-2 col-form-label" >Asset Image</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="file" id="asset_image" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Asset
                                                        Code</label>
                                                    <div class="col-sm-4">
                                                        <div class="form-text">Leave blank to auto-generate. System generated code
                                                            formats can be setup from Advanced settings</div>
                                                        <input type="text" class="form-control" id="basic-default-company"
                                                            placeholder="ACME Inc." />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Category</label>
                                                    <div class="col-sm-4">
                                                        <select id="country" class="select2 form-select">
                                                            <option value="">Select</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Brazil">Brazil</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exLargeModalCategory">
                                                            &#43;
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Location</label>
                                                    <div class="col-sm-4">
                                                        <select id="country" class="select2 form-select">
                                                            <option value="">Select</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Canada">Canada</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exLargeModalLocation">
                                                            &#43;
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
                                                    <div class="col-sm-4">
                                                        <select id="country" class="select2 form-select">
                                                            <option value="">Select</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Canada">Canada</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exLargeModalStatus">
                                                            &#43;
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="asset_name">Asset Name</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="asset_name"
                                                            placeholder="Enter Asset Name" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label" for="asset_name">CWIP Invoice Id</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="asset_name"
                                                            placeholder="Enter Asset Name" />
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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Condition</label>
                                                <div class="col-sm-4">
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="Canada">Canada</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Brand</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Model</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Link Asset</label>
                                                <div class="col-sm-4">
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="Canada">Canada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Description</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Serial No</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Upload Files</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="file" id="asset_image" />
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
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Link Asset</label>
                                                <div class="col-sm-4">
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="Canada">Canada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Invoice Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Invoice No</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Purchase Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" >Purchase Price</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="full_name_icon">
                                                            <i class="bx bx-rupee"></i>
                                                        </span>
                                                        <input
                                                            type="text"
                                                            name="full_name"
                                                            class="form-control"
                                                            id="full_name"
                                                            placeholder="Enter Full Name"
                                                            aria-label="Full Name"
                                                            aria-describedby="full_name_icon"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Self Owned / Partner</label>
                                                <div class="col-sm-4">
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault" />
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Default switch
                                                            checkbox input</label>
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
                                                            name="full_name"
                                                            class="form-control"
                                                            id="full_name"
                                                            placeholder="Enter Full Name"
                                                            aria-label="Full Name"
                                                            aria-describedby="full_name_icon"
                                                        />
                                                    </div>
                                                </div> 
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">End Of Life</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Capitalization Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Depreciation%</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
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
                                                            name="full_name"
                                                            class="form-control"
                                                            id="full_name"
                                                            placeholder="Enter Full Name"
                                                            aria-label="Full Name"
                                                            aria-describedby="full_name_icon"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" >Scrap Value</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Income Tax
                                                    Depreciation%</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
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
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Transferred
                                                    To</label>
                                                <div class="col-sm-4">
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Allotted Upto</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Remarks</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC Vendor</label>
                                                <div class="col-sm-4">
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty
                                                    Vendor</label>
                                                <div class="col-sm-4">
                                                    <select id="country" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Insurance Start
                                                    Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Insurance End
                                                    Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC Start
                                                    Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty End
                                                    Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC End Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty Start
                                                    Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC End Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty Start
                                                    Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4 justify-content-start">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
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
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('section-js')
<script>
    $(document).ready(function () {

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

        $(document).on('change', '#viewSelect', function () {

            let viewId = $(this).val();

            if (!viewId) {
                // show all columns if nothing selected
                $('[data-column]').show();
                return;
            }

            $.ajax({
                url: "{{ url('custom-view') }}/" + viewId,
                type: "GET",

                success: function (response) {

                    let selectedColumns = response.columns; // [1,2,3]
                    console.log(selectedColumns);
                    // Hide all first
                    $('[data-column]').hide();

                    // Show only selected
                    selectedColumns.forEach(function (colId) {
                        $('[data-column="'+colId+'"]').show();
                    });

                },

                error: function () {
                    showToast('Failed to load view', 'error');
                }
            });

        });

    });
</script>
@endsection



