
$().ready(function() {
    var $form = $(this);
    //validate the inquiry form on keyup and submit
    $("#emailverify").validate({
        submitHandler: function(form) {
            $.ajax({
                url: '/assets/php/processing/email-verify-resend.php',
                type: "POST",
                data: $(form).serialize(),

                beforeSend: function() {
                    document.getElementById("submit").value= "Processing...";
                    $("#submit").prop('disabled', true); // disable button
                },

                success: function(data) {
                   // document.getElementById('swag').innerHTML = data;
                   // document.getElementById('swag').innerHTML = data.response;
                   // document.getElementById('swag').innerHTML = data.reason;
                    if (data.response == 'success') {
                        $('#contactSuccess').removeClass('hidden');
                        $('#contactError').addClass('hidden');
                        $('#contactSuccess').html("<strong>Success!</strong> " +data.reason);

                        $('#submit').addClass('hidden');
                        $('#paragraph').addClass('hidden');

                        document.getElementById("submit").value= "Resend Verification Email";

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

                        $('#submit').addClass('hidden');
                        $('#paragraph').addClass('hidden');

                        document.getElementById("submit").value= "Resend Verification Email";
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