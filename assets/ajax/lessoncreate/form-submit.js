$().ready(function() {

    $.validator.addMethod("lettersonly", function(value, element) {

        return this.optional(element) || /^[a-zA-Z\s\-\.]+$/i.test(value);

    });



    $.validator.addMethod("alphanumeric", function(value, element) {

        return this.optional(element) || /^[a-zA-Z0-9\s]+$/i.test(value);

    });



    $.validator.addMethod("addresses", function(value, element) {

        return this.optional(element) || /^[a-zA-Z0-9\-]+$/i.test(value);

    });



    $.validator.addMethod("exactlength", function(value, element, param) {

        return this.optional(element) || value.length == param;

    });



    $.validator.addMethod("password", function(value, element) {

        return this.optional(element) || /^[a-zA-Z0-9!@#$%^&*()_+={};:|<>?]*$/i.test(value);

    });



    $.validator.addMethod("passwordrules", function(value, element) {

        return this.optional(element) || /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/i.test(value);

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

    $("#lessoncreateform").validate({

        // Specify the validation rules

        rules: {

            lesson_title: {
                required: true,
                alphanumeric: true
            },

            lesson_name: {
                required: true,
                lettersonly: true
            },

            lesson_description: {
                required: true,
                lettersonly: true
            },

            lesson_concept: {
                required: true,
                lettersonly: true
            },

            lesson_material: {
                required: true
            },
            selectsub: {
                required: true
            }
        },



        // Specify the validation error messages

        messages: {

            lesson_title: {
                required: "Please enter a lesson title",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            lesson_name: {
                required: "Please enter a lesson name",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            lesson_description: {
                required: "Please enter a lesson description",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            lesson_concept: {
                required: "Please enter a lesson concept",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            lesson_material: {
                required: "Please only use English letters, spaces and dashes."
            },
            selectsub: {
                required: "Please select a subject"
            }

        },



        submitHandler: function(form) {



            $.ajax({

                url: '/assets/includes/process_lessoncreate.php',

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

                        window.setTimeout(function(){window.location.href = "/user/login/"; }, 3000);

                        if (($('#contactSuccess').offset().top - 80) < $(window).scrollTop()) {

                            $('html, body').animate({

                                scrollTop: $('#contactSuccess').offset().top - 80

                            }, 300);

                        }



                    } else if (data.response == 'error') {

                        $('#contactError').html('Error! ' + data.reason);

                        $('#contactSuccess').addClass('hidden');

                        $('#contactError').removeClass('hidden');



                        document.getElementById("submit").value= "Create Lesson";

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

});// JavaScript Document