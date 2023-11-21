<?php require_once 'bc_nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload QBOMS</title>
</head>

<body class="bg-light">
    <div class="container my-2">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Uploading QBOMS</h4>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="card-subtitle mb-2"><i class="fa-solid fa-circle-exclamation fa-lg text-danger"></i> Select product first before uploading the QBOM Excel file for that specific Product.</div>
                        <div id="loadingSpinner" class="d-none text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p id="uploadingText">Uploading file for <span id="selectedProductText"></span>...</p>
                        </div>
                        <form method="post" enctype="multipart/form-data" id="fileInput">
                            <div class="form-floating mb-2">
                                <select class="form-select" id="selectProduct" name="product" required>
                                    <option value="">Select product</option>
                                    <option value="PNP">PNP</option>
                                    <option value="PNP CABLE">PNP CABLE</option>
                                    <option value="JLP">JLP</option>
                                    <option value="JLP CABLE">JLP CABLE</option>
                                    <option value="JTP">JTP</option>
                                    <option value="MTP">MTP</option>
                                    <option value="OLB">OLB</option>
                                    <option value="FLIPPER">FLIPPER</option>
                                    <option value="HIGHMAG">HIGHMAG</option>
                                    <option value="IONIZER">IONIZER</option>
                                    <option value="RCMTP">RCMTP</option>
                                </select>
                                <label for="selectProduct">Product</label>
                            </div>
                            <div class="mb-2" id="fileInputContainer" style="display: none;">
                                <input type="file" class="form-control" name="file" accept=".xlsx, .xls" id="inputFile">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary fw-bold" id="uploadButton"><i class="fa-solid fa-arrow-up-from-bracket"></i> Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Cache the loading spinner, file input, its container, and the product text element
            var loadingSpinner = $("#loadingSpinner");
            var uploadingText = $("#uploadingText"); // Cache the "Uploading file..." text element
            var selectedProductText = $("#selectedProductText"); // Cache the product text element
            var fileInput = $("#inputFile");

            var fileInputContainer = $("#fileInputContainer");

            $("form").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Disable the upload button to prevent multiple submissions
                $("#uploadButton").prop("disabled", true);

                // Check if the selected product is empty
                var selectedProduct = $("#selectProduct").val();
                if (!selectedProduct) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a product.'
                    });
                    // Enable the upload button and return
                    $("#uploadButton").prop("disabled", false);
                    return;
                }
                selectedProductText.text(selectedProduct);
                // Check if the file input is empty
                if (!fileInput.val()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a file to upload.'
                    });
                    // Enable the upload button and return
                    $("#uploadButton").prop("disabled", false);
                    return;
                }
                uploadingText.show();
                var fullPath = fileInput.val();
                var fileName = fullPath.split('\\').pop();
                var formattedText = '<div class="text-center">Are you sure you want to upload this file: <span class="text-danger fw-bold">' + fileName + '</span> to <span class="fw-bold">' + selectedProduct + '</span> Database? , once uploaded it will be changed!</div>';
                // Show a confirmation dialog before uploading
                Swal.fire({
                    icon: 'question',
                    title: 'Confirm Upload',
                    html: formattedText,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'No, cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show the loading spinner
                        $("#fileInput").css("display", "none");
                        $("#loadingSpinner").removeClass("d-none");
                        // Create a FormData object to send the form data via AJAX
                        var formData = new FormData(this);

                        $.ajax({
                            type: "POST",
                            url: "../controllers/upload.php",
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(response) {
                                // Hide the loading spinner
                                $("#fileInput").css("display", "block");
                                $("#loadingSpinner").addClass("d-none");
                                uploadingText.hide();
                                if (response.status === "success") {
                                    // Display a SweetAlert2 success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        timer: 3000, // Auto-close after 3 seconds
                                        showConfirmButton: false
                                    });

                                    // Reset the file input field
                                    fileInput.val(''); // Clear the file input value
                                    $("#selectProduct").val(''); // Clear the selection value
                                    fileInputContainer.hide();
                                } else if (response.status === "error") {
                                    // Display a SweetAlert2 error message
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Upload the correct excel file for the selected Product!'
                                    });
                                } // Enable the upload button
                                $("#uploadButton").prop("disabled", false);
                            },
                            error: function() {
                                $("#fileInput").css("display", "block");
                                $("#loadingSpinner").addClass("d-none");
                                uploadingText.hide();
                                // Handle AJAX error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while uploading the file. Please Contact the admin!'
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

            // Show/hide the file input based on the selected product
            $("#selectProduct").change(function() {
                var selectedProduct = $(this).val();

                if (selectedProduct) {
                    fileInputContainer.show();
                } else {
                    fileInputContainer.hide();
                }
            });
        });
    </script>
</body>

</html>