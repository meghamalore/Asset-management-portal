@extends('layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Add Asset</h4>
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
                                        <label class="col-sm-2 col-form-label" for="basic-default-company">Asset Code</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="basic-default-company"
                                                placeholder="ACME Inc." />
                                                <div class="form-text">
                                                    Leave blank to auto-generate. System generated code
                                                    formats can be setup from Advanced settings
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#smallModals">
                                                <i class="bx bx-barcode"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Category</label>
                                        <div class="col-sm-4">
                                            <select class="form-control select2"  name="location_id">
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
                                    <label class="col-sm-2 col-form-label">Upload Files</label>
                                    <div class="col-sm-4">
                                        <label class="btn btn-sm btn-primary mb-0">
                                            <i class="bx bx-upload me-1"></i> Upload File
                                            <input type="file" hidden>
                                        </label>
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

    <!-- Extra Large Category Modal -->
    <div class="modal fade" id="exLargeModalCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion mt-3" id="accordionExample">
                        <div class="card accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionSeven" aria-expanded="true" aria-controls="accordionSeven">
                                    Category Details
                                </button>
                            </h2>
                            <div id="accordionSeven" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Parent Category</label>
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
                                                <button type="button" class="btn btn-primary">
                                                    &#10006;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="asset_image">Show Category in Inventory Module</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" />
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="asset_name">Category Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="asset_name"
                                                    placeholder="Enter Asset Name" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="asset_image">Show this category assets in Linked Assets</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" />
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="asset_name">Category Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="asset_name"
                                                    placeholder="Enter Asset Name" />
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="asset_image">Default Transfer Duration</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="asset_name"
                                                    placeholder="Enter Asset Name" />
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="asset_name">Category Code</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" />
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="asset_image">Allow Auto Extend</label>
                                            <div class="col-sm-4">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" />
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                                </div>
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
                                    data-bs-target="#accordionEight" aria-expanded="true" aria-controls="accordionEight">
                                    Financial Information
                                </button>
                            </h2>
                            <div id="accordionEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Condition</label>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="text" id="asset_image" />
                                        </div>
                                        <div class="col-sm-2">
                                            <select id="country" class="select2 form-select">
                                                <option value="">Select</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Canada">Canada</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="asset_image">Depreciation %</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="asset_image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Scrap Value</label>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="text" id="asset_image" />
                                        </div>
                                        <div class="col-sm-2">
                                            <select id="country" class="select2 form-select">
                                                <option value="">Select</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Canada">Canada</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="asset_image">Income Tax Depreciation%</label>
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
                                    data-bs-target="#accordionnine" aria-expanded="true" aria-controls="accordionnine">
                                    Default Activity Schedules For Assets In This Category
                                </button>
                            </h2>
                            <div id="accordionnine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div id="addition-container">
                                    <div class="addition">
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="asset_image">Details</label>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Assignee Based On</label>
                                            <div class="col-sm-4">
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                                    <label class="form-check-label" for="defaultCheck1"> Users Involved </label>
                                                </div>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                                    <label class="form-check-label" for="defaultCheck1"> User Role </label>
                                                </div>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                                    <label class="form-check-label" for="defaultCheck1"> User group </label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">User Type</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Assignee Role</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Assignee</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Activity Type</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Occurs</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Start Schedule After (Days)</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" id="asset_image" />
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Activity Reminders</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Schedule Based On</label>
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
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Custom Days</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" id="asset_image" />
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
                                            <label class="col-sm-4 col-form-label" for="asset_image">Category Name Localization</label>
                                        </div>
                                        <div class="row mb-3">
                                                {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                                <div class="col-sm-4">
                                                </div> --}}
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                            <div class="col-sm-4">
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Category Name</label>
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
                                                        <input class="form-control" type="text" id="asset_image" />
                                                        </div>
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

    <!-- Extra Large Location Modal -->
    <div class="modal fade" id="exLargeModalLocation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Locations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                                        <label class="col-sm-2 col-form-label" for="asset_name">Parent Location Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="asset_name"
                                                placeholder="Enter Asset Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="asset_name">Location</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="asset_name"
                                                placeholder="Enter Asset Name" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="asset_name">Location Code</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="asset_name"
                                                placeholder="Enter Asset Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="asset_name">Location Code</label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" />
                                                <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                            </div>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="asset_name">Default Coordinates</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control mb-1" id="asset_name"
                                                placeholder="Latitude" />
                                            <input type="text" class="form-control" id="asset_name"
                                                placeholder="Longitude" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="asset_name">Description</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="flexSwitchCheckDefault" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" for="asset_image">Additional Info</label>
                                    </div>
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                        <div class="col-sm-4">
                                        </div> --}}
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                        <div class="col-sm-4">
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Department</label>
                                        <div class="col-sm-4">
                                            <label class=" col-form-label" for="basic-default-phone">Users</label>
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
                                            <label class="col-sm-4 col-form-label" for="asset_image">Location Name Localization</label>
                                        </div>
                                        <div class="row mb-3">
                                                {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                                <div class="col-sm-4">
                                                </div> --}}
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                            <div class="col-sm-4">
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Category Name</label>
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
                                                        <input class="form-control" type="text" id="asset_image" />
                                                        </div>
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

    <!-- Extra Large Status Modal -->
    <div class="modal fade" id="exLargeModalStatus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Add Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                                        <label class="col-sm-2 col-form-label" for="asset_name">Status Type</label>
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
                                        <label class="col-sm-2 col-form-label" for="asset_name">Status Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="asset_image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="asset_name">Next Status</label>
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
                                        <label class="col-sm-2 col-form-label" for="asset_name">Only visible for categories</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="asset_image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="asset_name">Hold/Pause Activity</label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" />
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
                                            <label class="col-sm-4 col-form-label" for="asset_image">Status Name Localization</label>
                                        </div>
                                        <div class="row mb-3">
                                                {{-- <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                                <div class="col-sm-4">
                                                </div> --}}
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone"></label>
                                            <div class="col-sm-4">
                                            </div>
                                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Status Name</label>
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
                                                        <input class="form-control" type="text" id="asset_image" />
                                                        </div>
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
    $(document).ready(function () {

         $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%'
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
    });
</script>
@endsection

