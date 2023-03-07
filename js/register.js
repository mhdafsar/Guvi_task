function register()
    {
        $(document).ready(function() {
            $('#confirm_password').on('keyup', function() {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#message').html('Passwords match').css('color', 'green');
                } else {
                    $('#message').html('Passwords do not match').css('color', 'red');
                }
            });
        });
$(document).ready(function() {
    $('#registration-form').submit(function(e) {
        e.preventDefault(); // prevent form submission
        var formData = $(this).serialize(); // serialize form data
        $.ajax({
            url: "php/register.php", // URL to PHP script
            type: 'POST',
            data: formData,
            success: function(response) {
                // show success message
                alert(response);
                // reset form
                $('#registration-form')[0].reset();
            },
            error: function(xhr, status, error) {
                // show error message
                alert("Error: " + error);
            }
        });
    });
});
}