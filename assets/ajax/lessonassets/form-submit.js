$().ready(function () {

    $.validator.addMethod("letters", function(value, element) {
        return this.optional(element) || /^[\w\s\-]+$/i.test(value);
    });

    /****************************************
     FORM VALIDATION PLACEMENT RULES
     ****************************************/
    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "help-block",
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
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
    $("#lessoncontent").validate({
        // Specify the validation rules
        rules: {
            lesson_video_link: {
                required: true,
                url: true
            },
            lesson_video_name: {
                required: true,
                letters: true
            }
        },
        // Specify the validation error messages

        messages: {
            lesson_video_link: {
                required: "Please enter a Youtube video link.",
                url: "Please enter a valid URL link."
            },
            lesson_video_name: {
                required: "Please enter a name for the video.",
                letters: "Only English letters, dashes, spaces, and underscroes are acceptable."
            }
        },

        submitHandler: function (form) {
            $.ajax({
                url: $("#lessoncontent").attr( 'action' ),//"/assets/includes/process_lessoncreate.php?id=<?php echo urldecode($_REQUEST['id'])?>",
                type: "POST",
                data: $(form).serialize(),
                beforeSend: function () {
                    document.getElementById("submit").value = "Loading...";
                    $("#submit").prop('disabled', true); // disable button
                },
                success: function (data) {
                    alert("swag");
                    alert(data.response);
                    if (data.response == 'success') {
                        $('#contactSuccess').html('<strong>Success!</strong> ' + data.reason);
                        $('#contactSuccess').removeClass('hidden');
                        $('#contactError').addClass('hidden');
                        $('#contactWarning').addClass('hidden');
                        document.getElementById("submit").value = "Add Content";
                        $("#submit").prop('disabled', false); // disable button
                        window.setTimeout(function () {
                            window.location.href = "/portal/lesson/new-content/";
                        }, 3000);
                        if (($('#contactSuccess').offset().top - 160) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactSuccess').offset().top - 80
                            }, 300);
                        }
                    } else if (data.response == 'error') {
                        $('#contactError').html('<strong>Error!</strong> ' + data.reason);
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').removeClass('hidden');
                        $('#contactWarning').addClass('hidden');
                        document.getElementById("submit").value = "Add Content";
                        $("#submit").prop('disabled', false); // disable button
                        if (($('#contactError').offset().top - 160) < $(window).scrollTop()) {
                            $('html, body').animate({scrollTop: $('#contactError').offset().top - 80
                            }, 300);
                        }
                    } else if (data.response == 'warning') {
                        $('#contactWarning').html('<strong>Warning!</strong> ' + data.reason);
                        $('#contactWarning').removeClass('hidden');
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').addClass('hidden');
                        window.setTimeout(function () {
                            window.location.href = "/portal/subject/";
                        }, 3000);
                        document.getElementById("submit").value = "Add Content";
                        $("#submit").prop('disabled', false); // disable button
                        if (($('#contactWarning').offset().top - 160) < $(window).scrollTop()) {
                            $('html, body').animate({scrollTop: $('#contactWarning').offset().top - 80
                            }, 300);
                        }
                    }
                }
            });
            $form.submit();
        }
    });
});// JavaScript Document