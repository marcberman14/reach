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
    $("#studentform").validate({
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
            stustreetno: {
                required: true,
                digits: true
            },
            stustreetname: {
                required: true,
                lettersandnumbers: true
            },
            stusuburb: {
                required: true,
                lettersandnumbers: true
            },
            stucity: {
                required: true,
                lettersandnumbers: true
            },
            stupostcode: {
                required: true,
                lettersandnumbers: true
            },
            stuhomeno: {
                required: true,
                digits: true
            },
            stucellno: {
                required: true,
                digits: true
            },
            stualtno: {
                required: true,
                digits: true
            },
            stuparentno: {
                required: true,
                digits: true
            },
            stuschoolname: {
                required: true,
                lettersonly: true,
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
            stustreetno: {
                required: "Please enter a street number",
                digits: "Please only enter digits"
            },
            stustreetname: {
                required: "Please enter a street name",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            stusuburb: {
                required: "Please enter a suburb",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            stucity: {
                required: "Please enter a city",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            stupostcode: {
                required: "Please enter a postal code",
                lettersandnumbers: "Please only use English letters, spaces and dashes"
            },
            stuhomeno: {
                required: "Please enter a home number",
                digits: "Please only enter digits"
            },
            stucellno: {
                required: "Please enter a cellphone number",
                digits: "Please only enter digits"
            },
            stualtno: {
                required: "Please enter a cellphone number",
                digits: "Please only enter digits"
            },
            stuparentno: {
                required: "Please enter a parent's contact number",
                digits: "Please only enter digits"
            },
            stuschoolname: {
                required: "Please enter a school name",
                lettersonly: "Please only use English letters, spaces and dashes."
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
                        window.setTimeout(function(){window.location.href = "/portal/userprofile/"; }, 3000);
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