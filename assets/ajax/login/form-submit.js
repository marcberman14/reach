function formhash(password, form) {
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
    } else {
        var p = document.getElementById("hashedPassword");
        p.value = hex_sha512(password.value);

        // Make sure the plaintext password doesn't get sent.
        document.getElementById("password").value = "";
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
    $("#loginform").validate({
        // Specify the validation rules
        rules: {
            email: {
                required:true,
            },
            password: {
                required:true,
            },
        },

        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter your e-mail address.",
            },
            password: {
                required:"Please enter your password.",
            },

        },


        submitHandler: function(form) {
            formhash(document.getElementById("password"), document.getElementById("loginform"));
            $.ajax({
                url: '/assets/includes/process_login.php',
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

                        if(data.active == 'noprofile'){
                            window.setTimeout(function(){window.location.href = "/portal/profile/"; }, 3000);
                        } else {
                            window.setTimeout(function(){window.location.href = "/portal/"; }, 3000);
                        }
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