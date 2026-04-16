@extends('layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Asset Details</h4>
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
                                    Details
                                </button>
                            </h2>
                            <div id="accordionOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Asset Name</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->asset_name }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Asset Image</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="file" name="image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Asset
                                            Code</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->asset_code }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Category <span
                                                style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->category->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Sub Category <span
                                                style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                             <p>{{ $asset->subCategories }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Location <span
                                                style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="location_id" name="location" class="form-select">
                                                <option value="">Select</option>
                                                
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
                                        <label class="col-sm-2 col-form-label">Sub Location <span
                                                style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select class="form-select" name="sub_location_id" id="sub_location_id">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Status <span
                                                style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="status_id" name="status" class=" form-select">
                                                <option value="">Select Status</option>
                                               
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
                                        <label class="col-sm-2 col-form-label">CWIP Invoice Id</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" placeholder="" name="cwip_invoice_id"
                                                id="cwip_invoice_id" />
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
                                    data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
                                    Additional Information
                                </button>
                            </h2>
                            <div id="accordionTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Condition</label>
                                        <div class="col-sm-4">
                                            <select id="condition" name="condition" class=" form-select force-validate">
                                                <option value="">Select</option>
                                                <option value="damaged">Damaged</option>
                                                <option value="good">Good</option>
                                                <option value="poor">Poor</option>
                                                <option value="new">New</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Brand</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="brand" id="brand" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Model</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="model" id="model" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Link Asset</label>
                                        <div class="col-sm-4">
                                            <select id="link_asset" class="select2 form-select" name="link_asset[]"
                                                multiple>
                                                <option></option>
                                                
                                            </select>
                                            <small class="form-text">The selected assets will be linked to this asset. The
                                                selected assets
                                                are the child assets and this will be the parent asset</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="description"
                                                id="description" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Serial No</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="serial_no"
                                                id="serial_no" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label">Upload Files</label>
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
                                            </div> --}}
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
                            <div id="accordionThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Vendor Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="vendor_name"
                                                id="vendor_name" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Po Number</label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text" id="po_number"
                                                name="po_number" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Invoice Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="invoice_date" type="date"
                                                id="invoice_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Invoice No</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="invoice_no" type="text"
                                                id="invoice_no" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Purchase Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" name="purchase_date"
                                                id="purchase_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Purchase Price</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="full_name_icon">
                                                    <i class="bx bx-rupee"></i>
                                                </span>
                                                <input type="text" name="purchase_price" class="form-control"
                                                    id="purchase_price" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Self Owned / Partner</label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="is_self_owned" />
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
                            <div id="accordionFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Capitalization Price</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="full_name_icon">
                                                    <i class="bx bx-rupee"></i>
                                                </span>
                                                <input type="text" name="capitalization_price" class="form-control"
                                                    id="capitalization_price" />
                                            </div>
                                        </div>
                                        <label class="col-sm-2 col-form-label">End Of Life</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" id="end_of_life"
                                                name="end_of_life" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Capitalization Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" name="capitalization_date"
                                                id="capitalization_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Depreciation%</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="depreciation"
                                                id="depreciation" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Accumulated
                                            Depreciation</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="full_name_icon">
                                                    <i class="bx bx-rupee"></i>
                                                </span>
                                                <input type="text" name="accumulated_depreciation"
                                                    class="form-control" id="accumulated_depreciation" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Scrap Value</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="scrap_value"
                                                id="scrap_value" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Income Tax
                                            Depreciation%</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="income_tax_depreciation"
                                                name="income_tax_depreciation" />
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
                            <div id="accordionFive" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"
                                            for="basic-default-phone">Department</label>
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
                                        <label class="col-sm-2 col-form-label">Allotted Upto</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" name="allotted_upto"
                                                id="allotted_upto" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Remarks</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="remarks" id="remarks" />
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
                            <div id="accordionSix" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">AMC Vendor</label>
                                        <div class="col-sm-4">
                                            <select id="amc_vendor" name="amc_vendor" class="form-select">
                                                <option value="">Select</option>
                                                <option value="amc_imc">Acme Inc.(S00081)</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Warranty
                                            Vendor</label>
                                        <div class="col-sm-4">
                                            <select id="warranty_vendor" name="warranty_vendor" class="form-select">
                                                <option value="">Select</option>
                                                <option value="warranty_vendor">Acme Inc.(S00081)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Insurance Start
                                            Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="insurance_start_date" type="date"
                                                id="insurance_start_date" name="insurance_start_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Insurance End
                                            Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="insurance_end_date"
                                                id="insurance_end_date" name="insurance_end_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">AMC Start
                                            Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" id="amc_start_date"
                                                name="amc_start_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Warranty End
                                            Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" id="warranty_end_date"
                                                name="warranty_end_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">AMC End Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" name="amc_end_date"
                                                id="amc_end_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label">Warranty Start
                                            Date</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="date" name="warranty_start_date"
                                                id="warranty_start_date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
@endsection
