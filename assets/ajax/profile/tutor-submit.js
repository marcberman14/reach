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
    $("#tutorprofile").validate({
        // Specify the validation rules
        rules: {
            tutgender: {
                required:true
            },
            tutdob: {
                required:true
            },
            tutstreetno: {
                required:true,
                digits: true
            },
            tutstreetname: {
                required:true,
                addresses:true
            },
            tutsuburb: {
                required:true,
                addresses:true
            },
            tutcity: {
                required:true,
                addresses:true
            },
            tutpostcode: {
                required:true,
                digits: true
            },
            tutcountry: {
                required:true
            },
            tutresidency: {
                required:true
            },
            tutnationality: {
                required:true
            },

            tutcellno: {
                required:true,
                digits: true
            },
            tutaltno: {
                required:true,
                digits: true
            },
            tutpemail: {
                required:true,
                email: true
            },
            tutstunum: {
                required:true,
                exactlength:8,
                digits: true
            },

            tutstudyyear: {
                required:true,
                maxlength:1,
                digits: true
            },
            tutmemail: {
                required: true,
            },

            tutareastud: {
                required: true
            }
        },

        // Specify the validation error messages
        messages: {

            tutgender: {
                required: "Please select your gender."
            },
            tutdob: {
                required: "Please select your date of birth."
            },
            tutstreetno: {
                required: "Please enter your street number.",
                digits: "Please only enter numbers."
            },
            tutstreetname: {
                required: "Please enter your street name.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            tutsuburb: {
                required: "Please enter your suburb.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            tutcity: {
                required: "Please enter your city.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            tutpostcode: {
                required: "Please enter your postal code.",
                digits: "Please enter English letters, numbers and dashes only."
            },
            tutcountry: {
                required: "Please select your country."
            },
            tutresidence: {
                required: "Please select your Country of Residence."
            },
            tutnationality: {
                required: "Please select your Nationality."
            },
            tutcellno: {
                required: "Please enter your cellphone number."
            },
            tutaltno: {
                required: "Please enter an alternative contact number."
            },
            tutpemail: {
                required: "Please enter a personal email address.",
                email: "Please enter a valid email address."
            },

            tutstunum: {
                required: "Please enter your student number.",
                exactlength: "Please only enter 8 numbers. E.G. 1234568.",
                digits: "Please only enter numbers."
            },
            tutstudyyear: {
                required: "Please enter your year of study.",
                maxlength: "Please only enter 1 numbers. E.G. 1.",
                digits: "Please only enter numbers."
            },
            tutmemail: {
                required: "Please enter your Monash Student email address.",
                email: "Please enter a valid email address."
            },
            tutareastud: {
                required: "Please select an area of study at Monash"
            }

        },

        submitHandler: function(form) {

            $.ajax({
                url: '/assets/includes/process_tutorprofile.php',
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