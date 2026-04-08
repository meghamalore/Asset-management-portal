@extends('layouts.master')
@section('section-css')
<style>
.select2-container--default .select2-selection--single {
    height: 38px;
    padding: 6px 12px;
    border: 1px solid #d9dee3;
    border-radius: 0.375rem;
    display: flex;
    align-items: center;
}

.select2-container--default .select2-selection__rendered {
    color: #697a8d;
    line-height: normal;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
    right: 10px;
}

.select2-container--default .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    display: none;
}

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #696cff;
    box-shadow: 0 0 0 0.15rem rgba(105, 108, 255, 0.25);
}
#toastContainer {
    z-index: 9999 !important;
}

/* Fix input height */
.input-group .form-control {
    height: 38px;
}

/* Keep alignment */
.input-group {
    flex-wrap: nowrap;
}

/* Error spacing */
.invalid-feedback {
    font-size: 12px;
    margin-top: 4px;
}

/* select2 css for status page  */

#exLargeModalStatus .accordion-body {
        overflow: visible;
        position: relative;
    }

    .dropdown-container {
        display: flex;
        gap: 8px;
        position: relative;
        z-index: 1;
        overflow: visible;
    }

    .dropdown-input {
        flex: 1;
        border: 1px solid #ccc;
        padding: 6px 12px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        background: white;
        position: relative;
        z-index: 2;
    }

    .toggle-line {
        font-weight: bold;
    }

    .outside-icons {
        display: flex;
        gap: 5px;
        position: relative;
        z-index: 3;
    }

    .apply-btn {
        background: green;
        color: white;
        padding: 5px 8px;
        border-radius: 4px;
        cursor: pointer;
    }

    .clear-btn {
        background: red;
        color: white;
        padding: 5px 8px;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Higher specificity than Bootstrap .dropdown-menu so custom panel layout applies */
    .dropdown-container .dropdown-menu {
        display: none;
        position: absolute;
        top: 40px;
        left: 0;
        width: 100%;
        min-width: 12rem;
        margin: 0;
        padding: 0.5rem 0;
        background: white;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        max-height: 250px;
        overflow-y: auto;
        z-index: 2000;
        list-style: none;
    }

    .dropdown-container .children {
        padding-left: 20px;
        display: none;
    }

    .dropdown-container .dropdown-menu .parent-header {
        padding: 0.35rem 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .dropdown-container .dropdown-menu label {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.25rem 0.75rem;
        margin: 0;
        font-weight: normal;
        cursor: pointer;
    }

    .dropdown-container .dropdown-menu .toggle {
        cursor: pointer;
        user-select: none;
        width: 1.25rem;
        display: inline-block;
    }
</style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Add Asset</h4>
        <div class="row">
            <form id="assetForm">
                @csrf
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
                                            <label class="col-sm-2 col-form-label" >Asset Name <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="asset_name" class="form-control" />
                                            </div>
                                            <label class="col-sm-2 col-form-label" >Asset Image <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="file" name="asset_image" id="image"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-company">Asset Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="asset_code" id="basic-default-company" />
                                                    <small class="form-text">
                                                        Leave blank to auto-generate. System generated code
                                                        formats can be setup from Advanced settings
                                                    </small>
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#smallModals">
                                                    <i class="bx bx-barcode"></i>
                                                </button>
                                            </div> -->
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Category <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-select select2" id="category_id" name="categ_id">
                                                    <option value="">Select</option>
                                                    @foreach ($categories as $categ)
                                                    <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                                    @endforeach
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
                                            <label class="col-sm-2 col-form-label">Sub Category <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-select select2"  name="sub_category_id" id="sub_category_id">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Location <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <select id="location_id" name="location" class="form-select">
                                                    <option value="">Select</option>
                                                    @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                    @endforeach
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
                                            <label class="col-sm-2 col-form-label">Sub Location <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-select"  name="sub_location_id" id="sub_location_id">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Status <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <select id="country" name="status" class="select2 form-select">
                                                    <option value="">Select Status</option>
                                                    @foreach ($status as $statuses)
                                                    <option value="{{ $statuses->id }}">{{ $statuses->status_name }}</option>
                                                    @endforeach
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
                                            <label class="col-sm-2 col-form-label" >CWIP Invoice Id <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="cwip_invoice_id" class="form-control" />
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
                                        <label class="col-sm-2 col-form-label">Condition <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" name="condition" class=" form-select force-validate">
                                                <option value="">Select</option>
                                                <option value="damaged">Damaged</option>
                                                <option value="good">Good</option>
                                                <option value="poor">Poor</option>
                                                <option value="new">New</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Brand <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text"  name="brand" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Model <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text" name="model" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Link Asset</label>
                                        <div class="col-sm-4">
                                            <select id="link" class="select2 form-select" name="link_asset[]" multiple>
                                                @foreach($asset_list as $asset_lists)
                                                <option value="{{ $asset_lists->id }}">{{ $asset_lists->asset_name }}({{$asset_lists->asset_code}})</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text">The selected assets will be linked to this asset. The selected assets are the child assets and this will be the parent asset</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Description <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text" name="description" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Serial No </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="serial_no" />
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
                                            <select name="vendor_name" class="form-select">
                                                <option value="">Select</option>
                                                <option value="Australia">Acme Inc.</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Po Number <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text" name="po_number" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Invoice Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="invoice_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Invoice No <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text" name="invoice_no"  />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Purchase Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date"  name="purchase_date"/>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Purchase Price <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="full_name_icon">
                                                    <i class="bx bx-rupee"></i>
                                                </span>
                                                <input
                                                    type="text"
                                                    name="purchase_price"
                                                    class="form-control force-validate"
                                                    id="full_name"
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
                                                <input class="form-check-input force-validate" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="self_owned"/>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
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
                                        <label class="col-sm-2 col-form-label" >Capitalization Price <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="full_name_icon">
                                                    <i class="bx bx-rupee"></i>
                                                </span>
                                                <input
                                                    type="text"
                                                    name="capitalization_price"
                                                    class="form-control force-validate"
                                                    id="full_name"
                                                    aria-label="Full Name"
                                                />
                                            </div>
                                        </div> 
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">End Of Life <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" name="end_of_life" type="date"  />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Capitalization Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="capitalization_date"  />
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Depreciation% <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" name="depreciation" type="text"  />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Accumulated
                                            Depreciation<span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="full_name_icon">
                                                    <i class="bx bx-rupee"></i>
                                                </span>
                                                <input
                                                    type="text"
                                                    name="accumulated_dep"
                                                    class="form-control force-validate"
                                                    id="full_name"
                                                    aria-label="Full Name"
                                                    aria-describedby="full_name_icon"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Scrap Value</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text"  name="scrap_value" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Income Tax
                                            Depreciation%</label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text" name="income_tax_dep" />
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
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Department<span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" name="department" class="form-select force-validate">
                                                <option value="">Select</option>
                                                <option value="hr">HR</option>
                                                <option value="accounting">Accounting</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Transferred
                                            To<span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" name="transf_to" class="form-select force-validate">
                                                <option value="">Select</option>
                                                <option value="dust">dust</option>
                                                <option value="james_smith">James smith</option>
                                                <option value="jennifer_miller">Jennifer Miller</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Allotted Upto<span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="allotted_upto" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Remarks</label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text"  name="remark"/>
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
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC Vendor <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" name="amc_vendor" class="form-select force-validate">
                                                <option value="">Select</option>
                                                <option value="amc_inc">Acme Inc</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty
                                            Vendor <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" name="Warranty_vendor" class="form-select force-validate">
                                                <option value="">Select</option>
                                                <option value="amc_inc">Acme Inc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Insurance Start
                                            Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date"  name="insurance_start_date"/>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Insurance End
                                            Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="insurance_end_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC Start
                                            Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date"  name="amc_start_date"/>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty End
                                            Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="warranty_end_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC End Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="amc_end_date" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty Start
                                            Date <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="date" name="warranty_start_date" />
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <button type="reset" class="btn btn-danger">
                                Cancel
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>

    <!-- Extra Large Category Modal -->
    <div class="modal fade" id="exLargeModalCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Add Category</h5>
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
                                            <label class="col-sm-2 col-form-label" >Category Name <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Enter Category Name" name="parent_category_name">
                                                <select class="form-select" name="selective_category_id">
                                                    <option value="">Select Categories</option>
                                                    @foreach ($only_categories as $only_cat)
                                                    <option value="{{ $only_cat->id }}">{{ $only_cat->name }}</option> 
                                                    @endforeach
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
                                                Inventory Module <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="is_inventory" value="1"/>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Sub Category <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="category_name"
                                                    placeholder="Enter Category Name" name="sub_category_name"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Show this category
                                                assets in Linked Assets <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="is_link_asset" value="1"/>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label" >Category Code <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="category_code" name="category_code" 
                                                    placeholder="Enter Category Code" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" >Default Transfer
                                                Duration <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" 
                                                    placeholder="Enter Asset Name" name="trafs_duration"/>
                                            </div>
                                            <div class="col-sm-2">
                                                <select id="country" class="form-select" name="trafs_duration_type">
                                                    <option value="">Select</option>
                                                    <option value="day">Day(s)</option>
                                                    <option value="month">Month(s)</option>
                                                    <option value="year">Year(s)</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label" >Cascade <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                                Extend <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                        <label class="col-sm-2 col-form-label">End of Life <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                        <label class="col-sm-2 col-form-label" >Depreciation % <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text"  id="depreciation" name="depreciation"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Scrap Value <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-2">
                                            <input class="form-control force-validate" type="text" id="scrap_value" name="scrap_value"/>
                                        </div>
                                        <div class="col-sm-2">
                                        <select id="scrap_value_type" class="form-select force-validate" name="scrap_value_type">
                                            <option value="">Select</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Amount">Amount</option>
                                        </select>
                                        </div>

                                        <label class="col-sm-2 col-form-label" >Income Tax
                                            Depreciation% <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Assignee
                                                    Based On <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                                <label class="col-sm-2 col-form-label " for="basic-default-phone">User
                                                    Type <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Assignee
                                                    Role <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                <div class="col-sm-4">
                                                    <select id="assign_role" class="form-select force-validate" name="assign_role">
                                                        <option value="">Select</option>
                                                        <option value="Owner">Owner</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-default-phone">Assignee <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Activity
                                                    Type <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                <div class="col-sm-4">
                                                    <select id="activity_type" name="activity_type[]" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="Calibration">Calibration</option>
                                                        <option value="Inspection">Inspection</option>
                                                        <option value="Warranty Expiry">Warranty Expiry</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-default-phone">Occurs <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Start
                                                    Schedule After (Days) <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                <div class="col-sm-4">
                                                    <input class="form-control force-validate" type="text" name="start_schedule_after[]"  />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Activity
                                                    Reminders <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                <div class="col-sm-4">
                                                    <select id="activity_reminder" name="activity_reminder[]" class="form-select force-validate">
                                                        <option value="">Select</option>
                                                        <option value="1">One</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Schedule Based On <span style="color:#f1416c; font-size:18px;">*</span></label>
                                                <div class="col-sm-4">
                                                    <select id="schedule_based_on" class="form-select force-validate" name="schedule_based_on[]">
                                                        <option value="">Select</option>
                                                        <option value="created_date">Created Date</option>
                                                        <option value="capitalization_date">Capitalization Date</option>
                                                        <option value="Purchase_date">Purchase Date</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Custom
                                                    Days <span style="color:#f1416c; font-size:18px;">*</span></label>
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
                                        {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                        <div class="col-sm-4">
                                        </div> --}}
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                        <div class="col-sm-4">
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Category
                                            Name</label>
                                        <div class="col-sm-4">
                                            <label class=" col-form-label" for="basic-default-phone">Language</label>
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

    <!-- Extra Large Location Modal -->
    <div class="modal fade" id="exLargeModalLocation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Locations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="locationForm">
                @csrf
                <div class="modal-body">
                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionEleven" aria-expanded="true" aria-controls="accordionEleven">
                                        Location Information
                                    </button>
                                </h2>
                            <div id="accordionEleven" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Parent Location Name<span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" placeholder="Enter Location" id="parent_location_name" name="parent_location_name"/>
                                            <select class="form-select" name="selective_location_id">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Sub Location <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Sub Location" id="local_location_name" name="local_location_name"/>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Location Code <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Location Code" id="location_code" name="location_code" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Inventory Location <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="is_inventory"/>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                            </div>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Default Coordinates <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control mb-1" 
                                                placeholder="Latitude" id="latitude" name="latitude"/>
                                            <input type="text" class="form-control" 
                                                placeholder="Longitude" id="longitude" name="longitude"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Description <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="description" id="description" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" >Additional Info <span style="color:#f1416c; font-size:18px;">*</span></label>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                        <div class="col-sm-4">
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Department <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <label class=" col-form-label" for="basic-default-phone">Users<span style="color:#f1416c; font-size:18px;">*</span></label>
                                        </div>
                                    </div>
                                    <div id="addition-container-location">
                                        <div class="addition-location">
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <button type="button" id="addBtnadditional" class="btn btn-primary">
                                                        &#43;
                                                    </button>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select id="department" name="department[]" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="Accounting">Accounting</option>
                                                        <option value="human_resource">Human Resources</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select id="users" name="users[]" name class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="test">Test</option>
                                                    </select>
                                                </div>
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
                                    data-bs-target="#accordiontwell" aria-expanded="true" aria-controls="accordiontwell">
                                    Location Name Localization
                                </button>
                            </h2>
                            <div id="accordiontwell" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 col-form-label" >Location Name Localization</label>
                                        </div>
                                        <div class="row mb-3">
                                                {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                                <div class="col-sm-4">
                                                </div> --}}
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                            <div class="col-sm-4">
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Category Name <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                            <label class=" col-form-label" for="basic-default-phone">Language <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            </div>
                                        </div>
                                        <div id="addition-container-localization">
                                                <div class="addition-location-localization">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                        <button type="button" id="addBtnadditionalLocalization" class="btn btn-primary">
                                                            &#43;
                                                        </button>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <input class="form-control force-validate" type="text" id="location_name" name="location_name[]"/>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select id="language" name="language[]" class="form-select force-validate">
                                                                <option value="">Select</option>
                                                                <option value="marathi">Marathi</option>
                                                                <option value="english">English</option>
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

    <!-- Extra Large Status Modal -->
    <div class="modal fade" id="exLargeModalStatus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Add Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="statusForm">
                @csrf
                <div class="modal-body">
                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionThirteen" aria-expanded="true"
                                    aria-controls="accordionThirteen">
                                    Status Information
                                </button>
                            </h2>
                            <div id="accordionThirteen" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Status Type <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" class="form-select force-validate" name="status_type">
                                                <option value="">Select</option>
                                                <option value="allotted_status">Allotted Assets</option>
                                                <option value="unalloted_status">Unallotted Assets</option>
                                                <option value="discarded_assets">Discarded Assets</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Status Name <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <input class="form-control force-validate" type="text"  name="status_name"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Next Status <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <select id="country" class="form-select force-validate" name="next_status">
                                                <option value="">Select</option>
                                                <option value="in_use">In Use</option>
                                                <option value="lost">Lost</option>
                                                <option value="out_for_repair">Out for Repair</option>
                                                <option value="stolen">Stolen</option>
                                                <option value="write_off">Write-off</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Only visible for categories</label>
                                        <div class="col-sm-4">
                                            {{-- <select class="selectstatus2 force-validate" name="categ_id[]" multiple>

                                                @foreach($categories as $category)
                                                    <!-- Category selectable -->
                                                    <option value="cat_{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>

                                                    <!-- Subcategories -->
                                                    @foreach($category->subCategories as $sub)
                                                        <option value="sub_{{ $sub->id }}">
                                                            — {{ $sub->name }}
                                                        </option>
                                                    @endforeach

                                                @endforeach

                                            </select> --}}
                                            {{-- <div class="col-sm-4"> --}}
                                                {{-- <input type="hidden" name="categ_id[]" id="selectedCategories"> --}}
                                                <div id="hiddenCategoryInputs"></div>
                                                <div class="dropdown-container">
                                                    <!-- Input -->
                                                    <div class="dropdown-input" onclick="toggleDropdown()">
                                                        <span id="selectedText">Select Categories</span>
                                                        <span id="toggleIcon" class="toggle-line">|</span>
                                                        
                                                    </div>

                                                    <!-- Icons -->
                                                    <div class="outside-icons">
                                                        <span class="apply-btn" onclick="applySelection(event)">✔</span>
                                                        <span class="clear-btn" onclick="clearSelection(event)">✖</span>
                                                    </div>

                                                    <!-- Dropdown -->
                                                    <div class="dropdown-menu" id="dropdownMenu">
                                                        @foreach($categories as $category)
                                                        <div class="parent">
                                                            <div class="parent-header">
                                                                <span class="toggle" onclick="toggleChild(this)">▶</span>

                                                                <input type="checkbox" value="cat_{{ $category->id }}" onchange="toggleParent(this)">

                                                                {{ $category->name }}
                                                            </div>


                                                            <div class="children">
                                                                @foreach($category->subCategories as $sub)
                                                                <label>
                                                                    <input type="checkbox" value="sub_{{ $sub->id }}" onchange="toggleChildCheckbox(this)">
                                                                    {{ $sub->name }}
                                                                </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Hold/Pause Activity <span style="color:#f1416c; font-size:18px;">*</span></label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input force-validate" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="hold_pause_activity" value="1" />
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
                                    data-bs-target="#accordiontForteen" aria-expanded="true" aria-controls="accordiontForteen">
                                    Status Name Localization
                                </button>
                            </h2>
                            <div id="accordiontForteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 col-form-label" >Status Name Localization</label>
                                        </div>
                                        <div class="row mb-3">
                                                {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                                <div class="col-sm-4">
                                                </div> --}}
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                            <div class="col-sm-4">
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Status Name <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            <div class="col-sm-4">
                                            <label class=" col-form-label" for="basic-default-phone">Language <span style="color:#f1416c; font-size:18px;">*</span></label>
                                            </div>
                                        </div>
                                        <div id="addition-container-status">
                                                <div class="addition-status-localization">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                        <button type="button" id="addBtnadditionalStatusLocalization" class="btn btn-primary">
                                                            &#43;
                                                        </button>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <input class="form-control force-validate" type="text" id="localization_name" name="localization_name[]" />
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-select force-validate" id="localization_lang" name="localization_lang[]" data-placeholder="Select Location">
                                                                <option></option>
                                                                <option value="marathi">Marathi</option>
                                                                <option value="hindi">Hindi</option>
                                                                <option value="english">English</option>
                                                                <option value="Brazil">Brazil</option>
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

    <!-- Small Modal -->
    <div class="modal fade" id="smallModals" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Scan a barcode or a QR code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameSmall" class="form-label">Name</label>
                            <div class="col-sm-4 mx-auto">
                                <div class="form-check form-switch">
                                    Continues Scan<input class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckDefault" />
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
    </div>

