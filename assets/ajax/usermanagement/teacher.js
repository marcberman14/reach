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
    $("#teacherform").validate({
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
            dob: {
                required: true,
            },
            teaschoolemp: {
                required: true,
                lettersandnumbers: true,
            },
            teagradtaught: {
                required: true,
                digits: true,
            },
            teayearsofexperience: {
                required: true,
                digits: true,
            },
            teacellno: {
                required: true,
                digits: true,
            },
            teaaltno: {
                required: true,
                digits: true,
            },
            teapersonalemail: {
                required: true,
                email: true,
            },
            teaschooladdress: {
                required: true,
                lettersandnumbers: true,
            },
            teaschoolcontact: {
                required: true,
                digits: true,
            },
            teastreetno: {
                required: true,
                digits: true,
            },
            teastreetname: {
                required: true,
                lettersandnumbers: true,
            },
            teasuburb: {
                required: true,
                lettersandnumbers: true,
            },
            teacity: {
                required: true,
                lettersandnumbers: true,
            },
            teapostcode: {
                required: true,
                digits: true,
            },
            teasubtaught: {
                required: true,
                lettersandnumbers: true,
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
            teaschoolemp: {
                required: "Please enter the name of the teachers school",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            teagradtaught: {
                required: "Please enter the grade taught",
                digits: "Please only enter digits"
            },
            teayearsofexperience: {
                required: "Please enter the number of teaching experience in years",
                digits: "Please only enter digits"
            },
            teacellno: {
                required: "Please enter a cell phone number",
                digits: "Please only enter digits"
            },
            teaaltno: {
                required: "Please enter an alternative phone number",
                digits: "Please only enter digits"
            },
            teapersonalemail: {
                required: "Please enter a the personal email",
                email:"Please enter a valid email address"
            },
            teaschooladdress: {
                required: "Please enter the schools physical address",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            teaschoolcontact: {
                required: "Please enter the schools contact number",
                digits: "Please only enter digits"
            },
            teastreetno: {
                required: "Please enter the teachers street number",
                digits: "Please only enter digits"
            },
            teastreetname: {
                required: "Please enter the teachers street name",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            teasuburb: {
                required: "Please enter the teachers suburb",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            teacity: {
                required: "Please enter the teachers city",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            teapostcode: {
                required: "Please enter the teachers postal code",
                digits: "Please only enter digits"
            },
            teasubtaught: {
                required: "Please enter the subject taught",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
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
                        if (($('#contactSuccess').offset().top - 40) < $(window).scrollTop()) {
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