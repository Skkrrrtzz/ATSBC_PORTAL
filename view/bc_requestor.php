<?php require_once 'bc_nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requestor Form</title>
    <link rel="stylesheet" href="../assets/css/loading.css">
</head>

<body class="bg-light">
    <div class="container-fluid mt-2 mx-0">
        <form id="requestForm">
            <div class="card bg-light">
                <h5 class="fw-bold ps-2 pt-1 border-bottom text-bg-primary border-2 border-dark rounded-top"> <i class="fa-solid fa-file-lines"></i> Request Form</h5>
                <input type="hidden" name="email" id="email" value="<?= $Email; ?>" readonly>
                <div class="row g-2 justify-content-between mx-2 mb-2">
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="date" id="date" value="<?php echo $currentDate; ?>" readonly>
                            <label class="form-label fw-bold text-black" for="date">Date Requested</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="form-floating">
                            <input type="text" class="form-control bg-white" name="name" id="name" value="<?php echo $Name; ?>" readonly>
                            <label class="form-label fw-bold text-black" for="name">Requestor</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mx-2 mb-2">
                    <div class="col-sm col-md-4 col-lg-2 form-floating">
                        <select class="form-select" name="projects" id="projects" required>
                            <option value="" selected>Select Project</option>
                            <option value="JLP">JLP</option>
                            <option value="JLP CABLE">JLP CABLE</option>
                            <option value="MTP">MTP</option>
                            <option value="OLB">OLB</option>
                            <option value="FLIPPER">FLIPPER</option>
                            <option value="HIGHMAG">HIGHMAG</option>
                            <option value="IONIZER">IONIZER</option>
                            <option value="RCMTP">RCMTP</option>
                            <option value="JTP">JTP</option>
                            <option value="PNP">PNP</option>
                            <option value="PNP CABLE">PNP CABLE</option>
                            <option value="SWAP">SWAP</option>
                            <option value="SPARES">SPARES</option>
                        </select>
                        <label class="form-label fw-bold text-black" for="projects">Project</label>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="SAP_No" id="SAP_No" required>
                            <label class="form-label fw-bold text-black" for="SAP_No">SAP Number</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="Delta_PN" id="Delta_PN" value="" readonly>
                            <label class="form-label fw-bold text-black" for="Delta_PN">Delta Part Number</label>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="desc" id="desc" value="" readonly>
                            <label class="form-label fw-bold text-black" for="desc">Description</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 col-lg-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="QPA" id="QPA" required>
                            <label class="form-label fw-bold text-black" for="QPA">QPA</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 col-lg-1">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="PR_Qty" id="PR_Qty" required>
                            <label class="form-label fw-bold text-black" for="PR_Qty">PR Qty</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="Purchase_Qty" id="Purchase_Qty" required>
                            <label class="form-label fw-bold text-black" for="Purchase_Qty">Purchase Qty</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 col-lg-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="UOM" id="UOM" required>
                            <label class="form-label fw-bold text-black" for="UOM">UoM</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-md-4 col-lg-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="Prev_price" id="Prev_price" required>
                            <label class="form-label fw-bold text-black" for="Prev_price">Previous Price</label>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-3 col-lg-2 form-floating">
                        <select class="form-select" name="Currency" id="Currency" required>
                            <option value="" selected>Select Currency</option>
                            <option value="USD">USD</option>
                            <option value="PHP">PHP</option>
                            <option value="EURO">EURO</option>
                        </select>
                        <label class="form-label text-black fw-bold" for="Currency">Currency</label>
                    </div>
                    <div class="col-sm-2 col-md-4 col-lg-2 form-floating">
                        <select class="form-select" name="PPV_Type" id="PPV_Type" required>
                            <option value="" selected>Select PPV Type</option>
                            <option value="MOQ SPQ">MOQ/SPQ</option>
                            <option value="PRICE INCREASE">PRICE INCREASE</option>
                            <option value="SPOT BUY">SPOT BUY</option>
                            <option value="OTHERS">OTHERS</option>
                        </select>
                        <label class="form-label fw-bold text-black" for="PPV_Type">PPV Type</label>
                    </div>
                    <div class="col-md-8 col-lg-" id="other_ppv_type">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="other_ppv_type">
                            <label class="form-label fw-bold text-black" for="other_ppv_type">Please specify</label>
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-sm col-md-12 col-lg-6 my-1">
                        <div class="card">
                            <div class="d-flex justify-content-between pt-1 align-items-center text-bg-primary border-bottom border-2 border-dark rounded-top mb-2">
                                <h5 class="fw-bold ps-2"> Vendor 1</h5>
                            </div>
                            <div class="row g-2 mx-2 mb-2">
                                <div class="col-sm col-md-6 col-lg-5 form-floating">
                                    <input type="text" class="form-control" name="Current_Vendor" id="Current_Vendor" required>
                                    <label class="form-label fw-bold text-black" for="Current_Vendor">Current Vendor</label>
                                </div>
                                <div class="col-sm col-md-3 col-lg-4 form-floating">
                                    <input type="text" class="form-control" name="Current_Vendor_Price" id="Current_Vendor_Price" required>
                                    <label class="form-label fw-bold text-black" for="Current_Vendor_Price">Current Vendor Price</label>
                                </div>
                                <div class="col-7 col-md-3 col-lg-3 form-floating">
                                    <select class="form-select" name="Currency1" id="Currency1" required>
                                        <option value="" selected>Select Currency</option>
                                        <option value="USD">USD</option>
                                        <option value="PHP">PHP</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                    <label class="form-label fw-bold text-black" for="Currency1">Currency</label>
                                </div>
                                <div class="col-5 col-md-2 col-lg-2 form-floating">
                                    <input type="number" class="form-control" name="LT1" id="LT1" required>
                                    <label class="form-label fw-bold text-black" for="LT1">LT</label>
                                </div>
                                <div class="col-6 col-md-2 col-lg-2 form-floating">
                                    <input type="number" class="form-control" name="SPQ1" id="SPQ1" required>
                                    <label class="form-label fw-bold text-black" for="SPQ1">SPQ</label>
                                </div>
                                <div class="col-6 col-md-2 col-lg-2 form-floating">
                                    <input type="number" class="form-control" name="MOQ1" id="MOQ1" required>
                                    <label class="form-label fw-bold text-black" for="MOQ1">MOQ</label>
                                </div>
                                <div class="col-7 col-md-4 col-lg-4 form-floating">
                                    <input type="number" class="form-control" name="Qty_to_Purchase_from_Vendor_1" id="Qty_to_Purchase_from_Vendor_1" required>
                                    <label class="form-label fw-bold text-black" for="Qty_to_Purchase_from_Vendor_1">Qty to Purchase from Vendor 1</label>
                                </div>
                                <div class="col-5 col-md-2 col-lg-2 form-floating">
                                    <input type="text" class="form-control" name="Total_Amt_1" id="Total_Amt_1">
                                    <label class="form-label fw-bold text-black" for="Total_Amt_1">Total Amt</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm col-md-12 col-lg-6 my-1">
                        <div class="card" id="vendor2">
                            <div class="d-flex justify-content-between pt-1 align-items-center text-bg-primary border-bottom border-2 border-dark rounded-top mb-2">
                                <h5 class="fw-bold ps-2"> Vendor 2</h5>
                                <button class="btn btn-primary btn-sm fa-solid fa-minus" type="button" id="close">
                                </button>
                            </div>
                            <div class="row g-2 mx-2 mb-2">
                                <div class="col-sm-2 col-md-6 col-lg-4 form-floating">
                                    <input type="text" class="form-control" name="New_Vendor" id="New_Vendor">
                                    <label class="form-label fw-bold text-black" for="New_Vendor">New Vendor</label>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-4 form-floating">
                                    <input type="text" class="form-control" name="New_Vendor_Price" id="New_Vendor_Price">
                                    <label class="form-label fw-bold text-black" for="New_Vendor_Price">New Vendor Price</label>
                                </div>
                                <div class="col-7 col-md-3 col-lg-4 form-floating">
                                    <select class="form-select" name="Currency2" id="Currency2">
                                        <option value="" selected>Select Currency</option>
                                        <option value="USD">USD</option>
                                        <option value="PHP">PHP</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                    <label class="form-label fw-bold text-black" for="Currency2">Currency</label>
                                </div>
                                <div class="col-5 col-md-2 form-floating">
                                    <input type="number" class="form-control" name="LT2" id="LT2">
                                    <label class="form-label fw-bold text-black" for="LT2">LT</label>
                                </div>
                                <div class="col-6 col-md-2 form-floating">
                                    <input type="number" class="form-control" name="SPQ2" id="SPQ2">
                                    <label class="form-label fw-bold text-black" for="SPQ2">SPQ</label>
                                </div>
                                <div class="col-6 col-md-2 form-floating">
                                    <input type="number" class="form-control" name="MOQ2" id="MOQ2">
                                    <label class="form-label fw-bold text-black" for="MOQ2">MOQ</label>
                                </div>
                                <div class="col-7 col-md-4 col-lg-4 form-floating">
                                    <input type="number" class="form-control" name="Qty_to_Purchase_from_Vendor_2" id="Qty_to_Purchase_from_Vendor_2">
                                    <label class="form-label fw-bold text-black" for="Qty_to_Purchase_from_Vendor_2">Qty to Purchase from Vendor 2</label>
                                </div>
                                <div class="col-5 col-md-2 col-lg-2 form-floating">
                                    <input type="text" class="form-control" name="Total_Amt_2" id="Total_Amt_2">
                                    <label class="form-label fw-bold text-black" for="Total_Amt_2">Total Amt</label>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="reasonCard" style="display: none;">
                            <div class="row g-2 m-2">
                                <div class="d-flex justify-content-between">
                                    <i>Please indicate the reason why there is no Vendor 2</i>
                                    <button class="btn btn-primary btn-sm" type="button" id="open">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 form-floating">
                                    <input type="text" class="form-control" name="Reason" id="Reason">
                                    <label class="form-label fw-bold text-black" for="Reason">Reason</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 my-2">
                        <div class="col-sm col-md-8 col-lg-6 form-floating mx-2 pe-3">
                            <input type="text" class="form-control" name="Purchasing_Recom" id="Purchasing_Recom" required>
                            <label class="form-label fw-bold text-black" for="Purchasing_Recom">Purchasing Recommendation</label>
                        </div>
                        <div class="col-sm d-flex align-items-center justify-content-center mb-4">
                            <button class="btn btn-primary fw-bold" type="submit" name="submit">SUBMIT <i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="../js/requestor.js"></script>
</body>

</html>