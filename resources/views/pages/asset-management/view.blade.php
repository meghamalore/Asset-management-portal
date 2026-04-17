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
                                            <p>{{ $asset->asset_name ?? 'N/A'}}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Asset Image</label>
                                        <div class="col-sm-4">
                                            @if($asset->asset_image)
                                                <img src="{{ asset('storage/' . $asset->asset_image) }}" alt="Asset Image" width="100" height="100" class="img-thumbnail">
                                            @else
                                                <p>No Image</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Asset
                                            Code</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->asset_code ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Category </label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->category->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Sub Category </label>
                                        <div class="col-sm-4">
                                             <p>{{ $asset->subCategory->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Location </label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->location->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Sub Location </label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->SubLocation->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Status </label>
                                        <div class="col-sm-4">
                                                <p>{{ $asset->status->status_name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">CWIP Invoice Id</label>
                                        <div class="col-sm-4">
                                          <p>{{ $asset->cwip_invoice_id ?? 'N/A' }}</p>
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
                                            <p>{{ $asset->additionalInfo->condition ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Brand</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->additionalInfo->brand ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Model</label>
                                        <div class="col-sm-4">
                                                <p>{{ $asset->additionalInfo->model ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Link Asset</label>
                                        <div class="col-sm-4">
                                                @foreach($asset->linkedAssets as $linked)
                                                    {{ $linked->asset_name }}@if(!$loop->last), @endif
                                                @endforeach
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->additionalInfo->description ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Serial No</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->additionalInfo->serial_no ?? 'N/A' }}</p>
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
                                            <p>{{ $asset->purchaseInfo->vendor_name }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Po Number</label>
                                        <div class="col-sm-4">
                                           <p>{{ $asset->purchaseInfo->asset_po_number }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Invoice Date</label>
                                        <div class="col-sm-4">
                                           <p>{{ $asset->purchaseInfo->invoice_date }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Invoice No</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->purchaseInfo->invoice_no }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Purchase Date</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->purchaseInfo->purchase_date }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Purchase Price</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->purchaseInfo->purchase_price }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Self Owned / Partner</label>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch mb-2">
                                                <p>{{ $asset->purchaseInfo->is_self_owned == 1 ? 'yes' : 'No' }}</p>
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
                                                <p>{{ $asset->finacialInfos->capitalization_price ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <label class="col-sm-2 col-form-label">End Of Life</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->finacialInfos->end_of_life ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Capitalization Date</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->finacialInfos->capitalization_date ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Depreciation%</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->finacialInfos->depreciation_percent ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Accumulated
                                            Depreciation</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->finacialInfos->accumulated_depreciation ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Scrap Value</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->finacialInfos->scrap_value ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Income Tax
                                            Depreciation%</label>
                                        <div class="col-sm-4">
                                              <p>{{ $asset->finacialInfos->income_tax_depreciation_percent ?? 'N/A' }}</p>
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
                                         <p>{{ $asset->assetallotedInfos->department ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Transferred To</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->assetallotedInfos->transferred_to ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Allotted Upto</label>
                                        <div class="col-sm-4">
                                              <p>{{ $asset->assetallotedInfos->allotted_upto ?? 'N/A' }}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Remarks</label>
                                        <div class="col-sm-4">
                                                 <p>{{ $asset->assetallotedInfos->remarks ?? 'N/A'}}</p>
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
                                            <p>{{ $asset->assetwarrantyInfos->amc_vendor ?? 'N/A'}}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Warranty
                                            Vendor</label>
                                        <div class="col-sm-4">
                                                <p>{{ $asset->assetwarrantyInfos->warranty_vendor ?? 'N/A'}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Insurance Start
                                            Date</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->assetwarrantyInfos->insurance_start_date ?? 'N/A'}}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Insurance End
                                            Date</label>
                                        <div class="col-sm-4">
                                                <p>{{ $asset->assetwarrantyInfos->insurance_end_date ?? 'N/A'}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">AMC Start
                                            Date</label>
                                        <div class="col-sm-4">
                                              <p>{{ $asset->assetwarrantyInfos->amc_start_date ?? 'N/A'}}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Warranty End
                                            Date</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->assetwarrantyInfos->warranty_end_date ?? 'N/A'}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">AMC End Date</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->assetwarrantyInfos->amc_end_date ?? 'N/A'}}</p>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Warranty Start
                                            Date</label>
                                        <div class="col-sm-4">
                                            <p>{{ $asset->assetwarrantyInfos->warranty_start_date ?? 'N/A'}}</p>
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
