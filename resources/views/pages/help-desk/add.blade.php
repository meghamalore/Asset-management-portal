@extends('layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Generate Ticket</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Parent Ticket</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Type</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Location</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Asset</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Assigned To</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Group</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Priority</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                             <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Reported Date</label>
                                    <div class="col-sm-4">
                                        <input class="form-control force-validate" type="date" name="invoice_date" />
                                    </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Reported By</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Description</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control"></textarea>
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Reported By</label>
                                <div class="col-sm-4">
                                    <select id="country" class="form-select" name="trafs_duration_type">
                                        <option value="">Select</option>
                                        <option value="day">Day(s)</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" >Notifiy Reported By</label>
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
