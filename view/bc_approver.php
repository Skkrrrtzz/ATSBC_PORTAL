<?php
require_once 'bc_nav.php';
include_once '../controllers/apv_commands.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approver View</title>
    <link rel="stylesheet" href="../assets/css/loading.css">
</head>
<?php if ($Role === "Approver 1") { ?>

    <body class="bg-light">
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
            <form id="bcaForm">
                <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Business Control Analysis</h5>
                <input type="hidden" name="No" id="No" value="<?= $No; ?>" readonly>
                <div class="row mb-2">
                    <div class="col-sm col-md-12 col-lg-6">
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
                                    <input type="number" class="form-control bg-white" name="Conversion_Rate_Vendor_1" id="Conversion_Rate_Vendor_1" value="<?= $Conversion_Rate_V1; ?>" <?php echo !empty($Conversion_Rate_V1) ? 'readonly' : ''; ?> required>
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
                        <div class="row g-2 mb-2">
                            <div class="col-sm col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-white" name="Conversion_Rate_Vendor_2" id="Conversion_Rate_Vendor_2" value="<?= $Conversion_Rate_V2; ?>" <?php echo !empty($Conversion_Rate_V2) ? 'readonly' : ''; ?> required>
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
                    </div>
                    <div class="col-sm col-md col-lg-6">
                        <!--  -->
                        <div class="row g-2 ms-1 mb-2">
                            <div class="col-sm-4 col-md-4 col-lg-4 form-check">
                                <input class="form-check-input" type="checkbox" name="Chargable_to_Customer" id="Chargable_to_Customer">
                                <label class="fw-bold form-check-label" for="Chargable_to_Customer"> Chargeable to Customer? </label>
                            </div>
                            <div class="col-sm-4 col-md-3 col-lg-4 form-floating" id="Variance_Chargable_to_Cohu" style="display: none;">
                                <input type="number" class="form-control" name="VC2Cohu" id="VC2Cohu" value="<?= $VarianceChargable2Cohu; ?>">
                                <label class="fw-bold text-dark" for="VC2Cohu">Variance Chargeable to Cohu</label>
                            </div>
                        </div>
                        <div class="row g-2 ms-1">
                            <div class="col-sm-4 col-md-8 col-lg-4 form-check">
                                <input class="form-check-input" type="checkbox" name="For_Checking_of_CCP_analyst" id="For_Checking_of_CCP_analyst" readonly>
                                <label class="fw-bold form-check-label" for="For_Checking_of_CCP_analyst"> For Checking of CCP Analyst </label>
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-6 form-floating" id="Remarks_from_CCP_analyst" style="display: none;">
                                <textarea class="form-control" name="Remarks_from_CCP_analyst" readonly><?= $Remarks_from_CCP_analyst; ?></textarea>
                                <label class="form-label fw-bold text-dark" for="Remarks_from_CCP_analyst">Remarks of CCP Analyst</label>
                            </div>
                            <div id="sendCCP">
                                <button type="submit" class="btn btn-primary fw-bold">SEND TO CCP Analyst</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form id="apvForm">
                <div id="approvalSection">
                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Approval</h5>
                    <input type="hidden" name="Approver" id="Approver" value="<?= $Approver; ?>" readonly>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="row g-2 mb-2">
                                <? echo $BC_Recomm; ?>
                                <div class="col-sm-4 col-md-8 col-lg-8 form-floating">
                                    <select class="form-select" name="Business_Control_Recommendation" id="Business_Control_Recommendation" required>
                                        <option value="<?= $BC_Recomm; ?>" data-variance=""> <!-- Add data-variance attribute -->
                                            <?php echo empty($BC_Recomm) ? 'Select Vendor' : $BC_Recomm; ?>
                                        </option>
                                        <?php if (!empty($Current_Vendor)) : ?>
                                            <option value="<?= $Current_Vendor; ?>" data-variance="">
                                                <?= $Current_Vendor; ?>
                                            </option>
                                        <?php endif; ?>
                                        <?php if (!empty($New_Vendor)) : ?>
                                            <option value="<?= $New_Vendor; ?>" data-variance="">
                                                <?= $New_Vendor; ?>
                                            </option>
                                        <?php endif; ?>
                                    </select>
                                    <label class="form-label fw-bold text-black" for="Business_Control_Recommendation">Business Control Recommendation</label>
                                </div>
                                <div class="col-sm-2 col-md-4 col-lg-4 form-floating">
                                    <input type="text" class="form-control" name="Variance_VS_QBOM_Price" id="Variance_VS_QBOM_Price" value="<?= $Variance_VS_QBOM_Price; ?>" readonly>
                                    <label class="fw-bold text-black" for="Variance_VS_QBOM_Price">Variance VS QBOM Price</label>
                                </div>
                                <?php if (!empty($CCP_Name)) : ?>
                                    <div class="col-sm-2 col-md-3">
                                        <h6 class="fw-bold">Checked by</h6>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm mb-1" type="text" name="checker_name" id="checker_name" value="<?= $CCP_Name; ?>" readonly>
                                            <input class="form-control form-control-sm" type="text" name="checked_date" id="checked_date" value="<?= $check_date; ?>" readonly>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-2 col-md-3">
                                    <h6 class="fw-bold" id="Approved">Approved</h6>
                                    <?php if ($Role === 'Approver 1') { ?>
                                        <div class="col-sm col-md-12 form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                            <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvCheck1 === 'true' ? $ApvName1 : '' ?>" readonly>
                                        </div>
                                    <?php } elseif ($Role === 'Approver 2') { ?>
                                        <div class="col-sm col-md-12 form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                            <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                        </div>
                                        <div class="col-sm col-md-12 form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="approved_check2" name="approved_check2" <?= $ApvCheck2 === 'true' ? 'checked disabled' : '' ?>>
                                            <input class="form-control form-control-sm" type="text" name="approved_by_2" id="approved_by_2" value="<?= $ApvName2; ?>" readonly>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm col-md-12 form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                            <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                        </div>
                                        <div class="col-sm col-md-12 form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="approved_check2" name="approved_check2" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                            <input class="form-control form-control-sm" type="text" name="approved_by_2" id="approved_by_2" value="<?= $ApvName2; ?>" readonly>
                                        </div>
                                        <div class="col-sm col-md-12 form-check mb-1">
                                            <input class="form-check-input" type="checkbox" id="approved_check3" name="approved_check3">
                                            <input class="form-control form-control-sm" type="text" name="approved_by_3" id="approved_by_3" readonly>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <h6 class="fw-bold" id="Disapproved">Disapproved</h6>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" value="" name="disapproved_check" id="disapproved">
                                        <input class="form-control form-control-sm" type="text" name="disapproved_by" id="disapproved_by" value="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <h6 class="fw-bold">Date</h6>
                                    <?php if ($Role === 'Approver 1') { ?>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                        </div>
                                    <?php } elseif ($Role === 'Approver 2') { ?>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                        </div>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm" type="text" name="date_2" id="date_2" value="<?= $ApvDate2; ?>" readonly>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                        </div>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm" type="text" name="date_2" id="date_2" value="<?= $ApvDate2; ?>" readonly>
                                        </div>
                                        <div class="col-sm col-md-12 mb-1">
                                            <input class="form-control form-control-sm" type="text" name="date_3" id="date_3" value="<?= $ApvDate3; ?>" readonly>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="row g-2 mb-2">
                                <div class="col-sm-4 col-md-12 col-lg-12">
                                    <div class="form-outline">
                                        <textarea class="form-control" id="Remarks" name="Remarks" rows="3" value="" required></textarea>
                                        <label class="form-label fw-bold text-dark" for="Remarks">Remarks</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-evenly">
                                    <button type="submit" class="btn btn-primary fw-bold">SUBMIT <i class="fa-solid fa-paper-plane"></i></button>
                                    <!-- <button type="submit" class="btn btn-primary fw-bold">Send Email <i class="fas fa-envelope-circle-check"></i></button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script>
            $(document).ready(function() {
                // CHECKING OF CHECKBOX FOR CCP ANALYST AND CHARGE TO CUSTOMER
                let CCP_Analyst = "<?= $For_Checking_of_CCP_analyst; ?>";
                let remarksCCP = $("#Remarks_from_CCP_analyst");
                let checkBoxCCP = $("#For_Checking_of_CCP_analyst");
                let approvalForm = $("#approvalSection");
                let sendCCP = $("#sendCCP");
                let C2C = "<?= $Chargable2Customer; ?>";
                let checkBoxC2C = $("#Chargable_to_Customer");
                let varianceField = $("#Variance_Chargable_to_Cohu");
                let VC2Cohu = $("#VC2Cohu");

                if (CCP_Analyst === 'true') {
                    checkBoxCCP.prop('checked', true).prop('disabled', true);
                    remarksCCP.show();
                    sendCCP.hide();
                } else if (CCP_Analyst === '' || CCP_Analyst === null) {
                    checkBoxCCP.prop('disabled', false);
                    remarksCCP.hide();
                    sendCCP.hide();
                } else {
                    checkBoxCCP.prop('checked', false).prop('disabled', true);
                    remarksCCP.hide();
                }

                if (C2C === 'true') {
                    checkBoxC2C.prop('checked', true).prop('disabled', true);
                    varianceField.show();
                    VC2Cohu.prop('readonly', true);
                } else if (C2C === '' || C2C === null) {
                    checkBoxC2C.prop('disabled', false);
                    varianceField.hide();
                } else {
                    checkBoxC2C.prop('checked', false).prop('disabled', true);
                    varianceField.hide();
                }
                // Add an event handler to the checkbox
                checkBoxCCP.on('change', function() {
                    if (checkBoxCCP.is(':checked')) {
                        sendCCP.show();
                        approvalForm.hide();
                    } else {
                        sendCCP.hide();
                        approvalForm.show();
                    }
                });

                checkBoxC2C.on('change', function() {
                    if (checkBoxC2C.is(':checked')) {
                        varianceField.show();
                    } else {
                        varianceField.hide();
                    }
                });

                function handleCheckboxChange(checkboxId, nameFieldId, dateFieldId, otherCheckboxId, otherNameFieldId, divFieldId) {
                    return function() {
                        var nameField = $(nameFieldId);
                        var dateField = $(dateFieldId);
                        var otherCheckbox = $(otherCheckboxId);
                        var otherNameField = $(otherNameFieldId);
                        var divField = $(divFieldId);

                        if (this.checked) {
                            var name = "<?= $Name ?>";
                            console.log(this.checked);
                            nameField.val(name);

                            // Get the current date and time
                            var currentDateTime = new Date();

                            // Format the date and time as a string
                            var dateTimeString = currentDateTime.toLocaleString();

                            dateField.val(dateTimeString);

                            // Hide the other checkbox and name field
                            otherCheckbox.prop('checked', false);
                            otherCheckbox.hide();
                            otherNameField.hide();
                            divField.hide();
                        } else {
                            nameField.val('');
                            dateField.val('');

                            // Show the other checkbox and name field
                            otherCheckbox.show();
                            otherNameField.show();
                            divField.show();
                        }
                    };
                }

                $('#approved_check1').change(handleCheckboxChange('#approved_check1', '#approved_by_1', '#date_1', '#disapproved', '#disapproved_by', '#Disapproved'));
                $('#disapproved').change(handleCheckboxChange('#disapproved', '#disapproved_by', '#date_1', '#approved_check1', '#approved_by_1', '#Approved'));

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
                let Delta_PN = $('#Delta_PN').val();
                let projects = $('#projects').val();
                // Make an AJAX request to your server-side script
                $.ajax({
                    url: "../controllers/get_qbom_datas.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        Delta_PN: Delta_PN,
                        projects: projects
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "question",
                                title: response.table,
                                toast: true,
                                timerProgressBar: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            $("#QBOM_Unit_Price").val(response.message);

                            let QBOM_Unit_Price = parseFloat(response.message);

                            // get the purchase qty
                            let Purchase_Qty = parseFloat($("#Purchase_Qty").val()) || 0;

                            // Calculate the total amount
                            var Total_QBOM_Price = Purchase_Qty * QBOM_Unit_Price;

                            // Update the Total_QBOM_Price field
                            $("#Total_QBOM_Price").val(Total_QBOM_Price.toFixed(2));
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning",
                                text: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            // Remove the readonly attribute
                            $("#QBOM_Unit_Price").prop("readonly", false);
                            // Attach an event listener to the #QBOM_Unit_Price input
                            $("#QBOM_Unit_Price").on("input", function() {

                                // Get the QBOM_Unit_Price value
                                var QBOM_Unit_Price = parseFloat($(this).val()) || 0;

                                // Get the purchase qty
                                var Purchase_Qty = parseFloat($("#Purchase_Qty").val()) || 0;

                                // Calculate the total amount
                                var Total_QBOM_Price = Purchase_Qty * QBOM_Unit_Price;

                                // Update the Total_QBOM_Price field
                                $("#Total_QBOM_Price").val(Total_QBOM_Price.toFixed(2));
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(error);
                    },
                });


                handleConversionRateChange(
                    '#Conversion_Rate_Vendor_1',
                    '#Current_Vendor_Price',
                    '#Vendor_1_Converted_Price',
                    '#Vendor_1_Variance_VS_QBOM',
                    '#Qty_to_Purchase_from_Vendor_1'
                );

                handleConversionRateChange(
                    '#Conversion_Rate_Vendor_2',
                    '#New_Vendor_Price',
                    '#Vendor_2_Converted_Price',
                    '#Vendor_2_Variance_VS_QBOM',
                    '#Qty_to_Purchase_from_Vendor_2'
                );
                // Conversion Rate Input
                function handleConversionRateChange(conversionRateInput, priceInput, convertedPriceInput, varianceInput, qtyInput) {
                    $(conversionRateInput).on('input', function() {
                        let price = parseFloat($(priceInput).val()) || 0;
                        var conversionRate = parseFloat($(this).val()) || 0;

                        if (conversionRate !== 0) {
                            var convertedPrice = price / conversionRate;
                            $(convertedPriceInput).val(convertedPrice.toFixed(2));

                            // Calculate variance
                            let totalQBOMPrice = parseFloat($("#Total_QBOM_Price").val()) || 0;
                            let qty = parseFloat($(qtyInput).val()) || 0;
                            var variance = ((convertedPrice * qty) - totalQBOMPrice);
                            $(varianceInput).val(variance.toFixed(2));
                        } else {
                            $(convertedPriceInput).val('0');
                            $(varianceInput).val('0');
                        }
                    });

                }
                // Add a change event listener to the select element
                $("#Business_Control_Recommendation").on('change', function() {
                    var selectedOption = $(this).find("option:selected");
                    var currentVendor = $('#Current_Vendor').val();
                    var varianceInput = (selectedOption.val() === currentVendor) ? '#Vendor_1_Variance_VS_QBOM' : '#Vendor_2_Variance_VS_QBOM';
                    var varianceValue = $(varianceInput).val();
                    selectedOption.data('variance', varianceValue);
                    $("#Variance_VS_QBOM_Price").val(varianceValue);

                });

                $('#bcaForm').submit(function(e) {
                    e.preventDefault();

                    let No = $('#No').val();
                    let QBOM_Unit_Price = $('#QBOM_Unit_Price').val();
                    let Total_QBOM_Price = $('#Total_QBOM_Price').val();
                    let Conversion_Rate_Vendor_1 = $('#Conversion_Rate_Vendor_1').val();
                    let Vendor_1_Converted_Price = $('#Vendor_1_Converted_Price').val();
                    let Vendor_1_Variance_VS_QBOM = $('#Vendor_1_Variance_VS_QBOM').val();
                    let Conversion_Rate_Vendor_2 = $('#Conversion_Rate_Vendor_2').val();
                    let Vendor_2_Converted_Price = $('#Vendor_2_Converted_Price').val();
                    let Vendor_2_Variance_VS_QBOM = $('#Vendor_2_Variance_VS_QBOM').val();
                    let Chargable_to_Customer = $('#Chargable_to_Customer').is(':checked');
                    let Variance_Chargable_to_Cohu = $('#VC2Cohu').val();
                    let For_Checking_of_CCP_analyst = $('#For_Checking_of_CCP_analyst').is(':checked');
                    let Remarks_from_CCP_analyst = $('#Remarks_from_CCP_analyst').val();
                    Swal.fire({
                        title: 'Sending...',
                        html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });
                    $.ajax({
                        type: "POST",
                        url: "../controllers/apv_commands.php",
                        data: {
                            No: No,
                            QBOM_Unit_Price: QBOM_Unit_Price,
                            Total_QBOM_Price: Total_QBOM_Price,
                            Conversion_Rate_Vendor_1: Conversion_Rate_Vendor_1,
                            Vendor_1_Converted_Price: Vendor_1_Converted_Price,
                            Vendor_1_Variance_VS_QBOM: Vendor_1_Variance_VS_QBOM,
                            Conversion_Rate_Vendor_2: Conversion_Rate_Vendor_2,
                            Vendor_2_Converted_Price: Vendor_2_Converted_Price,
                            Vendor_2_Variance_VS_QBOM: Vendor_2_Variance_VS_QBOM,
                            Chargable_to_Customer: Chargable_to_Customer,
                            Variance_Chargable_to_Cohu: Variance_Chargable_to_Cohu,
                            For_Checking_of_CCP_analyst: For_Checking_of_CCP_analyst,
                            Remarks_from_CCP_analyst: Remarks_from_CCP_analyst,
                            bcaForm: true
                        },
                        dataType: "json",
                        success: function(response) {
                            Swal.close();
                            if (response.success) {
                                let ccpAnalystCheckbox = $("#For_Checking_of_CCP_analyst");
                                if (ccpAnalystCheckbox.is(":checked")) {
                                    // Show a SweetAlert confirmation dialog
                                    Swal.fire({
                                        icon: "success",
                                        title: "Successfully Sent!",
                                        text: response.message,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        window.location.href = "bc_dashboard.php";
                                    });
                                }
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
                            Swal.close();
                        },
                    });
                })
                $("#apvForm").submit(function(e) {
                    e.preventDefault();
                    var varQbomPrice = parseFloat($('#Variance_VS_QBOM_Price').val());
                    var approver;

                    if (varQbomPrice >= 0 && varQbomPrice <= 500) {
                        approver = 'Approver 1';
                    } else if (varQbomPrice > 500 && varQbomPrice <= 3000) {
                        approver = 'Approver 2';
                    } else if (varQbomPrice < 0) {
                        approver = 'Approver 1';
                    } else {
                        approver = 'Approver 3';
                    }

                    $('#Approver').val(approver);
                    console.log(approver, varQbomPrice);
                    // Prevent the default form submission
                    let No = $('#No').val();
                    let Approver = $('#Approver').val();
                    let QBOM_Unit_Price = $('#QBOM_Unit_Price').val();
                    let Total_QBOM_Price = $('#Total_QBOM_Price').val();
                    let Conversion_Rate_Vendor_1 = $('#Conversion_Rate_Vendor_1').val();
                    let Vendor_1_Converted_Price = $('#Vendor_1_Converted_Price').val();
                    let Vendor_1_Variance_VS_QBOM = $('#Vendor_1_Variance_VS_QBOM').val();
                    let Conversion_Rate_Vendor_2 = $('#Conversion_Rate_Vendor_2').val();
                    let Vendor_2_Converted_Price = $('#Vendor_2_Converted_Price').val();
                    let Vendor_2_Variance_VS_QBOM = $('#Vendor_2_Variance_VS_QBOM').val();
                    let Chargable_to_Customer = $('#Chargable_to_Customer').is(':checked');
                    let Variance_Chargable_to_Cohu = $('#VC2Cohu').val();
                    let Business_Control_Recommendation = $('#Business_Control_Recommendation').val();
                    let Variance_VS_QBOM_Price = $('#Variance_VS_QBOM_Price').val();
                    let approved_check1 = $('#approved_check1').is(':checked');
                    let disapproved_check = $('#disapproved').is(':checked');
                    if (!approved_check1 && !disapproved_check) {
                        // If checkbox is not checked, show a SweetAlert toast
                        Swal.fire({
                            icon: 'info',
                            title: 'Alert!',
                            text: 'Please check the approval checkbox before submitting.',
                        });
                        return false; // Prevent form submission
                    }
                    let approved_by_1 = $('#approved_by_1').val();
                    let disapproved_by = $('#disapproved_by').val();
                    let date_1 = $('#date_1').val();
                    let remarks = $('#Remarks').val();

                    var request_status = (approved_check1) ? 'Approved' : 'Disapproved';
                    console.log(request_status);
                    // Show a SweetAlert confirmation dialog
                    Swal.fire({
                        title: "Confirm Submission",
                        text: "Are you sure you want to submit this form ?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Proceed",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed, proceed with form submission
                            $.ajax({
                                type: "POST",
                                url: "../controllers/apv_commands.php",
                                data: {
                                    No: No,
                                    Approver: Approver,
                                    QBOM_Unit_Price: QBOM_Unit_Price,
                                    Total_QBOM_Price: Total_QBOM_Price,
                                    Conversion_Rate_Vendor_1: Conversion_Rate_Vendor_1,
                                    Vendor_1_Converted_Price: Vendor_1_Converted_Price,
                                    Vendor_1_Variance_VS_QBOM: Vendor_1_Variance_VS_QBOM,
                                    Conversion_Rate_Vendor_2: Conversion_Rate_Vendor_2,
                                    Vendor_2_Converted_Price: Vendor_2_Converted_Price,
                                    Vendor_2_Variance_VS_QBOM: Vendor_2_Variance_VS_QBOM,
                                    Chargable_to_Customer: Chargable_to_Customer,
                                    Variance_Chargable_to_Cohu: Variance_Chargable_to_Cohu,
                                    Business_Control_Recommendation: Business_Control_Recommendation,
                                    Variance_VS_QBOM_Price: Variance_VS_QBOM_Price,
                                    approved_check1: approved_check1,
                                    approved_by_1: approved_by_1,
                                    disapproved_check: disapproved_check,
                                    disapproved_by: disapproved_by,
                                    date_1: date_1,
                                    remarks: remarks,
                                    Request_Status: request_status,
                                    apvForm: true
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Successfully Submitted!"
                                        }).then(() => {
                                            if (request_status === 'Approved') {
                                                console.log(request_status);
                                                // Show a SweetAlert confirmation dialog
                                                if (Approver === 'Approver 2' || Approver === 'Approver 3') {
                                                    Swal.fire({
                                                        icon: "question",
                                                        title: "Sending Confirmation",
                                                        text: "Send this to next Approver?",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#3085d6",
                                                        confirmButtonText: "Proceed",
                                                        cancelButtonText: "Cancel",
                                                        allowOutsideClick: false,
                                                        allowEscapeKey: false
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            Swal.fire({
                                                                title: 'Sending...',
                                                                html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
                                                                showCancelButton: false,
                                                                showConfirmButton: false,
                                                                allowOutsideClick: false,
                                                                allowEscapeKey: false
                                                            });
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "../controllers/apv_commands.php",
                                                                data: {
                                                                    Approver: Approver,
                                                                    No: No,
                                                                    // Request_Status: request_status,
                                                                    // Variance_VS_QBOM_Price: Variance_VS_QBOM_Price,
                                                                    nxtApv: true,
                                                                },
                                                                dataType: "json",
                                                                success: function(response) {
                                                                    // Close the SweetAlert modal
                                                                    Swal.close();
                                                                    if (response.success) {
                                                                        Swal.fire({
                                                                            icon: "success",
                                                                            title: "Successfully Sent!",
                                                                            text: "Form has been sent to next Approver!",
                                                                        }).then(function() {
                                                                            // Redirect after the user clicks OK
                                                                            window.location.href = "bc_dashboard.php";
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
                                                                    Swal.close();
                                                                },
                                                            });
                                                        }
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        title: 'Sending...',
                                                        html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
                                                        showCancelButton: false,
                                                        showConfirmButton: false,
                                                        allowOutsideClick: false,
                                                        allowEscapeKey: false
                                                    });
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../controllers/apv_commands.php",
                                                        data: {
                                                            No: No,
                                                            Request_Status: request_status,
                                                            apv1: true,
                                                        },
                                                        dataType: "json",
                                                        success: function(response) {
                                                            // Close the SweetAlert modal
                                                            Swal.close();
                                                            if (response.success) {
                                                                Swal.fire({
                                                                    icon: "success",
                                                                    title: "Successfully Sent!",
                                                                    text: "Form has been sent to the Requestor!",
                                                                }).then(function() {
                                                                    // Redirect after the user clicks OK
                                                                    window.location.href = "bc_dashboard.php";
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
                                                            Swal.close();
                                                        },
                                                    });
                                                }
                                            } else {
                                                Swal.fire({
                                                    title: 'Sending...',
                                                    html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
                                                    showCancelButton: false,
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    allowEscapeKey: false
                                                });
                                                $.ajax({
                                                    type: "POST",
                                                    url: "../controllers/apv_commands.php",
                                                    data: {
                                                        No: No,
                                                        Request_Status: request_status,
                                                        apv1: true,
                                                    },
                                                    dataType: "json",
                                                    success: function(response) {
                                                        // Close the SweetAlert modal
                                                        Swal.close();
                                                        if (response.success) {
                                                            Swal.fire({
                                                                icon: "success",
                                                                title: "Successfully Sent!",
                                                                text: "Form has been sent to the Requestor!",
                                                            }).then(function() {
                                                                // Redirect after the user clicks OK
                                                                window.location.href = "bc_dashboard.php";
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
                                                        Swal.close();
                                                    },
                                                });
                                            }
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
                                },
                            });
                        }
                    });
                });
            });
        </script>
    </body>
<?php } else if ($Role === "Approver 2") { ?>

    <body class="bg-light">
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
            <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Business Control Analysis</h5>
            <div class="row mb-2">
                <div class="col-sm col-md-12 col-lg-6">
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
                </div>
                <div class="col-sm col-md col-lg-6">
                    <div class="row g-2 ms-1 mb-2">
                        <div class="col-sm-4 col-md-4 col-lg-4 form-check">
                            <input class="form-check-input" type="checkbox" name="Chargable_to_Customer" id="Chargable_to_Customer" <?php echo ($Chargable2Customer === 'true') ? 'checked disabled' : 'disabled'; ?>>
                            <label class="fw-bold form-check-label" for="Chargable_to_Customer"> Chargeable to Customer? </label>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-4 form-floating" id="Variance_Chargable_to_Cohu" style="display: none;">
                            <input type="number" class="form-control" name="VC2Cohu" id="VC2Cohu" value="<?= $VarianceChargable2Cohu; ?>">
                            <label class="fw-bold text-dark" for="VC2Cohu">Variance Chargeable to Cohu</label>
                        </div>
                    </div>
                    <div class="row g-2 ms-1">
                        <div class="col-sm-4 col-md-8 col-lg-4 form-check">
                            <input class="form-check-input" type="checkbox" name="For_Checking_of_CCP_analyst" id="For_Checking_of_CCP_analyst" readonly>
                            <label class="fw-bold form-check-label" for="For_Checking_of_CCP_analyst"> For Checking of CCP Analyst </label>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6 form-floating" id="Remarks_from_CCP_analyst" style="display: none;">
                            <textarea class="form-control" name="Remarks_from_CCP_analyst" readonly><?= $Remarks_from_CCP_analyst; ?></textarea>
                            <label class="form-label fw-bold text-dark" for="Remarks_from_CCP_analyst">Remarks of CCP Analyst</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="approvalSection">
                <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Approval</h5>
                <input type="hidden" name="Approver" id="Approver" value="<?= $Approver; ?>" readonly>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="row g-2 mb-2">
                            <div class="col-sm-4 col-md-8 col-lg-8 form-floating">
                                <input type="text" class="form-control bg-white" name="Business_Control_Recommendation" id="Business_Control_Recommendation" value="<?= $BC_Recomm; ?>" readonly>
                                <label class=" form-label fw-bold text-black" for="Business_Control_Recommendation">Business Control Recommendation</label>
                            </div>
                            <div class="col-sm-2 col-md-4 col-lg-4 form-floating">
                                <input type="text" class="form-control" name="Variance_VS_QBOM_Price" id="Variance_VS_QBOM_Price" value="<?= $Variance_VS_QBOM_Price; ?>" readonly>
                                <label class="fw-bold text-black" for="Variance_VS_QBOM_Price">Variance VS QBOM Price</label>
                            </div>
                            <?php if (!empty($CCP_Name)) : ?>
                                <div class="col-sm-2 col-md-3">
                                    <h6 class="fw-bold">Checked by</h6>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm mb-1" type="text" name="checker_name" id="checker_name" value="<?= $CCP_Name; ?>" readonly>
                                        <input class="form-control form-control-sm" type="text" name="checked_date" id="checked_date" value="<?= $check_date; ?>" readonly>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-sm-2 col-md-3">
                                <h6 class="fw-bold">Approved</h6>
                                <?php if ($Role === 'Approver 1') { ?>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                    </div>
                                <?php } elseif ($Role === 'Approver 2') { ?>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check2" name="approved_check2" <?= $ApvCheck2 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_2" id="approved_by_2" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check2" name="approved_check2" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_2" id="approved_by_2" value="<?= $ApvName2; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check3" name="approved_check3">
                                        <input class="form-control form-control-sm" type="text" name="approved_by_3" id="approved_by_3" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-2 col-md-3">
                                <h6 class="fw-bold">Disapproved</h6>
                                <div class="col-sm col-md-12 form-check mb-1">
                                    <input class="form-check-input" type="checkbox" value="" name="disapproved_check" id="disapproved">
                                    <input class="form-control form-control-sm" type="text" name="disapproved_by" id="disapproved_by" value="" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3">
                                <h6 class="fw-bold">Date</h6>
                                <?php if ($Role === 'Approver 1') { ?>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                    </div>
                                <?php } elseif ($Role === 'Approver 2') { ?>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_2" id="date_2" value="<?= $ApvDate2; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_2" id="date_2" value="<?= $ApvDate2; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_3" id="date_3" value="<?= $ApvDate3; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="row g-2 mb-2">
                            <div class="col-sm-4 col-md-12 col-lg-12">
                                <div class="form-outline">
                                    <textarea class="form-control" id="Remarks" name="Remarks" rows="3" readonly><?= $Remarks; ?></textarea>
                                    <label class="form-label fw-bold text-dark" for="Remarks">Remarks</label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-evenly">
                                <button id="submitBtn" type="button" class="btn btn-primary fw-bold">SUBMIT <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // CHECKING OF CHECKBOX FOR CCP ANALYST AND CHARGE TO CUSTOMER
                let CCP_Analyst = "<?= $For_Checking_of_CCP_analyst; ?>";
                let remarksCCP = $("#Remarks_from_CCP_analyst");
                let checkBoxCCP = $("#For_Checking_of_CCP_analyst");
                let approvalForm = $("#approvalSection");
                let sendCCP = $("#sendCCP");
                let C2C = "<?= $Chargable2Customer; ?>";
                let checkBoxC2C = $("#Chargable_to_Customer");
                let varianceField = $("#Variance_Chargable_to_Cohu");
                let VC2Cohu = $("#VC2Cohu");

                if (CCP_Analyst === 'true') {
                    checkBoxCCP.prop('checked', true).prop('disabled', true);
                    remarksCCP.show();
                    sendCCP.hide();
                } else if (CCP_Analyst === '' || CCP_Analyst === null) {
                    checkBoxCCP.prop('disabled', true);
                    remarksCCP.hide();
                    sendCCP.hide();
                } else {
                    checkBoxCCP.prop('checked', false).prop('disabled', true);
                    remarksCCP.hide();
                }

                if (C2C === 'true') {
                    checkBoxC2C.prop('checked', true).prop('disabled', true);
                    varianceField.show();
                    VC2Cohu.prop('readonly', true);
                } else if (C2C === '' || C2C === null) {
                    checkBoxC2C.prop('disabled', true);
                    varianceField.hide();
                } else {
                    checkBoxC2C.prop('checked', false).prop('disabled', true);
                    varianceField.hide();
                }
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

                function handleCheckboxChange(checkboxId, nameFieldId, dateFieldId, otherCheckboxId, otherNameFieldId, divFieldId) {
                    return function() {
                        var nameField = $(nameFieldId);
                        var dateField = $(dateFieldId);
                        var otherCheckbox = $(otherCheckboxId);
                        var otherNameField = $(otherNameFieldId);
                        var divField = $(divFieldId);

                        if (this.checked) {
                            var name = "<?= $Name ?>";
                            // console.log(this.checked);
                            nameField.val(name);

                            // Get the current date and time
                            var currentDateTime = new Date();

                            // Format the date and time as a string
                            var dateTimeString = currentDateTime.toLocaleString();

                            dateField.val(dateTimeString);

                            // Hide the other checkbox and name field
                            otherCheckbox.prop('checked', false);
                            otherCheckbox.hide();
                            otherNameField.hide();
                            divField.hide();
                        } else {
                            nameField.val('');
                            dateField.val('');

                            // Show the other checkbox and name field
                            otherCheckbox.show();
                            otherNameField.show();
                            divField.show();
                        }
                    };
                }

                $('#approved_check2').change(handleCheckboxChange('#approved_check2', '#approved_by_2', '#date_2', '#disapproved', '#disapproved_by', '#Disapproved'));
                $('#disapproved').change(handleCheckboxChange('#disapproved', '#disapproved_by', '#date_2', '#approved_check2', '#approved_by_2', '#Approved'));

                $("#submitBtn").click(function() {
                    var approvedCheck2 = $("#approved_check2").prop("checked");
                    if (!approvedCheck2) {
                        // If checkbox is not checked, show a SweetAlert toast
                        Swal.fire({
                            icon: 'info',
                            title: 'Alert!',
                            text: 'Please check the approval checkbox before submitting.',
                        });
                        return false; // Prevent form submission
                    }
                    var nO = "<?= $No ?>";
                    var approver = "<?= $Approver; ?>";
                    var varianceQbom = "<?= $Variance_VS_QBOM_Price; ?>";
                    var approvedBy2 = $("#approved_by_2").val();
                    var date2 = $("#date_2").val();
                    var disapproved_check = $('#disapproved').is(':checked');
                    var disapproved_by = $('#disapproved_by').val();
                    var request_status = (approvedCheck2) ? 'Approved' : 'Disapproved';
                    Swal.fire({
                        title: "Confirm Submission",
                        text: "Are you sure you want to submit this form ?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Proceed",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sending...',
                                html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });
                            $.ajax({
                                url: "../controllers/apv_commands.php",
                                method: "POST",
                                data: {
                                    nO: nO,
                                    approver: approver,
                                    varianceQbom: varianceQbom,
                                    request_status: request_status,
                                    approvedCheck2: approvedCheck2,
                                    approvedBy2: approvedBy2,
                                    date2: date2,
                                    disapproved: disapproved_check,
                                    disapproved_by: disapproved_by,
                                    apv2: true
                                },
                                success: function(response) {
                                    Swal.close();
                                    // console.log(response);
                                    Swal.fire({
                                        icon: "success",
                                        title: "Successfully Sent!",
                                        text: "Form submitted",
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        window.location.href = "bc_dashboard.php";
                                    });
                                },
                                error: function(error) {
                                    Swal.close();
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        text: error,
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </body>
<?php } else if ($Role === "Approver 3") { ?>

    <body class="bg-light">
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
            <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Business Control Analysis</h5>
            <div class="row mb-2">
                <div class="col-sm col-md-12 col-lg-6">
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
                </div>
                <div class="col-sm col-md col-lg-6">
                    <div class="row g-2 ms-1 mb-2">
                        <div class="col-sm-4 col-md-4 col-lg-4 form-check">
                            <input class="form-check-input" type="checkbox" name="Chargable_to_Customer" id="Chargable_to_Customer" <?php echo ($Chargable2Customer === 'true') ? 'checked disabled' : 'disabled'; ?>>
                            <label class="fw-bold form-check-label" for="Chargable_to_Customer"> Chargeable to Customer? </label>
                        </div>
                        <div class="col-sm-4 col-md-3 col-lg-4 form-floating" id="Variance_Chargable_to_Cohu" style="display: none;">
                            <input type="number" class="form-control" name="VC2Cohu" id="VC2Cohu" value="<?= $VarianceChargable2Cohu; ?>">
                            <label class="fw-bold text-dark" for="VC2Cohu">Variance Chargeable to Cohu</label>
                        </div>
                    </div>
                    <div class="row g-2 ms-1">
                        <div class="col-sm-4 col-md-8 col-lg-4 form-check">
                            <input class="form-check-input" type="checkbox" name="For_Checking_of_CCP_analyst" id="For_Checking_of_CCP_analyst" readonly>
                            <label class="fw-bold form-check-label" for="For_Checking_of_CCP_analyst"> For Checking of CCP Analyst </label>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6 form-floating" id="Remarks_from_CCP_analyst" style="display: none;">
                            <textarea class="form-control" name="Remarks_from_CCP_analyst" readonly><?= $Remarks_from_CCP_analyst; ?></textarea>
                            <label class="form-label fw-bold text-dark" for="Remarks_from_CCP_analyst">Remarks of CCP Analyst</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="approvalSection">
                <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Approval</h5>
                <input type="hidden" name="Approver" id="Approver" value="<?= $Approver; ?>" readonly>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="row g-2 mb-2">
                            <div class="col-sm-4 col-md-8 col-lg-8 form-floating">
                                <input type="text" class="form-control bg-white" name="Business_Control_Recommendation" id="Business_Control_Recommendation" value="<?= $BC_Recomm; ?>" readonly>
                                <label class=" form-label fw-bold text-black" for="Business_Control_Recommendation">Business Control Recommendation</label>
                            </div>
                            <div class="col-sm-2 col-md-4 col-lg-4 form-floating">
                                <input type="text" class="form-control" name="Variance_VS_QBOM_Price" id="Variance_VS_QBOM_Price" value="<?= $Variance_VS_QBOM_Price; ?>" readonly>
                                <label class="fw-bold text-black" for="Variance_VS_QBOM_Price">Variance VS QBOM Price</label>
                            </div>
                            <?php if (!empty($CCP_Name)) : ?>
                                <div class="col-sm-2 col-md-3">
                                    <h6 class="fw-bold">Checked by</h6>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm mb-1" type="text" name="checker_name" id="checker_name" value="<?= $CCP_Name; ?>" readonly>
                                        <input class="form-control form-control-sm" type="text" name="checked_date" id="checked_date" value="<?= $check_date; ?>" readonly>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-sm-2 col-md-3">
                                <h6 class="fw-bold">Approved</h6>
                                <?php if ($Role === 'Approver 1') { ?>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                    </div>
                                <?php } elseif ($Role === 'Approver 2') { ?>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check2" name="approved_check2" <?= $ApvCheck2 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_2" id="approved_by_2" value="<?= $ApvName2; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check1" name="approved_check1" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_1" id="approved_by_1" value="<?= $ApvName1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check2" name="approved_check2" <?= $ApvCheck1 === 'true' ? 'checked disabled' : '' ?>>
                                        <input class="form-control form-control-sm" type="text" name="approved_by_2" id="approved_by_2" value="<?= $ApvName2; ?>" readonly>
                                    </div>
                                    <div class=" col-sm col-md-12 form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="approved_check3" name="approved_check3">
                                        <input class="form-control form-control-sm" type="text" name="approved_by_3" id="approved_by_3" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-2 col-md-3">
                                <h6 class="fw-bold">Disapproved</h6>
                                <div class="col-sm col-md-12 form-check mb-1">
                                    <input class="form-check-input" type="checkbox" value="" name="disapproved_check" id="disapproved">
                                    <input class="form-control form-control-sm" type="text" name="disapproved_by" id="disapproved_by" value="" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3">
                                <h6 class="fw-bold">Date</h6>
                                <?php if ($Role === 'Approver 1') { ?>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                    </div>
                                <?php } elseif ($Role === 'Approver 2') { ?>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_2" id="date_2" value="<?= $ApvDate2; ?>" readonly>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_1" id="date_1" value="<?= $ApvDate1; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_2" id="date_2" value="<?= $ApvDate2; ?>" readonly>
                                    </div>
                                    <div class="col-sm col-md-12 mb-1">
                                        <input class="form-control form-control-sm" type="text" name="date_3" id="date_3" value="<?= $ApvDate3; ?>" readonly>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="row g-2 mb-2">
                            <div class="col-sm-4 col-md-12 col-lg-12">
                                <div class="form-outline">
                                    <textarea class="form-control" id="Remarks" name="Remarks" rows="3" readonly><?= $Remarks; ?></textarea>
                                    <label class="form-label fw-bold text-dark" for="Remarks">Remarks</label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-evenly">
                                <button id="submitBtn" type="button" class="btn btn-primary fw-bold">SUBMIT <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // CHECKING OF CHECKBOX FOR CCP ANALYST AND CHARGE TO CUSTOMER
                let CCP_Analyst = "<?= $For_Checking_of_CCP_analyst; ?>";
                let remarksCCP = $("#Remarks_from_CCP_analyst");
                let checkBoxCCP = $("#For_Checking_of_CCP_analyst");
                let approvalForm = $("#approvalSection");
                let sendCCP = $("#sendCCP");
                let C2C = "<?= $Chargable2Customer; ?>";
                let checkBoxC2C = $("#Chargable_to_Customer");
                let varianceField = $("#Variance_Chargable_to_Cohu");
                let VC2Cohu = $("#VC2Cohu");

                if (CCP_Analyst === 'true') {
                    checkBoxCCP.prop('checked', true).prop('disabled', true);
                    remarksCCP.show();
                    sendCCP.hide();
                } else if (CCP_Analyst === '' || CCP_Analyst === null) {
                    checkBoxCCP.prop('disabled', true);
                    remarksCCP.hide();
                    sendCCP.hide();
                } else {
                    checkBoxCCP.prop('checked', false).prop('disabled', true);
                    remarksCCP.hide();
                }

                if (C2C === 'true') {
                    checkBoxC2C.prop('checked', true).prop('disabled', true);
                    varianceField.show();
                    VC2Cohu.prop('readonly', true);
                } else if (C2C === '' || C2C === null) {
                    checkBoxC2C.prop('disabled', true);
                    varianceField.hide();
                } else {
                    checkBoxC2C.prop('checked', false).prop('disabled', true);
                    varianceField.hide();
                }
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

                function handleCheckboxChange(checkboxId, nameFieldId, dateFieldId, otherCheckboxId, otherNameFieldId, divFieldId) {
                    return function() {
                        var nameField = $(nameFieldId);
                        var dateField = $(dateFieldId);
                        var otherCheckbox = $(otherCheckboxId);
                        var otherNameField = $(otherNameFieldId);
                        var divField = $(divFieldId);

                        if (this.checked) {
                            var name = "<?= $Name ?>";
                            // console.log(this.checked);
                            nameField.val(name);

                            // Get the current date and time
                            var currentDateTime = new Date();

                            // Format the date and time as a string
                            var dateTimeString = currentDateTime.toLocaleString();

                            dateField.val(dateTimeString);

                            // Hide the other checkbox and name field
                            otherCheckbox.prop('checked', false);
                            otherCheckbox.hide();
                            otherNameField.hide();
                            divField.hide();
                        } else {
                            nameField.val('');
                            dateField.val('');

                            // Show the other checkbox and name field
                            otherCheckbox.show();
                            otherNameField.show();
                            divField.show();
                        }
                    };
                }

                $('#approved_check3').change(handleCheckboxChange('#approved_check3', '#approved_by_3', '#date_3', '#disapproved', '#disapproved_by', '#Disapproved'));
                $('#disapproved').change(handleCheckboxChange('#disapproved', '#disapproved_by', '#date_3', '#approved_check3', '#approved_by_3', '#Approved'));

                $("#submitBtn").click(function() {
                    var approvedCheck3 = $("#approved_check3").prop("checked");
                    if (!approvedCheck3) {
                        // If checkbox is not checked, show a SweetAlert toast
                        Swal.fire({
                            icon: 'info',
                            title: 'Alert!',
                            text: 'Please check the approval checkbox before submitting.',
                        });
                        return false; // Prevent form submission
                    }
                    var nO = "<?= $No ?>";
                    var approver = "<?= $Approver; ?>";
                    var varianceQbom = "<?= $Variance_VS_QBOM_Price; ?>";
                    var approvedBy3 = $("#approved_by_3").val();
                    var date3 = $("#date_3").val();
                    var disapproved_check = $('#disapproved').is(':checked');
                    var disapproved_by = $('#disapproved_by').val();
                    var request_status = (approvedCheck3) ? 'Approved' : 'Disapproved';
                    Swal.fire({
                        title: "Confirm Submission",
                        text: "Are you sure you want to submit this form ?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Proceed",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sending...',
                                html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });
                            $.ajax({
                                url: "../controllers/apv_commands.php",
                                method: "POST",
                                data: {
                                    nO: nO,
                                    approver: approver,
                                    request_status: request_status,
                                    approvedCheck3: approvedCheck3,
                                    approvedBy3: approvedBy3,
                                    date3: date3,
                                    disapproved: disapproved_check,
                                    disapproved_by: disapproved_by,
                                    apv3: true
                                },
                                success: function(response) {
                                    Swal.close();
                                    // console.log(response);
                                    Swal.fire({
                                        icon: "success",
                                        title: "Successfully Sent!",
                                        text: "Form submitted!",
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        window.location.href = "bc_dashboard.php";
                                    });
                                },
                                error: function(error) {
                                    Swal.close();
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        text: error,
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </body>
<?php } ?>

</html>