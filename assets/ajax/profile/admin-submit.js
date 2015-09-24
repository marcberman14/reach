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
    $("#adminprofile").validate({
        // Specify the validation rules
        rules: {
            admgender: {
                required:true
            },
            admdateofbirth: {
                required:true
            },
            admstreetno: {
                required:true,
                digits: true
            },
            admstreetname: {
                required:true,
                addresses:true
            },
            admsuburb: {
                required:true,
                addresses:true
            },
            admcity: {
                required:true,
                addresses:true
            },
            admpostcode: {
                required:true,
                digits: true
            },
            admcountry: {
                required:true
            },
            admhomeno: {
                required:true,
                digits: true
            },

            admcellno: {
                required:true,
                digits: true
            },
            admaltno: {
                required:true,
                digits: true
            },
            admmail: {
                required:true

            },
            admwmail: {
                required:true

            },

            admworknum: {
                required:true,
                maxlength:10,
                digits: true
            },
            admstaffnum: {
                required: true,
                maxlength: 8,
                digits: true
            },

            admworkdepart: {
                required: true
            },

            admworkpos: {
                required: true
            }
        },

        // Specify the validation error messages
        messages: {

            admgender: {
                required: "Please select your gender."
            },
            admdob: {
                required: "Please select your date of birth."
            },
            admstreetno: {
                required: "Please enter your street number.",
                digits: "Please only enter numbers."
            },
            admstreetname: {
                required: "Please enter your street name.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            admsuburb: {
                required: "Please enter your suburb.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            admcity: {
                required: "Please enter your city.",
                addresses: "Please enter English letters, numbers and dashes only."
            },
            admpostcode: {
                required: "Please enter your postal code.",
                digits: "Please enter English letters, numbers and dashes only."
            },
            admcountry: {
                required: "Please select your country."
            },
            admhomeno: {
                required: "Please select your Country of Residence."
            },
            admcellno: {
                required: "Please enter your cell phone number."

            },

            admaltno: {
                required: "Please enter your alternative number."
            },
            admmail: {
                required: "Please enter an alternative email."
            },
            admwmail: {
                required: "Please enter monash email address."
            },

            admworknum: {
                required: "Please select your work number.",
                maxlength: "Please only enter 10 numbers.",
                digits: "Please only enter numbers."
            },
            admstaffnum: {
                required: "Please select your staff number.",
                maxlength: "Please only enter 8 numbers. E.G. 12345678.",
                digits: "Please only enter numbers."
            },
            admworkdepart: {
                required: "Please enter your work department."
            },

            admworkpos: {
                required: "Please enter your work position."
            }

        },

        submitHandler: function(form) {

            $.ajax({
                url: '/assets/includes/process_adminprofile.php',
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