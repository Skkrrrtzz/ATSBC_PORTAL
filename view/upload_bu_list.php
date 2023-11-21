<?php require_once 'bc_nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload BU List</title>
    <style>
        .dataTables_wrapper .dataTables_filter {
            margin-top: .5rem;
            margin-right: .5rem;
        }

        .dataTables_wrapper .dataTables_length {
            margin-top: .5rem;
            margin-right: .5rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container my-3">
        <!-- Form for uploading Excel file -->
        <form id="excelUploadForm" enctype="multipart/form-data">
            <div class="form-group" id="fileInputGroup">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="upload_bu_file" name="upload_bu_file" accept=".xlsx, .xls, .csv">
                    <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-color="dark" name="upload_bu_file" form="excelUploadForm" id="uploadButton">Upload</button>
                </div>
            </div>
        </form>
        <!-- Loading spinner -->
        <div id="loadingSpinner" class="d-none text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Uploading...</span>
            </div>
            <p>Uploading file...</p>
        </div>
        <div class="table-responsive ">
            <table class="table table-striped table-bordered table-hover table-sm rounded text-nowrap" width="100%" id="bu_table">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Item No</th>
                        <th>Item Description</th>
                        <th>Foreign Name</th>
                        <th>Cost Center</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#bu_table').DataTable({
                ajax: {
                    url: '../controllers/get_bu_data.php',
                    method: 'GET',
                    dataSrc: ''
                },
                dom: '<"row"<"col-sm-8"Bl><"col-sm-4"f>>t<"row"<"col-sm-6"i><"col-sm-6"p>>',
                buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copy',
                }, {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                }, {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                }, {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    orientation: 'portrait',
                    pageSize: 'LEGAL',
                }, ],
                deferRender: true,
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: 'No'
                    },
                    {
                        data: 'Item_No'
                    },
                    {
                        data: 'Item_Description'
                    },
                    {
                        data: 'Foreign_Name',
                    },
                    {
                        data: 'Cost_Center'
                    }
                ]
            });
            // Upload Excel file
            $("#excelUploadForm").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission
                // Disable the upload button
                $("#uploadButton").prop("disabled", true);

                // Check if a file has been selected
                var fileInput = document.getElementById("upload_bu_file");
                if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                    // Show an error message for no file selected
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a file to upload.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000 // 3 seconds
                    });

                    // Enable the upload button
                    $("#uploadButton").prop("disabled", false);

                    return; // Exit the function
                }

                // Show a confirmation dialog before uploading
                Swal.fire({
                    icon: 'question',
                    title: 'Confirm Upload',
                    text: 'Are you sure you want to upload this file?, you cannot revert this',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, upload it!',
                    cancelButtonText: 'No, cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, proceed with the upload

                        // Hide the file input and show the loading spinner
                        $("#fileInputGroup").css("display", "none");
                        $("#loadingSpinner").removeClass("d-none");

                        var formData = new FormData(this);

                        $.ajax({
                            url: "../controllers/upload.php",
                            type: "POST",
                            data: formData,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                // Hide the loading spinner and show the file input again
                                $("#loadingSpinner").addClass("d-none");
                                $("#fileInputGroup").css("display", "block");

                                if (response.success === true) {
                                    // File upload was successful, show a success toast
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000 // 3 seconds
                                    });
                                    // Clear the file input field
                                    $("#upload_bu_file").val("");
                                    table.ajax.reload();
                                } else {
                                    // File upload failed, show an error toast
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'This is not the correct excel file for this BU List',
                                        text: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000 // 3 seconds
                                    });
                                }

                                // Enable the upload button
                                $("#uploadButton").prop("disabled", false);
                            },
                            error: function(xhr, status, error) {
                                // Hide the loading spinner and show the file input again
                                $("#loadingSpinner").addClass("d-none");
                                $("#fileInputGroup").css("display", "block");
                                // File upload failed, show an error toast
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Cannot read the excel file!',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                });
                                // Enable the upload button
                                $("#uploadButton").prop("disabled", false);
                            }
                        });
                    } else {
                        // User canceled, enable the upload button
                        $("#uploadButton").prop("disabled", false);
                    }
                });
            });

        });
    </script>
</body>

</html>