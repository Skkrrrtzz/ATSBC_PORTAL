<?php
require_once 'bc_nav.php';
include_once '../controllers/apv_commands.php';

if ($Role === "Optional Approver") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Optional Approver View</title>
        <link rel="stylesheet" href="../assets/css/loading.css">
    </head>

    <body class="bg-light">
        <!-- HTML content for the custom loading animation -->
        <div id="loading-spinner" style="display: none;">
            <div class="loader3">
                <div class="circle1"></div>
                <div class="circle1"></div>
                <div class="circle1"></div>
                <div class="circle1"></div>
                <div class="circle1"></div>
            </div>
        </div>

        <div class="container-fluid mt-1 mx-0">
            <h5 class="fw-bold ps-2 pt-1 border-bottom border-2 border-dark text-bg-primary rounded-top"> <i class="fas fa-file-signature"></i> For Approval</h5>
            <div class="row g-2 mb-2 justify-content-between">
                <div class="col-sm-2 col-md-3 col-lg-2">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="date" id="date" value="<?= $Date_Requested; ?>">
                        <label class="form-label fw-bold" for="date">Date Requested</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-3 col-lg-2">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="name" id="name" value="<?= $Requestor; ?>" readonly>
                        <label class="form-label fw-bold" for="name">Requestor</label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-sm-2 col-md-2">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="projects" id="projects" value="<?= $Project; ?>" readonly>
                        <label class="form-label fw-bold" for="projects">Project</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="SAP_No" id="SAP_No" value="<?= $SAP_PN; ?>" readonly>
                        <label class="form-label fw-bold" for="SAP_No">SAP Number</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-3 col-lg-2">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="Delta_PN" id="Delta_PN" value="<?= $Delta_PN; ?>" readonly>
                        <label class="form-label fw-bold" for="Delta_PN">Delta Part Number</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-6">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="desc" id="desc" value="<?= $Description; ?>" readonly>
                        <label class="form-label fw-bold" for="desc">Description</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-1">
                    <div class="form-outline">
                        <input type="number" class="form-control bg-white" name="QPA" id="QPA" value="<?= $QPA; ?>" readonly>
                        <label class="form-label fw-bold" for="QPA">QPA</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-1">
                    <div class="form-outline">
                        <input type="number" class="form-control bg-white" name="PR_Qty" id="PR_Qty" value="<?= $PR_Qty; ?>" readonly>
                        <label class="form-label fw-bold" for="PR_Qty">PR Qty</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2">
                    <div class="form-outline">
                        <input type="number" class="form-control bg-white" name="Purchase_Qty" id="Purchase_Qty" value="<?= $Purchase_Qty; ?>" readonly>
                        <label class="form-label fw-bold" for="Purchase_Qty">Purchase Qty</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-1">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="UOM" id="UOM" value="<?= $UoM; ?>" readonly>
                        <label class="form-label fw-bold" for="UOM">UOM</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <div class="form-outline">
                        <input type="number" class="form-control bg-white" name="Prev_price" id="Prev_price" value="<?= $Prev_Price; ?>" readonly>
                        <label class="form-label fw-bold" for="Prev_price">Previous Price</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-1">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="Currency" id="Currency" value="<?= $Currency; ?>" readonly>
                        <label class="form-label fw-bold" for="Currency">Currency</label>
                    </div>
                </div>
                <div class="col-sm-2 col-md-3 col-lg-2">
                    <div class="form-outline">
                        <input type="text" class="form-control bg-white" name="PPV_Type" id="PPV_Type" value="<?= $PPV_Type; ?>" readonly>
                        <label class="form-label fw-bold" for="PPV_Type">PPV Type</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-outline" id="other_ppv_type">
                        <input type="text" class="form-control bg-white" name="other_ppv_type" value="<?= $other_ppv_type; ?>" readonly>
                        <label class="form-label" for="other_ppv_type">Please specify</label>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm rounded mb-2">
                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top">Vendor 1</h5>
                    <div class="row g-2">
                        <div class="col-sm-2 col-md-6 col-lg-5">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-white" name="Current_Vendor" id="Current_Vendor" value="<?= $Current_Vendor; ?>" readonly>
                                <label class="form-label fw-bold" for="Current_Vendor">Current Vendor</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6 col-lg-4">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="Current_Vendor_Price" id="Current_Vendor_Price" value="<?= $New_Price_1; ?>" readonly>
                                <label class="form-label fw-bold" for="Current_Vendor_Price">Current Vendor Price</label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-white" name="Currency_1" id="Currency_1" value="<?= $Currency_1; ?>" readonly>
                                <label class="form-label fw-bold" for="Currency_1">Currency</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="LT_1" id="LT_1" value="<?= $LT_1; ?>" readonly>
                                <label class="form-label fw-bold" for="LT_1">LT</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="SPQ_1" id="SPQ_1" value="<?= $SPQ_1; ?>" readonly>
                                <label class="form-label fw-bold" for="SPQ_1">SPQ</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="MOQ_1" id="MOQ_1" value="<?= $MOQ_1; ?>" readonly>
                                <label class="form-label fw-bold" for="MOQ_1">MOQ</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-8 col-lg-4">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="Qty_to_Purchase_from_Vendor_1" id="Qty_to_Purchase_from_Vendor_1" value="<?= $Qty2PurchasetoVendor_1; ?>" readonly>
                                <label class="form-label fw-bold" for="Qty_to_Purchase_from_Vendor_1">Qty to Purchase from Vendor</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-2">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="Total_Amt_1" id="Total_Amt_1" value="<?= $Total_Amt_1; ?>" readonly>
                                <label class="form-label fw-bold" for="Total_Amt_1">Total Amt</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm rounded mb-2">
                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top">Vendor 2</h5>
                    <?php if (!empty($New_Vendor)) { ?>
                        <div class="row g-2">
                            <div class="col-sm col-md-6 col-lg-5">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-white" name="New_Vendor" id="New_Vendor" value="<?= $New_Vendor; ?>" readonly>
                                    <label class="form-label fw-bold" for="New_Vendor">New Vendor</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-4">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="New_Vendor_Price" id="New_Vendor_Price" value="<?= $New_Price_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="New_Vendor_Price">New Vendor Price</label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-white" name="Currency_2" id="Currency_2" value="<?= $Currency_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="Currency_2">Currency</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 col-lg-2">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="LT_2" id="LT_2" value="<?= $LT_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="LT_2">LT</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 col-lg-2">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="SPQ_2" id="SPQ_2" value="<?= $SPQ_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="SPQ_2">SPQ</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 col-lg-2">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="MOQ_2" id="MOQ_2" value="<?= $MOQ_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="MOQ_2">MOQ</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-8 col-lg-4">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="Qty_to_Purchase_from_Vendor_2" id="Qty_to_Purchase_from_Vendor_2" value="<?= $Qty2PurchasetoVendor_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="Qty_to_Purchase_from_Vendor_2">Qty to Purchase from Vendor</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="Total_Amt_2" id="Total_Amt_2" value="<?= $Total_Amt_2; ?>" readonly>
                                    <label class="form-label fw-bold" for="Total_Amt_2">Total Amt</label>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12 col-md-12 col-lg-12 form-floating"">
                            <input type=" text" class="form-control" id="Reason" autocomplete="FALSE" value="<?= $Reason; ?>" readonly>
                            <label class="form-label fw-bold text-black" for="Reason">Reason</label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row g-2 justify-content-between">
                <div class="col-sm col-md-6 col-lg-6 ">
                    <div class="form-outline mb-2">
                        <input type="text" class="form-control bg-white" name="Purchasing_Recom" id="Purchasing_Recom" value="<?= $Purchasing_Recom; ?>" readonly>
                        <label class="form-label fw-bold" for="Purchasing_Recom">Purchasing Recommendation</label>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm col-md-12 col-lg-6">
                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Business Control Analysis</h5>
                    <div class="row g-2">
                        <div class="col-sm-4 col-md-6 col-lg-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bold">QBOM Unit Price: </span>
                                <input type="number" class="form-control" name="QBOM_Unit_Price" id="QBOM_Unit_Price" value="<?= $QBOM_Unit_Price; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6 col-lg-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bold">Total QBOM Price: </span>
                                <input type="number" class="form-control" name="Total_QBOM_Price" id="Total_QBOM_Price" value="<?= $Total_QBOM_Price; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-sm col-md-4 col-lg-4">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-white" name="Conversion_Rate_Vendor_1" id="Conversion_Rate_Vendor_1" value="<?= $Conversion_Rate_V1; ?>" readonly>
                                <label class="form-label fw-bold" for="Conversion_Rate_Vendor_1">Conversion Rate Vendor 1</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-white" name="Vendor_1_Converted_Price" id="Vendor_1_Converted_Price" value="<?= $V1_Converted_Price; ?>" readonly>
                                <label class="form-label fw-bold" for="Vendor_1_Converted_Price">Vendor 1 Converted Price</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-white" name="Vendor_1_Variance_VS_QBOM" id="Vendor_1_Variance_VS_QBOM" value="<?= $V1_VarianceVSQBOM; ?>" readonly>
                                <label class="form-label fw-bold" for="Vendor_1_Variance_VS_QBOM">Vendor 1 Variance VS QBOM</label>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($New_Vendor)) { ?>
                        <div class="row g-2 mb-2">
                            <div class="col-sm col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="Conversion_Rate_Vendor_2" id="Conversion_Rate_Vendor_2" value="<?= $Conversion_Rate_V2; ?>" readonly>
                                    <label class="form-label fw-bold" for="Conversion_Rate_Vendor_2">Conversion Rate Vendor 2</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-white" name="Vendor_2_Converted_Price" id="Vendor_2_Converted_Price" value="<?= $V2_Converted_Price; ?>" readonly>
                                    <label class="form-label fw-bold" for="Vendor_2_Converted_Price">Vendor 2 Converted Price</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-white" name="Vendor_2_Variance_VS_QBOM" id="Vendor_2_Variance_VS_QBOM" value="<?= $V2_VarianceVSQBOM; ?>" readonly>
                                    <label class="form-label fw-bold" for="Vendor_2_Variance_VS_QBOM">Vendor 2 Variance VS QBOM</label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm col-md col-lg-6">
                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Action to do</h5>
                    <div class="row g-2 ms-1 mb-2">
                        <div class="col-sm-2 col-md-5 form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $Chargable2Customer; ?>" name="Chargable_to_Customer" id="Chargable_to_Customer" <?= ($Chargable2Customer == 'true') ? 'checked' : ''; ?> disabled>
                            <label class="fw-bold form-check-label" for="Chargable_to_Customer"> Chargable to Customer? </label>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div class="form-outline" id="Variance_Chargable_to_Cohu">
                                <input type="number" class="form-control" name="Variance_Chargable_to_Cohu" value="<?= $VarianceChargable2Cohu; ?>" disabled>
                                <label class="form-label fw-bold" for="Variance_Chargable_to_Cohu">Variance Chargable to Cohu</label>
                            </div>
                        </div>
                    </div>
                    <form id="optApvForm">
                        <div class="row g-2 ms-1 mb-2">
                            <div class="col-sm-2 col-md-5 form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $For_Checking_of_CCP_analyst ?>" name="For_Checking_of_CCP_analyst" id="For_Checking_of_CCP_analyst" <?= ($For_Checking_of_CCP_analyst == 'true') ? 'checked' : ''; ?> disabled>
                                <label class="fw-bold form-check-label" for="For_Checking_of_CCP_analyst"> For Checking of CCP Analyst </label>
                            </div>
                            <input type="hidden" name="No" id="No" value="<?= $No; ?>" readonly>
                            <input type="hidden" name="checker_name" id="checker_name" value="<?= $Name; ?>" readonly>
                            <input type="hidden" name="checked_date" id="checked_date" value="<?= $ccp_checked_date; ?>" readonly>
                            <input type="hidden" name="checker_email" value="<?= $Email ?>" readonly>
                            <div class="col-sm-4 col-md-7 form-floating" id="Remarks_from_CCP_analyst"">
                            <div class=" form-outline">
                                <textarea class="form-control" name="Remarks_from_CCP_analyst" rows="2" required <?= $Remarks_from_CCP_analyst ? 'readonly' : '' ?>><?= $Remarks_from_CCP_analyst; ?></textarea>
                                <label class="form-label fw-bold" for="Remarks_from_CCP_analyst">Remarks of CCP Analyst</label>
                            </div>
                        </div>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <?php
                    if (empty($check_date) && is_null($check_date) && empty($CCP_Name) && is_null($CCP_Name)) {
                        echo '<button type="submit" class="btn btn-primary fw-bold">SUBMIT <i class="fa-solid fa-paper-plane"></i></button>';
                    }
                    ?>
                </div>
            </div>
            </form>
        </div>
        <script>
            $(document).ready(function() {
                // Initially hide the "other_ppv_type" input field
                $("#other_ppv_type").hide();
                let PPV_type = $("#PPV_Type").val();

                if (PPV_type === "OTHERS") {
                    // Show the "other_ppv_type" input field
                    $("#other_ppv_type").show();
                } else {
                    // Hide the "other_ppv_type" input field if any other option is selected
                    $("#other_ppv_type").hide();
                }
                $("#optApvForm").submit(function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    // Show a SweetAlert confirmation dialog
                    Swal.fire({
                        title: "Confirm Submission",
                        text: "Are you sure you want to send this to next approver?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Proceed",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed, proceed with form submission
                            var formData = new FormData(this);
                            formData.append("remarks", "1");
                            $.ajax({
                                type: "POST",
                                url: "../controllers/apv_commands.php",
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: "json",
                                success: function(response) {
                                    // Close the SweetAlert modal

                                    if (response.success) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Successfully Sent!",
                                            text: "Form has been sent to next Approver!",
                                        }).then(function() {
                                            // Redirect after the user clicks OK
                                            window.location.href = response.redirect;
                                        });
                                    } else {
                                        // Show a SweetAlert error message
                                        Swal.fire({
                                            icon: "error",
                                            title: "Error",
                                            text: response.message,
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("AJAX request failed with status: " + status);
                                    // Close the SweetAlert modal

                                },
                            });
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
<?php } else {
    exit();
} ?>