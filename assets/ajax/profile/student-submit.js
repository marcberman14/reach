$().ready(function() {
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s\-]+$/i.test(value);
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
    });

    $.validator.addMethod("addresses", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\-\s]+$/i.test(value);
    });

    $.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    });

    $.validator.addMethod("needsSelection", function (value, element) {
        var count = $(element).find('option:selected').length;
        return count > 0;
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
    $("#studentprofile").validate({
        // Specify the validation rules
        rules: {
            stugender: {
                required:true,
            },
            studateofbirth: {
                required:true,
            },
            stustreetno: {
                required:true,
                digits: true,
            },
            stustreetname: {
                required:true,
                addresses:true,
            },
            stusuburb: {
                required:true,
                addresses:true,
            },
            stucity: {
                required:true,
                addresses:true,
            },
            stupostcode: {
                required:true,
                digits: true
            },
            stucountry: {
                required:true,
            },
            stuhomeno: {
                required:true,
                digits: true
            },
            stucellno: {
                required:true,
                digits: true
            },
            stualtno: {
                required:true,
                digits: true
            },
            stuparentno: {
                required:true,
                digits: true
            },
            stuschoolname: {
                required:true,
                lettersonly:true
            },
            stugrade: {
                required:true,
                maxlength:2,
                digits: true
            },
            stusubjects: {
                required:true,
            },
        },

        // Specify the validation error messages
        messages: {

            stugender: {
                required: "Please select your gender.",
            },
            studateofbirth: {
                required: "Please select your date of birth.",
            },
            stustreetno: {
                required: "Please enter your street number.",
                digits: "Please only enter numbers."
            },
            stustreetname: {
                required: "Please enter your street name.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            stusuburb: {
                required: "Please enter your suburb.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            stucity: {
                required: "Please enter your city.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            stupostcode: {
                required: "Please enter your postal code.",
                digits: "Please only enter numbers."
            },
            stucountry: {
                required: "Please select your country.",
            },
            stuhomeno: {
                required: "Please enter your home contact number.",
                digits: "Please only enter numbers."
            },
            stucellno: {
                required: "Please enter your cellphone number.",
                digits: "Please only enter numbers."
            },
            stualtno: {
                required: "Please enter an alternative contact number.",
                digits: "Please only enter numbers."
            },
            stuparentno: {
                required: "Please enter an parent's contact number.",
                digits: "Please only enter numbers."
            },
            stuschoolname: {
                required: "Please enter your school name.",
                lettersonly: "Please only use English letters."
            },
            stugrade: {
                required: "Please select your grade.",
                maxlength: "Please only enter 2 numbers. E.G. 12.",
                digits: "Please only enter numbers."
            },
            stusubjects: {
                required: "Please select at least 7 subjects.",
            },
        },

        submitHandler: function(form) {

            $.ajax({
                url: '/assets/includes/process_studentprofile.php',
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