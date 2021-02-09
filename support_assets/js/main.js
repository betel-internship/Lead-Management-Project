// Submited Commenting

$("#submited_comment_form").validate({
    ignore: ":hidden",
    rules: {
        
        lead_statuss:{
         required:true,
        },
        comment:{
         required:true,
        },
   
    },
    messages: { 
         lead_statuss: {
            required: "<span>Please select lead status</span>",
        },
         comment: {
            required: "<span>Please enter something about lead</span>",
        },
    },
    submitHandler: function (form) {
         var formData = new FormData($("#submited_comment_form")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'submitted_your_commenting',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Submit Comment');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                   $("#comment").val(""); 
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                  $('#get_recent_comment').hide().html(obj.comments).fadeIn('slow');    
                   $('#submit_button').html('Submit Comment');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                 //   window.location='create_lead';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });


// Lead Updation
$("#update_creation_form").validate({
   ignore: ":hidden",
    rules: {
        customer_name: {
            required: true,
            minlength: 3,
            maxlength: 100,
        },
        mobile_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
       
        city:{
         required:true,
        },
        state:{
         required:true,
        },
         status:{
         required:true,
        },
       userid:{
         required:true,
        },
    },
    messages: { 
        customer_name: {
            required: "<span>Please enter customer name</span>",
            minlength: "<span>please customer name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
      
        mobile_no: {
            required: "<span>Please enter Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
       
         city: {
            required: "<span>Please enter city name</span>",
        },
         state: {
            required: "<span>Please etner state name</span>",
        },
         status: {
            required: "<span>Please select lead status</span>",
        },
         userid: {
            required: "<span>Please select employee</span>",
        },
    },
    submitHandler: function (form) {
         var formData = new FormData($("#update_creation_form")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'update_creation_process',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Update Lead');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                    window.location='create_lead';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });

// Lead Creation
$("#lead_creation_form").validate({
    ignore: ":hidden",
    rules: {
        customer_name: {
            required: true,
            minlength: 3,
            maxlength: 100,
        },
        mobile_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
       
        city:{
         required:true,
        },
        state:{
         required:true,
        },
         status:{
         required:true,
        },
       userid:{
         required:true,
        },
    },
    messages: { 
        customer_name: {
            required: "<span>Please enter customer name</span>",
            minlength: "<span>please customer name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
      
        mobile_no: {
            required: "<span>Please enter Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
       
         city: {
            required: "<span>Please enter city name</span>",
        },
         state: {
            required: "<span>Please etner state name</span>",
        },
         status: {
            required: "<span>Please select lead status</span>",
        },
         userid: {
            required: "<span>Please select employee</span>",
        },
    },
    submitHandler: function (form) {
         var formData = new FormData($("#lead_creation_form")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'lead_creation_process',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Add Lead');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                    window.location='create_lead';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });

// Lead Creation and Updatation By Employee


// Lead Updation
$("#update_creation_form_employee").validate({
   ignore: ":hidden",
    rules: {
        customer_name: {
            required: true,
            minlength: 3,
            maxlength: 100,
        },
        mobile_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
       
        city:{
         required:true,
        },
        state:{
         required:true,
        },
         status:{
         required:true,
        },
      
    },
    messages: { 
        customer_name: {
            required: "<span>Please enter customer name</span>",
            minlength: "<span>please customer name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
      
        mobile_no: {
            required: "<span>Please enter Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
       
         city: {
            required: "<span>Please enter city name</span>",
        },
         state: {
            required: "<span>Please etner state name</span>",
        },
         status: {
            required: "<span>Please select lead status</span>",
        },
        
    },
    submitHandler: function (form) {
         var formData = new FormData($("#update_creation_form_employee")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'update_creation_process_employee',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Update Lead');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                    window.location='employee_created_leads';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });

// Lead Creation
$("#lead_creation_form_employee").validate({
    ignore: ":hidden",
    rules: {
        customer_name: {
            required: true,
            minlength: 3,
            maxlength: 100,
        },
        mobile_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
       
        city:{
         required:true,
        },
        state:{
         required:true,
        },
         status:{
         required:true,
        },
      
    },
    messages: { 
        customer_name: {
            required: "<span>Please enter customer name</span>",
            minlength: "<span>please customer name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
      
        mobile_no: {
            required: "<span>Please enter Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
       
         city: {
            required: "<span>Please enter city name</span>",
        },
         state: {
            required: "<span>Please etner state name</span>",
        },
         status: {
            required: "<span>Please select lead status</span>",
        },
       
    },
    submitHandler: function (form) {
         var formData = new FormData($("#lead_creation_form_employee")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'lead_creation_process_employee',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Add Lead');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                    window.location='employee_created_leads';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });


// Registers Sales Users

$("#add_emplyee_form").validate({
    ignore: ":hidden",
    rules: {
        full_name: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        mobile_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
        email_address: {
            required: true,
            email: true,
        },
        
        location:{
         required:true,
        },
        role:{
         required:true,
        },
        password:{
            minlength: 6,
            maxlength: 20,
            required: true,  
        },
       
        

    },
    messages: { 
        full_name: {
            required: "<span>Please enter employee full name</span>",
            minlength: "<span>please employee full name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
        password: {
            required: "<span>Please enter password</span>",
            minlength: "<span>Please enter password min 6  or max 30 charater</span>",
            maxlength: "<span>Please enter password min 6  or max 30 charater/span>",
        },
      
        mobile_no: {
            required: "<span>Please enter Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        email_address: {
            required: "<span>Please enter email address</span>",
            email: "<span>Please enter a valid email address.</span>",
        },
         location: {
            required: "<span>Please enter location</span>",
        },
         role: {
            required: "<span>Please select employee role</span>",
        },
    },
    submitHandler: function (form) {
         var formData = new FormData($("#add_emplyee_form")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'registration_employee',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Add Employee');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                    window.location='employee';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });
  
  // 
  
  // Update Employee
  
  $("#update_emplyee_form").validate({
    ignore: ":hidden",
    rules: {
        full_name: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        mobile_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
        email_address: {
            required: true,
            email: true,
        },
        
        location:{
         required:true,
        },
        role:{
         required:true,
        },
       
    },
    messages: { 
        full_name: {
            required: "<span>Please enter employee full name</span>",
            minlength: "<span>please employee full name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
      
      
        mobile_no: {
            required: "<span>Please enter Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        email_address: {
            required: "<span>Please enter email address</span>",
            email: "<span>Please enter a valid email address.</span>",
        },
         location: {
            required: "<span>Please enter location</span>",
        },
         role: {
            required: "<span>Please select employee role</span>",
        },
    },
    submitHandler: function (form) {
         var formData = new FormData($("#update_emplyee_form")[0]); 
        $.ajax({
            type: "POST",
            url: BASE_URL + 'updates_employee',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType  
            beforeSend: function () {
                $('#submit_button').addClass('Submiting').attr("disabled", true);
                $('#submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#submit_button').prop('disabled', false);
                     $('#submit_button').html('Update Employee');
                     $('#submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 8000);
                    return false;
                } else {
                    $('#success_message_submit').show();
                    $('#success_message_submit').html(obj.message);
                    setTimeout(function(){ $('#success_message_submit').hide();
                    window.location='employee';
                    }, 3000);
                    return false;
                }
            }
        });
      }
  });
  
  
  // Staus changed ajax
function update_employee_status(id,type){
  con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"change_status_employee",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='employee';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}



// Register Users Code

$("#loging_submit").validate({
    ignore: ":hidden",
    rules: {
        username: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        password: {
            required: true,
           
        },
      
    },
    messages: {
        username: {
            required: "<span>Please enter your username or mobile no</span>",
            maxlength: "<span>Please enter username or mobile no min 3 or 30 character </span>",
            minlength: "<span>please enter min 3 digit character</span>",
        },
        password: {
            required: "<span>Please enter enter your password</span>",
          
        },
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'SupportController/support_login',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#Login_customers').addClass('sanding').attr("disabled", true);
                $('#Login_customers').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
          
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_login').show();
                   $('#error_message_login').html(obj.message);
                   
                     $('#Login_customers').prop('disabled', false);
                     $('#Login_customers').html('SIGN IN');
                     $('#Login_customers').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_login').hide(); }, 10000);
                    return false;
                } else {
                    $('#success_message_login').show();
                    $('#success_message_login').html(obj.message);
                    window.location=BASE_URL;
                    return false;

                }
            }
        });
        
        
        
    }
});
// Update Vendor

// Staus changed ajax
function update_status_customer(id,type){
  con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"Changed_Status_Hotels",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='admin_hotel_list';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}

// Staff ajax
function update_status_servies_users(id,type){
  con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"changed_services_status",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='services_type';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}
function update_status_vendor(id,type){
con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"change_status_vendors",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='vendor_list_detail';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }    
}
function change_status_vendor_requirement(id,type){
con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"change_status_vendor_requirement",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='admin_hotel_requirement';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }    
}
function update_status_staff(id,type){
  con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"change_staff_changed",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='addmin_staff_list';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}
// Changed Password


$("#changed_password").validate({
    ignore: ":hidden",
    rules: {
        new_password: {
            required: true,
            minlength: 6,
            maxlength: 30,
        },
        con_password:{
        equalTo : "#new_password",
        minlength: 6,
        maxlength: 30,
        }
      
    },
    messages: {
        new_password: {
            required: "<span>Please enter new password</span>",
            maxlength: "<span>your entered password min 6 or 30 character </span>",
            minlength: "<span>please enter min 6 character</span>",
        },
       con_password: {
            minlength: "<span>Your password must consist of at least 6 characters</span>",
            maxlength: "<span>your entered password min 6 or 30 character </span>",
            equalTo: "Enter Confirm Password Same as Password",
        }
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'change_password_process',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#change_Password').addClass('sanding').attr("disabled", true);
                $('#change_Password').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#change_Password').prop('disabled', false);
                     $('#change_Password').html('Change Password');
                     $('#change_Password').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_login').hide(); }, 10000);
                    return false;
                } else {
                    window.location='change_password';
                    return false;

                }
            }
        });  
    }
});

// GST Master

$("#gst_master_forms").validate({
    ignore: ":hidden",
    rules: {
        gst_master: {
            required: true,
            minlength: 1,
            number: true,
            maxlength:6,
        },
      
      
    },
    messages: {
        gst_master: {
            required: "<span>Please enter percent</span>",
            maxlength: "<span>your entered percent min 1 or 6 digit </span>",
            minlength: "<span>please enter min 1 digit</span>",
           number: "<span>Please enter digit only</span>", 
        },
      
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'add_new_gst_masters',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#gst_button').addClass('sanding').attr("disabled", true);
                $('#gst_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#gst_button').prop('disabled', false);
                     $('#gst_button').html('Save Changes');
                     $('#gst_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_login').hide(); }, 10000);
                    return false;
                } else {
                    window.location='GST-Master';
                    return false;

                }
            }
        });  
    }
});


// Update GST Master

$("#gst_master_forms_update").validate({
    ignore: ":hidden",
    rules: {
        gst_master: {
            required: true,
            minlength: 1,
            number: true,
            maxlength:6,
        },
      
      
    },
    messages: {
        gst_master: {
            required: "<span>Please enter percent</span>",
            maxlength: "<span>your entered percent min 1 or 6 digit </span>",
            minlength: "<span>please enter min 1 digit</span>",
           number: "<span>Please enter digit only</span>", 
        },
      
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'update_new_gst_masters',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#gst_button_update').addClass('sanding').attr("disabled", true);
                $('#gst_button_update').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#gst_button_update').prop('disabled', false);
                     $('#gst_button_update').html('Save Changes');
                     $('#gst_button_update').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_login').hide(); }, 10000);
                    return false;
                } else {
                    window.location='GST-Master';
                    return false;

                }
            }
        });  
    }
});



// Servies Tables
 table = $('#employee_table').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": BASE_URL+"employee_listing_paging",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    
    // Lead Creation
   table = $('#lead_creation_tables').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": BASE_URL+"lead_details_pagination",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    
    lead_status=$("#lead_status").val();
     // Lead Creation
   table = $('#all_tables_details').DataTable({ 
	"pageLength": 50,
	"bLengthChange": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": BASE_URL+"lead_details_pagination_details",
            "type": "POST",
            "data":{lead_status:lead_status} 
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    
    
 
    
    function delete_gst_master_tables(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_gst_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='GST-Master';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}


function delete_sale_product(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_sales_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='sales_master';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}


function delete_purchases_masters(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_purchases_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='purchase_master';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}
function delete_productss_master(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_productss_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='product_master';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}

$("#product_master_forms").validate({
    ignore: ":hidden",
    rules: {
        
        product_name: {
            required: true,
        },
       gst_rate: {
            required: true,
        },  
      price: {
            required: true,
            number: true,
        
        }, 
      
    },
    messages: {
        product_name: {
            required: "<span>Please enter product name</span>",
        },
        gst_rate: {
            required: "<span>Please select gst rate</span>",
        },
       price: {
            required: "<span>Please enter product price</span>",
            number: "<span>Please enter digit only</span>", 
        },  
      
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'add_new_product_masters',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#product__button').addClass('sanding').attr("disabled", true);
                $('#product__button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#product__button').prop('disabled', false);
                     $('#product__button').html('Save Changes');
                     $('#product__button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 10000);
                    return false;
                } else {
                    window.location='product_master';
                    return false;

                }
            }
        });  
    }
});

// Product status

function update_status_product(id){
  con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"Product_Status_Changed",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='product_master';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}

$("#product_master_upate").validate({
    ignore: ":hidden",
    rules: {
        
        product_name: {
            required: true,
        },
       gst_rate: {
            required: true,
        },  
      price: {
            required: true,
            number: true,
        
        }, 
      
    },
    messages: {
        product_name: {
            required: "<span>Please enter product name</span>",
        },
        gst_rate: {
            required: "<span>Please select gst rate</span>",
        },
       price: {
            required: "<span>Please enter product price</span>",
            number: "<span>Please enter digit only</span>", 
        },  
      
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'update_new_product_masters',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#product_update_button').addClass('sanding').attr("disabled", true);
                $('#product_update_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message_change').show();
                   $('#error_message_change').html(obj.message);
                   
                     $('#product_update_button').prop('disabled', false);
                     $('#product_update_button').html('Save Changes');
                     $('#product_update_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 10000);
                    return false;
                } else {
                    window.location='product_master';
                    return false;

                }
            }
        });  
    }
});


$("#purchase_master_forms").validate({
    ignore: ":hidden",
    rules: {
        
        product_name: {
            required: true,
        },
       gst_rate: {
            required: true,
        },  
      product_price: {
            required: true,
            number: true,
        
        }, 
        
      qty: {
            required: true,
            number: true,
        
        },   
      
    },
    messages: {
        product_name: {
            required: "<span>Please enter product name</span>",
        },
        gst_rate: {
            required: "<span>Please select gst rate</span>",
        },
       product_price: {
            required: "<span>Please enter product price</span>",
            number: "<span>Please enter digit only</span>", 
        },  
        
        qty: {
            required: "<span>Please enter quantity</span>",
            number: "<span>Please enter digit only</span>", 
        },  
      
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'add_new_purchase_prod_items',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#purchase__button').addClass('sanding').attr("disabled", true);
                $('#purchase__button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message_change').show();
                     $('#error_message_change').html(obj.message);
                     $('#purchase__button').prop('disabled', false);
                     $('#purchase__button').html('Add Item');
                     $('#purchase__button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 10000);
                    return false;
                } else {
                  // alert(data); 
                    $('#purchase__button').prop('disabled', false);
                     $('#purchase__button').html('Add Item');
                     $('#purchase__button').addClass('sanding').attr("disabled", false);
                     $("#product_name").val('');
                     $("#product_price").val('');
                     $("#qty").val('');
                     $('#get_temp_details').hide().html(obj.datas).fadeIn('slow');
                }
            }
        });  
    }
});


    function delete_purchase_masters(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_purchase_temp_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          $('#get_temp_details').hide().html(obj.datas).fadeIn('slow');
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}

  function purchase_product(){
      var vendor_name=$("#vendor_name").val();
      var mobile_no=$("#mobile_no").val();
      var mobilenovalidation=/^\d{10}$/;
      if(vendor_name==""){
       $("#vendor_namer").html('Please enter vendor name');
       $("#vendor_name").focus();  
       return false;
      }
      if(mobile_no==""){
       $("#mobile_nor").html('Please enter mobile number');
       $("#mobile_no").focus(); 
       return false;
      }
        if (!(mobile_no.match(mobilenovalidation))) {
        $("#mobile_nor").html("Please enter 10 digit contact number");	
        $("#mobile_no").focus();
        return false;
        }
      
        $.ajax({
            type: "POST",
            url: BASE_URL + 'Puchase_product_vendors',
            data:{vendor_name:vendor_name,mobile_no:mobile_no},
            beforeSend: function () {
                $('#purchase__button').addClass('sanding').attr("disabled", true);
                $('#purchase__button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
          
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message_submit').show();
                     $('#error_message_submit').html(obj.message);
                     $('#purchase__button').prop('disabled', false);
                     $('#purchase__button').html('Submit');
                     $('#purchase__button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_submit').hide(); }, 10000);
                    return false;
                } else {
             
                    window.location='purchase_master?pid='+obj.pid;
                    return false;

                }
            }
        });      
    }



$("#inovice_terms_forms").validate({
    ignore: ":hidden",
    rules: {
        details: {
            required: true,
            minlength: 3,
            maxlength: 200,
        },
       
     
      
    },
    messages: {
        details: {
            required: "<span>Please enter invoice terms </span>",
            maxlength: "<span>Please enter invoice terms min 3 or 200 character </span>",
            minlength: "<span>please enter min 3  character</span>",
        },
         
      
      },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'inert_new_terms_condition',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#inovice__button').addClass('sanding').attr("disabled", true);
                $('#inovice__button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
          
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message_submit').show();
                     $('#error_message_submit').html(obj.message);
                     $('#inovice__button').prop('disabled', false);
                     $('#inovice__button').html('Submit');
                     $('#inovice__button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_submit').hide(); }, 10000);
                    return false;
                } else {
                    window.location='inovice_terms';
                    return false;

                }
            }
        });
        
        
        
    }
});

  
    function delete_invoice_tables(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_invoice_tables",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='inovice_terms';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}


  
  // Sales Product Action
  
  
  $("#sale_master_forms").validate({
    ignore: ":hidden",
    rules: {
        
        product_name: {
            required: true,
        },
       gst_rate: {
            required: true,
        },  
      product_price: {
            required: true,
            number: true,
        
        }, 
        
      qty: {
            required: true,
            number: true,
        
        },   
      
    },
    messages: {
        product_name: {
            required: "<span>Please enter product name</span>",
        },
        gst_rate: {
            required: "<span>Please select gst rate</span>",
        },
       product_price: {
            required: "<span>Please enter product price</span>",
            number: "<span>Please enter digit only</span>", 
        },  
        
        qty: {
            required: "<span>Please enter quantity</span>",
            number: "<span>Please enter digit only</span>", 
        },  
      
       

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'add_new_sale_prod_items',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#sale__button').addClass('sanding').attr("disabled", true);
                $('#sale__button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message_change').show();
                     $('#error_message_change').html(obj.message);
                     $('#sale__button').prop('disabled', false);
                     $('#sale__button').html('Add Item');
                     $('#sale__button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_change').hide(); }, 10000);
                    return false;
                } else {
                  // alert(data); 
                    $('#sale__button').prop('disabled', false);
                     $('#sale__button').html('Add Item');
                     $('#sale__button').addClass('sanding').attr("disabled", false);
                     $("#product_name").val('');
                     $("#product_price").val('');
                     $("#qty").val('');
                     $('#get_temp_details').hide().html(obj.datas).fadeIn('slow');
                }
            }
        });  
    }
});


    function delete_services(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_serives_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='services_type';
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}

 function delete_vendor_master(id){
  con=confirm('Are you sure the delete record');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_vendor_master",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='vendor_list_master';
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}




 function changed_job_status_details(id,type){
  con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"change_status_jobs",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='job_list';
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}
  function sale_product(){
      var vendor_name=$("#vendor_name").val();
      var mobile_no=$("#mobile_no").val();
      var mobilenovalidation=/^\d{10}$/;
      if(vendor_name==""){
       $("#vendor_namer").html('Please enter customer name');
       $("#vendor_name").focus();  
       return false;
      }
      if(mobile_no==""){
       $("#mobile_nor").html('Please enter mobile number');
       $("#mobile_no").focus(); 
       return false;
      }
        if (!(mobile_no.match(mobilenovalidation))) {
        $("#mobile_nor").html("Please enter 10 digit contact number");	
        $("#mobile_no").focus();
        return false;
        }
      
        $.ajax({
            type: "POST",
            url: BASE_URL + 'sale_product_vendors',
            data:{vendor_name:vendor_name,mobile_no:mobile_no},
            beforeSend: function () {
                $('#sales_final_button').addClass('sanding').attr("disabled", true);
                $('#sales_final_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
          
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message_submit').show();
                     $('#error_message_submit').html(obj.message);
                     $('#sales_final_button').prop('disabled', false);
                     $('#sales_final_button').html('Submit');
                     $('#sales_final_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message_submit').hide(); }, 10000);
                    return false;
                } else {
                    window.location='sales_master?pid='+obj.pid;
                    return false;

                }
            }
        });      
    }
    
    
    var jq=$.noConflict();
