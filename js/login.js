function login(){
    $(document).ready(function() {
        $("#login-form").submit(function(event) {
            event.preventDefault(); // prevent default form submission
            var form_data = $(this).serialize(); // serialize form data
            $.ajax({
                url: "login.php", // URL for login script
                type: "POST", // request method
                data: form_data, // form data to be submitted
                dataType: "json", // expected data type from server
                success: function(response) {
                    if (response.status == "success") {
                        // login successful, redirect to home page
                        window.location.href = "home.html";
                    } else {
                        // login failed, display error message
                        $("#error-message").text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // error occurred during AJAX request
                    alert("An error occurred: " + error);
                }
            });
        });
    });
}
