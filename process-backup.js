
$().ready(function() {
    var $form = $(this);
    //validate the inquiry form on keyup and submit
    $("#backupform").validate({
        submitHandler: function(form) {
            $.ajax({
                url: '/assets/php/processing/process-backup.php',
                type: "POST",
                data: $(form).serialize(),

                beforeSend: function() {
                    document.getElementById("submit").value= "Processing...";
                    $("#submit").prop('disabled', true); // disable button
                },

                success: function(data) {
                    alert(data);
                    if (data.response === 'success') {
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



                    } else if (data.response === 'error') {

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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