jq(document).ready(function(){
jq("#product_names").autocomplete({
        source: BASE_URL+"autosearch_product",
        minLength: 1,
       select: function(event, data) {
       jq("#product_names").val(data.item.value);
       jq("#product_price").val(data.item.price);
       },
   });
  });
  
  function update_status_sales_users(id,type){
con=confirm('Are you sure the changed status');
  if(con==true){
    $.ajax({
     url:BASE_URL+"change_status_changed_sales",
     type: "POST",
     data:{id:id,type:type},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='sales_members';
          return false;
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }    
}
  
  




            function upload_validation_exctanation(){
            var lblError = document.getElementById("uploadsheetr");
            myfile= $('#uploadsheet').val();
            var ext = myfile.split('.').pop();
            if(ext=="xlsx"){
            // alert('Valid');
            lblError.innerHTML='';
            }else{
            lblError.innerHTML = "Please upload files having extensions: <b> .xlsx</b> only.";
            document.getElementById('uploadsheet').value='';
            return false;
            }
            }
            
             function delete_lead_creation(id){
  con=confirm('Are you sure the delete lead');
  if(con==true){
    $.ajax({
     url:BASE_URL+"delete_location_masters",
     type: "POST",
     data:{id:id},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
          window.location='location_master';
          }else{
           alert('Not Updated');
           return false;
           }
         }
    });  
  }
}

function update_notification_count(){
   $.ajax({
     url:BASE_URL+"update_notification_count",
     type: "POST",
     data:{},
     success: function (data) {
         obj = JSON.parse(data);
        if (obj.code == 200) {
         // window.location='location_master';
       //  alert('UPDATE')
          }else{
         //  alert('Not Updated');
           return false;
           }
         }
    });   
}

jQuery(document).ready(function($){
        function loadData() {
        jQuery('#get_data_notification').load(BASE_URL+"get_notification_users",function() {
        if (window.reloadData != 0)
        window.clearTimeout(window.reloadData);
        window.reloadData = window.setTimeout(loadData,10000)
        }).fadeIn("slow"); 
        }
        window.reloadData = 0; // store timer load data on page load, which sets timeout to reload again
        loadData();
});


