$().ready(function() {

    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s\-\.]+$/i.test(value);
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]+$/i.test(value);
    });

    $.validator.addMethod("lettersandnumbers", function(value, element) {
        return this.optional(element) || /^[\w\W\s\-\.]+$/i.test(value);
    });

    /****************************************

     FORM VALIDATION PLACEMENT RULES

     ****************************************/

    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "help-block",
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length || element.prop('type') === 'checkbox') {
                error.insertAfter(element.parent());
            } else if (element.is(":radio")) {
                error.insertAfter(element.closest(".radio-group"));
            } else {
                error.insertAfter(element);
            }
        }
    });

    var $form = $(this);
    //validate the inquiry form on keyup and submit
    $("#password").validate({
        // Specify the validation rules
        rules: {
            oldpassword: {
                required: true,
            },
            password: {
                required: true,
            },
            confirmpwd: {
                required: true,
                equalTo: "#password"
            }
        },

        // Specify the validation error messages

        messages: {

            oldpassword: {
                required: "Please enter your old password",
            },
            password: {
                required: "Please enter a new password",
            },
            confirmpwd: {
                required: "Please confirm your new password",
                equalTo: "Your passwords do not match"
            },
        },

        submitHandler: function(form) {

            $.ajax({
                url: $(form).attr('action'),
                type: "POST",
                data: $(form).serialize(),
                beforeSend: function() {
                    document.getElementById("submit").value= "Loading...";
                    $("#pswsubmit").prop('disabled', true); // disable button
                },
                success: function(data) {
                    if (data.response == 'success') {
                        $('#passwordSuccess').html('<strong>Success!</strong> ' + data.reason);
                        $('#passwordSuccess').removeClass('hidden');
                        $('#passwordError').addClass('hidden');
                        document.getElementById("submit").value= "Edit user";
                        $("#pswsubmit").prop('disabled', false); // disable button
                        window.setTimeout(function(){window.location.href = "/portal/userprofile/"; }, 3000);
                        if (($('#passwordSuccess').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#passwordSuccess').offset().top - 120
                            }, 300);
                        }
                    } else if (data.response == 'error') {
                        $('#passwordError').html('<strong>Error!</strong> ' + data.reason);
                        $('#passwordSuccess').addClass('hidden');
                        $('#passwordError').removeClass('hidden');
                        document.getElementById("submit").value= "Edit user";
                        $("#pswsubmit").prop('disabled', false); // disable button
                        if (($('#contactError').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#passwordError').offset().top - 120
                            }, 300);
                        }
                    }
                }
            });
            $form.submit();
        }
    });
});