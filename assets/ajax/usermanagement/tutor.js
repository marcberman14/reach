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
    $("#tutorform").validate({
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
            dob: {
                required: true,
            },
            tutcellno: {
                required: true,
                digits: true
            },
            tutaltno: {
                required: true,
                digits: true
            },
            tutstreetno: {
                required: true,
                digits: true
            },
            tutstreetname: {
                required: true,
                lettersandnumbers: true
            },
            tutsuburb: {
                required: true,
                lettersandnumbers: true
            },
            tutcity: {
                required: true,
                lettersandnumbers: true
            },
            tutpostcode: {
                required: true,
                lettersandnumbers: true
            },
            tutnationality: {
                required: true,
            },
            tutcountryofres: {
                required: true,
            },
            tutsarea: {
                required: true,
            },
            tutsyear: {
                required: true,
            },
            tutsstudentnumber: {
                required: true,
            },
            tutmonashemail: {
                required: true,
                email: true
            },
            active: {
                required: true,
            },
            gender: {
                required: true,
            },
            country: {
                required: true,
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
            dob: {
                required: "Please enter an date of birth"
            },
            tutcellno: {
                required: "Please enter a cellphone number",
                digits: "Please only enter digits"
            },
            tutaltno: {
                required: "Please enter a cellphone number",
                digits: "Please only enter digits"
            },
            tutstreetno: {
                required: "Please enter a street number",
                digits: "Please only enter digits"
            },
            tutstreetname: {
                required: "Please enter a street name",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            tutsuburb: {
                required: "Please enter a suburb",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            tutcity: {
                required: "Please enter a city",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            tutpostcode: {
                required: "Please enter a postal code",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            tutnationality: {
                required: "Please enter a nationality"
            },
            tutcountryofres: {
                required: "Please enter a country of residence"
            },
            tutsarea: {
                required:"Please enter a grade"
            },
            tutsyear: {
                required:"Please enter a the year of study currently being undertaken"
            },
            tutsstudentnumber: {
                required:"Please enter a Monash student number"
            },
            tutmonashemail: {
                required:"Please enter a Monash student email address",
                email: "Please enter a valid student email"
            },
            active: {
                required: "Please select an active state"
            },
            gender: {
                required: "Please select a gender"
            },
            country: {
                required: "Please select a country"
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