@endsection
@section('section-js')
<script>
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


    function toggleDropdown() {
        let menu = document.getElementById('dropdownMenu');
        let icon = document.getElementById('toggleIcon');

        if (menu.style.display === 'block') {
            menu.style.display = 'none';
            icon.innerText = '|';
        } else {
            menu.style.display = 'block';
            icon.innerText = '▲';
        }
    }

    function toggleChild(el) {
        let parent = el.closest('.parent');
        let children = parent.querySelector('.children');

        if (!children) return;

        children.style.display =
            children.style.display === 'block' ? 'none' : 'block';

        el.innerText = children.style.display === 'block' ? '▼' : '▶';
    }

    function toggleParent(el) {
        let parent = el.closest('.parent');
        let children = parent.querySelectorAll('.children input');

        children.forEach(child => child.checked = el.checked);

        updateCount();
    }

    function toggleChildCheckbox(el) {
        let parent = el.closest('.parent');
        let parentCheckbox = parent.querySelector('.parent-header input');

        parentCheckbox.checked = true;

        updateCount();
    }

    //  COUNT LOGIC
    function updateCount() {
        let checked = document.querySelectorAll('#dropdownMenu input:checked');
        let text = "Select Categories";

        if (checked.length > 0) {
            text = checked.length + " selected";
        }

        document.getElementById('selectedText').innerText = text;
    }

    // ✔ Apply
    function applySelection(event) {
    if (event) event.stopPropagation(); 

    let container = document.getElementById('hiddenCategoryInputs');
    container.innerHTML = ''; // clear old inputs

    let selected = document.querySelectorAll('#dropdownMenu input:checked');

    selected.forEach(function (el) {

        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'categ_id[]';   //  THIS IS KEY
        input.value = el.value;      // cat_1 / sub_5
        input.classList.add('force-validate'); //  for validation
        container.appendChild(input);
    });

    updateCount();
    //  CLOSE DROPDOWN
    let menu = document.getElementById('dropdownMenu');
    let icon = document.getElementById('toggleIcon');

    menu.style.display = 'none';
    icon.innerText = '|';
}

    //  Clear
    function clearSelection(event) {
    event.stopPropagation();

    document.querySelectorAll('#dropdownMenu input').forEach(el => {
        el.checked = false;
    });

    document.getElementById('hiddenCategoryInputs').innerHTML = '';

    updateCount();
}

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        let dropdown = document.querySelector('.dropdown-container');
        if (dropdown && !dropdown.contains(event.target)) {
            let menu = document.getElementById('dropdownMenu');
            let icon = document.getElementById('toggleIcon');
            if (menu && icon) {
                menu.style.display = 'none';
                icon.innerText = '|';
            }
        }
    });
    $(document).ready(function () {


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

        // For Categories

        $('.select2').select2({
            placeholder: function () {
                return $(this).data('placeholder');
            },
            allowClear: true,
            width: '100%',
            dropdownAutoWidth: true
        });
        
        $('#addBtns').click(function () {
            let newSection = $('.addition:first').clone();

            newSection.find('input').val('');
            newSection.find('select').val('');

            newSection.append(`
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger removeBtn">
                            &#10006;
                        </button>
                    </div>
                </div>
            `);

            $('#addition-container').append(newSection);
        });

        $(document).on('click', '.removeBtn', function () {
            $(this).closest('.addition').remove();
        });

        $('#categoryForm').validate({

            ignore: ":hidden:not(.force-validate)",
            groups: {
                category_group: "parent_category_name selective_category_id"
            },
            rules: {
                parent_category_name: {
                    required: function () {
                        return $('[name="selective_category_id"]').val() === "";
                    }
                },
                selective_category_id: {
                    required: function () {
                        return $('[name="parent_category_name"]').val().trim() === "";
                    }
                },
                sub_category_name: {
                    required: true
                },
                is_inventory: {
                    required: true
                },
                is_link_asset: {
                    required: true
                },
                cascade: {
                    required: true
                },
                local_category_name: {
                    required: true
                },
                category_code: {
                    required: true
                },
                trafs_duration: {
                    required: true,
                    number: true
                },
                trafs_duration_type: {
                    required: true
                },
                end_of_life: {
                    required: true,
                    number: true
                },
                end_of_life_type: {
                    required: true
                },
                depreciation: {
                    required: true,
                    number: true
                },
                scrap_value: {
                    required: true,
                    number: true
                },
                scrap_value_type: {
                    required: true,
                },
                income_tax_depreciation: {
                    required: true,
                    number: true
                },
                allow_auto: {
                    required: true,
                    number: true
                },

                // Activity Schedule
                assign_based: {
                    required: true
                },
                user_type: {
                    required: true
                },
                assign_role: {
                    required: true
                },
                assignee: {
                    required: true
                },

                'activity_type[]': {
                    required: true
                },
                'occurs[]': {
                    required: true
                },
                'start_schedule_after[]': {
                    required: true,
                    number: true
                },
                'activity_reminder[]': {
                    required: true
                },
                'schedule_based_on[]': {
                    required: true
                },
                'custom_days[]': {
                    required: true,
                    number: true
                },

                // Localization
                'category_name[]': {
                    required: true
                },
                'language[]': {
                    required: true
                }
            },

            messages: {
                parent_category_name: {
                    required: "Please Enter category name or select one"
                },
                selective_category_id: {
                    required: "Select category or enter new one"
                },
                sub_category_name: {
                    required: "Please enter sub category name"
                },
                is_inventory: {
                    required: "Please slect inventory"
                },
                is_link_asset: {
                    required: "Please link asset"
                },
                cascade: {
                    required: "Please select cascade"
                },
                category_code: {
                    required: "Please enter category code"
                },
                trafs_duration: {
                    number: "Transfer duration must be a number"
                },
                trafs_duration_type: {
                    required: "Please select duration type"
                },
                end_of_life: {
                    required: "Please enter end of life",
                    number: "End of life must be a number"
                },
                end_of_life_type: {
                    required: "Please select end of life type"
                },
                depreciation: {
                    required: "Please enter depreciation",
                    number: "Depreciation must be a number"
                },
                scrap_value: {
                    required: "Please enter Scrap value",
                    number: "Scrap value must be a number"
                },
                scrap_value_type: {
                    required: "Please enter Scrap value"
                },
                income_tax_depreciation: {
                    required: "Please enter income tax depreciation",
                    number: "Income tax depreciation must be a number"
                },
                allow_auto: {
                    number: "Income tax depreciation must be a number"
                },

                // Activity Schedule
                assign_based: {
                    required: "Please select user type"
                },
                user_type: {
                    required: "Please select user type"
                },
                assign_role: {
                    required: "Please select assign role"
                },
                assignee: {
                    required: "Please select assignee"
                },

                'activity_type[]': {
                    required: "Please select activity type"
                },
                'occurs[]': {
                    required: "Please select occurs"
                },
                'start_schedule_after[]': {
                    required: "Please enter start schedule days",
                    number: "Must be a number"
                },
                'activity_reminder[]': {
                    required: "Please select activity reminder"
                },
                'schedule_based_on[]': {
                    required: "Please select schedule based on"
                },
                'custom_days[]': {
                    required: "Please enter custom days",
                    number: "Must be a number"
                },

                // Localization
                'category_name[]': {
                    required: "Please enter localized category name"
                },
                'language[]': {
                    required: "Please select language"
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
                if (element.hasClass('select2')) {
                    error.insertAfter(element.next('.select2-container'));
                }else if (element.closest('.input-group').length) {
                    error.insertAfter(element.closest('.input-group'));
                }else {
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
                url: "{{ route('categories.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                //  BEFORE SEND
                beforeSend: function () {

                    // Disable submit button
                    $('#categoryForm button[type="submit"]').prop('disabled', true);

                    // Change button text (optional)
                    $('#categoryForm button[type="submit"]').html(
                        `<span class="spinner-border spinner-border-sm me-2"></span> Saving...`
                    );
                },

                //  SUCCESS
                success: function (response) {

                    if (response.status) {
                        showToast(response.message, 'success');

                        $('#categoryForm')[0].reset();
                        $('.select2').val(null).trigger('change');

                    } else {
                        showToast(response.message, 'error');
                    }
                },

                //  ERROR
                error: function (xhr) {

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (field, messages) {
                            showToast(messages[0], 'error'); // replaced toastr 
                        });

                    } else {
                        showToast(xhr.responseJSON.message || 'Something went wrong!', 'error');
                    }
                },

                //  AFTER COMPLETE (always runs)
                complete: function () {

                    // Enable button again
                    $('#categoryForm button[type="submit"]').prop('disabled', false);

                    // Restore button text
                    $('#categoryForm button[type="submit"]').html('Submit');
                }
            });
            }
        });

        // add btn for localization
        $('#addBtnLocal').click(function () {
            let newSection = $('.addition-two:first').clone();

            newSection.find('input').val('');
            newSection.find('select').val('');

            newSection.append(`
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger removeBtnTwo">
                            &#10006;
                        </button>
                    </div>
                </div>
            `);

            $('#addition-container-two').append(newSection);
        });

        $(document).on('click', '.removeBtnTwo', function () {
            $(this).closest('.addition-two').remove();
        });

        // For Categories end

        // For Location
        //for addtion info start
        $('#addBtnadditional').click(function () {
            let newSection = $('.addition-location:first').clone();

            newSection.find('input').val('');
            newSection.find('select').val('');

            newSection.append(`
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger removeBtnadditional">
                            &#10006;
                        </button>
                    </div>
                </div>
            `);

            $('#addition-container-location').append(newSection);
        });

        $(document).on('click', '.removeBtnadditional', function () {
            $(this).closest('.addition-location').remove();
        });
        //for addtion info end

         //for localization start
        $('#addBtnadditionalLocalization').click(function () {
            let newSection = $('.addition-location-localization:first').clone();

            newSection.find('input').val('');
            newSection.find('select').val('');

            newSection.append(`
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger removeBtnadditionalLocalization">
                            &#10006;
                        </button>
                    </div>
                </div>
            `);

            $('#addition-container-localization').append(newSection);
        });

        $(document).on('click', '.removeBtnadditionalLocalization', function () {
            $(this).closest('.addition-location-localization').remove();
        });

        $('#locationForm').validate({

            ignore: ":hidden:not(.force-validate)",
            groups: {
                category_group: "parent_location_name selective_location_id"
            },
            rules: {
                parent_location_name: {
                    required: function () {
                        return $('[name="selective_location_id"]').val() === "";
                    }
                },
                selective_location_id: {
                    required: function () {
                        return $('[name="parent_location_name"]').val().trim() === "";
                    }
                },
                is_inventory: {
                    required: true
                },
                local_location_name: {
                    required: true
                },
                location_code: {
                    required: true
                },
                latitude: {
                    required: true,
                    number: true
                },
                longitude: {
                    required: true
                },
                description: {
                    required: true
                },
                'department[]': {
                    required: true
                },

                // Additional Info
                'file[]': {
                    required: true
                },
                'users[]': {
                    required: true
                },

                // Localization
                'location_name[]': {
                    required: true
                },
                'language[]': {
                    required: true
                }
            },

            messages: {
                parent_location_name: {
                    required: "Please enter parent location name"
                },
                is_inventory: {
                    required: "Please select inventory option"
                },
                local_location_name: {
                    required: "Please enter location name"
                },
                location_code: {
                    required: "Please enter location code"
                },
                latitude: {
                    required: "Please enter latitude",
                    number: "Latitude must be a number"
                },
                longitude: {
                    required: "Please enter longitude",
                    number: "Longitude must be a number"
                },
                description: {
                    required: "Please enter description"
                },

                // Additional Info
                'department[]': {
                    required: "Please enter department"
                },
                'files[]': {
                    required: "Please enter department"
                },

                'users[]': {
                    required: "Please select user"
                },

                // Localization
                'location_name[]': {
                    required: "Please enter localized location name"
                },
                'language[]': {
                    required: "Please select language"
                }
            },

            submitHandler: function (form) {

                let formData = new FormData(form);

                let btn = $('#locationForm button[type="submit"]'); //  button ref

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('location.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    //  BEFORE SEND
                    beforeSend: function () {
                        btn.prop('disabled', true);
                        btn.html(`<span class="spinner-border spinner-border-sm me-2"></span> Saving...`);
                    },

                    //  SUCCESS
                    success: function (response) {

                        if (response.status) {
                            showToast(response.message, 'success');

                            $('#locationForm')[0].reset(); //  fixed
                            $('.select2').val(null).trigger('change');

                        } else {
                            showToast(response.message, 'error');
                        }
                    },

                    //  ERROR
                    error: function (xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (field, messages) {
                                showToast(messages[0], 'error'); //  replaced toastr
                            });

                        } else {
                            showToast(xhr.responseJSON.message || 'Something went wrong!', 'error');
                        }
                    },

                    //  AFTER SEND (ALWAYS RUNS)
                    complete: function () {
                        btn.prop('disabled', false);
                        btn.html('Submit'); // or your original button text
                    }
                });
            }
        });
        //for localization end

        // For Location end

        // For Status start

        
        $('#addBtnadditionalStatusLocalization').click(function () {
            let newSection = $('.addition-status-localization:first').clone();

            newSection.find('input').val('');
            newSection.find('select').val('');

            newSection.append(`
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger removeBtnadditionalstatus">
                            &#10006;
                        </button>
                    </div>
                </div>
            `);

            $('#addition-container-status').append(newSection);
        });

        $(document).on('click', '.removeBtnadditionalstatus', function () {
            $(this).closest('.addition-status-localization').remove();
        });

        $('#statusForm').validate({

            ignore: ":hidden:not(.force-validate)",
            
            rules: {
                status_type: {
                    required: true
                },
                status_name: {
                    required: true
                },
                next_status: {
                    required: true
                },
                'categ_id[]': {
                    required: true
                },
                hold_pause_activity: {
                    required: true
                },
                // Localization
                'localization_name[]': {
                    required: true
                },
                'localization_lang[]': {
                    required: true
                }
            },

            messages: {
                status_type: {
                    required: "Please select a status type."
                },
                status_name: {
                    required: "Please enter the status name."
                },
                next_status: {
                    required: "Please select the next status."
                },
                'categ_id[]': {
                    required: "Please select at least one category."
                },
                hold_pause_activity: {
                    required: "Please choose hold/pause activity."
                },

                // Localization
                'localization_name[]': {
                    required: "Please enter status name for all languages."
                },
                'localization_lang[]': {
                    required: "Please select at least one language."
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
                url: "{{ route('status.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                //  BEFORE SEND
                beforeSend: function () {

                    // Disable submit button
                    $('#statusForm button[type="submit"]').prop('disabled', true);

                    // Change button text (optional)
                    $('#statusForm button[type="submit"]').html(
                        `<span class="spinner-border spinner-border-sm me-2"></span> Saving...`
                    );
                },

                //  SUCCESS
                success: function (response) {

                    if (response.status) {
                        showToast(response.message, 'success');

                        $('#statusForm')[0].reset();
                        $('.select2').val(null).trigger('change');

                    } else {
                        showToast(response.message, 'error');
                    }
                },

                //  ERROR
                error: function (xhr) {

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (field, messages) {
                            showToast(messages[0], 'error'); // replaced toastr 
                        });

                    } else {
                        showToast(xhr.responseJSON.message || 'Something went wrong!', 'error');
                    }
                },

                //  AFTER COMPLETE (always runs)
                complete: function () {

                    // Enable button again
                    $('#statusForm button[type="submit"]').prop('disabled', false);

                    // Restore button text
                    $('#statusForm button[type="submit"]').html('Submit');
                }
            });
            }
        });
        
        // For Status end


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

        $('#assetForm').validate({

            ignore: ":hidden:not(.force-validate)",

            rules: {
                // Asset Details
                asset_name: {
                    required: true,
                    minlength: 3
                },
                asset_code: {
                    maxlength: 20
                },
                categ_id: {
                    required: true
                },
                sub_category_id: {
                    required: true
                },
                location: {
                    required: true
                },
                status: {
                    required: true
                },
                sub_location_id: {
                    required: true
                },   
                cwip_invoice_id: {
                    required: true
                },

                // Additional Info
                condition: {
                    required: true
                },
                brand: {
                    required: true
                },
                model: {
                    required: true
                },
                description: {
                    required: true
                },

                // Purchase Info
                vendor_name: {
                    required: true
                },
                invoice_date: {
                    required: true,
                    date: true
                },
                invoice_no: {
                    required: true
                },
                po_number: {
                    required: true
                },
                purchase_date: {
                    required: true,
                    date: true
                },
                purchase_price: {
                    required: true,
                    number: true
                },

                // Financial
                capitalization_price: {
                    required: true,
                    number: true
                },
                end_of_life: {
                    required: true,
                    date: true
                },
                capitalization_date: {
                    required: true,
                    date: true
                },
                depreciation: {
                    required: true,
                    number: true
                },
                accumulated_dep: {
                    required: true,
                    number: true
                },
                scrap_value: {
                    required: true,
                    number: true
                },

                // Allotted
                department: {
                    required: true
                },
                transf_to: {
                    required: true
                },
                allotted_upto: {
                    required: true,
                    date: true
                },

                // Warranty
                amc_vendor: {
                    required: true
                },
                Warranty_vendor: {
                    required: true
                },
                insurance_start_date: {
                    required: true,
                    date: true
                },
                insurance_end_date: {
                    required: true
                },
                amc_start_date: {
                    required: true,
                    date: true
                },
                warranty_end_date: {
                    required: true,
                    date: true
                },
                amc_end_date: {
                    required: true,
                    date: true
                },
                warranty_start_date: {
                    required: true,
                    date: true
                }
            },

            messages: {
                asset_name: "Enter asset name (min 3 characters)",
                asset_code: "Max 20 characters allowed",

                categ_id: "Select category",
                sub_category_id: "Select sub category",
                location: "Select location",
                sub_location_id: "Select sub location",
                status: "Select status",
                cwip_invoice_id: "Enter CWIP invoice id",

                condition: "Select condition",
                brand: "Enter brand",
                model: "Enter model",
                description: "Enter description",

                vendor_name: "Enter vendor name",
                invoice_date: "Select invoice date",
                invoice_no: "Enter invoice number",
                purchase_date: "Select purchase date",
                purchase_price: "Enter valid price",
                po_number: "Enter Po Number",

                capitalization_price: "Enter capitalization price",
                end_of_life: "Select end of life date",
                capitalization_date: "Select capitalization date",
                depreciation: "Enter depreciation %",
                accumulated_dep: "Enter accumulated depreciation",
                scrap_value: "Enter scrap value",

                department: "Select department",
                transf_to: "Select transfer person",
                allotted_upto: "Select allotted date",

                amc_vendor: "Select AMC vendor",
                Warranty_vendor: "Select warranty vendor",
                insurance_start_date: "Select insurance start date",
                insurance_end_date: "Enter insurance end date",
                amc_start_date: "Select AMC start date",
                warranty_end_date: "Select warranty end date",
                amc_end_date: "Select AMC end date",
                warranty_start_date: "Select warranty start date"
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
                if (element.hasClass('select2')) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.closest('.input-group').length) {
                    error.insertAfter(element.closest('.input-group'));
                }else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {

                let formData = new FormData(form);

                $.ajax({
                    url: "{{ route('asset.store') }}",
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
        // for add page sub categories
    });
</script>
@endsection

