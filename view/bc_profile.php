<?php require_once 'bc_nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .image-container {
            position: relative;
            overflow: hidden;
        }

        .edit-icon {
            position: absolute;
            top: 0;
            right: 0;
            display: none;
            background-color: transparent;
            padding: 5px;
            cursor: pointer;
        }

        .image-container:hover .edit-icon {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container-fluid my-3 mx-0">
        <div class="col-md-12 col-xl-6">
            <div class="card bg-super-light border border-2 border-primary">
                <h4 class="card-header text-bg-primary">User Information</h4>
                <div class="card-body">
                    <!-- <h5 class="card-title">Profile</h5> -->
                    <div class="row g-2 mb-2">
                        <!-- <div class="col-md-4">
                            <img src="../assets/images/user.png" class="img-fluid img-thumbnail hover-shadow border border-2 border-primary " alt="Your Image" />
                        </div> -->
                        <div class="col-md-4">
                            <div class="image-container">
                                <img id="previewImage" src="../assets/images/user.png" class="img-fluid img-thumbnail hover-shadow border border-2 border-primary" alt="Your Image" />
                                <label for="hiddenImageInput" class="edit-icon" style="cursor: pointer;">
                                    <i class="fa-solid fa-pen-to-square text-dark fa-2x"></i>
                                </label>
                                <input type="file" id="hiddenImageInput" style="display: none;" accept="image/png, image/jpeg, image/jpg" />
                            </div>
                        </div>
                        <div class="col-md-6">
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
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" id="test-email-button" data-name="<?= $Name ?>" data-email="<?= $Email ?>"> <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                    Test Email <i class="fa-regular fa-paper-plane"></i>
                                </button>
                                <button type="button" class="btn btn-primary" id="change_pw" data-mdb-toggle="modal" data-mdb-target="#changePassword">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ChangePassword Modal -->
    <div class="modal fade" id="changePassword" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-bg-primary">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePasswordForm" class="needs-validation" novalidate>
                    <input type="hidden" id="empID" value="<?= $Emp_ID ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            <div id="passwordFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancel" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
                    confirmButtonText: 'Proceed',
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

            var newPasswordInput = $('#newPassword');
            var confirmPasswordInput = $('#confirmPassword');
            var passwordFeedback = $('#passwordFeedback');
            const empId = $('#empID').val();

            function updatePasswordFeedback(isValid) {
                if (isValid) {
                    passwordFeedback.html('Passwords match.').removeClass('invalid-feedback').addClass('valid-feedback');
                    newPasswordInput.removeClass('is-invalid').addClass('is-valid');
                    confirmPasswordInput.removeClass('is-invalid').addClass('is-valid');
                } else {
                    passwordFeedback.html('Passwords do not match.').removeClass('valid-feedback').addClass('invalid-feedback');
                    newPasswordInput.removeClass('is-valid').addClass('is-invalid');
                    confirmPasswordInput.removeClass('is-valid').addClass('is-invalid');
                }
            }

            function clearForm() {
                newPasswordInput.val('');
                confirmPasswordInput.val('');
                passwordFeedback.html(''); // Clear the feedback
                newPasswordInput.removeClass('is-valid is-invalid');
                confirmPasswordInput.removeClass('is-valid is-invalid');
            }

            function checkPasswordMatch() {
                var newPassword = newPasswordInput.val();
                var confirmPassword = confirmPasswordInput.val();
                var isValid = newPassword !== '' && confirmPassword !== '' && newPassword === confirmPassword;
                updatePasswordFeedback(isValid);
                return isValid;
            }

            // Event listener for changes in password fields
            newPasswordInput.on('input', checkPasswordMatch);
            confirmPasswordInput.on('input', checkPasswordMatch);
            // Event listener for form submission
            $('#changePasswordForm').submit(function(e) {
                e.preventDefault();

                // Check if passwords match before making the AJAX request
                if (checkPasswordMatch()) {
                    var newPassword = newPasswordInput.val();
                    var confirmPassword = confirmPasswordInput.val();

                    $.ajax({
                        url: '../controllers/changepw.php',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            empID: empId,
                            newPassword: newPassword,
                            confirmPassword: confirmPassword
                        },
                        success: function(response) {
                            // console.log(response);
                            // Handle the AJAX response
                            if (response.success) {
                                // Show success message using SweetAlert2
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function() {
                                    // Clear the form after success
                                    clearForm();

                                    // Close the modal
                                    $('#changePassword').modal('hide');
                                });
                            } else {
                                // Handle the case when the update failed
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed',
                                    text: response.message,
                                    showConfirmButton: true
                                });
                            }
                        },
                        error: function(error) {
                            // Handle AJAX error
                            console.error(error);
                        }
                    });
                }
                // else {
                //     console.log('gg');
                // }
            });

            // Event listener for the "Cancel" button
            $('#cancel').on('click', function() {
                // Clear the form when cancel is clicked
                clearForm();
            });

            // // Edit Image
            $('#hiddenImageInput').on('change', function() {
                loadImage(this);
            });

            $('.edit-icon').on('click', function(e) {
                e.preventDefault();
                $('#hiddenImageInput').click();
            });

            function loadImage(input) {
                const file = input.files[0];

                if (file) {
                    // Validate file type and size
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                    const maxSize = 1 * 1024 * 1024; // 3MB

                    if (allowedTypes.includes(file.type) && file.size <= maxSize) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const image = $('#previewImage');
                            image.attr('src', e.target.result);
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // Reset the input and show an error message
                        $('#hiddenImageInput').val('');
                        Swal.fire({
                            icon: 'info',
                            toast: true,
                            position: 'top-end',
                            // timerProgressBar: true,
                            text: 'Please select a valid image (PNG, JPEG) with a maximum size of 3MB.',
                            showConfirmButton: false,
                            timer: 5000
                        });
                    }
                }
            }
        });
    </script>
</body>

</html>