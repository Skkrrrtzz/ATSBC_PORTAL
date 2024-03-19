<?php require_once 'bc_nav.php';
if ($Role === "Admin") : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Users</title>
        <style>
            /* table.dataTable td {
            font-size: 12px;
            padding: 2px;
        } */
        </style>
    </head>

    <body class="bg-light">
        <div class="container my-2">
            <div class="mb-2" role="group" aria-label="Add-User">
                <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#addUserModal"><i class="fa-solid fa-circle-plus"></i> Add User</button>
            </div>
            <div class="table-responsive">
                <table id="admin_users" class="table table-hover table-sm rounded text-nowrap" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Position</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Add user Modal -->
        <div class="modal fade" id="addUserModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center mx-2 my-1 d-none" role="alert" id="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <span id="alert-text"></span>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-sm-6 mb-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="addUserField" name="name" required />
                                    <label class="form-label" for="addUserField">Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-outline">
                                    <input type="email" class="form-control" id="addEmailField" name="email" required />
                                    <label class="form-label" for="addEmailField">Email address</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-sm-6 mb-3">
                                <div class="form-outline">
                                    <input type="number" class="form-control" id="addEmpField" name="employee_id" required />
                                    <label class="form-label" for="addEmpField">Emp ID</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="addPassField" placeholder="Password" required minlength="8" pattern=".{8,}" title="Password must be at least 8 characters long">
                                    <button class="btn btn-outline-primary" type="button" id="toggleAddPassword" data-mdb-ripple-color="dark">
                                        <i class="far fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="form-floating col-sm-4 mb-3">
                                <select class="form-select" id="addDeptField" name="department" required>
                                    <option value="">Choose Department</option>
                                    <option value="Business Control">Business Control</option>
                                    <option value="Purchasing">Purchasing</option>
                                    <option value="Sourcing">Sourcing</option>
                                    <option value="EVP">EVP</option>
                                </select>
                                <label class="form-label" for="addDeptField">Department</label>
                            </div>
                            <div class="form-floating col-sm-4 mb-3">
                                <select class="form-select" id="addRoleField" name="role" required>
                                    <option value="">Choose role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Viewer">Viewer</option>
                                    <option value="Approver 1">Approver 1</option>
                                    <option value="Approver 2">Approver 2</option>
                                    <option value="Approver 3">Approver 3</option>
                                    <option value="Optional Approver">Optional Approver</option>
                                    <option value="Requestor">Requestor</option>
                                </select>
                                <label class="form-label" for="addRoleField">Role</label>
                            </div>
                            <div class="form-floating col-sm-4 mb-3">
                                <select class="form-select" id="addPosField" name="position" required>
                                    <option value="">Choose position</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                </select>
                                <label class="form-label" for="addPosField">Position</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="addBtn" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit user Modal -->
        <div class="modal fade" id="editUserModal" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            <div class="row g-2">
                                <div class="col-sm-6 mb-3">
                                    <div class="form-outline">
                                        <input type="text" class="form-control" id="editNameField" name="name" required />
                                        <label class="form-label" for="editNameField">Name</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="form-outline">
                                        <input type="email" class="form-control" id="editEmailField" name="email" required />
                                        <label class="form-label" for="editEmailField">Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-sm-6 mb-3">
                                    <div class="form-outline">
                                        <input type="number" class="form-control" id="editEmpField" name="employee_id" required />
                                        <label class="form-label" for="editEmpField">Emp ID</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="editPassField" placeholder="Password" required minlength="8" pattern=".{8,}" title="Password must be at least 8 characters long">
                                        <button class="btn btn-outline-primary" type="button" id="toggleEditPassword" data-mdb-ripple-color="dark">
                                            <i class="far fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-sm form-floating">
                                    <select class="form-select" id="editDeptField" name="department" required>
                                        <option value="">Choose Department</option>
                                        <option value="Business Control">Business Control</option>
                                        <option value="Purchasing">Purchasing</option>
                                        <option value="Sourcing">Sourcing</option>
                                        <option value="EVP">EVP</option>
                                    </select>
                                    <label for="editDeptField">Department</label>
                                </div>
                                <div class="col-sm form-floating">
                                    <select class="form-select" id="editRoleField" name="role" required>
                                        <option value="">Choose role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Viewer">Viewer</option>
                                        <option value="Approver 1">Approver 1</option>
                                        <option value="Approver 2">Approver 2</option>
                                        <option value="Approver 3">Approver 3</option>
                                        <option value="Optional Approver">Optional Approver</option>
                                        <option value="Requestor">Requestor</option>
                                    </select>
                                    <label for="editRoleField">Role</label>
                                </div>
                                <div class="form-floating col-sm-4 mb-3">
                                    <select class="form-select" id="editPosField" name="position" required>
                                        <option value="">Choose position</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                    <label class="form-label" for="editPosField">Position</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitBtn" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var table = $('#admin_users').DataTable({
                    ajax: {
                        url: "../controllers/commands.php",
                        dataType: "json",
                        dataSrc: ""
                    },
                    columns: [{
                            data: "username"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "email"
                        },
                        {
                            data: "dept"
                        },
                        {
                            data: "role",
                            render: function(data, type, row) {
                                if (data === "Approver 1" || data === "Approver 2" || data === "Approver 3") {
                                    return '<span class="badge badge-pill badge-success">' + data + '</span>';
                                } else if (data === "Optional Approver") {
                                    return '<span class="badge badge-pill badge-warning">' + data + '</span>';
                                } else if (data === "Requestor") {
                                    return '<span class="badge badge-pill badge-danger">' + data + '</span>';
                                } else {
                                    return '<span class="badge badge-pill badge-primary">' + data + '</span>';
                                }
                                return data;
                            }
                        },
                        {
                            "data": "position",
                            "render": function(data, type, row) {
                                if (data === "Admin") {
                                    return '<span class="badge badge-pill badge-primary">' + data + '</span>';
                                } else if (data === "Manager") {
                                    return '<span class="badge badge-pill badge-secondary">' + data + '</span>';
                                } else {
                                    return data;
                                }
                                return data;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return '<a href="javascript:void();" class="text-primary edit-btn fs-4" data-id="' + row.ID + '" data-mdb-toggle="modal" data-mdb-target="#editUserModal"><i class="fa-solid fa-pen-to-square"></i></a>' + ' <a href="javascript:void();" class="text-danger delete-btn fs-4" data-id= "' + row.ID + '" ><i class="fa-solid fa-trash"></i></a>';
                            }
                        }
                    ],
                    order: [
                        [4, "asc"]
                    ],
                    "paging": true,
                    scrollX: true,
                    scrollY: "50vh",
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "responsive": true,
                    "lengthChange": true,
                });

                // Handle click event of "Submit" button in the modal
                $('#addBtn').on('click', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    // Retrieve the values from the modal inputs
                    var name = $('#addUserField').val();
                    var email = $('#addEmailField').val();
                    var emp_id = $('#addEmpField').val();
                    var pass = $('#addPassField').val();
                    var dept = $('#addDeptField').val();
                    var role = $('#addRoleField').val();
                    var pos = $('#addPosField').val();
                    // Hide the alert by default
                    $('#alert').addClass('d-none');

                    // Check if any required field is empty
                    if (name === '' || email === '' || emp_id === '' || pass === '' || role === '') {
                        // Display error message for empty fields
                        $('#alert-text').text('Please fill in all required fields.');
                        $('#alert').removeClass('d-none').show();
                        return;
                    }
                    // Check the password length
                    if (pass.length < 8) {
                        // Display an error message for a password that is less than 8 characters long
                        $('#alert-text').text('Password must be at least 8 characters long.');
                        $('#alert').removeClass('d-none').show();
                        return;
                    }
                    // Hide the alert message if all fields are filled
                    $('#alert').addClass('d-none');

                    // Perform an AJAX request to insert the data into the database
                    $.ajax({
                        url: '../controllers/commands.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'add',
                            name: name,
                            email: email,
                            employee_id: emp_id,
                            password: pass,
                            dept: dept,
                            role: role,
                            position: pos
                        },
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Check the value of the response

                            if (response.success) { // Check the 'success' property in the response
                                // Show success message using SweetAlert2
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added Successful',
                                    text: 'The data has been added successfully!',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(function() {
                                    // Reset the modal inputs
                                    $('#addUserField').val('');
                                    $('#addEmailField').val('');
                                    $('#addEmpField').val('');
                                    $('#addPassField').val('');
                                    $('#addDeptField').val('');
                                    $('#addRoleField').val('');
                                    $('#addPosField').val('');
                                    // Close the modal
                                    $('#addUserModal').modal('hide');
                                    $('.modal-backdrop').remove();
                                    table.ajax.reload(); // Reload the DataTable
                                });
                            } else {
                                // Handle the case when the update failed
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed',
                                    text: 'Failed to add the data: ' + response.message,
                                    showConfirmButton: true
                                });
                            }
                        },
                        error: function() {
                            // Handle the error case
                            console.log('Error occurred during data insertion');
                        }
                    });
                });

                // Bind the click event to a parent element and delegate it to .edit-btn
                $('#admin_users tbody').on('click', '.edit-btn', function(e) {
                    e.preventDefault(); // Prevent any default actions
                    selectedId = $(this).data('id'); // Store the id value in the variable
                    var rowData = table.row($(this).closest('tr')).data(); // Get the data of the clicked row

                    // Set the values inside the form fields
                    $('#editNameField').val(rowData.name);
                    $('#editEmpField').val(rowData.username);
                    $('#editEmailField').val(rowData.email);
                    $('#editDeptField').val(rowData.dept);
                    $('#editRoleField').val(rowData.role);
                    $('#editPosField').val(rowData.position);

                });
                // Handle submit button click inside the modal
                $('#submitBtn').on('click', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    var id = selectedId;
                    // var updateName = $('#editNameField').val();
                    var updateEMP = $('#editEmpField').val();
                    var updateEmail = $('#editEmailField').val();
                    var updatePass = $('#editPassField').val();
                    var updateDept = $('#editDeptField').val();
                    var updateRole = $('#editRoleField').val();
                    var updatePosition = $('#editPosField').val();

                    // Make an AJAX request to update the values in the database
                    $.ajax({
                        url: '../controllers/commands.php',
                        method: 'POST',
                        data: {
                            action: 'edit',
                            id: id,
                            // name: updateName,
                            employee_id: updateEMP,
                            email: updateEmail,
                            password: updatePass,
                            dept: updateDept,
                            role: updateRole,
                            position: updatePosition
                        },
                        success: function(response) {
                            console.log(response);
                            try {
                                // Parse the JSON response into a JavaScript object
                                var responseObject = JSON.parse(response);

                                if (responseObject.success) {
                                    Swal.fire({
                                        title: 'Message',
                                        text: responseObject.message,
                                        icon: 'success',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });

                                    // Reset the input fields
                                    // $('#editNameField').val('');
                                    $('#editEmpField').val('');
                                    $('#editEmailField').val('');
                                    $('#editPassField').val('');
                                    $('#editDeptField').val('');
                                    $('#editRoleField').val('');
                                    $('#editPosField').val('');
                                    table.ajax.reload();
                                } else {
                                    // Display an error message
                                    Swal.fire('Error', responseObject.message, 'error');
                                }
                            } catch (error) {
                                // Handle JSON parsing error
                                console.error('Error parsing JSON response:', error);
                                Swal.fire('Error', 'An error occurred while processing the response.', 'error');
                            }
                        },
                    });

                });

                $('#admin_users tbody').on('click', '.delete-btn', function() {
                    var userId = $(this).data('id');
                    // Show a confirmation dialog (e.g., SweetAlert2)
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this user!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform the delete operation using AJAX to PHP
                            $.ajax({
                                url: '../controllers/commands.php',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    action: 'delete',
                                    id: userId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            title: 'Message',
                                            text: response.message,
                                            icon: 'success',
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 5000
                                        });
                                        table.ajax.reload();
                                    } else {
                                        // Display an error message
                                        Swal.fire('Error', response.message, 'error');
                                    }
                                },
                                error: function() {
                                    // Display a generic error message
                                    Swal.fire('Error', 'An error occurred while deleting the user.', 'error');
                                }
                            });
                        }
                    });
                });
            });
            $('#toggleAddPassword').click(function() {
                // Toggle the password visibility
                let passwordAddField = $('#addPassField');
                let iconAdd = $(this).find('i');

                if (passwordAddField.attr('type') === 'password') {
                    passwordAddField.attr('type', 'text');
                    iconAdd.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    passwordAddField.attr('type', 'password');
                    iconAdd.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
            $('#toggleEditPassword').click(function() {
                let passwordEditField = $('#editPassField');
                let iconEdit = $(this).find('i');

                if (passwordEditField.attr('type') === 'password') {
                    passwordEditField.attr('type', 'text');
                    iconEdit.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    passwordEditField.attr('type', 'password');
                    iconEdit.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        </script>
    </body>

    </html>
<?php endif; ?>