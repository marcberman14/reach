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
    $("#newuserform").validate({
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
            gender: {
                required: true,
            },
            usertype: {
                required: true
            },
        },
        // Specify the validation error messages
        messages: {
            firstname: {
                required: "Please enter user's first name.",
                lettersonly: "Please only use English letters, spaces and dashes."
            },
            gender: {
                required: "Please enter user's gender.",
            },
            surname: {
                required: "Please enter user's surname",
                lettersonly: "Please only use English letters, spaces and dashes."
            },
            email: {
                required: "Please enter user's email address.",
                email: "Please enter a valid email address"
            },
            usertype: {
                required: "Please select user's user type."
            },
        },

        submitHandler: function(form) {

            $.ajax({
                url: $(form).attr('action'),
                type: "POST",
                data: $(form).serialize(),
                beforeSend: function() {
                    document.getElementById("submit").value= "Loading...";
                    $("#submit").prop('disabled', true); // disable button
                },
                success: function(data) {
                    if (data.response == 'success') {
                        $('#contactSuccess').html('<strong>Success!</strong> ' + data.reason);
                        $('#contactSuccess').removeClass('hidden');
                        $('#contactError').addClass('hidden');
                        document.getElementById("submit").value= "Edit user";
                        $("#submit").prop('disabled', false); // disable button
                        window.setTimeout(function(){window.location.href = "/portal/users/view/"; }, 3000);
                        if (($('#contactSuccess').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactSuccess').offset().top - 120
                            }, 300);
                        }
                    } else if (data.response == 'error') {
                        $('#contactError').html('<strong>Error!</strong> ' + data.reason);
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').removeClass('hidden');
                        document.getElementById("submit").value= "Edit user";
                        $("#submit").prop('disabled', false); // disable button
                        if (($('#contactError').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactError').offset().top - 120
                            }, 300);
                        }
                    }
                }
            });
            $form.submit();
        }
    });
});