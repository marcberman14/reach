
$().ready(function() {
    var $form = $(this);
    //validate the inquiry form on keyup and submit
    $("#backupform").validate({
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: "POST",
                data: $(form).serialize(),

                beforeSend: function() {
                    document.getElementById("submit").value= "Processing...";
                    $("#submit").prop('disabled', true); // disable button
                },

                success: function(data) {
                    if (data.response == 'success') {
                        $('#contactSuccess').removeClass('hidden');
                        $('#contactError').addClass('hidden');
                        $('#contactSuccess').html("<strong>Success!</strong> " +data.reason);
                        document.getElementById("submit").value= "backup";
                        window.setTimeout(function(){window.location.href = "/portal/backup/"; }, 3000);
                        $("#submit").prop('disabled', false); // disable button
                        if (($('#contactSuccess').offset().top - 80) < $(window).scrollTop()) {
                            $('html, body').animate({
                                scrollTop: $('#contactSuccess').offset().top - 80
                            }, 300);
                        }

                    } else if (data.response == 'error') {

                        $('#contactError').html("<strong>Error!</strong> " +data.reason);
                        $('#contactSuccess').addClass('hidden');
                        $('#contactError').removeClass('hidden');
                        document.getElementById("submit").value= "backup";
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