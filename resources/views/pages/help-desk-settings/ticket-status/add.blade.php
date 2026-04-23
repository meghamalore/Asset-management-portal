@extends('layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ticket Status</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Status Type</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Hold</option>
                                        <option value="month">Assigned</option>
                                        <option value="year">Open</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Sub Status</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="invoice_date" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Hour(s) for Auto Closer</label>
                                <div class="col-sm-4">
                                    <input class="form-control force-validate" type="text" name="invoice_date" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Is Default</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="self_owned"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Edit button to be displayed based On</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">User Involved</option>
                                        <option value="month">User Role</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Auto Check-Out on This Ticket Status</label>
                                <div class="col-sm-4">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input force-validate" type="checkbox"
                                            id="flexSwitchCheckDefault" name="self_owned"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label" >Tat Count</label>
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
