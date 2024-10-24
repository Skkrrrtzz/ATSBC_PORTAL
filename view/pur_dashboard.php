<?php
require_once 'bc_nav.php';
include_once '../controllers/requestor_dashboard_data.php';
if ($Role === "Requestor" || $Role === 'Admin') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchasing Dashboard</title>

    </head>

    <body class="bg-light">
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card shadow bg-warning ">
                        <div class="card-body" type="button" data-mdb-toggle="modal" data-mdb-target="#pendingModal">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-circle-exclamation fa-3x text-white"></i>
                                </div>
                                <div class="col mr-2">
                                    <div class="text-white text-end">
                                        <h4 class="fs-1"><?php echo $pending; ?></h4>
                                    </div>
                                    <div class="mb-1 text-end text-white">
                                        <h4 class="fs-6">Pending Approval</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card shadow bg-success border-3 border-success-subtle">
                        <div class="card-body" type="button" data-mdb-toggle="modal" data-mdb-target="#approvedModal">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-circle-check fa-3x text-white"></i>
                                </div>
                                <div class="col mr-2">
                                    <div class="text-white text-end">
                                        <h4 class="fs-1"><?php echo $approved; ?></h4>
                                    </div>
                                    <div class="mb-1 text-end text-white">
                                        <h4 class="fs-6">Approved</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card shadow bg-danger border-3 border-danger-subtle">
                        <div class="card-body" type="button" data-mdb-toggle="modal" data-mdb-target="#disapprovedModal">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-circle-xmark fa-3x text-white"></i>
                                </div>
                                <div class="col mr-2">
                                    <div class="text-white text-end">
                                        <h4 class="fs-1"><?php echo $disapproved; ?></h4>
                                    </div>
                                    <div class="mb-1 text-end text-white">
                                        <h4 class="fs-6">Disapproved</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Modal -->
        <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h1 class="modal-title fs-5" id="pendingModalLabel">Pending Request/s</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light rounded-bottom">
                        <div class="d-flex justify-content-end ">
                            <div class="form-group my-auto">
                                <label for="partNumberSearch" class="form-label fw-bold">Search by Part Number: </label>
                            </div>
                            <div class="form-group mb-2 my-auto">
                                <input type="text" class="form-control" id="partNumberSearch" placeholder="Enter Part Number">
                            </div>
                        </div>
                        <div class="table-responsive ">
                            <table class="table table-bordered table-sm table-hover text-nowrap" id="pendingTable">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Request No</th>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
                                        <th>Part Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingResult as $row) : ?>
                                        <tr>
                                            <td><?= $row['No'] ?></td>
                                            <td><?= $row['Date_Received'] ?></td>
                                            <td><?= $row['Requestor'] ?></td>
                                            <td><?= $row['Project'] ?></td>
                                            <td><?= $row['Delta_PN'] ?></td>
                                            <td><span class="badge badge-success"><?= $row['Status'] ?></span>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-primary btn-sm" type="button" onclick="viewModal(<?= $row['No'] ?>)"> View</button>
                                                <button class="btn btn-outline-danger btn-sm" type="button" onclick="deleteNo(<?= $row['No'] ?>)"> Delete</button>
                                                <?php if ($row['Status'] !== 'IN-PROCESS') : ?>
                                                    <button class="btn btn-secondary btn-sm fw-bold" type="button" onclick="editModal(<?= $row['No'] ?>)"> Edit</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Approved Modal -->
        <div class="modal fade" id="approvedModal" tabindex="-1" aria-labelledby="approvedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h1 class="modal-title fs-5" id="approvedModalLabel">Approved Request/s</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-nowrap">
                                <thead class="table-success">
                                    <tr>
                                        <th>Request No</th>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Approved By</th>
                                        <th>Approved Date</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($approvedResult as $row) : ?>
                                        <tr>
                                            <td><?= $row['No'] ?></td>
                                            <td><?= $row['Date_Received'] ?></td>
                                            <td><?= $row['Requestor'] ?></td>
                                            <td><?= $row['Project'] ?></td>
                                            <td><span class="badge badge-success"><?= $row['Status'] ?></span></td>
                                            <td><span class="badge badge-success"><?= $row['Approver_Name_1']; ?><?= $row['Approver_Name_2'] ? ', ' . $row['Approver_Name_2'] : ''; ?><?= $row['Approver_Name_3'] ? ', ' . $row['Approver_Name_3'] : ''; ?></span></td>
                                            <td><?= formatApprovalDate($row['Date_Approved_1']); ?></td>
                                            <td class="text-wrap"><?= $row['Remarks'] ?></td>
                                            <td><button class="btn btn-outline-primary btn-sm" type="button" onclick="viewModal(<?= $row['No'] ?>)"> View</button></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Disapproved Modal -->
        <div class="modal fade" id="disapprovedModal" tabindex="-1" aria-labelledby="disapprovedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h1 class="modal-title fs-5" id="disapprovedModalLabel">Disapproved Request/s</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-nowrap">
                                <thead class="table-danger">
                                    <tr>
                                        <th>Request No</th>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
                                        <th>Disapproved By</th>
                                        <th>Disapproved Date</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($disapprovedResult as $row) : ?>
                                        <tr>
                                            <td><?= $row['No'] ?></td>
                                            <td><?= $row['Date_Received'] ?></td>
                                            <td><?= $row['Requestor'] ?></td>
                                            <td><?= $row['Project'] ?></td>
                                            <td>
                                                <span class="badge badge-danger">
                                                    <?= $row['DisApprover_Name'] ?>
                                                </span>
                                            </td>
                                            <td><?= formatApprovalDate($row['Date_Approved_1']); ?></td>
                                            <td class="text-wrap"><?= $row['Remarks'] ?></td>
                                            <td>
                                                <button class="btn btn-outline-primary btn-sm" type="button" onclick="viewModal(<?= $row['No'] ?>)"> View</button>
                                                <button class="btn btn-primary btn-sm" type="button" onclick="returnNo(<?= htmlspecialchars(json_encode($row['No'])) ?>)">Resubmit</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Viewing Modal-->
        <div class="modal fade" id="viewModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-bg-primary">
                        <h1 class="modal-title fs-5 fw-bold" id="viewModalLabel"><i class="fa-regular fa-file-lines"></i> View Request Form</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-secondary-subtle">
                        <div class="row g-2 justify-content-between mb-2">
                            <div class="col-md-4 col-lg-2">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="date" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="date">Date Requested</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="name" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="name">Requestor</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-3 col-lg-2">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="projects" value="" readonly>
                                    <label class="form-label fw-bold text-dark text-black" for="projects">Project</label>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="SAP_No" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="SAP_No">SAP Number</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="Delta_PN" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="Delta_PN">Delta Part Number</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="desc" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="desc">Description</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-1">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="QPA" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="QPA">QPA</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-1">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="PR_Qty" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="PR_Qty">PR Qty</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="Purchase_Qty" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="Purchase_Qty">Purchase Qty</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-1 ">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="UOM" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="UOM">UOM</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2 ">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="Prev_price" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="Prev_price">Previous Price</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-1">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="Currency" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="Currency">Currency</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="PPV_Type" value="" readonly>
                                    <label class="form-label fw-bold text-dark" for="PPV_Type">PPV Type</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-outline" id="other_ppv_type">
                                    <input type="text" class="form-control bg-light" id="other_ppv_types" value="" readonly>
                                    <label class="form-label" for="other_ppv_types">please specify</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md-6 my-2">
                                <div class=" bg-secondary-subtle">
                                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Vendor 1</h5>
                                    <div class="row m-1 g-2 mb-2">
                                        <div class="col-md-6 ">
                                            <div class="form-outline">
                                                <input type="text" class="form-control bg-light" id="Current_Vendor" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="Current_Vendor">Current Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="Current_Vendor_Price" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="Current_Vendor_Price">Current Vendor Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="text" class="form-control bg-light" id="Currency_1" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="Currency_1">Currency</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="LT_1" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="LT_1">LT</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="SPQ_1" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="SPQ_1">SPQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="MOQ_1" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="MOQ_1">MOQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="Qty_to_Purchase_from_Vendor_1" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="Qty_to_Purchase_from_Vendor_1">Qty to Purchase from Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="Total_Amt_1" value="" readonly>
                                                <label class="form-label fw-bold text-dark" for="Total_Amt_1">Total Amt</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm col-md-6 my-2">
                                <div class=" bg-secondary-subtle" id="Vendor2">
                                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Vendor 2</h5>
                                    <div class="row m-1 g-2 mb-2">
                                        <div class="col-md-6 ">
                                            <div class="form-outline">
                                                <input type="text" class="form-control bg-light" id="New_Vendor" readonly>
                                                <label class="form-label fw-bold text-dark" for="New_Vendor">New Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="New_Vendor_Price" readonly>
                                                <label class="form-label fw-bold text-dark" for="New_Vendor_Price">New Vendor Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="text" class="form-control bg-light" id="Currency_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="Currency_2">Currency</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="LT_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="LT_2">LT</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="SPQ_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="SPQ_2">SPQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="MOQ_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="MOQ_2">MOQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="Qty_to_Purchase_from_Vendor_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="Qty_to_Purchase_from_Vendor_2">Qty to Purchase from Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="Total_Amt_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="Total_Amt_2">Total Amt</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 form-outline" id="theReason">
                                    <input type="text" class="form-control" id="Reason" autocomplete="FALSE" readonly>
                                    <label class="form-label fw-bold text-black" for="Reason">No Vendor 2</label>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col ms-2 mb-2">
                                    <div class="form-outline">
                                        <input type="text" class="form-control bg-light" id="Purchasing_Recom" readonly>
                                        <label class="form-label fw-bold text-dark" for="Purchasing_Recom">Purchasing Recommendation</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 d-none" id="remarks">
                                <div class="col ms-2 mb-2">
                                    <div class="form-outline">
                                        <input type="text" class="form-control bg-light text-danger fw-bold" id="remarksfromApprover" readonly>
                                        <label class="form-label fw-bold text-dark" for="remarksfromApprover">Remarks from Approver</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Modal-->
        <div class="modal fade" id="editModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-bg-primary">
                        <h1 class="modal-title fs-5 fw-bold" id="editModalLabel"><i class="fa-regular fa-file-lines"></i> Edit Request Form</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-secondary-subtle">
                        <div class="row g-2 justify-content-between mb-2">
                            <div class="col-md-8 col-lg-8">
                                <div class="row g-2">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-outline">
                                            <input type="text" class="form-control bg-light" id="edate" readonly>
                                            <label class="form-label fw-bold text-dark" for="date">Date Requested</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-outline">
                                            <input type="text" class="form-control bg-light" id="edate_updated" readonly>
                                            <label class="form-label fw-bold text-dark" for="date">Date Updated</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="ename" readonly>
                                    <label class="form-label fw-bold text-dark" for="name">Requestor</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-3 col-lg-2">
                                <select class="form-select bg-light fw-bold" name="projects" id="eprojects" required>
                                    <option selected disabled>Select Project</option>
                                    <option value="JLP">JLP</option>
                                    <option value="JLP CABLE">JLP CABLE</option>
                                    <option value="MTP">MTP</option>
                                    <option value="OLB">OLB</option>
                                    <option value="FLIPPER">FLIPPER</option>
                                    <option value="HIGHMAG">HIGHMAG</option>
                                    <option value="IONIZER">IONIZER</option>
                                    <option value="RCMTP">RCMTP</option>
                                    <option value="ECLIPSE XTA">ECLIPSE XTA</option>
                                    <option value="JTP">JTP</option>
                                    <option value="PNP">PNP</option>
                                    <option value="PNP CABLE">PNP CABLE</option>
                                    <option value="SWAP">SWAP</option>
                                    <option value="JRS">JRS</option>
                                    <option value="JRS CABLE">JRS CABLE</option>
                                    <!-- <option value="SPARES">SPARES</option> -->
                                </select>
                            </div>
                            <div class="col-md-5 col-lg-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="eSAP_No" readonly>
                                    <label class="form-label fw-bold text-dark" for="SAP_No">SAP Number</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="eDelta_PN" readonly>
                                    <label class="form-label fw-bold text-dark" for="Delta_PN">Delta Part Number</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="edesc" readonly>
                                    <label class="form-label fw-bold text-dark" for="desc">Description</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-1">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="eQPA" required>
                                    <label class="form-label fw-bold text-dark" for="QPA">QPA</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-1">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="ePR_Qty" required>
                                    <label class="form-label fw-bold text-dark" for="PR_Qty">PR Qty</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="ePurchase_Qty" required>
                                    <label class="form-label fw-bold text-dark" for="Purchase_Qty">Purchase Qty</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-1 ">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="eUOM" required>
                                    <label class="form-label fw-bold text-dark" for="UOM">UOM</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2 ">
                                <div class="form-outline">
                                    <input type="number" class="form-control bg-light" id="ePrev_price" required>
                                    <label class="form-label fw-bold text-dark" for="Prev_price">Previous Price</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <select class="form-select bg-light fw-bold" name="eCurrency" id="eCurrency" required>
                                    <option selected disabled>Select Currency</option>
                                    <option value="USD">USD</option>
                                    <option value="PHP">PHP</option>
                                    <option value="EURO">EURO</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <select class="form-select bg-light fw-bold" name="PPV_Type" id="ePPV_Type" required>
                                    <option selected disabled>Select PPV Type</option>
                                    <option value="MOQ SPQ">MOQ/SPQ</option>
                                    <option value="PRICE INCREASE">PRICE INCREASE</option>
                                    <option value="SPOT BUY">SPOT BUY</option>
                                    <option value="OTHERS">OTHERS</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-outline" id="eother_ppv_type">
                                    <input type="text" class="form-control bg-light" id="eother_ppv_types">
                                    <label class="form-label fw-bold text-dark" for="other_ppv_types">please specify</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md-6 my-2">
                                <div class=" bg-secondary-subtle">
                                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Vendor 1</h5>
                                    <div class="row m-1 g-2 mb-2">
                                        <div class="col-md-12">
                                            <div class="form-outline">
                                                <input type="text" class="form-control bg-light" id="eCurrent_Vendor" required>
                                                <label class="form-label fw-bold text-dark" for="Current_Vendor">Current Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eCurrent_Vendor_Price" required>
                                                <label class="form-label fw-bold text-dark" for="Current_Vendor_Price">Current Vendor Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select bg-light fw-bold" name="eCurrency_1" id="eCurrency_1" required>
                                                <option selected disabled>Select Currency</option>
                                                <option value="USD">USD</option>
                                                <option value="PHP">PHP</option>
                                                <option value="EURO">EURO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eLT_1" required>
                                                <label class="form-label fw-bold text-dark" for="LT_1">LT</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eSPQ_1" required>
                                                <label class="form-label fw-bold text-dark" for="SPQ_1">SPQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eMOQ_1" required>
                                                <label class="form-label fw-bold text-dark" for="MOQ_1">MOQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eQty_to_Purchase_from_Vendor_1" required>
                                                <label class="form-label fw-bold text-dark" for="Qty_to_Purchase_from_Vendor_1">Qty to Purchase from Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eTotal_Amt_1" readonly>
                                                <label class="form-label fw-bold text-dark" for="Total_Amt_1">Total Amt</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm col-md-6 my-2">
                                <div class=" bg-secondary-subtle" id="eVendor2">
                                    <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Vendor 2</h5>
                                    <div class="row m-1 g-2 mb-2">
                                        <div class="col-md-12">
                                            <div class="form-outline">
                                                <input type="text" class="form-control bg-light" id="eNew_Vendor" required>
                                                <label class="form-label fw-bold text-dark" for="New_Vendor">New Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eNew_Vendor_Price" required>
                                                <label class="form-label fw-bold text-dark" for="New_Vendor_Price">New Vendor Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select bg-light fw-bold" name="eCurrency_2" id="eCurrency_2" required>
                                                <option selected disabled>Select Currency</option>
                                                <option value="USD">USD</option>
                                                <option value="PHP">PHP</option>
                                                <option value="EURO">EURO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eLT_2" required>
                                                <label class="form-label fw-bold text-dark" for="LT_2">LT</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eSPQ_2" required>
                                                <label class="form-label fw-bold text-dark" for="SPQ_2">SPQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eMOQ_2" required>
                                                <label class="form-label fw-bold text-dark" for="MOQ_2">MOQ</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eQty_to_Purchase_from_Vendor_2" required>
                                                <label class="form-label fw-bold text-dark" for="Qty_to_Purchase_from_Vendor_2">Qty to Purchase from Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <input type="number" class="form-control bg-light" id="eTotal_Amt_2" readonly>
                                                <label class="form-label fw-bold text-dark" for="Total_Amt_2">Total Amt</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 form-outline" id="etheReason">
                                    <input type="text" class="form-control" id="eReason" autocomplete="FALSE" required>
                                    <label class="form-label fw-bold text-black" for="Reason">No Vendor 2</label>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col ms-2 mb-2">
                                    <div class="form-outline">
                                        <input type="text" class="form-control bg-light" id="ePurchasing_Recom" value="<?= $Purchasing_Recom; ?>" required>
                                        <label class="form-label fw-bold text-dark" for="Purchasing_Recom">Purchasing Recommendation</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary fw-bold" data-bs-dismiss="modal" id="updateBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // View request
            function viewModal(No) {
                $.ajax({
                    url: "../controllers/ppv_data.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        No: No
                    },
                    success: function(response) {
                        $("#date").val(response.Date_Received);
                        $("#name").val(response.Requestor);
                        $("#projects").val(response.Project);
                        $("#SAP_No").val(response.SAP_PN);
                        $("#Delta_PN").val(response.Delta_PN);
                        $("#desc").val(response.Description);
                        $("#QPA").val(response.QPA);
                        $("#PR_Qty").val(response.PR_Qty);
                        $("#Purchase_Qty").val(response.Purchase_Qty);
                        $("#UOM").val(response.UoM);
                        $("#Prev_price").val(response.Prev_Price);
                        $("#Currency").val(response.Currency);
                        $("#PPV_Type").val(response.PPV_Type);
                        $("#other_ppv_types").val(response.other_ppv_type);

                        // Vendor 1
                        $("#Current_Vendor").val(response.Current_Vendor);
                        $("#Current_Vendor_Price").val(response.New_Price_1);
                        $("#Currency_1").val(response.Currency_1);
                        $("#LT_1").val(response.LT_1);
                        $("#SPQ_1").val(response.SPQ_1);
                        $("#MOQ_1").val(response.MOQ_1);
                        $("#Qty_to_Purchase_from_Vendor_1").val(response.Qty2PurchasetoVendor_1);
                        $("#Total_Amt_1").val(response.Total_Amt_1);
                        // console.log(response.New_Vendor);
                        // Vendor 2
                        if (response.New_Vendor !== null && response.New_Vendor.trim() !== '') {
                            $("#New_Vendor").val(response.New_Vendor);
                            $("#New_Vendor_Price").val(response.New_Price_2);
                            $("#Currency_2").val(response.Currency_2);
                            $("#LT_2").val(response.LT_2);
                            $("#SPQ_2").val(response.SPQ_2);
                            $("#MOQ_2").val(response.MOQ_2);
                            $("#Qty_to_Purchase_from_Vendor_2").val(response.Qty2PurchasetoVendor_2);
                            $("#Total_Amt_2").val(response.Total_Amt_2);
                            $("#Vendor2").show(); // Show the Vendor2 element
                            $("#theReason").hide();
                        } else {
                            // Hide the Vendor2 element if New_Vendor is empty or null
                            $("#Vendor2").hide();
                            $("#Reason").val(response.reason);
                            $("#theReason").show();
                        }
                        $("#Purchasing_Recom").val(response.Purchasing_Recom);
                        let isDisapproved = response.DisApproved;

                        if (isDisapproved) {
                            $("#remarks").removeClass("d-none");
                            $("#remarksfromApprover").val(response.Remarks);
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
                        // Show the modal
                        $("#viewModal").modal("show");
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax request failed with status: " + status);
                    }
                });
            }

            // Edit request
            function editModal(No) {

                // Initially hide the "other_ppv_type" input field
                $("#eother_ppv_type").hide();

                // Listen for changes in the "PPV_Type" dropdown
                $("#ePPV_Type").change(function() {
                    // Check if "OTHERS" is selected
                    if ($(this).val() === "OTHERS") {
                        // Show the "other_ppv_type" input field
                        $("#eother_ppv_type").show();
                    } else {
                        // Hide the "other_ppv_type" input field if any other option is selected
                        $("#eother_ppv_type").hide();
                    }
                });
                // Add event listeners to the input fields
                $("#eCurrent_Vendor_Price, #eQty_to_Purchase_from_Vendor_1").on(
                    "input",
                    function() {
                        // Get the values from the input fields
                        var currentVendorPrice = parseFloat($("#eCurrent_Vendor_Price").val()) || 0;
                        console.log(currentVendorPrice);
                        var qtyToPurchaseFromVendor =
                            parseFloat($("#eQty_to_Purchase_from_Vendor_1").val()) || 0;
                        console.log(qtyToPurchaseFromVendor);
                        // Calculate the total amount
                        var totalAmt = currentVendorPrice * qtyToPurchaseFromVendor;

                        // Update the Total_Amt field
                        $("#eTotal_Amt_1").val(totalAmt.toFixed(2)); // Display the total amount with 2 decimal places
                    }
                );
                // Add event listeners to the input fields
                $("#eNew_Vendor_Price, #eQty_to_Purchase_from_Vendor_2").on("input", function() {
                    // Get the values from the input fields
                    var NewVendorPrice = parseFloat($("#eNew_Vendor_Price").val()) || 0;
                    var qtyToPurchaseFromVendor2 =
                        parseFloat($("#eQty_to_Purchase_from_Vendor_2").val()) || 0;
                    // Calculate the total amount
                    var totalAmt2 = NewVendorPrice * qtyToPurchaseFromVendor2;

                    // Update the Total_Amt field
                    $("#eTotal_Amt_2").val(totalAmt2.toFixed(2)); // Display the total amount with 2 decimal places
                });
                // Get the current date and time
                var currentDateTime = new Date();

                // Format the date and time as a string
                var dateTimeString = currentDateTime.toLocaleString();
                $("#edate_updated").val(dateTimeString);

                $('#updateBtn').on('click', function(e) {
                    e.preventDefault();
                    // Show a SweetAlert confirmation dialog
                    Swal.fire({
                        title: "Edit Confirmation",
                        text: "Are you sure you want to Edit this request?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Proceed",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "../controllers/ppv_data.php",
                                data: {
                                    updatePPV: true,
                                    PPVNo: No,
                                    Date_Updated: $("#edate_updated").val(),
                                    Project: $("#eprojects").val(),
                                    QPA: $("#eQPA").val(),
                                    PR_Qty: $("#ePR_Qty").val(),
                                    Purchase_Qty: $("#ePurchase_Qty").val(),
                                    UoM: $("#eUOM").val(),
                                    Prev_Price: $("#ePrev_price").val(),
                                    Currency: $("#eCurrency").val(),
                                    PPV_Type: $("#ePPV_Type").val(),
                                    // Vendor 1
                                    Current_Vendor: $("#eCurrent_Vendor").val(),
                                    Current_Vendor_Price: $("#eCurrent_Vendor_Price").val(),
                                    Currency_1: $("#eCurrency_1").val(),
                                    LT1: $("#eLT_1").val(),
                                    SPQ1: $("#eSPQ_1").val(),
                                    MOQ1: $("#eMOQ_1").val(),
                                    Qty_to_Purchase_from_Vendor1: $("#eQty_to_Purchase_from_Vendor_1").val(),
                                    Total_Amt1: $("#eTotal_Amt_1").val(),
                                    // Vendor 2
                                    New_Vendor: $("#eNew_Vendor").val(),
                                    New_Price: $("#eNew_Vendor_Price").val(),
                                    Currency_2: $("#eCurrency_2").val(),
                                    LT2: $("#eLT_2").val(),
                                    SPQ2: $("#eSPQ_2").val(),
                                    MOQ2: $("#eMOQ_2").val(),
                                    Qty_to_Purchase_from_Vendor2: $("#eQty_to_Purchase_from_Vendor_2").val(),
                                    Total_Amt2: $("#eTotal_Amt_2").val(),
                                    Purchasing_Recom: $("#ePurchasing_Recom").val(),
                                    Reason: $("#eReason").val(),
                                    other_ppv_type: $("#eother_ppv_types").val()
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    console.log(response);
                                    if (response.success) {
                                        Swal.fire({
                                            title: "Success",
                                            text: response.message,
                                            icon: "success"
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Error",
                                            text: response.message,
                                            icon: "error"
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Ajax request failed with status: " + status);
                                    Swal.fire({
                                        title: "Error",
                                        text: "An error occurred while processing your request.",
                                        icon: "error"
                                    });
                                }
                            });
                        }
                    });
                });
                // Ajax request
                $.ajax({
                    url: "../controllers/ppv_data.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        No: No
                    },
                    success: function(response) {
                        $("#edate").val(response.Date_Received);
                        $("#ename").val(response.Requestor);
                        $("#eprojects").val(response.Project);
                        $("#eSAP_No").val(response.SAP_PN);
                        $("#eDelta_PN").val(response.Delta_PN);
                        $("#edesc").val(response.Description);
                        $("#eQPA").val(response.QPA);
                        $("#ePR_Qty").val(response.PR_Qty);
                        $("#ePurchase_Qty").val(response.Purchase_Qty);
                        $("#eUOM").val(response.UoM);
                        $("#ePrev_price").val(response.Prev_Price);
                        $("#eCurrency").val(response.Currency);
                        $("#ePPV_Type").val(response.PPV_Type);
                        $("#eother_ppv_types").val(response.other_ppv_type);

                        // Vendor 1
                        $("#eCurrent_Vendor").val(response.Current_Vendor);
                        $("#eCurrent_Vendor_Price").val(response.New_Price_1);
                        $("#eCurrency_1").val(response.Currency_1);
                        $("#eLT_1").val(response.LT_1);
                        $("#eSPQ_1").val(response.SPQ_1);
                        $("#eMOQ_1").val(response.MOQ_1);
                        $("#eQty_to_Purchase_from_Vendor_1").val(response.Qty2PurchasetoVendor_1);
                        $("#eTotal_Amt_1").val(response.Total_Amt_1);
                        // console.log(response.New_Vendor);
                        // Vendor 2
                        if (response.New_Vendor !== '') {
                            $("#eNew_Vendor").val(response.New_Vendor);
                            $("#eNew_Vendor_Price").val(response.New_Price_2);
                            $("#eCurrency_2").val(response.Currency_2);
                            $("#eLT_2").val(response.LT_2);
                            $("#eSPQ_2").val(response.SPQ_2);
                            $("#eMOQ_2").val(response.MOQ_2);
                            $("#eQty_to_Purchase_from_Vendor_2").val(response.Qty2PurchasetoVendor_2);
                            $("#eTotal_Amt_2").val(response.Total_Amt_2);
                            $("#eVendor2").show(); // Show the Vendor2 element
                            $("#etheReason").hide();
                        } else {
                            // Hide the Vendor2 element if New_Vendor is empty or null
                            $("#eVendor2").hide();
                            $("#eReason").val(response.reason);
                            $("#etheReason").show();
                        }
                        $("#ePurchasing_Recom").val(response.Purchasing_Recom);
                        // Initially hide the "other_ppv_type" input field
                        $("#eother_ppv_type").hide();
                        let PPV_type = $("#ePPV_Type").val();

                        if (PPV_type === "OTHERS") {
                            // Show the "other_ppv_type" input field
                            $("#eother_ppv_type").show();
                        } else {
                            // Hide the "other_ppv_type" input field if any other option is selected
                            $("#eother_ppv_type").hide();
                        }
                        // Show the modal
                        $("#editModal").modal("show");
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax request failed with status: " + status);
                    }
                });
            }

            // Delete request
            function deleteNo(No) {
                // Show a SweetAlert confirmation dialog
                Swal.fire({
                    title: "Delete Confirmation",
                    text: "Are you sure you want to delete this request?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Proceed",
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "../controllers/req_commands.php",
                            method: "POST",
                            data: {
                                No: No,
                                delete: true
                            },
                            dataType: "json", // Make sure to specify JSON data type
                            success: function(response) {
                                if (response.success) {
                                    // Successful deletion
                                    Swal.fire({
                                        title: "Success",
                                        text: response.message,
                                        icon: "success"
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    // Error during deletion
                                    Swal.fire({
                                        title: "Error",
                                        text: response.message,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Ajax request failed with status: " + status);
                                Swal.fire({
                                    title: "Error",
                                    text: "An error occurred while processing your request.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            }

            // Resubmit request
            function returnNo(No) {
                // Navigate to a new page and pass the ID as a parameter
                window.location.href = "bc_requestor.php?No=" + encodeURIComponent(No);
            }

            // Search part number
            $(document).ready(function() {
                $('#partNumberSearch').on('input', function() {
                    const searchTerm = $(this).val().toLowerCase();

                    $('#pendingTable tbody tr').each(function() {
                        const partNumber = $(this).find('td:eq(4)').text().toLowerCase(); // Adjust the index if needed

                        if (partNumber.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
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