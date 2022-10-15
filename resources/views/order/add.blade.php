@section('title', 'Create Order')
@extends('layouts.admin')

@section('content')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<!-- Latest compiled JavaScript -->
{{-- <script src="htt/ps://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
@php

$follow_steps = 1 ;
$installation_date = $installation_time = '';
$site_visit_date = $site_visit_time = '';
$data_target = 'step-one';
if(isset($data['order_detail']->follow_steps)){
$follow_steps = $data['order_detail']->follow_steps;
}

if(isset($data['order_detail']->site_visit_datetime)){
$site_visit_date = date('Y-m-d', strtotime($data['order_detail']->site_visit_datetime));

}
if($follow_steps == 2){
$data_target = 'step-two';

}else if($follow_steps == 3){
$data_target = 'step-three';

}else if($follow_steps == 4){
$data_target = 'step-four';

}else if($follow_steps == 5){
$data_target = 'step-five';

}else if($follow_steps == 6){
$data_target = 'step-six';

}
else if($follow_steps == 7){
$data_target = 'step-seven';

}

$first_invoice_id = 0;
$second_invoice_id = 0;
$third_invoice_id = 0;
$fourth_invoice_id = 0;
$fifth_invoice_id = 0;
if(isset($data['order_invoices'])){
    foreach($data['order_invoices'] as $key => $value){
        if($value->invoice_step == 1){
            $first_invoice_id = $value->id;
            $first_status_invoice = $value->invoice_status;
            $first_invoice_image = $value->invoice_file;
        }
        else if($value->invoice_step == 2){
            $second_status_invoice = $value->invoice_status;
            $second_invoice_id = $value->id;
            $second_invoice_image = $value->invoice_file;
        }
        else if($value->invoice_step == 3){
            $third_status_invoice = $value->invoice_status;
            $third_invoice_id = $value->id;
            $third_invoice_image = $value->invoice_file;

        }
        else if($value->invoice_step == 4){
            $fourth_status_invoice = $value->invoice_status;
            $fourth_invoice_id = $value->id;
            $fourth_invoice_image = $value->invoice_file;

        }
        else if($value->invoice_step == 5){
            $fifth_status_invoice = $value->invoice_status;
            $fifth_invoice_id = $value->id;
            $fifth_invoice_image = $value->invoice_file;

        }
    }
}
$step_two_id = 0;
$step_three_document_id = 0;
$step_three_agreement_id = 0;
$step_three_proposal_docuemnt_id = 0;
$step_six_guarantee_docuemnt_id = 0;
$step_six_manual_docuemnt_id = 0;
if(isset($data['order_asset_detail'])){
    foreach($data['order_asset_detail'] as $key => $value){
        
       if ($value->field_name == 'step2_document') {
        $step_two_document = $value->file_path;
        $step_two_id = $value->id;
        $step_two_user_id = $value->user_id;
      
       }
       if ($value->field_name == 'step3_agreement_document') {
        $step_three_agreement = $value->file_path;
        $step_three_agreement_id = $value->id;
        $step_document_user_id = $value->user_id;
       }
       if ($value->field_name == 'step3_document_file') {
        $step_three_document = $value->file_path;
        $step_three_document_id = $value->id;
        $step_three_document_user_id = $value->user_id;
       }
       if ($value->field_name == 'step3_proposal_document') {
        $step_three_proposal_file_path = $value->file_path;
        $step_three_proposal_field_name = $value->field_name;
        $step_three_proposal_docuemnt_id = $value->id;
       }
       if ($value->field_name == 'step6_upload_manual') {
        $step_six_manual_file_path = $value->file_path;
        $step_six_manual_field_name = $value->field_name;
        $step_six_manual_docuemnt_id = $value->id;
       }
       if ($value->field_name == 'step6_guarantee_document') {
        $step_six_guarantee_file_path = $value->file_path;
        $step_six_guarantee_field_name = $value->field_name;
        $step_six_guarantee_docuemnt_id = $value->id;
       }
       
    }
}
@endphp
<style>
    html {
        scroll-behavior: smooth;
    }

    .bs-stepper-header .line {
        display: none;
    }

    .alert {
        display: none;
    }

    .status-div {
        display: block;
    }

    .hide {
        display: none;
    }

    /* .btnformsubm_invoice {
        width: 20%;
    } */

    .btnformsubm_invoice .loading {
        width: 38%;
    }

    .btnformsubm .loading {
        width: 38%;
    }

    .send_email_confirmation {
        float: left;
        margin-top: 1%;
    }

    .invoice_type_label {
        margin-right: 13%;
    }
    .heading{
        font-weight: 600;
    }
    .icons:hover{
        color:#00cfe8;
    }

    @media screen and (max-width: 400px) {
        .invoice_dropdown {
            text-align: left;
            width: 100%;
        }

        .invoice_type_label {
            float: left;
        }

        .send_email_confirmation {
            float: left;
        }
    }
</style>
<div class="content-wrapper">

    <div class="content-body">
        <div class="bs-stepper checkout-tab-steps">

            <!-- Wizard starts -->
            <div class="bs-stepper-header">
                <div class="step {{ $follow_steps == 1 ? 'active':'' }}" data-target="#step-one">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="shopping-cart" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 1</span>
                            <span class="bs-stepper-subtitle">Sales Pick Up</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="{{ ($follow_steps == 2 || $follow_steps == 3 || $follow_steps == 4 || $follow_steps == 5 || $follow_steps == 6 || $follow_steps == 7) ? 'step':'temp-step' }} {{ $follow_steps == 2 ? 'active':'' }}" data-target="#step-two">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="home" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 2</span>
                            <span class="bs-stepper-subtitle">Survey</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="{{ ($follow_steps == 3 || $follow_steps == 4 || $follow_steps == 5 || $follow_steps == 6 || $follow_steps == 7) ? 'step':'temp-step' }} {{ $follow_steps == 3 ? 'active':'' }}" data-target="#step-three">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="credit-card" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 3</span>
                            <span class="bs-stepper-subtitle">Proposal</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="{{ ($follow_steps == 4 || $follow_steps == 5 || $follow_steps == 6 || $follow_steps == 7) ? 'step':'temp-step' }} {{ $follow_steps == 4 ? 'active':'' }}" data-target="#step-four">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="bar-chart" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 4</span>
                            <span class="bs-stepper-subtitle">Sale</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="{{ ($follow_steps == 5 || $follow_steps == 6 || $follow_steps == 7) ? 'step':'temp-step' }} {{ $follow_steps == 5 ? 'active':''  }}" data-target="#step-five">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="calendar" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 5</span>
                            <span class="bs-stepper-subtitle">Installation</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="{{ ($follow_steps == 6 || $follow_steps == 7) ? 'step':'temp-step' }} {{ $follow_steps == 6 ? 'active':'' }}" data-target="#step-six">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="layout" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 6</span>
                            <span class="bs-stepper-subtitle">Project Completion</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="{{ ($follow_steps == 7) ? 'step':'temp-step' }} {{ $follow_steps == 7 ? 'active':'' }}" data-target="#step-seven">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="check-circle" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Step 7</span>
                            <span class="bs-stepper-subtitle">Success</span>
                        </span>
                    </button>
                </div>
            </div>
            <!-- Wizard ends -->

            <!-- Order steps -->
            <div class="bs-stepper-content">

                <div class="alert alert-danger"><strong>Sorry: </strong><span class="error-message"></span></div>
                <div class="alert alert-success"><strong>Success: </strong><span class="success-message"></span></div>
                @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 3)
                <div class="alert alert-danger2 status-div">
                    <p>Sale pick up date and time has been rejected.</p>
                </div>
                @endif
                @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 2 && empty($data['order_detail']->survey_information))
                <div class="alert alert-success2 status-div">
                    <p>Sale pick up date and time has been accepted successfully.</p>
                </div>
                @endif
                @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 2 && !empty($data['order_detail']->survey_information)  &&  empty($data['order_detail']->proposal_status))
                <div class="alert alert-success2 status-div">
                    <p>Survey information added successfully.</p>
                </div>
                @endif
                @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 2 && !empty($data['order_detail']->survey_information)  && empty($step_two_id))
                <div class="alert alert-info2 status-div">
                    <p>Upload excel file.</p>
                </div>
                @endif
              
                
                @if (isset($data['order_detail']->proposal_status) && $data['order_detail']->follow_steps == 3 && $data['order_detail']->proposal_status == 1 && !empty($data['order_detail']->proposal_cost))
                <div class="alert alert-info2 status-div">
                    <p>Proposal submitted successfully please wait for the client approval.</p>
                </div>
                @endif
                {{-- @if (isset($data['order_detail']->proposal_status) && $data['order_detail']->survey_status == 2 && isset($data['order_detail']->survey_information) && isset($step_two_id) && @$step_two_user_id != 1)
                    <div class="alert alert-info2 status-div">
                        <p>Client uploaded document.</p>
                    </div>
                
                    @elseif ($data['order_detail']->survey_status == 2 && isset($data['order_detail']->survey_information) && empty($step_two_id))
                    <div class="alert alert-info2 status-div">
                        <p>Upload document.</p>
                    </div>
                @endif --}}
                @if (isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 3)
                <div class="alert alert-danger2 status-div">
                    <p>Proposal information has been rejected.</p>
                </div>
                @endif
                {{-- @if (isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 && $step_three_document_id == 0)
                <div class="alert alert-info2 status-div">
                    <p>Proposal accepted successfully, upload document file.</p>
                </div>
                @elseif (isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 && $step_three_agreement_id == 0 )
                <div class="alert alert-info2 status-div">
                    <p>Please upload agreement file</p>
                </div>
                @elseif(isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 && $step_three_proposal_docuemnt_id == 0)
                <div class="alert alert-info2 status-div">
                    <p>Upload order confirmation document file</p>
                </div> --}}
                @if (@$data['order_detail']->proposal_status == 2 && isset($step_three_proposal_docuemnt_id) &&  empty($data['order_detail']->showroon_visit_date))
                <div class="alert alert-info2 status-div">
                    <p>Wait, client not confirmed showroom visit date</p>
                </div>
                @elseif (isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 && empty($data['order_detail']->installation_start_date))
                <div class="alert alert-info2 status-div">
                    <p>please add installation date</p>
                </div>
                {{-- @elseif (isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 && isset($data['order_detail']->installation_start_date) && @$data['order_detail']->showroom_visit_status != 2)
                <div class="alert alert-info2 status-div">
                    <p>Please accept showroom visit question</p>
                </div> --}}
                @elseif (isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 && isset($data['order_detail']->installation_start_date) && @$first_invoice_id == 0)
                <div class="alert alert-info2 status-div">
                    <p>Upload first invoice of 30%</p>
                </div>
                
                @elseif(@$data['order_detail']->proposal_status == 2 && @$data['order_detail']->showroom_visit_status != 2 && $first_status_invoice == 2)
                <div class="alert alert-info2 status-div">
                    <p>Please Review showroom visit date</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 && @$data['order_detail']->showroom_visit_status == 2 && isset($step_two_id) && !isset($second_invoice_id))
                <div class="alert alert-info2 status-div">
                    <p>Showroom visit date accepted successfully</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 && @$data['order_detail']->showroom_visit_status == 2 && @$second_invoice_id == 0 && @$first_status_invoice == 2)
                <div class="alert alert-info2 status-div">
                    <p>Upload second invoice of 40%</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 && @$data['order_detail']->showroom_visit_status == 2 && @$fifth_invoice_id == 0 && @$second_status_invoice == 2)
                <div class="alert alert-info2 status-div">
                    <p>Upload Showroom extra invoice</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 && @$third_invoice_id == 0 && @$data['order_detail']->portallo_ordered == 1)
                <div class="alert alert-info2 status-div">
                    <p>Upload third invoice 20%</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 && $fourth_invoice_id == 0 && @$third_status_invoice == 2)
                <div class="alert alert-info2 status-div">
                    <p>Upload fourth invoice of 10%</p>
                </div>
                @elseif(isset($fourth_invoice_id) && @$fourth_status_invoice == 2 && empty($data['order_detail']->installation_checklist_notes))
                <div class="alert alert-info2 status-div">
                    <p>Add installation checklist notes</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 &&  isset($data['order_detail']->installation_checklist_notes) && @$step_six_manual_docuemnt_id == 0)
                <div class="alert alert-info2 status-div">
                    <p>Upload manual document</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 &&  isset($data['order_detail']->installation_checklist_notes) && @$step_six_guarantee_docuemnt_id == 0 && isset($step_six_manual_docuemnt_id))
                <div class="alert alert-info2 status-div">
                    <p>Upload Gurantee document</p>
                </div>
                @elseif(@$data['order_detail']->proposal_status == 2 && $step_six_guarantee_docuemnt_id != 0 && empty($data['order_detail']->rectification_period_date))
                <div class="alert alert-info2 status-div">
                    <p>Add rectification period end date</p>
                </div>
                @endif


                @if (
                ($first_invoice_id !=0 && $first_status_invoice == 4) ||
                ($second_invoice_id !=0 && $second_status_invoice == 4) ||
                ($third_invoice_id !=0 && $third_status_invoice == 4) ||
                ($fourth_invoice_id !=0 && $fourth_status_invoice == 4) ||
                (@$fifth_invoice_id !=0 && @$fifth_status_invoice == 4)
                )
                <div class="alert alert-info2 status-div">
                    <p>Client payment sent successfully please check and change status.</p>
                </div>
                @endif
                {{-- <div class="alert alert-info3 status-div" style="display: none">
                    <p>Document deleted successfully</p>
                </div> --}}

                <!-- Step one Order Form -->


                <div id="step-one" class="content {{ $follow_steps == 1 ? 'active dstepper-block':'' }}">
                    <form id="step_one_form" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="1">
                        <!-- Customer Sale Pickup -->
                        <div class="card">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Add New Sales Pick Up</h4>
                                        <p class="card-text text-muted mt-25">Please ensure all required information is completed</p>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="assign_model_stepone">Assign Task</button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="card-header flex-column align-items-start">
                                        <span style="display: flex;">
                                            <h5><b>Preferred Model Of Pod:</b></h5>

                                            <p class="para-info ml-1">{{ @$data['enquiry_detail']['preferred_model_of_pod'] }}</p>
                                        </span>
                                        <span style="display: flex;">
                                            <h5><b>Preferred Survey Date:</b></h5>

                                            <p class="para-info" style="margin-left: 28px;">{{ @$data['enquiry_detail']['preferred_survey_date'] }}</p>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                    $survey_date = '';
                                    $survey_time = '';
                                    if(isset($data['order_detail']->survey_datetime)){
                                    // $survey_date = date('Y-m-d\\TH:i', strtotime($data['order_detail']->survey_datetime));
                                    $survey_date = date('Y-m-d', strtotime($data['order_detail']->survey_datetime));
                                    $survey_hour = date('H', strtotime($data['order_detail']->survey_datetime));
                                    $survey_minute = date('i', strtotime($data['order_detail']->survey_datetime));

                                    }
                                    @endphp
                                   
                                    <div class="col-md-5 col-sm-12">
                                        <label for="survey_date" class="heading">Survey Date And Time:</label>
                                        <div class="input-group mb-2">
                                            <input id="survey_date" style="width:50% " class="form-control " name="survey_date" type="date" value="{{ $survey_date }}" />
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <label for="survey_hour">Hour:</label>
                                        <label for="survey_minute" style="margin-left:33% ;">Minute:</label>
                                        <div class="input-group mb-2">
      
                                            @php
                                            $hours = array("01","02","03","04","05","06","07","08","09",
                                            10,11,12,13,14,15,16,17,18,19,20,21,22,23);
                                            $mins = array("00",15,30,45);
                                            $hourSelect = '';
                                           
                                            $hourSelect .= "<select name='survey_hour' class='form-control'>";
                                                foreach ($hours as $key => $hour) {

                                                    $selected = @$survey_hour == $hour ? 'selected' :''; 

                                                    $hourSelect .= '<option value="'.$hour.'" '.$selected.'>'.$hour.'</option>';
                                                }
                                                $hourSelect .= '</select>';
                                            echo $hourSelect;

                                            $minuteSelect = '';
                                            $minuteSelect .= "<select name='survey_minute' class='form-control'>";
                                                foreach ($mins as $key => $min) { 
                                                    $selectedmin = @$survey_minute == $min ? 'selected' :''; 
                                                    $minuteSelect .= '<option value="'.$min.'" '.$selectedmin.'>'.$min.'</option>';
                                                }
                                                $minuteSelect .= '</select>';
                                            echo $minuteSelect;
                                            @endphp

                                            <!-- <input style="width:50% " class="form-control " name="survey_time" type="time" value="{{ @$survey_time }}" /> -->
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <button type="button" id="formsubmit" follow_steps="1" class="btn btn-primary btnformsubm btn_submit sbmt_form_data">Save</button>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" value="4" class="btn btn-primary btn_submit send_email_confirmation mr-1">Thank you booking home survey</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Customer Sale Pickup Ends -->
                    </form>
                      <!--step_one_form Modal -->
                    <div class="modal fade" id="step_one_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form class="list-view product-checkout"  id="task_step_one_data" enctype="multipart/form-data">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="1">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control"  cols="30" rows="3" placeholder="Task Description" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="1" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- Step one Order Form Ends-->

                <!-- Step Two Order Form -->
                <div id="step-two" class="content {{ $follow_steps == 2 ? 'active dstepper-block':'' }}">
                 
                    <form id="step_two_form" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="2">
                        <!-- Customer Survey Information -->
                    
                        <div class="card">
                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Add New Survey Information</h4>
                                        <p class="card-text text-muted mt-25">Please ensure all required information is completed</p>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="assign_model_steptwo">Assign Task</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Survey Date And Time:</label><br>
                                            {{ isset($data['order_detail']->survey_datetime) ? date('d M, Y h:i A', strtotime($data['order_detail']->survey_datetime)): '' }}
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Survey notes:</label>
                                            <textarea class="form-control" id="checkout-survey_information" name="survey_information" cols="30" rows="5" placeholder="Survey Notes" value="{!! @$data['order_detail']->survey_information !!}">{!! @$data['order_detail']->survey_information !!}</textarea>
                                        </div>
                                    </div>
                            
                                    {{-- <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="survey_items_required">Survey Items Required:</label>
                                            <textarea class="form-control" id="survey_items_required" name="survey_items_required" cols="30" rows="5" placeholder="Survey Items Required" value="{!! @$data['order_detail']->survey_items_required !!}">{!! @$data['order_detail']->survey_items_required !!}</textarea>

                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-12">

                                    <button type="button" id="formsubmit" follow_steps="2" class="btn btn-primary btnformsubm btn_submit sbmt_form_data">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    

                    <!--assign_model_steptwo Modal -->
                    <div class="modal fade" id="step_two_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form class="list-view product-checkout"  id="task_step_two_data" enctype="multipart/form-data">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="2">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control"  cols="30" rows="3" placeholder="Task Description" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="2" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <form id="step_two_admin_document" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="2">

                        {{-- <div class="card" id="excel_file_document" style="display:{{@$data['order_detail']->survey_information ? 'block':'none'}}"> --}}
                            <div class="card" id="excel_file_document" >
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Upload document</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group mb-2">

                                            
                                            <label for="checkout-excel_file" class="heading">Add document:</label><br>
                                            <input type="file" id="excel_file" class="form-control" placeholder="Profile Image" name="excel_file[]" multiple required>
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                            <div class="showinputfile document_admin_excel">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step2_document' && $value->user_id == 1) 
                                                            <div class="delete_document document-{{$value->id}}">
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                    <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                        <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                    </a>
                                                                </span>
                                                                <span class="bs-stepper-box">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Client document:</label><br>
                                            <div class="showinputfile document_excel">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step2_document' && $value->user_id != 1) 
                                                            <div class="delete_document document-{{$value->id}}">
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                    <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                        <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                    </a>
                                                                </span>
                                                                <span class="bs-stepper-box">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                            </div>
                                                                
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Step Two Order Form Ends-->

                <!-- Step Three Order Form -->
                <div id="step-three" class="content {{ $follow_steps == 3 ? 'active dstepper-block':'' }}">
                    
                    <form id="step_three_form" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Add New Proposal Information</h4>
                                        <p class="card-text text-muted mt-25">Please ensure all required information is completed</p>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">

                                        <button type="button" value="3" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="assign_model_stepthree">Assign Task</button>
                                    </div>
                                </div>
                                
                            </div>
                           
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-proposal_cost" class="heading">Proposal Cost:</label>
                                            <input type="number" id="checkout-proposal_cost" class="form-control" name="proposal_cost" placeholder="Proposal Cost" value="{{ @$data['order_detail']->proposal_cost }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-proposal_notes" class="heading">Proposal Notes:</label>
                                            <textarea class="form-control" id="checkout-proposal_notes" name="proposal_notes" cols="30" rows="2" placeholder="Proposal Notes" value="{!! @$data['order_detail']->proposal_notes !!}">{!! @$data['order_detail']->proposal_notes !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary btnformsubm_invoice btn_submit sbmt_form_data">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                     {{-- assign_model_stepthree Assign Task Model --}}
                    <div class="modal fade" id="step_three_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form class="list-view product-checkout" id="task_step_three_data">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="3">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="3" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- @if(@$data['order_detail']->showroom_question)
                        <div class="card">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Showroom Invite</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Showroom question:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->showroom_question) ? @$data['order_detail']->showroom_question : '-----' }}</p>
                                </div>
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Showroom Visit date:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->showroon_visit_date) ? @$data['order_detail']->showroon_visit_date : '-----' }}</p>
                                </div>
                                <form id="showroom_confirmation_form" method="POST" class="list-view product-checkout" action="{{ route('order.update',$data['order_detail']->id) }}">
                                    @method('PUT')
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 mb-2">
                                                @if(@$data['order_detail']->showroom_visit_status != 2)
                                                    <button value="2" name="showroom_visit_status" type="submit" class="btn btn-primary btn_submit_status">Accept</button>
                                                    <button value="3" name="showroom_visit_status" type="submit" class="btn btn-primary btn_submit_status">Reject</button>
                                                @endif
                                            </div>
                                        </div>
                                    
                                    <!-- Customer Sale Pickup Ends -->
                                </form>
    
                            </div>
                            
                        </div>
                    @endif --}}

                    {{-- Document upload --}}
                    <form id="admin_upload_document" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">


                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Upoad document</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Add upload document:</label><br>
                                            <input type="file" id="admin_upload_document" class="form-control" name="admin_upload_document[]" multiple required>
                                        
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                            <div class="showinputfile admin_document_files">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_document_file'  && $value->user_id == 1) 
                                                            <div class="delete_document document-{{$value->id}}">
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                    <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                        <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                    </a>
                                                                </span>
                                                                <span class="bs-stepper-box">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Client document:</label><br>
                                            <div class="showinputfile user_document_files">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_document_file' && $value->user_id != 1) 
                                                            <div class="delete_document document-{{$value->id}}">
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                    <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                        <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                    </a>
                                                                </span>
                                                                <span class="bs-stepper-box">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Agreement file upload --}}
                    <form id="admin_agreement_document" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">


                        <div class="card" style="display: {{isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 ? 'block' : 'none'}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Agreement Upload</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Add agreement document:</label><br>
                                            <input type="file" id="admin_agreement_document" class="form-control" placeholder="Profile Image" name="admin_agreement_document" required>
                                        
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                                <div class="showinputfile admin_agreement">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step3_agreement_document'  && $value->user_id == 1) 
                                                                <div class="delete_document document-{{$value->id}}">
                                                                    <label for="checkout-survey_information" class="heading">Document</label>
                                                                    <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                        <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                            <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="bs-stepper-box">
                                                                        <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                            <i data-feather="download" class="font-medium"></i>
                                                                        </a>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;">
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <label for="checkout-survey_information" class="heading">Client document:</label><br>
                                                <div class="showinputfile document_agreement">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step3_agreement_document' && $value->user_id != 1) 
                                                                <div class="delete_document document-{{$value->id}}">
                                                                    <label for="checkout-survey_information" class="heading">Document</label>
                                                                    <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                        <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                            <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="bs-stepper-box">
                                                                        <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                            <i data-feather="download" class="font-medium"></i>
                                                                        </a>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-12">

                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        
                    {{-- Proposal file upload --}}
                    <form id="step_three_proposal_document" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">
                        @if(@$data['order_detail']->proposal_status == 2 )
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Order Confirmation</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-upload_document" class="heading">Upload Document</label>
                                            <input type="file" id="proposal_document_image" data-img-val="preview_proposal_document_image" class="form-control" placeholder="Document file" name="proposal_document_image[]" multiple>
                                        </div>
                                    </div>
                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                                <div class="showinputfile admin_proposal">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step3_proposal_document'  && $value->user_id == 1) 
                                                                <div class="delete_document document-{{$value->id}}">
                                                                    <label for="checkout-survey_information" class="heading">Document</label>
                                                                    <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                        <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                            <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="bs-stepper-box">
                                                                        <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                            <i data-feather="download" class="font-medium"></i>
                                                                        </a>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Client document:</label><br>
                                            <div class="showinputfile client_proposal">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_proposal_document' && $value->user_id != 1) 
                                                            <div class="delete_document document-{{$value->id}}">
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                    <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                        <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                    </a>
                                                                </span>
                                                                <span class="bs-stepper-box">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>

                    {{-- Installation start date --}}
                    <form id="step_three_installation" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">

                        <div class="card" id="installation_section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Installation Section</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @php
                                $installation_start_date = '';
                                $survey_time = '';
                                if(isset($data['order_detail']->installation_start_date)){
                                $installation_start_date = date('Y-m-d', strtotime($data['order_detail']->installation_start_date));
                                $installation_hour = date('H', strtotime($data['order_detail']->installation_start_date));
                                $installation_minute = date('i', strtotime($data['order_detail']->installation_start_date));

                                }
                                @endphp

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="installation_start_date" class="heading">Installation start date:</label>
                                        <div class="input-group mb-2">
                                            <input id="installation_start_date" style="width:50% " class="form-control " name="installation_start_date" type="date" value="{{ @$installation_start_date }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="installation_hour">Hour:</label>
                                        <label for="installation_minute" style="margin-left:33% ;">Minute:</label>
                                        <div class="input-group mb-2">

                                            @php
                                                $hours = array("01","02","03","04","05","06","07","08","09",
                                                10,11,12,13,14,15,16,17,18,19,20,21,22,23);
                                                $mins = array("00",15,30,45);
                                                $hourSelect = '';
                                            
                                                $hourSelect .= "<select name='installation_hour' class='form-control'>";
                                                    foreach ($hours as $key => $hour) {

                                                        $selected = @$installation_hour == $hour ? 'selected' :''; 

                                                        $hourSelect .= '<option value="'.$hour.'" '.$selected.'>'.$hour.'</option>';
                                                    }
                                                    $hourSelect .= '</select>';
                                                echo $hourSelect;

                                                $minuteSelect = '';
                                                $minuteSelect .= "<select name='installation_minute' class='form-control'>";
                                                    foreach ($mins as $key => $min) { 
                                                        $selectedmin = @$installation_minute == $min ? 'selected' :''; 
                                                        $minuteSelect .= '<option value="'.$min.'" '.$selectedmin.'>'.$min.'</option>';
                                                    }
                                                    $minuteSelect .= '</select>';
                                                echo $minuteSelect;
                                            @endphp
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <label for="installation_duration" class="heading">Installation Duration:</label>
                                        <div class="input-group mb-2">
                                            <textarea id="installation_duration" class="form-control " name="installation_duration" cols="30" placeholder="Installation duration" rows="3" value="{!! @$data['order_detail']->installation_duration !!}" >{!! @$data['order_detail']->installation_duration !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary btnformsubm_invoice btn_submit sbmt_form_data">Submit</button>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                   

                </div>
                <!-- Step Three Order Form Ends-->

                <!-- Step Four Order Form -->
                <div id="step-four" class="content {{ $follow_steps == 4 && $data['order_detail']->showroom_question != Null  ? 'active dstepper-block':'' }}">
                    <form id="invoice_one_form" class="list-view product-checkout">
                        <input type="hidden" class="invoice_step" name="invoice_step" value="1">
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        @csrf
                        <div class="customer-card">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-header">
                                            <h4 class="card-title">Upload First Invoice (30%)</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 pr-3">
                                        <div class="btn-model text-right">
    
                                            <button type="button" value="4" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="invoice_step_one_model">Assign Task</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body actions">
                                    <div class="row">

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-1">

                                                @if(isset($first_invoice_image))
                                                {{-- <label>Uploaded First Invoice: --}}
                                                    <a href="{{ asset($first_invoice_image) }}" download>Download First Invoice</a>
                                                {{-- </label> --}}
                                                @endif

                                            </div>

                                            <div class="form-group mb-2">
                                                {{-- <label for="checkout-first_invoice">Upload First Inovice:</label> --}}
                                                <input class="form-control" type="file" id="first_invoice" name="invoice_file" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 text-right mb-2" id="first_invoice_status" style="display: <?php echo $first_invoice_id == 0 ? 'none' : 'block' ?>">
                                            <label class="invoice_type_label">Invoice Status:</label>
                                            <div class="dropdown">
                                                <input type="hidden" class="invoice_id invoice_id_1" value="{{ $first_invoice_id }}">
                                                <select class="form-select rounded invoice_status invoice_status_dd invoice_dropdown" id="first_invoice_status" aria-label="Default select example" name="invoice_status">
                                                    <option value="1" {{ isset($first_status_invoice) && $first_status_invoice == 1 ? 'selected' : ''}}>Pending</option>
                                                    <option value="2" {{ isset($first_status_invoice) && $first_status_invoice == 2 ? 'selected' : ''}}>Payment Received</option>
                                                    <option value="3" {{ isset($first_status_invoice) && $first_status_invoice == 3 ? 'selected' : ''}}>Payment Not Received</option>
                                                    <option value="4" {{ isset($first_status_invoice) && $first_status_invoice == 4 ? 'selected' : ''}}>Invoice Sent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" id="first_invoice_btn" class="btn btn-primary btnformsubm_invoice btn_submit invoice_submit_data">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                      {{--invoice_step_one_model Assign Task Model --}}
                    <div class="modal fade" id="invoice_one_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form class="list-view product-checkout" id="task_step_invoice_one">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="7">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="7" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                     {{-- showroom question from clinet side --}}
                    @if(@$data['order_detail']->showroom_question)
                        <div class="card">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Showroom Invite</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Showroom question:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->showroom_question) ? @$data['order_detail']->showroom_question : '-----' }}</p>
                                </div>
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Showroom Visit date:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->showroon_visit_date) ? @$data['order_detail']->showroon_visit_date : '-----' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <form id="showroom_confirmation_form" method="POST" class="list-view product-checkout" action="{{ route('order.update',$data['order_detail']->id) }}">
                                    @method('PUT')
                                    @csrf
                                        <div class="col-md-6 ml-2 showroom_status">
                                            @if(@$data['order_detail']->showroom_visit_status == 1)
                                                <button value="2" name="showroom_visit_status" type="submit" class="btn btn-primary">Accept</button>
                                            @endif
                                        </div>
                                </form>

                                <div class="{{@$data['order_detail']->showroom_visit_status == 2 ? 'col-md-12 ml-2' :'col-md-6'}}" id="reschedule_div" style="margin-bottom: 17px;">
                                    <button type="button" value="5" class="btn btn-primary btn_submit" data-toggle="modal" id="reschedule_model">Reschedule</button>
                                </div>
                            </div>
                        </div>
                    @endif

                     {{--Reschedule Model--}}
                    <div class="modal fade" id="reschedule_date_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                        
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                        <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="step_four_reschedule">
                                        @csrf
                                        <!-- Customer Sale Information -->
                                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        <input type="hidden" class="follow_steps" name="follow_steps" value="4">
                                    
                                        <div class="row">
                                            @php
                                            $showroon_visit_date = '';
                                            $survey_time = '';
                                            if(isset($data['order_detail']->showroon_visit_date)){
                                            $showroon_visit_date = date('Y-m-d', strtotime($data['order_detail']->showroon_visit_date));
                                            $showroom_hour = date('H', strtotime($data['order_detail']->showroon_visit_date));
                                            $showroom_minute = date('i', strtotime($data['order_detail']->showroon_visit_date));

                                            }
                                            @endphp
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-12">
                                                        <div class="form-group">

                                                            <label for="showroon_visit_date" style="font-weight: 600">Showroom date and time:</label>
                                                            <div class="input-group mb-2">
                                                                <input id="showroon_visit_date" style="width:50% " class="form-control " name="showroon_visit_date" type="date" value="{{ $showroon_visit_date }}" />
                                                            
                                                            </div>

                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label for="installation_hour">Hour:</label>
                                                        {{-- <label for="installation_minute" style="margin-left:33% ;">Minute:</label> --}}
                                                        <div class="input-group mb-2" style="width: 68px;">

                                                            @php
                                                                $hours = array("01","02","03","04","05","06","07","08","09",
                                                                10,11,12,13,14,15,16,17,18,19,20,21,22,23);
                                                                $mins = array("00",15,30,45);
                                                                $hourSelect = '';
                                                            
                                                                $hourSelect .= "<select name='showroom_hour' class='form-control'>";
                                                                    foreach ($hours as $key => $hour) {

                                                                        $selected = @$showroom_hour == $hour ? 'selected' :''; 

                                                                        $hourSelect .= '<option value="'.$hour.'" '.$selected.'>'.$hour.'</option>';
                                                                    }
                                                                    $hourSelect .= '</select>';
                                                                echo $hourSelect;
                                                            @endphp
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <label for="installation_minute">Minute:</label>
                                                        <div class="input-group mb-2" style="width: 68px;">

                                                            @php
                                                                $minuteSelect = '';
                                                                $minuteSelect .= "<select name='showroom_minute' class='form-control'>";
                                                                    foreach ($mins as $key => $min) { 
                                                                        $selectedmin = @$showroom_minute == $min ? 'selected' :''; 
                                                                        $minuteSelect .= '<option value="'.$min.'" '.$selectedmin.'>'.$min.'</option>';
                                                                    }
                                                                    $minuteSelect .= '</select>';
                                                                echo $minuteSelect;
                                                            @endphp
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="button" id="formsubmit" follow_steps="4" class="btn btn-primary btnformsubm btn_submit sbmt_form_data">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="showroom_visit_confirm">

                        <form id="order_information" class="list-view product-checkout">
                            @csrf
                            <!-- Customer Sale Information -->
                        
                            <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                            <input type="hidden" class="follow_steps" name="follow_steps" value="4">
                            <div class="card" id="customer_sale_info" style="display: {{ @$first_status_invoice == 2 || @$data['order_detail']->ordering_items ? 'block' : 'none'}};">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-header flex-column align-items-start">
                                            <h4 class="card-title">Items to order information</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 pr-3">
                                        <div class="btn-model text-right">
                                            <button type="button" value="5" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="assign_model_order_information">Assign Task</button>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="card-body">
                                    <div class="row">
                                        {{-- <div class="col-md-5 col-sm-12">
                                            <label for="installation_date" style="font-weight: 600">Installation Date/Time:</label>
                                            <div class="input-group mb-2">
                                                <input id="installation_date" style="width:50% " class="form-control " name="installation_date" type="date" value="{{ @$order_installation_date }}" />
                                            </div>

                                        </div> --}}

                                        {{-- <div class="col-md-2">
                                            <label for="order_installation_hour">Hour:</label>
                                            <label for="order_installation_minute" style="margin-left:33% ;">Minute:</label>
                                            <div class="input-group mb-2">

                                                @php
                                                $hours = array("01","02","03","04","05","06","07","08","09",
                                                10,11,12,13,14,15,16,17,18,19,20,21,22,23);
                                                $mins = array("00",15,30,45);
                                                $hourSelect = '';
                                                $hourSelect .= "<select name='order_installation_hour' class='form-control'>";
                                                    foreach ($hours as $hour) {
                                                        $selected = @$order_installation_hour == $hour ? 'selected' :''; 
                                                        $hourSelect .= '<option value="'.$hour.'" '.$selected.' >'.$hour.'</option>';
                                                    }
                                                    $hourSelect .= '</select>';
                                                echo $hourSelect;

                                                $minuteSelect = '';
                                                $minuteSelect .= "<select name='order_installation_minute' class='form-control'>";
                                                    foreach($mins as $min) {
                                                        $selected = @$order_installation_minute == $min ? 'selected' :''; 
                                                        $minuteSelect .= '<option value="'.$min.'" '.$selected.'>'.$min.'</option>';
                                                    }
                                                    $minuteSelect .= '</select>';
                                                echo $minuteSelect;
                                                @endphp

                                                <!-- <input style="width:50% " class="form-control " name="survey_time" type="time" value="{{ @$survey_time }}" /> -->
                                            </div>
                                        </div> --}}


                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group mb-2">
                                                @php
                                                $ordering_items_value = json_decode(@$data['order_detail']->ordering_items);
                                                  
                                                @endphp
                                              
                                                <label for="checkout-ordering_items" style="font-weight: 600;">List of order information:</label>

                                                <div class="form-check" style="margin-left: 20px;">
                                                    <input class="form-check-input" type="checkbox" name="ordering_items[]" id="windowsCheck" value="windows" {{@in_array('windows', @$ordering_items_value) ? 'checked' :''}}>
                                                    <label class="form-check-label" for="windowsCheck">
                                                    Windows
                                                    </label>
                                                </div>
                                                <div class="form-check" style="margin-left: 20px;">
                                                    <input class="form-check-input" type="checkbox" name="ordering_items[]" id="doorCheck" value="doors" {{@in_array('doors', @$ordering_items_value) ? 'checked' :''}} >
                                                    <label class="form-check-label" for="doorCheck">
                                                    Doors
                                                    </label>
                                                </div>

                                                {{-- <textarea class="form-control" id="ordering_items" name="ordering_items" cols="30" rows="5" placeholder="Items to Order Information" value="{!! @$data['order_detail']->ordering_items !!}">{!! @$data['order_detail']->ordering_items !!}</textarea> --}}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" id="formsubmit" follow_steps="4" class="btn btn-primary btnformsubm btn_submit sbmt_form_data">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        {{-- assign_model_order_information Assign Task Model --}}
                        <div class="modal fade" id="step_four_order_information" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                            
                                    <div class="card-body">
                                        {{-- @if (Session::has('message')) --}}
                                            <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                        {{-- @endif --}}
                                        {{-- @if (Session::has('error_message')) --}}
                                            <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                        {{-- @endif --}}

                                        <form class="list-view product-checkout" id="task_step_four_data">
                                            <input type="hidden" name="task_step" class="task_step" id="task_step" value="5">
                                            <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task">Select Staff Member</label>
                                                                <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                    <option value="">Choose Staff Member</option>
                                                                    @if(isset($data['staff_members']))
                                                                        @foreach($data['staff_members'] as $item => $user)
                                                                            <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @error('assign_user_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="due_date">Due Date</label>
                                                                <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                                @error('due_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
        
                                                        
                                                        @if (isset($data->id))
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task_status">Task Status</label>
                                                                <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                    <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                    <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                    <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="task_description">Task Description</label>
                                                                <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="col-12">
                                                    <button type="button" value="5" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                          {{-- showroom invite email --}}
                        {{-- @if(isset($data['order_detail']->installation_datetime)) --}}
                        <div class="card">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Showroom invite email</h4>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" value="7" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="showroom_invite_email">Assign Task</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" value="5" class="btn btn-primary btn_submit send_email_confirmation mr-1">Showroom invite email</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        {{-- @endif --}}

                        {{-- showroom_invite_email Assign Task Model --}}
                        <div class="modal fade" id="showroom_invite_email_task" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                            
                                    <div class="card-body">
                                        {{-- @if (Session::has('message')) --}}
                                            <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                        {{-- @endif --}}
                                        {{-- @if (Session::has('error_message')) --}}
                                            <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                        {{-- @endif --}}

                                        <form class="list-view product-checkout" id="showroom_invite_email_form">
                                            <input type="hidden" name="task_step" class="task_step" id="task_step" value="6">
                                            <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task">Select Staff Member</label>
                                                                <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                    <option value="">Choose Staff Member</option>
                                                                    @if(isset($data['staff_members']))
                                                                        @foreach($data['staff_members'] as $item => $user)
                                                                            <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif


                                                                </select>
                                                                @error('assign_user_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="due_date">Due Date</label>
                                                                <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                                @error('due_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        
                                                        @if (isset($data->id))
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task_status">Task Status</label>
                                                                <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                    <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                    <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                    <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="task_description">Task Description</label>
                                                                <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button type="button" value="6" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        {{--Upload Second Invoice  --}}
                        <form id="invoice_two_form" class="list-view product-checkout">
                            @csrf
                            <input type="hidden" class="invoice_step" name="invoice_step" value="2">
                            <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                            <div class="customer-card" id="second_invoice_info">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card-header">
                                                <h4 class="card-title">Upload Second Invoice (40%)</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12 pr-3">
                                            <div class="btn-model text-right">
                                                <button type="button" value="6" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="invoice_step_two_model">Assign Task</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="card-body actions">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-1">

                                                    @if(isset($second_invoice_image))
                                                        <a href="{{ asset($second_invoice_image) }}" download>Download Second Invoice</a>
                                                    @endif

                                                </div>
                                                <div class="form-group mb-2">
                                                    <input class="form-control" type="file" id="second_invoice" name="invoice_file" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 text-right mb-2" id="second_invoice_status" style="display:<?php echo $second_invoice_id == 0 ? 'none' : 'block' ?>">
                                                <label class="invoice_type_label">Invoice Status:</label>
                                                <div class="dropdown">

                                                    <input type="hidden" class="invoice_id invoice_id_2" value="{{ $second_invoice_id }}">
                                                    <select class="form-select rounded invoice_status invoice_status_dd invoice_dropdown" id="second_invoice_status" aria-label="Default select example" name="invoice_status">
                                                        <option value="1" {{ isset($second_status_invoice) && $second_status_invoice == 1 ? 'selected' : ''}}>Pending</option>
                                                        <option value="2" {{ isset($second_status_invoice) && $second_status_invoice == 2 ? 'selected' : ''}}>Payment Received</option>
                                                        <option value="3" {{ isset($second_status_invoice) && $second_status_invoice == 3 ? 'selected' : ''}}>Payment Not Received</option>
                                                        <option value="4" {{ isset($second_status_invoice) && $second_status_invoice == 4 ? 'selected' : ''}}>Invoice Sent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" id="secondid_invoice_btn" class="btn btn-primary btnformsubm_invoice btn_submit invoice_submit_data">Upload</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Customer Sale Information Ends-->
                        </form>
                        {{-- Second invoice model Assign Task Model --}}
                        <div class="modal fade" id="invoice_two_model" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                            
                                    <div class="card-body">
                                        {{-- @if (Session::has('message')) --}}
                                            <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                        {{-- @endif --}}
                                        {{-- @if (Session::has('error_message')) --}}
                                            <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                        {{-- @endif --}}

                                        <form id="task_step_invoice_two" class="list-view product-checkout">
                                            <input type="hidden" name="task_step" class="task_step" id="task_step" value="8">
                                            <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task">Select Staff Member</label>
                                                                <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                    <option value="">Choose Staff Member</option>
                                                                    @if(isset($data['staff_members']))
                                                                        @foreach($data['staff_members'] as $item => $user)
                                                                            <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
        
        
                                                                </select>
                                                                @error('assign_user_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="due_date">Due Date</label>
                                                                <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                                @error('due_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
        
                                                        
                                                        @if (isset($data->id))
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task_status">Task Status</label>
                                                                <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                    <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                    <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                    <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="task_description">Task Description</label>
                                                                <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="col-12">
                                                    <button type="button" value="8" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        {{--Upload Showroom Invoice/Extra invoice  --}}
                        <form id="showroom_invoice_form" class="list-view product-checkout">
                            @csrf
                            <input type="hidden" class="invoice_step" name="invoice_step" value="5">
                            <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                            <div class="customer-card" id="showroom_form">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card-header">
                                                <h4 class="card-title">Upload Showroom Extra Invoice</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12 pr-3">
                                            <div class="btn-model text-right">
                                                <button type="button" value="8" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="showroom_invoice_model">Assign Task</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="card-body actions">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-1">

                                                    @if(isset($fifth_invoice_image))
                                                    {{-- <label>Uploaded Second Invoice: --}}
                                                        <a href="{{ asset($fifth_invoice_image) }}" download>Download showroom extra invoice</a>
                                                    {{-- </label> --}}
                                                    @endif

                                                </div>
                                                <div class="form-group mb-2">
                                                    <input class="form-control" type="file" id="second_invoice" name="invoice_file" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 text-right mb-2" id="showroom_extra_invoice" style="display:<?php echo @$fifth_invoice_id == 0 ? 'none' : 'block' ?>">
                                                <label class="invoice_type_label">Invoice Status:</label>
                                                <div class="dropdown">

                                                    <input type="hidden" class="invoice_id invoice_id_5" value="{{ @$fifth_invoice_id }}">
                                                    <select class="form-select rounded invoice_status invoice_status_dd invoice_dropdown" id="showroom_extra_invoice" aria-label="Default select example" name="invoice_status">
                                                        <option value="1" {{ isset($fifth_status_invoice) && $fifth_status_invoice == 1 ? 'selected' : ''}}>Pending</option>
                                                        <option value="2" {{ isset($fifth_status_invoice) && $fifth_status_invoice == 2 ? 'selected' : ''}}>Payment Received</option>
                                                        <option value="3" {{ isset($fifth_status_invoice) && $fifth_status_invoice == 3 ? 'selected' : ''}}>Payment Not Received</option>
                                                        <option value="4" {{ isset($fifth_status_invoice) && $fifth_status_invoice == 4 ? 'selected' : ''}}>Invoice Sent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" id="showroom_extra_invoice_btn" class="btn btn-primary btnformsubm_invoice btn_submit invoice_submit_data">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Customer Sale Information Ends-->
                        </form>
                        {{-- Showroom Invoice Assign Task Model/Extra invoice --}}
                        <div class="modal fade" id="showroom_invoice_assign_model" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                            
                                    <div class="card-body">
                                        {{-- @if (Session::has('message')) --}}
                                            <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                        {{-- @endif --}}
                                        {{-- @if (Session::has('error_message')) --}}
                                            <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                        {{-- @endif --}}

                                        <form id="showroom_invoice_task_step" class="list-view product-checkout">
                                            <input type="hidden" name="task_step" class="task_step" id="task_step" value="9">
                                            <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task">Select Staff Member</label>
                                                                <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                    <option value="">Choose Staff Member</option>
                                                                    @if(isset($data['staff_members']))
                                                                        @foreach($data['staff_members'] as $item => $user)
                                                                            <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @error('assign_user_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="due_date">Due Date</label>
                                                                <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                                @error('due_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        @if (isset($data->id))
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task_status">Task Status</label>
                                                                <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                    <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                    <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                    <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="task_description">Task Description</label>
                                                                <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button type="button" value="9" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        {{-- Portallo section --}}
                        {{-- @if(isset($data['order_detail']->installation_datetime)) --}}
                        <form id="portallo_form">
                            @csrf
                            <!-- Customer Sale Information -->
                            <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                            <input type="hidden" class="follow_steps" name="follow_steps" value="4">
                            <div class="customer-card">
                        
                                <div class="card" id="porlallo">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card-header flex-column align-items-start">
                                                <h4 class="card-title">Portallo section</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12 pr-3">
                                            <div class="btn-model text-right">
                                                <button type="button" value="9" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="portallo_ordered">Assign Task</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                        
                                            <div class="form-check ml-1 mb-2">
                                                <label class="form-check-label" style="margin-right: 34px;">
                                                    Portaloo ordered
                                                </label>
                                                <input type="radio" id="smt-fld-1-2" class="form-check-input" value="1" name="portallo_ordered" {{isset($data['order_detail']->portallo_ordered) &&  $data['order_detail']->portallo_ordered == 1 ? 'checked' : '' }} style="width: 12px;"><label style="margin-right: 16px;">Yes</label>
                                                
                                                <input type="radio" id="smt-fld-1-2" name="portallo_ordered" value="2" {{isset($data['order_detail']->portallo_ordered) &&  $data['order_detail']->portallo_ordered == 2 ? 'checked' : '' }}  style="width: 12px;"><label style="margin-left: 6px;">No</label>

                                            </div>
                                            
                                            <div class="col-12">

                                                <button type="button" id="formsubmit" follow_steps="4" class="btn btn-primary btnformsubm btn_submit sbmt_form_data">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- @endif --}}

                        {{-- Portallo Assign Task Model --}}
                        <div class="modal fade" id="portallo_assign_task" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                            
                                    <div class="card-body">
                                        {{-- @if (Session::has('message')) --}}
                                            <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                        {{-- @endif --}}
                                        {{-- @if (Session::has('error_message')) --}}
                                            <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                        {{-- @endif --}}

                                        <form id="portallo_task_step" class="list-view product-checkout">
                                            <input type="hidden" name="task_step" class="task_step" id="task_step" value="10">
                                            <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task">Select Staff Member</label>
                                                                <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                    <option value="">Choose Staff Member</option>
                                                                    @if(isset($data['staff_members']))
                                                                        @foreach($data['staff_members'] as $item => $user)
                                                                            <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif


                                                                </select>
                                                                @error('assign_user_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="due_date">Due Date</label>
                                                                <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                                @error('due_date')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        
                                                        @if (isset($data->id))
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="task_status">Task Status</label>
                                                                <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                    <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                    <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                    <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="task_description">Task Description</label>
                                                                <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button type="button" value="10" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    
                </div>
                <!-- Step Four Order Form Ends-->

                <!-- Step Five Order Form -->
                <div id="step-five" class="content {{ $follow_steps == 5 ? 'active dstepper-block':'' }}">

                    <form id="invoice_three_form" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" class="invoice_step" name="invoice_step" value="3">
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <div class="customer-card">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-header">
                                            <h4 class="card-title">Upload Third Invoice (20%)</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 pr-3">
                                        <div class="btn-model text-right">
                                            <button type="button" value="10" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="invoice_step_three_model">Assign Task</button>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="card-body actions">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mb-1">
                                            <div class="form-group mb-1">
                                                @if(isset($third_invoice_image))
                                                        <a href="{{ asset($third_invoice_image) }}" download>Download Third Invoice</a>
                                                @endif
                                            </div>
                                            <div class="form-group mb-2">
                                                 {{-- <label for="checkout-third_invoice">Upload Third Inovice:</label> --}}
                                                <input class="form-control" type="file" id="third_invoice" name="invoice_file" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 text-right mb-2">
                                            <div id="third_invoice_status" style="display: <?php echo $third_invoice_id == 0 ? 'none' : 'block' ?> ">
                                                <label class="invoice_type_label">Invoice Status:</label>
                                                <div class="dropdown">
                                                    <input type="hidden" class="invoice_id invoice_id_3" value="{{ $third_invoice_id }}">
                                                    <select class="form-select rounded invoice_status invoice_status_dd invoice_dropdown" aria-label="Default select example" id="third_invoice_status" name="invoice_status">
                                                        <option value="1" {{ isset($third_status_invoice) && $third_status_invoice == 1 ? 'selected' : ''}}>Pending</option>
                                                        <option value="2" {{ isset($third_status_invoice) && $third_status_invoice == 2 ? 'selected' : ''}}>Payment Received</option>
                                                        <option value="3" {{ isset($third_status_invoice) && $third_status_invoice == 3 ? 'selected' : ''}}>Payment Not Received</option>
                                                        <option value="4" {{ isset($third_status_invoice) && $third_status_invoice == 4 ? 'selected' : ''}}>Invoice Sent</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-12" style="margin-top: 5px">
                                            <button type="button" id="third_invoice_btn" class="btn btn-primary btnformsubm_invoice btn_submit invoice_submit_data">Upload</button>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" value="1" class="btn btn-primary btn_submit send_email_confirmation mr-1">Installation commenced email</button>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" value="2" class="btn btn-primary btn_submit send_email_confirmation mr-1">Installation progress email</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Checkout Customer Address Right ends -->
                    </form>
                     {{-- Invoice three Assign Task Model --}}
                    <div class="modal fade" id="invoice_three_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="task_step_invoice_three" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="11">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="11" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <form id="email_confirmaiton" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" class="invoice_step" name="invoice_step" value="3">
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">

                    </form>
                </div>
                <!-- Step Five Order Form Ends-->

                <!-- Step Six Order Form -->

                <div id="step-six" class="content {{ $follow_steps == 6 ? 'active dstepper-block':'' }}">
                    <form id="invoice_four_form" class="list-view product-checkout">
                        <input type="hidden" class="invoice_step" class="follow_steps" name="invoice_step" value="4">
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        @csrf

                        <div class="customer-card">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-header">
                                            <h4 class="card-title">Upload Fourth Invoice (10%)</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 pr-3">
                                        <div class="btn-model text-right">
                                            <button type="button" value="11" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="invoice_step_four_model">Assign Task</button>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="card-body actions">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-1">

                                                @if(isset($fourth_invoice_image))
                                                    <a href="{{ asset($fourth_invoice_image) }}" download>Download Fourth Invoice</a>
                                                @endif

                                            </div>
                                            <div class="form-group mb-2">
                                                <input class="form-control" type="file" id="fourth_invoice" name="invoice_file" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 text-right" id="fourth_invoice_status" style="display: <?php echo $fourth_invoice_id == 0 ? 'none' : 'block' ?>">
                                            <label class="invoice_type_label">Invoice Status:</label>
                                            <div class="dropdown">
                                                <input type="hidden" class="invoice_id invoice_id_4" value="{{ $fourth_invoice_id }}">
                                                <select class="form-select w-25 rounded invoice_status_dd invoice_dropdown" aria-label="Default select example" id="fourth_invoice_status" name="invoice_status">
                                                    <option value="1" {{ isset($fourth_status_invoice) && $fourth_status_invoice == 1 ? 'selected' : ''}}>Pending</option>
                                                    <option value="2" {{ isset($fourth_status_invoice) && $fourth_status_invoice == 2 ? 'selected' : ''}}>Payment Received</option>
                                                    <option value="3" {{ isset($fourth_status_invoice) && $fourth_status_invoice == 3 ? 'selected' : ''}}>Payment Not Received</option>
                                                    <option value="4" {{ isset($fourth_status_invoice) && $fourth_status_invoice == 4 ? 'selected' : ''}}>Invoice Sent</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" id="fourth_invoice_btn" class="btn btn-primary btnformsubm_invoice btn_submit invoice_submit_data">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                      {{--Invoie four Assign Task Model --}}
                    <div class="modal fade" id="invoice_four_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="task_step_invoice_four" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="12">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="12" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                  
                    {{-- installation checklist notes form --}}
                    <form id="installation_checklist_form" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="6">
                        <div class="card" id="installation_checklist_section" style="display: {{@$fourth_status_invoice && @$fourth_status_invoice == 2 ? 'block': 'none'}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header">
                                        <h4 class="card-title">Installation Checklist</h4>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" value="13" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="installation_checklist_task_model">Assign Task</button>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="installation_checklist_notes"  class="heading">Installation checklist notes</label>
                                            <textarea name="installation_checklist_notes" id="installation_checklist_notes" class="form-control" cols="30" rows="3" placeholder="Installation checklist notes" value="{!! @$data['order_detail']->installation_checklist_notes !!}">{!! @$data['order_detail']->installation_checklist_notes !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary btnformsubm_invoice btn_submit sbmt_form_data">Sent to client</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- installation checklist notes Task Model --}}
                    <div class="modal fade" id="installation_checklist_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="installation_checklist_model_form" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="13">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="13" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                     {{--Upload manual  --}}
                    <form id="upload_manual_document" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="6">
                        <div class="card" id="upload_manual_section" style="display: {{@$data['order_detail']->installation_checklist_notes ? 'block': 'none'}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header">
                                        <h4 class="card-title">Upload Manual</h4>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" value="14" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="upload_mannual_document_model">Assign Task</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Add upload manual document:</label><br>
                                            <input type="file" id="upload_manual" class="form-control" placeholder="Upload manual document" data-img-val="preview_proposal_document_image" name="upload_manual" required>
                                         
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <div class="showinputfile manual_admin_document">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step6_upload_manual'  && $value->user_id == 1) 
                                                                <div class="delete_document document-{{$value->id}}">
                                                                    <label for="checkout-survey_information" class="heading">Document</label>
                                                                    <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                        <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                            <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="bs-stepper-box">
                                                                        <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                            <i data-feather="download" class="font-medium"></i>
                                                                        </a>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-12">

                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                     {{-- Upload manual Task Model --}}
                    <div class="modal fade" id="upload_mannual_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="upload_mannual_task_form" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="14">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="14" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{--Gurantee document --}}
                    <form id="gurantee_document" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="6">
                        <div class="card" id="gurantee_section" style="display: {{@$step_six_manual_docuemnt_id != 0 ? 'block': 'none'}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header">
                                        <h4 class="card-title">Gurantee Upload</h4>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" value="15" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="upload_gurantee_document_model">Assign Task</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Add Gurantee document:</label><br>
                                            <input type="file" id="guarantee_document" class="form-control" placeholder="Gurantee document" name="guarantee_document" required>
                                         
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <div class="showinputfile gurantee_admin_document">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step6_guarantee_document'  && $value->user_id == 1) 
                                                                <div class="delete_document document-{{$value->id}}">
                                                                    <label for="checkout-survey_information" class="heading">Document</label>
                                                                    <span class="bs-stepper-box ml-2" style="margin-right: 15px;">
                                                                        <a href="javascript:void(0)" data-id="{{ $value->id }}" class="deletebtn">
                                                                            <i data-feather="trash" class="font-medium icons"  type="submit"></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="bs-stepper-box">
                                                                        <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                            <i data-feather="download" class="font-medium"></i>
                                                                        </a>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-12">

                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                     {{-- Gurantee document Task Model --}}
                     <div class="modal fade" id="upload_gurantee_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="upload_gurantee_task_from" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="15">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="15" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- Rectification end period --}}
                    <form id="rectification_period" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="6">

                        <div class="card" id="rectification_period_section" style="display:{{@$step_six_guarantee_docuemnt_id != 0  ? 'block' :'none'}}" >
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-header">
                                        <h4 class="card-title">Rectification period</h4>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 pr-3">
                                    <div class="btn-model text-right">
                                        <button type="button" value="16" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="rectification_period_model">Assign Task</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @php
                                $rectification_period_date = '';
                                $survey_time = '';
                                if(isset($data['order_detail']->rectification_period_date)){
                                // $rectification_period_date = date('Y-m-d\\TH:i', strtotime($data['order_detail']->rectification_period_date));
                                $rectification_period_date = date('Y-m-d', strtotime($data['order_detail']->rectification_period_date));
                                $rectification_period_hour = date('H', strtotime($data['order_detail']->rectification_period_date));
                                $rectification_period_minute = date('i', strtotime($data['order_detail']->rectification_period_date));

                                }
                                @endphp

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="rectification_period_date" class="heading">Rectification period end date:</label>
                                        <div class="input-group mb-2">
                                            <input id="rectification_period_date" style="width:50% " class="form-control " name="rectification_period_date" type="date" value="{{ @$rectification_period_date }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="rectification_period_hour">Hour:</label>
                                        <label for="rectification_period_minute" style="margin-left:33% ;">Minute:</label>
                                        <div class="input-group mb-2">

                                            @php
                                                $hours = array("01","02","03","04","05","06","07","08","09",
                                                10,11,12,13,14,15,16,17,18,19,20,21,22,23);
                                                $mins = array("00",15,30,45);
                                                $hourSelect = '';
                                            
                                                $hourSelect .= "<select name='rectification_period_hour' class='form-control'>";
                                                    foreach ($hours as $key => $hour) {

                                                        $selected = @$rectification_period_hour == $hour ? 'selected' :''; 

                                                        $hourSelect .= '<option value="'.$hour.'" '.$selected.'>'.$hour.'</option>';
                                                    }
                                                    $hourSelect .= '</select>';
                                                echo $hourSelect;

                                                $minuteSelect = '';
                                                $minuteSelect .= "<select name='rectification_period_minute' class='form-control'>";
                                                    foreach ($mins as $key => $min) { 
                                                        $selectedmin = @$rectification_period_minute == $min ? 'selected' :''; 
                                                        $minuteSelect .= '<option value="'.$min.'" '.$selectedmin.'>'.$min.'</option>';
                                                    }
                                                    $minuteSelect .= '</select>';
                                                echo $minuteSelect;
                                            @endphp
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary btnformsubm_invoice btn_submit sbmt_form_data">Submit</button>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </form>

                    {{-- Rectification end period Task Model --}}
                    <div class="modal fade" id="rectification_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="rectification_period_task_form" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="16">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="16" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- Checklist form --}}
                    <form id="step_six_form" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="6">
                        <input type="hidden" id="installation_checklist" name="installation_checklist" value="2">
                        <div class="card" id="project_invoice_info"  style="display: {{isset($data['order_detail']->rectification_period_date) ? 'block': 'none'}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-2 ml-2" id="installation_checkbox">

                                            <input type="hidden" class="invoice_id invoice_id_4" value="{{ $fourth_invoice_id }}">
                                            <label class="form-check-label" id="flexCheckDefault"> <input class="form-check-input sbmt_form_data" type="checkbox" name="installation_checklist_status" id="flexCheckDefault" {{ isset($data['order_detail']->installation_checklist) && $data['order_detail']->installation_checklist == 1 ? 'checked=checked' : '' }}> Installation checklist complete</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 pr-3">
                                        <div class="btn-model text-right">
                                            <button type="button" value="12" class="btn btn-primary btn_submit btn-md mt-2 text-right" data-toggle="modal" id="assign_model_stepsix" style="margin-right: -4%;">Assign Task</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <button type="button" value="3" class="btn btn-primary btn_submit send_email_confirmation">Send manual email</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                     {{-- Checklist complete Assign Task Model --}}
                     <div class="modal fade" id="step_six_model" role="dialog">
                        <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                           
                                <div class="card-body">
                                    {{-- @if (Session::has('message')) --}}
                                        <div class="alert alert-success alert-success-assign"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                                    {{-- @endif --}}
                                    {{-- @if (Session::has('error_message')) --}}
                                         <div class="alert alert-danger alert-danger-assign"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                                    {{-- @endif --}}

                                    <form id="task_step_six_data" class="list-view product-checkout">
                                        <input type="hidden" name="task_step" class="task_step" id="task_step" value="17">
                                        <input type="hidden" name="enquery_id" id="assign_enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task">Select Staff Member</label>
                                                            <select class="form-control @error('assign_user_id') is-invalid @enderror" name="assign_user_id" id="assign_user_id">
                                                                <option value="">Choose Staff Member</option>
                                                                @if(isset($data['staff_members']))
                                                                    @foreach($data['staff_members'] as $item => $user)
                                                                        <option  {{ old('assign_user_id') == $user['id'] || (isset($data->assign_user_id) && $data->assign_user_id==$user['id'])? 'selected': '' }} value="{{ $user['id'] }}">{{ $user['first_name']. ' ' .$user['last_name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
    
    
                                                            </select>
                                                            @error('assign_user_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="date" value="{{old('due_date', isset($data->due_date)? $data->due_date: '')}}" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date">
                                                            @error('due_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
                                                    
                                                    @if (isset($data->id))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="task_status">Task Status</label>
                                                            <select class="form-control @error('task_status') is-invalid @enderror" name="task_status" id="task_status">
                                                                <option {{$data->task_status == 'Pending'? 'selected':''}}  value="1">Pending</option>
                                                                <option {{$data->task_status == 'In Progress'? 'selected':''}}  value="2">In Progress</option>
                                                                <option {{$data->task_status == 'Completed'? 'selected':''}}  value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="task_description">Task Description</label>
                                                            <textarea name="task_description" id="task_description" class="form-control" cols="30" rows="3" placeholder="Task Description" ></textarea>
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-12">
                                                <button type="button" value="17" class="btn btn-primary mr-1 waves-effect waves-float waves-light task_submit">{{ isset($data->id)? 'Update':'Add' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
                <!-- Step Six Order Form Ends-->

                <!-- Step Seven Order Form -->
                <div id="step-seven" class="content {{ $follow_steps == 7 ? 'active dstepper-block':'' }}">
                    <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                    <input type="hidden" class="follow_steps" name="follow_steps" value="7">
                    <div class="step_seven_form" id="step_seven_form">
                        <!-- <div class="card"> -->
                        <div class="alert alert-success2 status-div text-left">
                            Congratulations!! Order has been completed successfully.
                        </div>
                    </div>
                </div>
                <!-- Step Seven Order Form Ends-->

            </div>
        </div>
        <!-- Order steps End -->

    </div>

    @section('scripts')
    <script>
        $(document).ready(function() {
            <?php
            if (isset($follow_steps)) {
            ?>
                follow_steps_active('{{$data_target}}');
            <?php
            }
            ?>

            $("#first_invoice_btn").click(function() {
                $('#first_invoice_status').show();
            });
            $("#secondid_invoice_btn").click(function() {
                $('#second_invoice_status').show();
            });
            $("#showroom_extra_invoice_btn").click(function() {
                $('#showroom_extra_invoice').show();
            });
            $("#third_invoice_btn").click(function() {
                $('#third_invoice_status').show();
            });
            $("#fourth_invoice_btn").click(function() {
                $('#fourth_invoice_status').show();
            });

        });

        function follow_steps_active(prm_data_target) {
            $('.content').removeClass('active dstepper-block');
            $('#' + prm_data_target).addClass('active dstepper-block');
            $('.step').removeClass('active');
            $('.step').addClass('crossed');
            $('.step').each(function() {
                var data_target = $(this).attr('data-target');
                if (data_target == '#' + prm_data_target) {
                    // alert('run');
                    $(this).removeClass('temp-step');
                    $(this).removeClass('crossed');
                    $(this).addClass('active');
                    $(this).addClass('step');
                }
            });

            $('.temp-step').each(function() {
                var data_target = $(this).attr('data-target');
                if (data_target == '#' + prm_data_target) {
                    $(this).removeClass('temp-step');
                    $(this).addClass('step');
                    $(this).addClass('active');
                }
            });
        }
    </script>
    @endsection

    @endsection