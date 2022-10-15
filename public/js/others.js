jQuery(document).ready(function() {

    $(document).on('click', '.btn_submit_status', function(event) {
        $('.alert-danger').hide();
        $('.status-div').hide();
        var invoice_id = $(this).closest(".change_payment_status").find(".invoice_id").val();
        var invoice_status = $(this).val();

        swal({
            title: `Are you sure you want to confirm  payment sent`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then(function(data) {
            if (data === true) {
                $.ajax({
                    type: "put",
                    url: "{{ URL::to('invoice') }}/" + invoice_id,
                    data: {
                        _token: "{{ csrf_token() }}",
                        update_id: invoice_id,
                        invoice_status: invoice_status,
                    },
                    success: function(data) {
                        if (data.success) {
                            // $('.invoice_id_' + data.records.invoice_step).val(data.records.id);
                            $('.ajax-alert-info2').show();
                            $("input.btn_submit_status").prop("disabled", true);
                            $('.loaderOverlay').fadeOut();

                        } else {
                            $('.alert-danger').show();
                            $('.error-message').html(data.records.error);
                        }
                        $('html,body').animate({
                                scrollTop: $(".bs-stepper-header").offset().top
                            },
                            'smooth');
                    },
                    error: function(e) {}
                });

            } else {
                location.reload(true);
                $('.loaderOverlay').fadeOut();
            }
        });
    });

    $(document).on('click', '.send_email_confirmation', function(event){
        $('.alert-danger').hide();
        $('.alert-success').hide();
        $('.status-div').hide();
        $('.loaderOverlay').fadeIn();
        var status = $(this).val();

        swal({
                title: `Are you sure you want send email`,
                icon: "success",
                buttons: ["No", "Yes"],
                dangerMode: true,
            })
            .then(function(data) {
                if (data === true) {
                    $.ajax({
                        type: "post",
                        url: "{{ URL::to('client_confirmation') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            enquery_id: "{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}",
                            status: status
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('.loaderOverlay').fadeOut();
                            $('.alert-success').show();
                            $('.success-message').html(data.message);
                            $('html,body').animate({
                                    scrollTop: $(".bs-stepper-header").offset().top
                                },
                                'smooth');
                        },
                        error: function(e) {}
                    });
                } else {
                    $('.loaderOverlay').fadeOut();
                }
            });

    });

    // $(document).on('click', '#customSwitch1', function(event) { 
    $(document).on('click', '.invoice_submit_data', function(event) {
        
        var btn_txt = $(this).text();
        var btn_loader = ' <i class="fa fa-spinner fa-pulse"></i>';
        $(this).html(btn_txt + btn_loader);
        $(this).attr('disabled', 'disabled');

        $('.alert-danger').hide();
        $('.alert-success').hide();
        $('.status-div').hide();
        var followStep = $(this).closest("form").find(".invoice_step").val();
        if (followStep == 1) {
            if ($(this).prop("checked") == true) {
                $('#invoice_status').val(1);
            } else if ($(this).prop("checked") == false) {
                $('#invoice_status').val(2);
            }
            var form = $('#invoice_one_form')[0];
        }
        var form = $(this).closest("form")[0];
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ URL::to('invoice') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            context: this,
            // timeout: 600000,
            dataType: 'json',
            success: function(data) {
                $(this).html(btn_txt);
                $(this).removeAttr('disabled');
                if (data.success) {
                    $('.invoice_id_' + data.records.invoice_step).val(data.records.id);
                    $('.alert-success').show();
                    $('.success-message').html(data.message);

                } else {
                    $('.alert-danger').show();
                    $('.error-message').html(data.records.error);
                }
                $('html,body').animate({
                        scrollTop: $(".bs-stepper-header").offset().top
                    },
                    'smooth');
            },
            error: function(e) {}
        });

    });

    $(document).on('change', '.invoice_status_dd', function(event) {
        $('.alert-danger').hide();
        $('.alert-success').hide();
        $('.status-div').hide();

        var invoice_id = $(this).closest(".dropdown").find(".invoice_id").val();
        var invoice_status = $(this).val();
        $('.loaderOverlay').fadeIn();
        $.ajax({
            type: "put",
            url: "{{ URL::to('invoice') }}/" + invoice_id,
            data: {
                _token: "{{ csrf_token() }}",
                update_id: invoice_id,
                invoice_status: invoice_status,
            },
            success: function(data) {
                $('.loaderOverlay').fadeOut();
                console.log(data);
                if (data.success) {
                    $('.alert-success').show();
                    $('.success-message').html(data.message);
                    if (invoice_status == 2 || data.records.invoice_step == 2) {
                        $('#customer_sale_info').show();
                    } else {
                        $('#customer_sale_info').hide();
                    }
                    if (invoice_status == 2 && data.records.invoice_step == 4) {
                        $('#installation_checkbox').show();
                    } else {
                        $('#installation_checkbox').hide();
                    }
                    if (invoice_status == 2 && data.records.invoice_step == 5) {
                        $('#porlallo').show();
                        // follow_steps_active('step-five');
                    }else if (invoice_status == 2 && data.records.invoice_step == 2) {
                        $('#showroom_form').show();
                    } else if (invoice_status == 2 && data.records.invoice_step == 3) {
                        follow_steps_active('step-six');
                    }else if (invoice_status == 2 && data.records.invoice_step == 4) {
                        $('#installation_checklist_section').show();
                    } else if (invoice_status == 2 && data.records.invoice_step == 2) {
                        alert(data.records.invoice_step);
                    }

                } else {
                    $('.alert-danger').show();
                    $('.error-message').html(data.records.error);
                }
                $('html,body').animate({
                        scrollTop: $(".bs-stepper-header").offset().top
                    },
                    'smooth');

            },
            error: function(e) {}
        });
    });

    //Delete File
    $(document).on('click', '.deletebtn', function(event){
        var id = $(this).data("id");
        
        swal({
            title: `Are you sure you want delete`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then(function(data) {
            if (data === true) {
                $.ajax({
                    type: "delete",
                    url: "{{ URL::to('orderasset') }}/" + id,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id:id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.document-'+id).remove();
                    $('.alert-info3').show();

                        
                        $('html,body').animate({
                                scrollTop: $(".bs-stepper-header").offset().top
                            },
                            'smooth');
                    },
                    error: function(e) {}
                });
            } else {
                $('.loaderOverlay').fadeOut();
            }
        });
    });

    $(document).on('click', '.task_submit', function(event) {
        // alert("sdfsfs");
        var btn_val = $(this).val();
        $('.alert-danger-assign').hide();
        $('.alert-success-assign').hide();
        $('.loading').show();
        $('.status-div').hide();
        var followStep = $(this).closest("form").find(".task_step").val();
        var form = $(this).closest("form")[0];
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ URL::to('task') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            context: this,
            // timeout: 600000,
            dataType: 'json',
            // data: {
            //     _token: "{{ csrf_token() }}",
            //     assign_user_id: assign_user_id,
            //     due_date: due_date,
            //     task_description: task_description,
            //     enquery_id: enquery_id,
            //     task_step:btn_val
            // },
            success: function(data) {
                console.log(data);
                if (data.success) {
                    // alert("data");
                    $('.loading').hide();
                    $('.alert-success-assign').show();
                    $('.success-message').html(data.message);
                } else {
                    $('.alert-danger-assign').show();
                    $('.loading').hide();
                    $('.error-message').html(data.records.error);
                }
            },
            error: function(e) {

            }
        });
    });

    // Document upload 
    $(document).on('click', '.sbmt_document_file', function(event) {
        event.preventDefault();
         var btn_txt = $(this).text();
         var btn_loader = ' <i class="fa fa-spinner fa-pulse"></i>';
         $(this).html(btn_txt + btn_loader);

         $('.alert-danger').hide();
         $('.alert-success').hide();
         $('.loading').show();
         $('.status-div').hide();

         var form = $(this).closest("form")[0];
         
         var formData = new FormData(form);
         
        
         $(this).attr('disabled', 'disabled');

         $.ajax({
            type: "POST",
            url: "{{ URL::to('orderasset') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            context: this,
            // timeout: 600000,
            dataType: 'json',

            success: function(data) {
                var html='';
                var field_name = '';
                var records_id = '';
                for (let index = 0; index < data.records.length; index++) {
                        
                    var source = "{{url('/')}}";
                    source = source+'/'+data.records[index].file_path;
                    field_name = data.records[index].field_name;
                    records_id = data.records[index].user_id;
                    
                    html += '<div class="delete_document document-'+data.records[index].id+'">';
                    html += '<label for="checkout-survey_information" class="heading">Document</label>';
                    html += '<span class="bs-stepper-box ml-2" style="margin-right: 15px;">';
                    html += '<a href="javascript:void(0)" data-id="'+data.records[index].id+'" class="deletebtn" style="margin-left: 5px;">';
                    html +=  '<i data-feather="trash" class="font-medium icons"  type="submit"></i>';
                    html += '</a>';
                    html += '</span>';
                    html += '<span class="bs-stepper-box">';
                    html += '<a class="icons" href="'+source+'" target="_blank" download>';
                    html +=  '<i data-feather="download" class="font-medium"></i>';
                    html +=  '</a>';
                    html += '</span>';
                    html +=  '</div>'; 
                }                  

                // $(this).closest("form").append('.showinputfile').append(html);
                if (field_name != '' && field_name == 'step3_document_file' && records_id == 1) {
                    $(".admin_document_files").append(html);
                }
                else if (field_name != '' && field_name == 'step3_document_file' && records_id != 1) {
                    $(".user_document_files").append(html);
                }
                else if (field_name != '' && field_name == 'step3_agreement_document' && records_id != 1) {
                    $(".document_agreement").html(html);
                }
                else if (field_name != '' && field_name == 'step3_agreement_document' && records_id == 1) {
                    $(".admin_agreement").html(html);
                }
                else if (field_name != '' && field_name == 'step2_document' && records_id != 1) {
                    $(".document_excel").append(html);
                }
            
                else if (field_name != '' && field_name == 'step2_document' && records_id == 1) {
                    $(".document_admin_excel").append(html);
                }
                else if (field_name != '' && field_name == 'step3_proposal_document' && records_id != 1) {
                    $(".client_proposal").append(html);
                }
                else if (field_name != '' && field_name == 'step3_proposal_document' && records_id == 1) {
                    $(".admin_proposal").append(html);
                }
                else if (field_name != '' && field_name == 'step6_guarantee_document' && records_id == 1) {
                    $(".gurantee_admin_document").html(html);
                }
                else if (field_name != '' && field_name == 'step6_upload_manual' && records_id == 1) {
                    $(".manual_admin_document").html(html);
                }
                feather.replace();
                
                $(this).html(btn_txt);
                $(this).removeAttr('disabled');

                if (data.success) {
                    form.reset(); 
                
                    
                    $('.loading').hide();
                    $('.alert-success').show();
                    $('.success-message').html(data.message);
                    swal({
                    title: `Document uploaded successfully`,
                    icon: "success",
                    buttons: "OK",
                    dangerMode: false,
                });
                if (field_name == 'step2_document' && records_id == 1) {
                        follow_steps_active('step-three');
                }
                if (field_name == 'step3_proposal_document' ) {
                    $('#installation_section').show();
                }
                if (field_name == 'step6_upload_manual') {
                    $('#gurantee_section').show();
                }
                if (field_name == 'step6_guarantee_document') {
                    $('#rectification_period_section').show();
                }
                } else {
                    $('.alert-danger').show();
                    $('.loading').hide();
                    $('.error-message').html(data.records.error);
                    
                    $('html,body').animate({
                            scrollTop: $(".bs-stepper-header").offset().top
                        },
                        'smooth');
                }

            },
            error: function(e) {

            }
        });
    });

    $(document).on('click', '.sbmt_form_data', function(event) {

        var btn_txt = $(this).text();
        var btn_loader = ' <i class="fa fa-spinner fa-pulse"></i>';
        $(this).html(btn_txt + btn_loader);
        $('.alert-danger').hide();
        $('.alert-success').hide();
        $('.loading').show();
        $('.status-div').hide();
        var followStep = $(this).closest("form").find(".follow_steps").val();
        if (followStep == 6) {

            if ($(this).prop("checked") == true) {
                $('#installation_checklist').val(1);
            } else if ($(this).prop("checked") == false) {
                $('#installation_checklist').val(2);
            }
            // var form = $('#step_six_form')[0];
        } 
        // else if (followStep == 7) {
        //     var form = $('#step_seven_form')[0];
        // }
        var form = $(this).closest("form")[0];

        var formData = new FormData(form);
        $(this).attr('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: "{{ URL::to('order') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            context: this,
            dataType: 'json',

            success: function(data) {
                console.log(data);

                $(this).html(btn_txt);
                $(this).removeAttr('disabled');

                if (data.success) {
                    $('.loading').hide();
                    $('.alert-success').show();
                    $('.success-message').html(data.message);
                   
                    if (followStep == 2 && data.records.follow_steps == 2) {
                        $('#excel_file_document').css('display', 'block');
                        }
                    if (followStep == 3 && data.records.follow_steps == 4 && data.records.installation_start_date != null) {
                        follow_steps_active('step-four');
                    }
                    if (followStep == 4 && data.records.follow_steps == 5 && data.records.portallo_ordered == 1) {
                        follow_steps_active('step-five');
                    }
                    if (followStep == 6 && data.records.follow_steps == 6  && data.records.installation_checklist_notes != null) {
                        $('#upload_manual_section').css('display', 'block');
                    }
                    if (followStep == 6 && data.records.follow_steps == 6  && data.records.rectification_period_date != null) {
                        $('#project_invoice_info').css('display', 'block');
                    }

                    var html="";
                    if (data.records.showroon_visit_date) {
                        if (data.records.showroom_visit_status == 2) {
                            html += "<p style='color:green'>(Admin accepted showroom visit date)</p>";
                        } else if (data.records.showroom_visit_status == 4) {
                            html +=  "<p style='color:rgb(255, 0, 0)'>(Admin change showroom visit date kindly review it)</p>";
                            $('.showroom_status').hide();
                            $("#reschedule_div").addClass("ml-2");

                        } else if (data.records.showroom_visit_status == 1){
                            html +=  "<p style='color:rgb(0, 162, 255)'>(Please wait for admin approval)</p>";
                        }
                        $('.showroom_status_text').html(html);
                    }
                    if (followStep == 6 && data.records.follow_steps == 7) {
                        
                        setTimeout(function() {
                            location.reload(true);
                        }, 5000);
                    }
                    
                } else {
                    $('.alert-danger').show();
                    $('.loading').hide();
                    $('.error-message').html(data.records.error);
                }

                $('html,body').animate({
                        scrollTop: $(".bs-stepper-header").offset().top
                    },
                    'smooth');
            },
            error: function(e) {

            }
        });
    });

    
});


