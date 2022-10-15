@section('title', 'Order')
@extends('layouts.admin')

@section('content')

@php

$order_id = 0 ;

if(isset($data['order_detail']->id)){

$order_id = $data['order_detail']->id;
}
if(isset($data['order_asset_detail']->id)){

$order_id =$data['order_asset_detail']->id;
}


$step_two_id = 0;
$step_three_agreement_id = 0;
$step_three_proposal_docuemnt_id = 0;
$step_six_guarantee_docuemnt_id = 0;
$step_six_manual_docuemnt_id = 0;
if(isset($data['order_asset_detail'])){
    foreach($data['order_asset_detail'] as $key => $value){
        
       if ($value->field_name == 'step2_document') {
        $step_two_document = $value->file_path;
        $step_two_field_name = $value->field_name;
        $step_two_id = $value->id;
        $step_two_user_id = $value->user_id;
      
       }
       if ($value->field_name == 'step3_document_file') {
        $step_three_document = $value->file_path;
        $step_three_document_field_name = $value->field_name;
        $step_three_document_id = $value->id;
        $step_three_document_user_id = $value->user_id;
       }
       if ($value->field_name == 'step3_agreement_document') {
        $step_three_agreement = $value->file_path;
        $step_three_agreement_field_name = $value->field_name;
        $step_three_agreement_id = $value->id;
        $step_agreement_document_user_id = $value->user_id;
       }
       if ($value->field_name == 'step3_proposal_document') {
        $step_three_proposal_file_path = $value->file_path;
        $step_three_proposal_field_name = $value->field_name;
        $step_three_proposal_docuemnt_id = $value->id;
        $step_three_proposal_user_id = $value->id;
       }
       if ($value->field_name == 'step6_upload_manual') {
        $step_six_manual_file_path = $value->file_path;
        $step_six_manual_field_name = $value->field_name;
        $step_six_manual_docuemnt_id = $value->id;
        $step_six_mannual_user_id = $value->user_id;
       }
       if ($value->field_name == 'step6_guarantee_document') {
        $step_six_guarantee_file_path = $value->file_path;
        $step_six_guarantee_field_name = $value->field_name;
        $step_six_guarantee_docuemnt_id = $value->id;
        $step_six_guarantee_user_id = $value->user_id;
       }
       
    }
}

