$().ready(function() {
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
    $("#deleteform").validate({
        // Specify the validation rules
        rules: {
            confirm: {
                required:true
            }
        },

        // Specify the validation error messages
        messages: {
            confirm: {
                required: "Please confirm that the details are correct."
            }

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
                        document.getElementById("submit").value= "Delete Subject";
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

                        document.getElementById("submit").value= "Delete Subject";
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