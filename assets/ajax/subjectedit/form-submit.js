$().ready(function() {

    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s\-\._~\-!@#\$%\^&\*\(\)]+$/i.test(value);
    });
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]+$/i.test(value);
    });

    $.validator.addMethod("addresses", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\-]+$/i.test(value);
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
    $("#subeditform").validate({
        // Specify the validation rules
        rules: {
            code: {
                required: true,
                alphanumeric: true
            },
            subject_name: {
                required: true,
                lettersonly: true
            },
            subject_description: {
                required: true,
            },
            subject_category: {
                required: true,
                lettersonly: true
            },
            grade: {
                required: true
            },
            selecttutor: {
                required: true
            }
        },

        // Specify the validation error messages

        messages: {
            code: {
                required: "Please enter a subject code",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            subject_name: {
                required: "Please enter a subject name",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            subject_description: {
                required: "Please enter a subject description",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            subject_category: {
                required: "Please enter a subject category.",
                lettersonly: "Please only use English letters, spaces and dashes."
            },

            grade: {
                required: "Please only use English letters, spaces and dashes."
            },
            selecttutor: {
                required: "Please select a tutor"
            }
        },

        submitHandler: function(form) {
            $.ajax({
                url: '/assets/includes/process_subedit.php',
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
                        document.getElementById("submit").value= "Edit Subject";
                        $("#submit").prop('disabled', false); // disable button
                        window.setTimeout(function(){window.location.href = "/portal/subject/view/"; }, 3000);
                        if (($('#contactSuccess').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactSuccess').offset().top - 80
                            }, 300);
                        }
                    } else if (data.response == 'error') {
                        $('#contactError').html('<strong>Error!</strong> ' + data.reason);
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').removeClass('hidden');
                        document.getElementById("submit").value= "Edit Subject";
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