$follow_steps = 0 ;
$data_target = 'step-one';
if(isset($data['order_detail']->follow_steps)){
$follow_steps = $data['order_detail']->follow_steps;
}
if($follow_steps == 1){
$data_target = 'step-one';

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
$fifth_status_invoice = 0;

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
 
@endphp
<style>
    html {
        scroll-behavior: smooth;
    }

    .bs-stepper-header .line {
        display: none;
    }

    .para-info {
        font-size: 14px;
        text-align: justify;
    }
    .heading{
        font-weight: 600;
    }
    @media screen and (max-width: 700px) {
        .xs-hide-d-flex{
            display: block !important;
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
                <!-- <div class="alert alert-danger"><strong>Sorry: </strong><span class="error-message"></span></div>
                <div class="alert alert-success"><strong>Success: </strong><span class="success-message"></span></div> -->
               
                @if (Session::has('message'))
                 <div class="alert alert-success2"><b>Success: </b>{{ Session::get('message') }}</div>
                @endif
                @if (Session::has('error-message'))
                <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error-message') }}</div>
                @endif

                @if (Session::has('message') || Session::has('error-message'))
                @else
                @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 3 && empty($data['order_detail']->survey_information))
                <div class="alert alert-danger2 status-div">
                    <p>Sale pick up date and time has been rejected.</p>
                </div>
                @endif
                @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 2 && !empty($data['order_detail']->survey_information) && empty($data['order_detail']->proposal_status))
                    <div class="alert alert-success2 status-div">
                        <p>Survey notes added successfully.</p>
                    </div>
                @endif
                {{-- @if (isset($data['order_detail']->survey_status) && $data['order_detail']->survey_status == 2 && !empty($data['order_detail']->survey_information) && isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status != 2)
                    <div class="alert alert-success2 status-div">
                        <p>Please accept proposal to continue further.</p>
                    </div>
                @endif --}}
                {{-- @if (@$data['order_detail']->survey_status == 2 && @$data['order_detail']->proposal_status == 2 && empty($data['order_detail']->showroon_visit_date))
                    <div class="alert alert-success2 status-div">
                        <p>Please add showroom questions.</p>
                    </div>
                @endif --}}
               
              
                @if (@$data['order_detail']->survey_status == 2 && $data['order_detail']->proposal_status == 2 && $follow_steps != 7 &&
                 ( (isset($step_three_document_id) && @$step_three_document_field_name  == 'step3_document_file' && $step_three_document_user_id == 1 && empty($data['order_detail']->installation_start_date) ) ||
                 (isset($step_three_agreement_id) && @$step_three_agreement_field_name  == 'step3_agreement_document' && @$step_agreement_document_user_id == 1 && empty($data['order_detail']->installation_start_date) )  || 
                 (isset($step_three_proposal_docuemnt_id) && @$step_three_proposal_field_name  == 'step3_proposal_document' && @$step_three_proposal_user_id == 1 && empty($data['order_detail']->installation_start_date) ||
                 (isset($step_six_manual_docuemnt_id) && @$step_six_manual_field_name  == 'step6_upload_manual' && @$step_six_mannual_user_id == 1) ||
                 (isset($step_six_guarantee_docuemnt_id) && @$step_six_guarantee_field_name  == 'step6_guarantee_document' && @$step_six_guarantee_user_id == 1 
                 )))) 
               
                <div class="alert alert-info2 status-div">
                    <p>Admin upload file kindly view it.</p>
                </div>
                @elseif(@$data['order_detail']->survey_status == 2 && @$data['order_detail']->proposal_status == 2 && empty($data['order_detail']->showroon_visit_date))
                    <div class="alert alert-info2 status-div">
                        <p>Please add showroom questions.</p>
                    </div>
                @elseif(@$data['order_detail']->survey_status == 2 && isset($data['order_detail']->installation_start_date) && $first_invoice_id == 0)
                    <div class="alert alert-info2 status-div">
                        <p>Installation date and duration added successfuly please review it.</p>
                    </div>
                @elseif(@$fourth_status_invoice == 2 && isset($data['order_detail']->installation_checklist_notes) &&  empty($data['order_detail']->rectification_period_date))
                    <div class="alert alert-info2 status-div">
                        <p>Installation checklist notes added successfully.</p>
                    </div>
                @endif
                {{-- @if (@$data['order_detail']->survey_status == 2 && isset($data['order_detail']->ordering_items) && $second_invoice_id == 0)
                    <div class="alert alert-info2 status-div">
                        <p>Installation information added successfully.</p>
                    </div>
                @endif --}}
                {{-- @if (@$fourth_status_invoice == 2 && isset($data['order_detail']->installation_checklist_notes) &&  empty($data['order_detail']->rectification_period_date))
                    <div class="alert alert-info2 status-div">
                        <p>Installation checklist notes added successfully.</p>
                    </div>
                @endif --}}
               
                @if (($first_invoice_id !=0 && $first_status_invoice == 4) || ($second_invoice_id !=0 && $second_status_invoice == 4) || ($third_invoice_id !=0 && $third_status_invoice == 4) || ($fourth_invoice_id !=0 && $fourth_status_invoice == 4) || (@$fifth_status_invoice == 4 && @$fifth_invoice_id !=0))
                <div class="alert alert-info2 status-div">
                    <p>Payment sent successfully please wait for the admin approval.</p>
                </div>
                @endif
               
                @if (($first_invoice_id !=0 && $first_status_invoice == 3) || ($second_invoice_id !=0 && $second_status_invoice == 3) || ($third_invoice_id !=0 && $third_status_invoice == 3) || ($fourth_invoice_id !=0 && $fourth_status_invoice == 3) || (@$fifth_invoice_id !=0 && @$fifth_status_invoice == 3))
                <div class="alert alert-danger2 status-div">
                    <p>Payment not recieved by admin please check again.</p>
                </div>
                @endif
                @if (
                ($first_invoice_id !=0 && $first_status_invoice == 2 && $second_invoice_id == 0 && empty($data['order_detail']->installation_datetime)) ||
                ($second_invoice_id !=0 && $second_status_invoice == 2 && $fifth_invoice_id == 0 ) ||
                ($fifth_invoice_id !=0 && $fifth_status_invoice == 2 && $third_invoice_id == 0 ) ||
                ($third_invoice_id !=0 && $third_status_invoice == 2 && $fourth_invoice_id == 0) ||
                ($fourth_invoice_id !=0 && $fourth_status_invoice == 2 && empty($data['order_detail']->installation_checklist_notes) && $data['order_detail']->installation_checklist == 2)
               
                )
                <div class="alert alert-success2 status-div">
                    <p>Thanks, payment received successfully.</p>
                </div>
                @endif
                @endif
                <div class="alert ajax-alert-info2 alert-info2 status-div" style="display: none">
                    <p>Payment sent successfully please wait for the admin approval.</p>
                </div>


                <!-- Step one Order Form -->
                <div id="step-one" class="content {{ $follow_steps == 1 ? 'active dstepper-block':'' }}">
                    <form id="step_one_form" method="POST" class="list-view product-checkout" action="{{ route('order.update',$order_id) }}">
                        @method('PUT')
                        @csrf
                        <!-- Customer Sale Pickup -->
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Sale Pick Date And Time</h4>
                                        <p class="card-text text-muted mt-25">Accept/Reject sale pick up survey date and time to continue further.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Survey Date And Time:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->survey_datetime) ? $data['order_detail']->survey_datetime  : '-----'}}</p>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    @if(isset($data['order_detail']) && $data['order_detail']->survey_status != 2)
                                    <div class="card-header flex-column align-items-start d-inline">
                                        <button value="2" name="survey_status" type="submit" class="btn btn-primary">Accept</button>
                                        <button value="3" name="survey_status" type="submit" class="btn btn-primary">Reject</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Customer Sale Pickup Ends -->
                    </form>
                </div>
                <!-- Step one Order Form Ends-->

                <!-- Step Two Order Form -->
                <div id="step-two" class="content {{ $follow_steps == 2 ? 'active dstepper-block':'' }}">
                    <div class="alert alert-success alert-success-assign" style="display: none"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                    <div class="alert alert-danger alert-danger-assign" style="display: none"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>
                    <!-- Customer Survey Information -->
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Sale Pick Date And Time</h4>
                                    <p class="card-text text-muted mt-25">Accept/Reject sale pick up survey date and time to continue further.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="d-flex xs-hide-d-flex">
                                <h5><b>Survey Date And Time:</b></h5>
                                <p class="ml-2">{{ @$data['order_detail']->survey_datetime }}</p>
                            </div>
                            <div class="d-flex xs-hide-d-flex">
                                <h5><b>Survey Notes:</b></h5>
                                <p class="ml-2">{{ isset($data['order_detail']->survey_information) ? $data['order_detail']->survey_information : '-----' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <form id="step_two_file_document" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="2">


                        <div class="card" style="display:{{@$data['order_detail']->survey_information ? 'block':'none'}}">
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
                                            <label for="checkout-survey_information" class="heading">Add document:</label><br>
                                            <input type="file" id="excel_file" data-img-val="preview_excel_file" class="form-control @error('excel_file') is-invalid @enderror" placeholder="Profile Image" name="excel_file[]" multiple required>
                                            @error('excel_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                            <div class="showinputfile document_excel">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step2_document'  && $value->user_id != 1) 
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
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <label for="checkout-survey_information" class="heading">Admin document:</label><br>
                                                <div class="showinputfile document_admin_excel">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step2_document' && $value->user_id == 1) 
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box" style="margin-left: 18px;">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                                
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

                </div>
                <!-- Step Two Order Form Ends-->

                <!-- Step Three Order Form -->
                <div id="step-three" class="content {{ $follow_steps == 3 ? 'active dstepper-block':'' }}">
                    <div class="alert alert-success alert-success-assign" style="display: none"><b>Success: </b><span class="success-message">{{ Session::get('message') }}</span></div>
                    <div class="alert alert-danger alert-danger-assign" style="display: none"><b>Sorry: </b><span class="error-message">{{ Session::get('error_message') }}</span></div>

                    {{-- Showroom invite --}}
                    <form id="step_three_form" class="list-view product-checkout" method="POST" action="{{ route('order.update', $order_id)}}">
                        @method('PUT')
                        @csrf

                        <div class="card">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Proposal Information</h4>
                                        <p class="card-text text-muted mt-25">Accept/Reject proposal continue further.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Proposal Cost:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->proposal_cost) ? @$data['order_detail']->proposal_cost : '-----' }}</p>
                                </div>
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Proposal Notes:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->proposal_notes) ? @$data['order_detail']->proposal_notes : '-----' }}</p>
                                </div>
                                {{-- <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Document:</b></h5>
                                    @foreach ($data['order_asset_detail'] as $key=>$value)
                                        @if ($value->field_name == 'step3_proposal_document')
                                            <p class="ml-2"><a href="{{ asset($value->file_path) }}" download>Document {{$key+1}}</a></p>
                                        @endif
                                    @endforeach
                                </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    @if(isset($data['order_detail']) && $data['order_detail']->proposal_status != 2 && $data['order_detail']->proposal_notes)
                                    <div class="card-header flex-column align-items-start d-inline">
                                        <button value="2" name="proposal_status" type="submit" class="btn btn-primary">Accept</button>
                                        <button value="3" name="proposal_status" type="submit" class="btn btn-primary">Reject</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                       
                    <form id="step_showroom_visit" class="list-view product-checkout">
                        @csrf
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">
                        <div class="card" style="display: {{@$data['order_detail']->proposal_status == 2 ? 'block' : 'none'}}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Showroom ask question</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
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
                                    
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="checkout-showroom_question" class="heading">Showroom ask question:</label>
                                            <textarea name="showroom_question" id="showroom_question" class="form-control"  cols="10" rows="3" placeholder="Showroom ask question" value="{!! @$data['order_detail']->showroom_question !!}">{!! @$data['order_detail']->showroom_question !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="showroon_visit_date" class="heading">Showroom date and time:</label>
                                        <div class="input-group mb-2">
                                            <input id="showroon_visit_date" style="width:50% " class="form-control " name="showroon_visit_date" type="date" value="{{ $showroon_visit_date }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="showroom_hour">Hour:</label>
                                        <label for="showroom_minute" style="margin-left:33% ;">Minute:</label>
                                        <div class="input-group mb-2">
    
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

                                    <div class="col-12">

                                        <button type="button" id="formsubmit" follow_steps="2" class="btn btn-primary btnformsubm btn_submit sbmt_form_data">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Customer Proposal Information Ends -->
                
                      {{-- Document upload--}}
                      <form id="step_three_document_file" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">

                        <div class="card" style="display: {{isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 ? 'block' : 'none'}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Document upload</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Upload document file :</label><br>
                                            <input type="file" id="admin_upload_document" data-img-val="preview_admin_upload_document" class="form-control" name="admin_upload_document[]" multiple>
                                        
                                        </div>
                                    </div>

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                            <div class="showinputfile user_document_files">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_document_file'  && $value->user_id != 1) 
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
                                            <label for="checkout-survey_information" class="heading">Admin document:</label><br>
                                            <div class="showinputfile admin_document_files">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_document_file' && $value->user_id == 1) 
                                                            <label for="checkout-survey_information" class="heading">Document</label>
                                                            <span class="bs-stepper-box" style="margin-left: 20px;">
                                                                <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                    <i data-feather="download" class="font-medium"></i>
                                                                </a>
                                                            </span>
                                                            <br>
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
                    
                    {{-- agreement signed --}}
                    <form id="step_three_file_document" class="list-view product-checkout">
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
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Agreement file :</label><br>
                                            <input type="file" id="agreement_file" data-img-val="preview_agreement_file" value="{{ isset($data['agreement_file'])? $data['agreement_file']: ''}}" class="form-control" placeholder="Agreement file" name="admin_agreement_document">
                                        
                                        </div>
                                    </div>
                                    {{-- @if(@$data['order_asset_detail']) --}}

                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                            <div class="showinputfile document_agreement">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_agreement_document'  && $value->user_id != 1) 
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
                                            <label for="checkout-survey_information" class="heading">Admin document:</label><br>
                                            <div class="showinputfile admin_agreement">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_agreement_document' && $value->user_id == 1) 
                                                                <label for="checkout-survey_information" class="heading">Document</label>
                                                                <span class="bs-stepper-box" style="margin-left: 20px;">
                                                                    <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                        <i data-feather="download" class="font-medium"></i>
                                                                    </a>
                                                                </span>
                                                                <br>
                                                            
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @endif --}}
                                    <div class="col-12">
                                        <button type="button" id="upload_document_btn" class="btn btn-primary sbmt_document_file">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>


                    {{-- Order confirmation --}}
                    <form id="step_three_form_file" class="list-view product-checkout">
                        @csrf
                        <!-- Customer Proposal Information -->
                        <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                        <input type="hidden" class="follow_steps" name="follow_steps" value="3">

                        <div class="card" style="display: {{isset($data['order_detail']->proposal_status) && $data['order_detail']->proposal_status == 2 ? 'block' : 'none'}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Order Confirmation</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group mb-2">
                                            <label for="checkout-survey_information" class="heading">Document upload :</label><br>
                                            <input type="file" id="proposal_document_image" data-img-val="preview_proposal_document_image" class="form-control" placeholder="Document file" name="proposal_document_image[]" multiple>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="co-md-4" style="margin-top: 15px;margin-left: 10px;    width: 248px;">
                                        {{-- <div class="col-md-6 col-sm-12" style="margin-top: 15px;"> --}}
                                            <div class="form-group mb-2">
                                                <label for="checkout-survey_information" class="heading">Your document:</label><br>
                                                <div class="showinputfile client_proposal">
                                                    @if(isset($data['order_asset_detail']))
                                                        @foreach(@$data['order_asset_detail'] as $key => $value)
                                                            @if ($value->field_name == 'step3_proposal_document'  && $value->user_id != 1) 
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
                                            <label for="checkout-survey_information" class="heading">Admin document:</label><br>
                                            <div class="showinputfile admin_proposal">
                                                @if(isset($data['order_asset_detail']))
                                                    @foreach(@$data['order_asset_detail'] as $key => $value)
                                                        @if ($value->field_name == 'step3_proposal_document' && $value->user_id == 1) 
                                                            <label for="checkout-survey_information" class="heading">Document</label>
                                                            <span class="bs-stepper-box" style="margin-left: 20px;">
                                                                <a class="icons" href="{{ asset(@$value->file_path) }}" target="_blank" download>
                                                                    <i data-feather="download" class="font-medium"></i>
                                                                </a>
                                                            </span>
                                                            <br>
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
                
                    @if (isset($data['order_detail']->installation_start_date))
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Installation section</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Installation Start date:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->installation_start_date) ? @$data['order_detail']->installation_start_date : '-----' }}</p>
                                </div>
                                <div class="d-flex xs-hide-d-flex">
                                    <h5><b>Installation duration:</b></h5>
                                    <p class="ml-2">{{ isset($data['order_detail']->installation_duration) ? @$data['order_detail']->installation_duration : '-----' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </div>
                <!-- Step Three Order Form Ends-->

                <!-- Step Four Order Form -->
                <div id="step-four" class="content {{ $follow_steps == 4 ? 'active dstepper-block':'' }}">
                    <form id="change_invoice_one_status" class="list-view product-checkout">
                        @method('PUT')
                        @csrf
                        <div class="customer-card">
                            <div class="card">
                                @if(isset($first_invoice_image))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header align-items-start">
                                            <h4 class="card-title">First Invoice (30%)</h4>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">First Invoice (30%)</h4>
                                            <p class="alert alert-info" style="width:100% ;">First invoice of 30% now due. This will be uploaded shortly.</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="card-body actions">

                                    @if(isset($first_invoice_image))
                                    <div class="row">

                                        <!-- <div class="col-md-3 col-sm-12">
                                            <h5><b>Uploaded First Invoice:</b></h5>
                                        </div> -->
                                        <div class="col-md-12 col-sm-12 ml-1">
                                            <a href="{{ asset($first_invoice_image) }}" download>Download First Invoice</a>
                                        </div>
                                    </div>
                                    @endif
            
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                           
                                            
                                            <div class="form-group mb-2 ml-1 mt-2 payment_status" style="display: {{@$first_status_invoice ? 'display' : 'none'}};">
                                                <div class="change_payment_status">
                                                    <input type="hidden" class="invoice_id invoice_id_1" value="{{ $first_invoice_id }}">
                                                    <label class="form-check-label">
                                                        <input {{ @$first_status_invoice != 1 && @$first_status_invoice != 3 ? 'disabled checked': '' }}  class="btn_submit_status" name="invoice_status" value="4" type="checkbox"> Confirm payment sent</label>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

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
                                    <span class="ml-1 showroom_status_text">
                                        @if ($data['order_detail']->showroom_visit_status == 2)
                                            <p style="color:green">(Admin accepted showroom visit date)</p>
                                        @elseif ($data['order_detail']->showroom_visit_status == 4)
                                            <p style="color:rgb(255, 0, 0)">(Admin change showroom visit date kindly review it)</p>
                                        @else
                                            <p style="color:rgb(0, 162, 255)">(Please wait for admin approval)</p>
                                        @endif
                                        
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- <div class="card" id="customer_sale_info" style="display: {{ isset($first_status_invoice) && $first_status_invoice == 2 ? 'block' : 'none'}};">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Ordering to items information</h4>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            @php 
                                $ordering_items = str_replace( array('["','"]') , ''  , @$data['order_detail']->ordering_items );
                                @endphp
                            <div class="d-flex xs-hide-d-flex">
                                <h5><b>Ordering items:</b></h5>
                                <p class="ml-2">{{ isset($ordering_items) ? $ordering_items  : '-----'}}</p>
                            </div>

                        </div>
                    </div> --}}
                    
                    <form id="change_invoice_two_status" class="list-view product-checkout">
                        @method('PUT')
                        @csrf

                        <div class="customer-card">
                            <div class="card">
                                @if(isset($second_invoice_image))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header align-items-start">
                                            <h4 class="card-title">Second Invoice (40%)</h4>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">Second Invoice (40%)</h4>
                                            <p class="alert alert-info" style="width:100% ;">Second invoice of 40% now due. This will be uploaded shortly.</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="card-body actions">
                                    @if(isset($second_invoice_image))

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ml-1">
                                            <a href="{{ asset($second_invoice_image) }}" download>Download Second Invoice</a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                           

                                            <div class="form-group mb-2 ml-1 mt-2 payment_status" style="display: {{@$second_status_invoice ? 'display' : 'none'}};">
                                                <div class="change_payment_status">
                                                    <input type="hidden" class="invoice_id invoice_id_2" value="{{ $second_invoice_id }}">
                                                    <label class="form-check-label">
                                                        <input {{ @$second_status_invoice != 1 && @$second_status_invoice != 3 ? 'disabled checked': '' }}  class="btn_submit_status" name="invoice_status" value="4" type="checkbox"> Confirm payment sent</label>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Customer Sale Information Ends-->
                    </form>

                    <form id="change_showroom" class="list-view product-checkout">
                        @method('PUT')
                        @csrf

                        <div class="customer-card">
                            <div class="card">
                                @if(isset($fifth_invoice_image))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header align-items-start">
                                            <h4 class="card-title">Showroom extra invoice</h4>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">Showroom extra invoice</h4>
                                            <p class="alert alert-info" style="width:100% ;">showroom extra invoice. This will be uploaded shortly.</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="card-body actions">
                                    @if(isset($fifth_invoice_image))

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ml-1">
                                            <a href="{{ asset($fifth_invoice_image) }}" download>Download showroom extra Invoice</a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group mb-2 ml-1 mt-2 payment_status" style="display: {{@$fifth_status_invoice ? 'display' : 'none'}};">
                                                <div class="change_payment_status">
                                                    <input type="hidden" class="invoice_id invoice_id_5" value="{{ $fifth_invoice_id }}">
                                                    <label class="form-check-label">
                                                        <input {{ @$fifth_status_invoice != 1 && @$fifth_status_invoice != 3 ? 'disabled checked': '' }}  class="btn_submit_status" id="checkbox_value" name="invoice_status" value="4" type="checkbox"> Confirm payment sent</label>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Customer Sale Information Ends-->
                    </form>

                    {{-- <div class="card" id="customer_sale_info" style="display: {{ isset($fifth_status_invoice) && $fifth_status_invoice == 2 ? 'block' : 'none'}};">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Portallo section</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex xs-hide-d-flex">
                                <h5><b>Portallo section:</b></h5>
                                <p class="ml-2">{{ isset($data['order_detail']->portallo_ordered) && $data['order_detail']->portallo_ordered == 1 ? 'Yes'  : 'No'}}</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- Step Four Order Form Ends-->

                <!-- Step Five Order Form -->
                <div id="step-five" class="content {{ $follow_steps == 5 ? 'active dstepper-block':'' }}">
                    <form id="change_invoice_three_status" class="list-view product-checkout">
                        @method('PUT')
                        @csrf
                        <div class="customer-card">
                            <div class="card">

                                @if(isset($third_invoice_image))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header align-items-start">
                                            <h4 class="card-title">Third Invoice (20%)</h4>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">Third Invoice (20%)</h4>
                                            <p class="alert alert-info" style="width:100% ;">Third invoice of 20% now due. This will be uploaded shortly.</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="card-body actions">

                                    @if(isset($third_invoice_image))
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ml-1">
                                            <a href="{{ asset($third_invoice_image) }}" download>Download Third Invoice</a>
                                        </div>
                                    </div>

                                    @endif
                                    <div class="row">

                                        <div class="col-md-12 col-sm-12">
                                           
                                            <div class="form-group mb-2 ml-1 mt-2  payment_status" style="display: {{@$third_status_invoice ? 'display' : 'none'}};">
                                                <div class="change_payment_status">
                                                    <input type="hidden"  class="invoice_id invoice_id_3" value="{{ $third_invoice_id }}">
                                                    <label class="form-check-label">
                                                        <input {{ @$third_status_invoice != 1 && @$third_status_invoice != 3 ? 'disabled checked': '' }} class="btn_submit_status" name="invoice_status" value="4" type="checkbox"> Confirm payment sent</label>
                                                </div>
                                            </div> 
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Customer Address Right ends -->
                    </form>
                </div>
            </div>
            <!-- Step Five Order Form Ends-->

            <!-- Step Six Order Form -->

            <div id="step-six" class="content {{ $follow_steps == 6 ? 'active dstepper-block':'' }}">
                <form id="change_invoice_four_status invoice_four_form" class="list-view product-checkout">
                    @method('PUT')
                    @csrf
                    <div class="customer-card">
                        <div class="card">

                            @if(isset($fourth_invoice_image))
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header align-items-start">
                                            <h4 class="card-title">Fourth Invoice (10%)</h4>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">Fourth Invoice (10%)</h4>
                                            <p class="alert alert-info" style="width:100% ;">Fourth invoice of 10% now due. This will be uploaded shortly.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body actions">

                                @if(isset($fourth_invoice_image))
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-12">
                                        <h5><b>Uploaded Fourth Invoice:</b></h5>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 ml-1">
                                        <a href="{{ asset($fourth_invoice_image) }}" download>Download Fourth Invoice</a>
                                    </div>
                                </div>
                                @endif
                                <div class="row">

                                    <div class="col-md-12 col-sm-12">
                                       
                                        <div class="form-group mb-2 ml-1 mt-2  payment_status" style="display: {{@$fourth_status_invoice ? 'display' : 'none'}};">
                                            <div class="change_payment_status">
                                                <input type="hidden"  class="invoice_id invoice_id_4" value="{{ $fourth_invoice_id }}">
                                                <label class="form-check-label">
                                                    <input {{ @$fourth_status_invoice != 1 && @$fourth_status_invoice != 3 ? 'disabled checked': '' }}  class="btn_submit_status" name="invoice_status" value="4" type="checkbox"> Confirm payment sent</label>
                                            </div>
                                            <!-- <button value="2" name="invoice_status" type="submit" class="btn btn-primary btn_submit_status">Send Payment</button> -->
                                            <!-- <button value="3" name="invoice_status" type="submit" class="btn btn-primary btn_submit_status">Not Send Payment</button> -->
                                        </div> 
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
                <div class="card" style="{{ @$data['order_detail']->installation_checklist_notes ? 'block' : 'none'}}">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="card-header flex-column align-items-start">
                                <h4 class="card-title">Installation Checklist</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex xs-hide-d-flex">
                            <h5><b>Checklist notes:</b></h5>
                            <p class="ml-2">{{ @$data['order_detail']->installation_checklist_notes }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header flex-column align-items-start">
                                <h4 class="card-title">Installation checklist documents</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex xs-hide-d-flex">
                            <h5><b>Manual document:</b></h5>
                            @foreach (@$data['order_asset_detail'] as $key=>$value)
                                @if ($value->field_name == 'step6_upload_manual')
                                    <p class="ml-2"><a href="{{ asset($value->file_path) }}" download>document </a></p>
                                @endif
                            @endforeach
                        </div>
                        <div class="d-flex xs-hide-d-flex">
                            <h5><b>Gurantee document:</b></h5>
                            @foreach (@$data['order_asset_detail'] as $key=>$value)
                                @if ($value->field_name == 'step6_guarantee_document')
                                    <p class="ml-2"><a href="{{ asset($value->file_path) }}" download>document</a></p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step Six Order Form Ends-->

            </div>
            <!-- Step Seven Order Form -->
            <div id="step-seven" class="content {{ $follow_steps == 7 ? 'active dstepper-block':'' }}">
                <input type="hidden" name="enquery_id" value="{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}">
                <input type="hidden" class="follow_steps" name="follow_steps" value="7">
                
                <div class="step_seven_form" id="step_seven_form">
                    <div class="alert alert-success status-div text-left">
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

        <?php if (isset($follow_steps)) { ?>
            follow_steps_active('{{$data_target}}');
        <?php }  ?>
        // if (isset($follow_steps)) {
        //     follow_steps_active('{{$data_target}}');
        // }
      

    });
</script>
<script>
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