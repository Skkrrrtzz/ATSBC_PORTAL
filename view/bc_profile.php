<?php require_once 'bc_nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <div class="container-fluid my-3 mx-0">
        <div class="col-md-6">
            <div class="card bg-super-light border border-2 border-primary">
                <h4 class="card-header text-bg-primary">User Information</h4>
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <img src="../assets/images/user.png" class="img-fluid img-thumbnail hover-shadow border border-2 border-primary " alt="Your Image" />
                        </div>
                        <div class="col-md-6 ms-3">
                            <div class="form-outline mb-4">
                                <input type="text" id="Name" value="<?= $Name ?>" class="form-control bg-light" readonly />
                                <label class="form-label" for="Name">Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="Email" value="<?= $Email ?>" class="form-control bg-light" readonly />
                                <label class="form-label" for="Email">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="Dept" value="<?= $Dept ?>" class="form-control bg-light" readonly />
                                <label class="form-label" for="Dept">Department</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="Role" value="<?= $Role ?>" class="form-control bg-light" readonly />
                                <label class="form-label" for="Role">Role</label>
                            </div>
                            <button type="button" class="btn btn-secondary" id="test-email-button" data-name="<?= $Name ?>" data-email="<?= $Email ?>"> <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                Test Email <i class="fa-regular fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#test-email-button').click(function(e) {
                e.preventDefault();

                // Get the button and spinner elements
                var button = $(this);
                var spinner = button.find('.spinner-border');

                // Get the email & name value from the button's data attribute
                var email = $(this).data('email');
                var name = $(this).data('name');

                // Show a confirmation modal using SweetAlert2
                Swal.fire({
                    title: 'Confirm Sending Email',
                    text: 'Are you sure you want to send this email for email confirmation?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable the button and show the spinner when the user confirms
                        button.prop('disabled', true);
                        spinner.removeClass('d-none');

                        // Perform an AJAX request to send the email value
                        $.ajax({
                            type: 'POST',
                            url: '../controllers/send_email.php',
                            data: {
                                email: email,
                                name: name,
                                send: true
                            },
                            complete: function() {
                                // Enable the button and hide the spinner when the request is complete
                                button.prop('disabled', false);
                                spinner.addClass('d-none');
                            },
                            success: function(response) {
                                var jsonResponse = JSON.parse(response);
                                // Check the response from the server
                                if (jsonResponse.success) {
                                    // Show a success toast using SweetAlert2
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Email Sent!',
                                        toast: true,
                                        text: 'Please check your email, Thank you!',
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else {
                                    // Show an error toast if needed
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle errors, e.g., show an error message
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    toast: true,
                                    text: 'Error: ' + error,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>