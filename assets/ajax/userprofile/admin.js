$().ready(function() {

    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s\-\._~\-!@#\$%\^&\*\(\)]+$/i.test(value);
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
    $("#admform").validate({
        // Specify the validation rules
        rules: {
            firstname: {
                required: true,
                lettersonly: true,
            },
            surname: {
                required: true,
                lettersonly: true,
            },
            email: {
                required: true,
                email: true,
            },
            admistreetno: {
                required: true,
                digits: true,
            },
            admstreetname: {
                required: true,
                lettersandnumbers: true,
            },
            admsuburb: {
                required: true,
                lettersandnumbers: true,
            },
            admcity: {
                required: true,
                lettersandnumbers: true,
            },
            admpostcode: {
                required: true,
                digits: true,
            },
            admhomeno: {
                required: true,
                digits: true,
            },
            admcellno: {
                required: true,
                digits: true,
            },
            admworkno: {
                required: true,
                digits: true,
            },
            admjobdept: {
                required: true,
                lettersandnumbers: true,
            },
            admjobpos: {
                required: true,
                lettersandnumbers: true,
            },
            admaltemail: {
                required: true,
                email: true,
            },
        },

        // Specify the validation error messages

        messages: {

            firstname: {
                required: "Please enter first name",
                lettersonly: "Please only use English letters, spaces and dashes."
            },
            surname: {
                required: "Please enter a last name",
                lettersonly: "Please only use English letters, spaces and dashes."
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            admstreetno: {
                required: "Please enter a street number",
                digits: "Please only enter digits"
            },
            admstreetname: {
                required: "Please enter a street name",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            admsuburb: {
                required: "Please enter a suburb",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            admcity: {
                required: "Please enter a city",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            admpostcode: {
                required: "Please enter a postal code",
                digits: "Please only enter digits"
            },
            admhomeno: {
                required: "Please enter a home phone number",
                digits: "Please only enter digits"
            },
            admcellno: {
                required: "Please enter a cellphone number",
                digits: "Please only enter digits"
            },
            admworkno: {
                required: "Please enter a work number",
                digits: "Please only enter digits"
            },
            admjobdept: {
                required: "Please enter the department the user works in",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            admjobpos: {
                required: "Please enter the position in the department the user works in",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            admaltemail: {
                required: "Please enter an alternative email",
                email:"Please enter a valid email address"
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
                        document.getElementById("submit").value= "Submit";
                        $("#submit").prop('disabled', false); // disable button
                        window.setTimeout(function(){window.location.href = "/portal/userprofile/"; }, 3000);
                        if (($('#contactSuccess').offset().top - 40) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactSuccess').offset().top - 120
                            }, 300);
                        }
                    } else if (data.response == 'error') {
                        $('#contactError').html('<strong>Error!</strong> ' + data.reason);
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').removeClass('hidden');
                        document.getElementById("submit").value= "Submit";
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