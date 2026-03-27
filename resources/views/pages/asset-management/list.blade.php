@extends('layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Assets List</h4>
        <!-- Basic Bootstrap Table -->
        <!-- Bordered Table -->
        <div class="card">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h5 class="card-header">Assets List</h5>
                </div>
                <div class="col-sm-3 my-auto">
                    <select class="form-select ">
                        <option value="">Select Option</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div>
                <div class="col-sm-3 my-auto">
                    <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#exLargeModaldefaultview">
                        <span class="tf-icons bx bx-plus"></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-dark" data-bs-toggle="modal" data-bs-target="#exLargeModalAddWidget">
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
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalAddGenerateSticker">
                            <span class="tf-icons bx bx-barcode"></span>&nbsp; Generated Stickers
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalAssetTraf">
                            <span class="tf-icons bx bx-transfer-alt"></span>&nbsp; Asset Transfer
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalAssetDisposal">
                            <span class="tf-icons bx bx-trash"></span>&nbsp; Discard or Sell
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalUpdateAsset">
                            <span class="tf-icons bx bx-edit"></span>&nbsp; Update Asset
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalScheduleActivity">
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
              </tr>
 
              <!-- COLUMN HEADER -->
              <tr>
                  <th>Asset Name</th>
 
                  <th class="default-extra">Image</th>
                  <th class="default-extra">Code</th>
                  <th class="default-extra">Category</th>
                  <th class="default-extra">Created</th>
                  <th class="default-extra">Location</th>
                  <th class="default-extra">Created By</th>
                  <th class="default-extra">Status</th>
                  <th class="default-extra">Scan Date</th>
                  <th class="default-extra">Scan By</th>
                  <th class="default-extra">Modified</th>
                  <th class="default-extra">Modified By</th>
                  <th class="default-extra">Parent</th>
 
                  <th class="additional-extra">Brand</th>
                  <th class="additional-extra">Model</th>
                  <th class="additional-extra">Linked Asset</th>
                  <th class="additional-extra">Description</th>
                  <th class="additional-extra">Serial No</th>
                  <th class="additional-extra">Upload Files</th>
 
                  <th class="purchase-extra">Vendor Name</th>
 
                  <th class="purchase-extra">PO Number</th>
                  <th class="purchase-extra">Invoice Date</th>
                  <th class="purchase-extra">Invoice No</th>
                  <th class="purchase-extra">Purchase Date</th>
                  <th class="purchase-extra">Purchase Price</th>
                  <th class="purchase-extra">Self Owned / Partner</th>
                  <th class="purchase-extra">Partner</th>
 
                  <th>Condition</th>
                <th>Model</th>
              </tr>
 
              <!-- FILTER -->
              <tr>
                  @for ($i = 0; $i < 29; $i++)
                  <th>
                      <div class="filter-box">
                          <input type="text">
                          <i class='bx bx-filter filter-icon'></i>
                      </div>
                  </th>
                  @endfor
              </tr>
          </thead>
 
          <tbody>
              @for($i=1; $i<=3; $i++)
              <tr>
                  <td><input type="checkbox"></td>
                  <td>👁️ ✏️ ⋮</td>
 
                  <td>Asset {{$i}}</td>
 
                  <td class="default-extra"><img src="https://dummyimage.com/40x40/000/fff"></td>
                  <td class="default-extra">AST00{{$i}}</td>
                  <td class="default-extra">Plant</td>
                  <td class="default-extra">2025-01-01</td>
                  <td class="default-extra">HO</td>
                  <td class="default-extra">Admin</td>
                  <td class="default-extra">Active</td>
                  <td class="default-extra">2025-01-02</td>
                  <td class="default-extra">User</td>
                  <td class="default-extra">2025-01-03</td>
                  <td class="default-extra">User</td>
                  <td class="default-extra">Parent</td>
 
                  <td class="additional-extra">Apple</td>
                  <td class="additional-extra">Macbook Air M3</td>
                  <td class="additional-extra">Linked Asset</td>
                  <td class="additional-extra">Description</td>
                  <td class="additional-extra">Serial No</td>
                  <td class="additional-extra">Upload Files</td>
 
                  <td class="purchase-extra">-</td>
 
                  <td class="purchase-extra">PO Number</td>
                  <td class="purchase-extra">Invoice Date</td>
                  <td class="purchase-extra">Invoice No</td>
                  <td class="purchase-extra">Purchase Date</td>
                  <td class="purchase-extra">Purchase Price</td>
                  <td class="purchase-extra"><select><option>None</option><option>Yes</option><option>No</option></select></td>
                  <td class="purchase-extra">Partner</td>
 
                  <td>Good</td>
                  <td>Dell</td>
              </tr>
              @endfor
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
                                <input type="text" class="form-control" id="asset_name"
                                    placeholder="Enter Asset Name" />
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_name">Columns</label>
                            <div class="col-sm-4">
                                <select class="form-select multiselect">
                                    <option value="">Select Option</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_image">Set as a default view?</label>
                            <div class="col-sm-4 mx-auto">
                                <div class="form-check form-switch">
                                    yes<input class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckDefault" />  
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-2">
                            <label class="col-sm-2 col-form-label" for="asset_image">Private View</label>
                            <div class="col-sm-4 mx-auto">
                                <div class="form-check form-switch">
                                    yes<input class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckDefault" />  
                                </div>
                            </div>
                           <label class="col-sm-2 col-form-label" for="asset_name">Role Name</label>
                            <div class="col-sm-4">
                                <select class="form-select multiselect">
                                    <option value="">Select Option</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Sold value</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Purchase Price</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Price Difference</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Net Book Value(Current date)</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Sold value</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Purchase Price</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Price Difference</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Net Book Value(Current date)</label>
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
                            <label class="col-sm-2 col-form-label" for="asset_image">Activity Type</label>
                            <div class="col-sm-4">
                                <select class="form-select multiselect">
                                    <option value="">Select Option</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label" for="asset_image">Description</label>
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
                                    <label class="col-sm-2 col-form-label" for="asset_image">Vendor Name </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="asset_name" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="asset_image">Amount</label>
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
                                                    <label class="col-sm-2 col-form-label" for="asset_image">Asset Image</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Brand</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="asset_image">Model</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Description</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="asset_image">Serial No</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="asset_image">Upload Files</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Vendor Name</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Invoice Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="asset_image">Invoice No</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="asset_image">Purchase Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="asset_image">Purchase Price</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Self Owned / Partner</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Capitalization Price</label>
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Capitalization Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="date" id="asset_image" />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Depreciation%</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="asset_image" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="asset_image">Accumulated
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
                                                <label class="col-sm-2 col-form-label" for="asset_image">Scrap Value</label>
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



