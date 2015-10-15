function formhash(password,form) {
    // Create a new element input, this will be our hashed password field.
    if(!document.getElementById("hashedPassword")){
        var p = document.createElement("input");

        // Add the new element to our form.
        form.appendChild(p);
        p.name = "hashedPassword";
        p.id = "hashedPassword";
        p.type = "hidden";
        p.value = hex_sha512(password.value);

        // Make sure the plaintext password doesn't get sent.
        document.getElementById("password").value = "";
        document.getElementById("confirmpwd").value = "";
    } else {
        var p = document.getElementById("hashedPassword");
        p.value = hex_sha512(password.value);

        // Make sure the plaintext password doesn't get sent.
        document.getElementById("password").value = "";
        document.getElementById("confirmpwd").value = "";
    }
}

$().ready(function() {
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s\-]+$/i.test(value);
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
    });

    $.validator.addMethod("addresses", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\-]+$/i.test(value);
    });

    $.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    });

    $.validator.addMethod("password", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9!@#$%^&*()_+={};:|<>?]*$/i.test(value);
    });

    $.validator.addMethod("passwordrules", function(value, element) {
        return this.optional(element) || /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/i.test(value);
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
    $("#registrationform").validate({
        // Specify the validation rules
        rules: {
            firstname: {
                required: true,
                lettersonly: true
            },
            surname: {
                required: true,
                lettersonly: true
            },
            email: {
                required: true,
                email: true
            },
            usertype: {
                required: true
            },
			 gender: {
                required: true
            },
            password: {
                required: true,
                password: true,
                passwordrules: true,
                minlength: 6
            },
            confirmpwd: {
                required: true,
                equalTo : "#password"
            },
        },

        // Specify the validation error messages
        messages: {
            firstname: {
                required: "Please enter your first name.",
                lettersonly: "Please only use English letters, spaces and dashes."
            },
            surname: {
                required: "Please enter your surname",
                lettersonly: "Please only use English letters, spaces and dashes."
            },
            email: {
                required: "Please enter your email address.",
                email: "Please enter a valid email address"
            },
            usertype: {
                required: "Please select your user type."
            },
			 gender: {
                required: "Please enter your gender.",
            },
            password: {
                required: "Please enter your password.",
                password: "Please english letters, numbers and select special characters allowed.",
                passwordrules: "At least one uppercase letter (A..Z), one lower case letter (a..z), and one number (0..9) must be used.",
                minlength:"Your password must be atleast 6 characters long."
            },
            confirmpwd: {
                required: "Please confirm your password",
                equalTo : "Your passwords do not match."
            },
        },

        submitHandler: function(form) {

            formhash(document.getElementById("password"), document.getElementById("registrationform"));

            $.ajax({
                url: '/assets/includes/process_register.php',
                type: "POST",
                data: $(form).serialize(),

                beforeSend: function() {
                    document.getElementById("submit").value= "Loading...";
                    $("#submit").prop('disabled', true); // disable button
                },

                success: function(data) {

                    if (data.response == 'success') {
                        $('#contactSuccess').removeClass('hidden');
                        $('#contactError').addClass('hidden');

                        document.getElementById("submit").value= "Login";
                        $("#submit").prop('disabled', false); // disable button
                        window.setTimeout(function(){window.location.href = "/user/login/"; }, 3000);
                        if (($('#contactSuccess').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactSuccess').offset().top - 80
                            }, 300);
                        }

                    } else if (data.response == 'error') {
                        $('#contactError').html('Error! ' + data.reason);
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').removeClass('hidden');

                        document.getElementById("submit").value= "Login";
                        $("#submit").prop('disabled', false); // disable button

                        if (($('#contactError').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactError').offset().top - 80
                            }, 300);
                        }
                    }

                }
            });
            $form.submit();
        }
    });
});