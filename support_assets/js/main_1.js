// Register Users Code
$("#registerform").validate({
    ignore: ":hidden",
    rules: {
        FULLNAME: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        MOBILE: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
        EMAIL: {
            required: true,
            email: true,
        },
        PASSWORD: {
            minlength: 6,
            required: true,
        },
        Confirm_Password: {
            minlength: 6,
            equalTo: "#PASSWORD",
            required: true,
        },

    },
    messages: {
        FULLNAME: {
            required: "<span>Please enter your Full Name</span>",
            minlength: "<span>Your Full Name must consist of at least 5 characters</span>",
            maxlength: "<span>The maximum number of characters - 3</span>",
        },
        MOBILE: {
            required: "<span>Please enter your Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        EMAIL: {
            required: "<span>Please enter your email address</span>",
            email: "<span>Please enter a valid email address.</span>",
        },
        PASSWORD: {
            required: "<span>Please enter your password</span>",
            minlength: "<span>Your password must consist of at least 6 characters</span>",
        },
        Confirm_Password: {
            required: "<span> Enter Confirm Password Same as Password</span>",
            minlength: "<span>Your password must consist of at least 6 characters</span>",
            equalTo: "Please enter the same password as above",
        }

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/users_registration',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#submt_register').addClass('sanding').attr("disabled", true);
                $('#submt_register').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message').show();
                   $('#error_message').html(obj.message);
                   
                     $('#submt_register').prop('disabled', false);
                     $('#submt_register').html('Register');
                     $('#submt_register').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message').hide(); }, 10000);
                    return false;
                } else {
                    $('#success_message').show();
                    $('#success_message').html(obj.message);
                     $("#registration_id").hide();
                    setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    $("#verify_otp_div").show();
                    return false;

                }
            }
        });
    }
});

