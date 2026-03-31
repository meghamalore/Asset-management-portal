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

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #696cff;
    box-shadow: 0 0 0 0.15rem rgba(105, 108, 255, 0.25);
}
</style>
@endsection
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
                                        <label class="col-sm-2 col-form-label" >Asset Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Asset Name" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Asset Image</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="file"  />
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
                                        <label class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-4">
                                            <select class="form-select select2"  name="location_id">
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
                                        <label class="col-sm-2 col-form-label" >Asset Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Asset Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >CWIP Invoice Id</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
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
                                        <input class="form-control" type="text"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Model</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
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
                                        <input class="form-control" type="text"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" >Serial No</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
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
                                    <label class="col-sm-2 col-form-label" >Vendor Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
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
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" >Invoice No</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Purchase Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
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
                                        <input class="form-control" type="date"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Capitalization Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Depreciation%</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
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
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Income Tax
                                        Depreciation%</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
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
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Remarks</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
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
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Insurance End
                                        Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC Start
                                        Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty End
                                        Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC End Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty Start
                                        Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">AMC End Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Warranty Start
                                        Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="date"  />
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
                                            <label class="col-sm-2 col-form-label" >Parent Category</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" 
                                                    placeholder="Enter Parent Category Name" name="parent_category_name"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary">
                                                    &#10006;
                                                </button>
                                            </div>
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
                                            <label class="col-sm-2 col-form-label">Category Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="category_name"
                                                    placeholder="Enter Category Name" name="local_category_name"/>
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
                                        <div class="col-sm-2">
                                        <select id="scrap_value_type" class="form-select force-validate" name="scrap_value_type">
                                            <option value="">Select</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Amount">Amount</option>
                                        </select>
                                        </div>

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
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Assignee
                                                    Based On</label>
                                                <div class="col-sm-4">
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" name="assign_based" type="radio" value="1"
                                                            id="assign_based" />
                                                        <label class="form-check-label"> Users Involved
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="radio" name="assign_based" value="2"
                                                            id="assign_based" />
                                                        <label class="form-check-label"> User Role
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="radio" name="assign_based" value="3"
                                                            id="assign_based" />
                                                        <label class="form-check-label" for="defaultCheck1"> User group
                                                        </label>
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">User
                                                    Type</label>
                                                <div class="col-sm-4">
                                                    <select id="user_type" name="user_type" class="form-select">
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
                                                    Role</label>
                                                <div class="col-sm-4">
                                                    <select id="assign_role" class="form-select" name="assign_role">
                                                        <option value="">Select</option>
                                                        <option value="Owner">Owner</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-default-phone">Assignee</label>
                                                <div class="col-sm-4">
                                                    <select id="assignee" name="assignee" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="Australia">test</option>
                                                        <option value="Bangladesh">Admin</option>
                                                        <option value="Belarus">James Smith</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Activity
                                                    Type</label>
                                                <div class="col-sm-4">
                                                    <select id="activity_type" name="activity_type[]" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="Calibration">Calibration</option>
                                                        <option value="Inspection">Inspection</option>
                                                        <option value="Warranty Expiry">Warranty Expiry</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-default-phone">Occurs</label>
                                                <div class="col-sm-4">
                                                    <select id="occurs" name="occurs[]" class="form-select">
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
                                                    Schedule After (Days)</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="start_schedule_after[]"  />
                                                </div>
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Activity
                                                    Reminders</label>
                                                <div class="col-sm-4">
                                                    <select id="activity_reminder" name="activity_reminder[]" class="form-select">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Schedule
                                                    Based On</label>
                                                <div class="col-sm-4">
                                                    <select id="schedule_based_on" class="form-select" name="schedule_based_on[]">
                                                        <option value="">Select</option>
                                                        <option value="created_date">Created Date</option>
                                                        <option value="capitalization_date">Capitalization Date</option>
                                                        <option value="Purchase_date">Purchase Date</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Custom
                                                    Days</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" id="custom_days"  name="custom_days[]" />
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
                                                    <input class="form-control" type="text" name="category_name[]" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select id="language" class="form-select" name="language[]">
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
                                        <label class="col-sm-2 col-form-label" >Parent Location Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Asset Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Location</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Asset Name" />
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Location Code</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" 
                                                placeholder="Enter Asset Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Location Code</label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" />
                                                <label class="form-check-label" for="flexSwitchCheckDefault">yes</label>
                                            </div>
                                        </div>
                                        <label class="col-sm-2 col-form-label" >Default Coordinates</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control mb-1" 
                                                placeholder="Latitude" />
                                            <input type="text" class="form-control" 
                                                placeholder="Longitude" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Description</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="flexSwitchCheckDefault" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label" >Additional Info</label>
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
                                            <label class="col-sm-4 col-form-label" >Location Name Localization</label>
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
                                                        <input class="form-control" type="text"  />
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
                                        <label class="col-sm-2 col-form-label" >Status Type</label>
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
                                        <label class="col-sm-2 col-form-label" >Status Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text"  />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" >Next Status</label>
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
                                        <label class="col-sm-2 col-form-label" >Only visible for categories</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text"  />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" >Hold/Pause Activity</label>
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
                                            <label class="col-sm-4 col-form-label" >Status Name Localization</label>
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
                                                        <input class="form-control" type="text"  />
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-select select2" name="location_id" data-placeholder="Select Location">
                                                                <option></option>
                                                                <option value="Australia">Australia</option>
                                                                <option value="Bangladesh">Bangladesh</option>
                                                                <option value="Belarus">Belarus</option>
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

        $('#categoryForm').validate({

            ignore: ":hidden:not(.force-validate)",
            rules: {
                parent_category_name: {
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
                    required: "Please enter parent category name"
                },
                local_category_name: {
                    required: "Please enter category name"
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

                    success: function (response) {

                        if (response.status) {
                            toastr.success(response.message);

                            $('#categoryForm')[0].reset();
                            $('.select2').val(null).trigger('change');

                        } else {
                            toastr.error(response.message);
                        }
                        
                    },

                    error: function (xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (field, messages) {
                                toastr.error(messages[0]);
                            });

                        } else {
                            toastr.error(xhr.responseJSON.message || 'Something went wrong!');
                        }
                    }
                });
            }
        });

    });
</script>
@endsection

