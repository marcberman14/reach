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
            } else if (element.prop('type') === 'select') {
                    error.insertAfter(element.closest(".multiselect-group"));
            } else {
                error.insertAfter(element);
            }
        }
    });



    var $form = $(this);
    //validate the inquiry form on keyup and submit
    $("#teacherprofile").validate({
        // Specify the validation rules
        rules: {
            teagender: {
                required:true,
            },
            teadateofbirth: {
                required:true,
            },
            teastreetno: {
                required:true,
                digits: true,
            },
            teastreetname: {
                required:true,
                addresses:true,
            },
            teasuburb: {
                required:true,
                addresses:true,
            },
            teacity: {
                required:true,
                addresses:true,
            },
            teapostcode: {
                required:true,
                digits: true
            },
            teacountry: {
                required:true,
            },
            teahomeno: {
                required:true,
            },
            teacellno: {
                required:true,
            },
            teaaltno: {
                required:true,
            },
            teaschoolemp: {
                required:true,
                lettersonly:true
            },
            teagrataught: {
                required:true,
                maxlength:2,
                digits: true
            },
            teamail: {
                required:true,
				email:true
            },
			teaexper: {
                required:true,
            },
			teaschcon: {
                required:true,
            },
            teaschooladdress: {
                required:true,
            },
            teastudy: {
                required: true,
                addresses: true
            }
        },

        // Specify the validation error messages
        messages: {

            teagender: {
                required: "Please select your gender.",
            },
            teadateofbirth: {
                required: "Please select your date of birth.",
            },
            teastreetno: {
                required: "Please enter your street number.",
                digits: "Please only enter numbers."
            },
            teastreetname: {
                required: "Please enter your street name.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            teasuburb: {
                required: "Please enter your suburb.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            teacity: {
                required: "Please enter your city.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            teapostcode: {
                required: "Please enter your postal code.",
                digits: "Please enter English letters, numbers and dashes only."
            },
            teacountry: {
                required: "Please select your country.",
            },
            teahomeno: {
                required: "Please enter your home contact number.",
            },
            teacellno: {
                required: "Please enter your cellphone number.",
            },
            teaaltno: {
                required: "Please enter an alternative contact number.",
            },
            teamail: {
                required: "Please enter your email address.",
				email:"Please insert a valid email address."
            },
            teaschoolemp: {
                required: "Please enter the school you are employed at.",
                lettersonly: "Please only use English letters."
            },
            teagrataught: {
                required: "Please enter the grade you teach.",
                maxlength: "Please only enter 2 numbers. E.G. 12.",
                digits: "Please only enter numbers."
            },
            teaschooladdress: {
                required: "Please enter the school address of where you teach.",
            },
			teaschcon: {
                required: "Please enter the school contact numbers.",
            },
			teaexper: {
                required: "Please enter the number of years of teaching experience you have (e.g. '4').",
            },
            teastudy: {
                required: "Please enter your highest qualification level.",
                addresses: "Please enter English letters, numbers and dashes only."
            }
        },

        submitHandler: function(form) {

            $.ajax({
                url: '/assets/includes/process_teacherprofile.php',
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