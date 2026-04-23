@extends('layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ticket Type</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Type</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="invoice_date" />
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Expected TAT</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="invoice_date" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">User Involved</option>
                                        <option value="month">User Role</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Activity Type</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Calibration</option>
                                        <option value="month">Inspection</option>
                                        <option value="month">Warranty Expiry</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Type Duration</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Days</option>
                                        <option value="day">Hours</option>
                                        <option value="month">Minutes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Reason</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">User Involved</option>
                                        <option value="month">User Role</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Location</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">User Involved</option>
                                        <option value="month">User Role</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Role</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">User Involved</option>
                                        <option value="month">User Role</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Re-Open Allowed Till</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">24 Hours</option>
                                        <option value="day">48 Hours</option>
                                        <option value="day">72 Hours</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >OTP Required</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="self_owned"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" >Generate Forwarding Email</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="self_owned"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Change Asset Status if Ticket is Raised with This Ticket Type</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="self_owned"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
