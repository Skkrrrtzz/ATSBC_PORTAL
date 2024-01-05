<?php require_once 'bc_nav.php';
include_once '../controllers/approver_dashboard_data.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approver Dashboard</title>
</head>

<body class="bg-light">
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card shadow bg-warning border-3 border-warning-subtle">
                    <div class="card-body" type="button" data-mdb-toggle="modal" data-mdb-target="#pendingModal">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fa-solid fa-circle-exclamation fa-3x text-white"></i>
                            </div>
                            <div class="col mr-2">
                                <div class="text-white text-end">
                                    <h4 class="fs-1"><?php echo $pending; ?></h4>
                                </div>
                                <div class="text-end text-white">
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
                                <div class="text-end text-white">
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
                                    <h4 class="fs-1"><?= $disapproved ?></h4>
                                </div>
                                <div class="text-end text-white">
                                    <h4 class="fs-6">Disapproved</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-6 my-2">
                <div class="card ">
                    <div class="card-body">
                        <h6 class="card-title text-primary fw-bold">Summary per module</h6>
                        <canvas id="sumPermodule"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Content per module Modal -->
    <div class="modal fade" id="sumpermoduleModal" tabindex="-1" aria-labelledby="sumpermoduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-bg-primary">
                    <h5 class="modal-title" id="modal_product"></h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="col-xl-12">
                            <canvas id="ppvTypeChart"></canvas>
                        </div>
                        <!-- <div class="col-xl-12">
                            <canvas id="varianceVsQBOMChart"></canvas>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer bg-light">
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
                    <div class="d-flex justify-content-end">
                        <div class="form-group my-auto">
                            <label for="partNumberSearch2" class="form-label fw-bold">Search by Part Number: </label>
                        </div>
                        <div class="form-group mb-2 my-auto">
                            <input type="text" class="form-control" id="partNumberSearch2" placeholder="Enter Part Number">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-nowrap" id="approvedTable">
                            <thead class="table-success">
                                <tr>
                                    <th>Request No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Project</th>
                                    <th>Part Number</th>
                                    <th>Approver</th>
                                    <th>Approved Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($approved_result as $row) : ?>
                                    <tr>
                                        <td><?= $row['No'] ?></td>
                                        <td><?= $row['Date_Received'] ?></td>
                                        <td><?= $row['Requestor'] ?></td>
                                        <td><?= $row['Project'] ?></td>
                                        <td><?= $row['Delta_PN'] ?></td>
                                        <td>
                                            <span class="badge badge-success">
                                                <?= $row['Approver_Name_1']; ?><?= $row['Approver_Name_2'] ? ', ' . $row['Approver_Name_2'] : ''; ?><?= $row['Approver_Name_3'] ? ', ' . $row['Approver_Name_3'] : ''; ?>
                                            </span>
                                        </td>

                                        <?php if ($Role === 'Approver 1') : ?>
                                            <td>
                                                <?= formatApprovalDate($row['Date_Approved_1']); ?>
                                            </td>
                                        <?php elseif ($Role === 'Approver 2') : ?>
                                            <td>
                                                <?= formatApprovalDate($row['Date_Approved_2']); ?>
                                            </td>
                                        <?php elseif ($Role === 'Approver 3') : ?>
                                            <td>
                                                <?= formatApprovalDate($row['Date_Approved_3']); ?>
                                            </td>
                                        <?php else :
                                            $dates = [$row['Date_Approved_1'], $row['Date_Approved_2'], $row['Date_Approved_3']];

                                            $nonEmptyDates = array_filter($dates, function ($date) {
                                                return !empty($date);
                                            });

                                            $dateApproved = implode(', ', array_map('formatApprovalDate', $nonEmptyDates));
                                        ?>
                                            <td>
                                                <?= formatApprovalDate($dateApproved); ?>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <i class="fa-solid fa-eye fa-2x text-primary" type="button" onclick="viewModal(<?= $row['No'] ?>)"></i>
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
    <!-- Pending Modal -->
    <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h1 class="modal-title fs-5" id="pendingModalLabel">Pending Request/s</h1>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <div class="form-group my-auto">
                            <label for="partNumberSearch1" class="form-label fw-bold">Search by Part Number: </label>
                        </div>
                        <div class="form-group mb-2 my-auto">
                            <input type="text" class="form-control" id="partNumberSearch1" placeholder="Enter Part Number">
                        </div>
                    </div>
                    <div class="table-responsive rounded-1">
                        <table class="table table-bordered table-sm text-nowrap" id="pendingTable">
                            <thead class="table-warning">
                                <tr>
                                    <th>Request No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Project</th>
                                    <th>Part Number</th>
                                    <th>Status</th>
                                    <th>Approver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_result as $row) : ?>
                                    <tr>
                                        <td><?= $row['No'] ?></td>
                                        <td><?= $row['Date_Received'] ?></td>
                                        <td><?= $row['Requestor'] ?></td>
                                        <td><?= $row['Project'] ?></td>
                                        <!-- <td><?= $row['Delta_PN'] ?></td> -->
                                        <td class="deltaPN-row" data-id="<?= $row['Delta_PN'] ?>">
                                            <?= $row['Delta_PN'] ?>
                                        </td>
                                        <td><span class="badge badge-success"><?= $row['Status'] ?></span></td>

                                        <?php
                                        $approverName = '';
                                        $showButton = false;

                                        if ($Role === 'Approver 1') {
                                            $approverName = $row['Approver_Name_1'];
                                            $showButton = empty($row['Status']) || ($row['Status'] == 'IN-PROCESS' && $row['Approver_Name_1'] == $Name);
                                        } elseif ($Role === 'Approver 2') {
                                            $approverName = $row['Approver_Name_2'];
                                            $showButton = $row['Status'] == 'IN-PROCESS' || $row['Approver_Name_2'] == $Name;
                                        } elseif ($Role === 'Approver 3') {
                                            $approverName = $row['Approver_Name_3'];
                                            $showButton = $row['Status'] == 'IN-PROCESS' || $row['Approver_Name_3'] == $Name;
                                        }
                                        ?>

                                        <td><span class="badge badge-success"><?= $approverName ?></span></td>
                                        <td>
                                            <?php if ($showButton) : ?>
                                                <button class="btn btn-outline-primary btn-sm" data-mdb-ripple-color="dark" data-id="<?= $row['No'] ?>" onclick="viewStatus(this)">View</button>
                                            <?php else : ?>
                                                <i class="fa-solid fa-eye fa-2x text-primary" type="button" onclick="viewModal(<?= $row['No'] ?>)"></i>
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
    <!-- Disapproved Modal -->
    <div class="modal fade" id="disapprovedModal" tabindex="-1" aria-labelledby="disapprovedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h1 class="modal-title fs-5" id="disapprovedModalLabel">Disapproved Request/s</h1>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <div class="form-group my-auto">
                            <label for="partNumberSearch3" class="form-label fw-bold">Search by Part Number: </label>
                        </div>
                        <div class="form-group mb-2 my-auto">
                            <input type="text" class="form-control" id="partNumberSearch3" placeholder="Enter Part Number">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-nowrap" id="disapprovedTable">
                            <thead class="table-danger">
                                <tr>
                                    <th>Request No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Project</th>
                                    <th>Part Number</th>
                                    <th>Disapproved by</th>
                                    <th>Disapproved Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($disapproved_result as $row) : ?>
                                    <tr>
                                        <td><?= $row['No'] ?></td>
                                        <td><?= $row['Date_Received'] ?></td>
                                        <td><?= $row['Requestor'] ?></td>
                                        <td><?= $row['Project'] ?></td>
                                        <td><?= $row['Delta_PN'] ?></td>

                                        <?php if ($Role === 'Approver 1') : ?>
                                            <td>
                                                <?php if ($row['DisApproved']) : ?>
                                                    <span class="badge badge-danger">
                                                        <!-- Add your checkmark icon here -->
                                                        <?= $row['DisApprover_Name'] ?>
                                                    </span>
                                                <?php else : ?>
                                                    <!-- Display something else if it's not true, or leave it empty -->
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= formatApprovalDate($row['Date_Approved_1']); ?>
                                            </td>
                                        <?php elseif ($Role === 'Approver 2') : ?>

                                            <td>
                                                <?php if ($row['DisApproved']) : ?>
                                                    <span class="badge badge-danger">
                                                        <!-- Add your checkmark icon here -->
                                                        <?= $row['DisApprover_Name'] ?>
                                                    </span>
                                                <?php else : ?>
                                                    <!-- Display something else if it's not true, or leave it empty -->
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= formatApprovalDate($row['Date_Approved_2']); ?>
                                            </td>
                                        <?php elseif ($Role === 'Approver 3') : ?>
                                            <td>
                                                <?php if ($row['DisApproved']) : ?>
                                                    <span class="badge badge-danger">
                                                        <!-- Add your checkmark icon here -->
                                                        <?= $row['DisApprover_Name'] ?>
                                                    </span>
                                                <?php else : ?>
                                                    <!-- Display something else if it's not true, or leave it empty -->
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= formatApprovalDate($row['Date_Approved_3']); ?>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <?php if ($row['DisApproved']) : ?>
                                                    <span class="badge badge-danger">
                                                        <!-- Add your checkmark icon here -->
                                                        <?= $row['DisApprover_Name'] ?>
                                                    </span>
                                                <?php else : ?>
                                                    <!-- Display something else if it's not true, or leave it empty -->
                                                <?php endif; ?>
                                            </td>
                                            <?php
                                            $disdates = [$row['Date_Approved_1'], $row['Date_Approved_2'], $row['Date_Approved_3']];

                                            $nonEmptyDates = array_filter($disdates, function ($date) {
                                                return !empty($date);
                                            });

                                            $dateDisApproved = implode(', ', array_map('formatApprovalDate', $nonEmptyDates));
                                            ?>
                                            <td>
                                                <?= formatApprovalDate($dateDisApproved); ?>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <i class="fa-solid fa-eye fa-2x text-primary" type="button" onclick="viewModal(<?= $row['No'] ?>)"></i>
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
                    <h1 class="modal-title fs-5 fw-bold" id="viewRequest"></h1>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-secondary-subtle">
                    <div class="row g-2 justify-content-between mb-2">
                        <div class="col-md-4 col-lg-2">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="date" readonly>
                                <label class="form-label fw-bold text-dark" for="date">Date Requested</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="name" readonly>
                                <label class="form-label fw-bold text-dark" for="name">Requestor</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-3 col-lg-2">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="projects" readonly>
                                <label class="form-label fw-bold text-dark text-black" for="projects">Project</label>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-3">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="SAP_No" readonly>
                                <label class="form-label fw-bold text-dark" for="SAP_No">SAP Number</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="Delta_PN" readonly>
                                <label class="form-label fw-bold text-dark" for="Delta_PN">Delta Part Number</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="desc" readonly>
                                <label class="form-label fw-bold text-dark" for="desc">Description</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-light" id="QPA" readonly>
                                <label class="form-label fw-bold text-dark" for="QPA">QPA</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-light" id="PR_Qty" readonly>
                                <label class="form-label fw-bold text-dark" for="PR_Qty">PR Qty</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-light" id="Purchase_Qty" readonly>
                                <label class="form-label fw-bold text-dark" for="Purchase_Qty">Purchase Qty</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-1 ">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="UOM" readonly>
                                <label class="form-label fw-bold text-dark" for="UOM">UOM</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 ">
                            <div class="form-outline">
                                <input type="number" class="form-control bg-light" id="Prev_price" readonly>
                                <label class="form-label fw-bold text-dark" for="Prev_price">Previous Price</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-1">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="Currency" readonly>
                                <label class="form-label fw-bold text-dark" for="Currency">Currency</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="PPV_Type" readonly>
                                <label class="form-label fw-bold text-dark" for="PPV_Type">PPV Type</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-outline" id="other_ppv_type">
                                <input type="text" class="form-control bg-light" id="other_ppv_types" readonly>
                                <label class="form-label" for="other_ppv_types">please specify</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm col-md-6 my-2" id="Vendor1">
                            <div class=" bg-secondary-subtle">
                                <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Vendor 1</h5>
                                <div class="row m-1 g-2 mb-2">
                                    <div class="col-md-6 ">
                                        <div class="form-outline">
                                            <input type="text" class="form-control bg-light" id="Current_Vendor" readonly>
                                            <label class="form-label fw-bold text-dark" for="Current_Vendor">Current Vendor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Current_Vendor_Price" readonly>
                                            <label class="form-label fw-bold text-dark" for="Current_Vendor_Price">Current Vendor Price</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-outline">
                                            <input type="text" class="form-control bg-light" id="Currency_1" readonly>
                                            <label class="form-label fw-bold text-dark" for="Currency_1">Currency</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="LT_1" readonly>
                                            <label class="form-label fw-bold text-dark" for="LT_1">LT</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="SPQ_1" readonly>
                                            <label class="form-label fw-bold text-dark" for="SPQ_1">SPQ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="MOQ_1" readonly>
                                            <label class="form-label fw-bold text-dark" for="MOQ_1">MOQ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Qty_to_Purchase_from_Vendor_1" readonly>
                                            <label class="form-label fw-bold text-dark" for="Qty_to_Purchase_from_Vendor_1">Qty to Purchase from Vendor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Total_Amt_1" readonly>
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
                                <label class="form-label fw-bold text-black" for="Reason">Reason</label>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="Purchasing_Recom" readonly>
                                <label class="form-label fw-bold text-dark" for="Purchasing_Recom">Purchasing Recommendation</label>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-2" id="BCA">
                        <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Business Control Analysis</h5>
                        <div class="row">
                            <div class="col-md-12 col-lg-8">
                                <div class="row g-2 mb-2">
                                    <div class="col-sm-4 col-md-6 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="QBOM_Unit_Price" readonly>
                                            <label class="form-label fw-bold text-dark" for="QBOM_Unit_Price">QBOM Unit Price</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-6 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Total_QBOM_Price" readonly>
                                            <label class="form-label fw-bold text-dark">Total QBOM Price </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Conversion_Rate_Vendor_1" readonly>
                                            <label class="form-label fw-bold text-dark">Conversion Rate Vendor 1 </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Vendor_1_Converted_Price" readonly>
                                            <label class="form-label fw-bold text-dark">Vendor 1 Converted Price </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Vendor_1_Variance_VS_QBOM" readonly>
                                            <label class="form-label fw-bold text-dark">Vendor 1 Variance VS QBOM </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2" id="CRV_2">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Conversion_Rate_Vendor_2" readonly>
                                            <label class="form-label fw-bold text-dark">Conversion Rate Vendor 2 </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Vendor_2_Converted_Price" readonly>
                                            <label class="form-label fw-bold text-dark">Vendor 2 Converted Price </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-outline">
                                            <input type="number" class="form-control bg-light" id="Vendor_2_Variance_VS_QBOM" readonly>
                                            <label class="form-label fw-bold text-dark">Vendor 2 Variance VS QBOM </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="row g-2 mb-2">
                                    <div class="col-sm-4 col-md-6 col-lg-12" id="C2C">
                                        <div class="form-outline">
                                            <input type="text" class="form-control bg-light" id="Chargable_to_Customer" readonly>
                                            <label class="form-label fw-bold text-dark">Chargeable to Customer </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-12" id="CCP">
                                    <div class="form-outline">
                                        <input type="text" class="form-control bg-light" id="Remarks_from_CCP_analyst" readonly>
                                        <label class="form-label fw-bold text-dark">Remarks from CCP Analyst </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-2" id="APV">
                        <h5 class="fw-bold text-bg-primary border-bottom border-2 border-dark ps-2 rounded-top"> Approval</h5>
                        <div class="row g-2 mb-2">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="Business_Control_Recommendation" readonly>
                                    <label class="form-label fw-bold text-dark" for="Business_Control_Recommendation">Business Control Recommendation</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="Variance_VS_QBOM_Price" readonly>
                                    <label class="form-label fw-bold text-dark" for="Variance_VS_QBOM_Price">Variance VS QBOM Price</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control bg-light" id="Status" readonly>
                                    <label class="form-label fw-bold text-dark" for="Status">Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" class="form-control bg-light" id="Remarks" readonly>
                                <label class="form-label fw-bold text-dark" for="Remarks">Remarks</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/Chart.js"></script>
    <script src="../assets/js/chartjs-plugin-datalabels.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "../controllers/get_ppv_data.php",
                data: {
                    PPV: true
                },
                dataType: "JSON",
                success: function(response) {
                    // Your data for the bar chart
                    const currentDate = new Date();
                    const currentMonth = currentDate.toLocaleString("default", {
                        month: "short",
                    });
                    // Define an array of colors for each dataset
                    const datasetColors = [
                        "#2587ff",
                        "#444e86",
                        "#955196",
                        "#dd5182",
                        "#ff6e54",
                        "#ffa600",
                    ];
                    // Group response data by project and calculate the sum of variance_vs_qbomprice for each project
                    const groupedData = response.reduce((accumulator, current) => {
                        const project = current.project;
                        const variance = parseFloat(current.variance_vs_qbomprice);

                        if (!accumulator[project]) {
                            accumulator[project] = 0;
                        }

                        // console.log(`Adding ${variance} to ${project}. Current sum: ${accumulator[project]}`);
                        accumulator[project] += variance;

                        return accumulator;
                    }, {});

                    // Round the sums to two decimal places
                    for (const project in groupedData) {
                        if (groupedData.hasOwnProperty(project)) {
                            groupedData[project] = parseFloat(groupedData[project]).toFixed(2);
                        }
                    }

                    // Log the final groupedData
                    // console.log('Final groupedData:', groupedData);


                    // Create an array to hold datasets for each project
                    const datasets = Object.entries(groupedData).map(
                        ([project, sumVariance], index) => {
                            return {
                                label: project,
                                data: [sumVariance],
                                backgroundColor: datasetColors[index],
                                borderColor: datasetColors[index],
                                borderWidth: 1,
                            };
                        }
                    );

                    // Get the canvas element
                    const ctx = document.getElementById("sumPermodule").getContext("2d");

                    // Create the bar chart
                    const myBarChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: [currentMonth],
                            datasets: datasets,
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                            layout: {
                                padding: {
                                    top: 30,
                                },
                            },
                            plugins: {
                                datalabels: {
                                    anchor: "end",
                                    align: "end",
                                    color: "black",
                                    font: {
                                        weight: "bold",
                                    },
                                    formatter: (value, context) => {
                                        return "$" + value;
                                    },
                                },
                                legend: {
                                    labels: {
                                        font: {
                                            weight: "bold",
                                        },
                                    },
                                    position: "bottom",
                                },
                            },
                        },
                        plugins: [ChartDataLabels],
                    });

                    // Group data by project and PPV_Type
                    const grpData = response.reduce((acc, item) => {
                        const key = `${item.project}_${item.PPV_Type}`;
                        acc[key] = (acc[key] || 0) + parseFloat(item.variance_vs_qbomprice);
                        return acc;
                    }, {});

                    // Extract unique labels from the grouped data
                    const uniqueLabels = Object.keys(grpData);

                    // PPV Type Chart
                    const ppvTypeChartCanvas = document.getElementById("ppvTypeChart").getContext("2d");
                    const ppvTypeChart = new Chart(ppvTypeChartCanvas, {
                        type: "bar",
                        data: {
                            labels: uniqueLabels.map(label => label.split('_').join(' - ')), // Use a separator for project and PPV_Type
                            datasets: [{
                                label: "Sum of Vendor 1 VarianceVSQBOM",
                                data: uniqueLabels.map(label => grpData[label]),
                                backgroundColor: "rgba(75, 192, 192, 0.5)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                            layout: {
                                padding: {
                                    top: 30,
                                },
                            },
                            plugins: {
                                datalabels: {
                                    anchor: "end",
                                    align: "end",
                                    color: "black",
                                    font: {
                                        weight: "bold",
                                    },
                                    formatter: (value, context) => {
                                        return "$" + value;
                                    },
                                },
                                legend: {
                                    labels: {
                                        font: {
                                            weight: "bold",
                                        },
                                    },
                                    position: "bottom",
                                },
                            },
                        },
                        plugins: [ChartDataLabels],
                    });
                    // Function to update ppvTypeChart based on selected project
                    function updatePpvTypeChart(selectedProject) {
                        const filteredData = response.filter(item => item.project === selectedProject);

                        // Group filtered data by project and PPV_Type
                        const grpData = filteredData.reduce((acc, item) => {
                            const key = `${item.project}_${item.PPV_Type}`;
                            acc[key] = (acc[key] || 0) + parseFloat(item.variance_vs_qbomprice);
                            return acc;
                        }, {});

                        // Extract unique PPV_Type values from the grouped data
                        const uniquePPVTypes = [...new Set(filteredData.map(item => item.PPV_Type))];

                        // Update ppvTypeChart data and labels
                        ppvTypeChart.data.labels = uniquePPVTypes;
                        ppvTypeChart.data.datasets[0].data = uniquePPVTypes.map(ppvType => parseFloat(grpData[`${selectedProject}_${ppvType}`]).toFixed(2));

                        // Update the chart
                        ppvTypeChart.update();
                    }
                    // Add click event listener to the "sumPermodule" chart
                    document.getElementById("sumPermodule").onclick = function(event) {
                        const activePoints = myBarChart.getElementsAtEventForMode(
                            event,
                            "nearest", {
                                intersect: true
                            },
                            false
                        );

                        if (activePoints.length > 0) {
                            const clickedDatasetIndex = activePoints[0].datasetIndex;

                            if (myBarChart.data.datasets[clickedDatasetIndex]) {
                                const clickedProject = myBarChart.data.datasets[clickedDatasetIndex].label;

                                console.log(`Project clicked: ${clickedProject}`);

                                // Update the ppvTypeChart based on the selected project
                                updatePpvTypeChart(clickedProject);

                                // Display the modal
                                showModal(clickedProject);
                            }
                        }
                    };

                },
            });

            function showModal(product, value) {
                // Implement this function to display a modal with the clicked product and value
                console.log(`Showing modal for ${product} with value ${value}`);
            }

            function showModal(product, value) {
                // Replace this with your modal display logic (e.g., show a Bootstrap modal)
                $("#sumpermoduleModal").modal("show");

                // You can also update the modal content based on the clicked data
                $("#modal_product").html(`${product}`);
            }

            // // Function to display the modal (replace this with your actual modal logic)
            // function showModal(product, value) {
            //     // Replace this with your modal display logic (e.g., show a Bootstrap modal)
            //     $("#sumpermoduleModal").modal("show");
            //     // You can also update the modal content based on the clicked data
            //     $("#modal_product").html(`${product}`);
            // }
        });
    </script>
    <script>
        function viewStatus(button) {
            // Get the data-id attribute (ID of the selected row)
            var No = button.getAttribute("data-id");
            let status = "IN-PROCESS";
            let apv_Name = "<?php echo $Name; ?>";
            let apv_Role = "<?php echo $Role; ?>";
            $.ajax({
                type: "POST",
                url: "../controllers/apv_commands.php",
                data: {
                    status: status,
                    name: apv_Name,
                    role: apv_Role,
                    no: No,
                    view: true
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    // Navigate to a new page and pass the ID as a parameter
                    window.location.href = "bc_approver.php?No=" + No;
                }
            });
        }

        function viewModal(No) {
            $.ajax({
                url: "../controllers/ppv_data.php",
                method: "POST",
                dataType: "json",
                data: {
                    No: No
                },
                success: function(response) {
                    $("#viewRequest").html('<i class="fa-regular fa-file-lines"></i> View Request No. ' + response.No);
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
                        $("#Vendor2,#CRV_2").show(); // Show the Vendor2 element
                        $("#theReason").hide();
                    } else {
                        // Hide the Vendor2 element if New_Vendor is empty or null
                        $("#Vendor2,#CRV_2").hide();
                        $("#Reason").val(response.reason);
                        $("#theReason").show();
                    }

                    $("#Purchasing_Recom").val(response.Purchasing_Recom);
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
                    $("#QBOM_Unit_Price").val(response.QBOM_Unit_Price);
                    $("#Total_QBOM_Price").val(response.Total_QBOM_Price);
                    $("#Conversion_Rate_Vendor_1").val(response.Conversion_Rate_V1);
                    $("#Conversion_Rate_Vendor_2").val(response.Conversion_Rate_V2);
                    $("#Vendor_1_Converted_Price").val(response.Conversion_Rate_V1);
                    $("#Vendor_2_Converted_Price").val(response.Conversion_Rate_V2);
                    $("#Vendor_1_Variance_VS_QBOM").val(response.V1_VarianceVSQBOM);
                    $("#Vendor_2_Variance_VS_QBOM").val(response.V2_VarianceVSQBOM);
                    $("#Business_Control_Recommendation").val(response.bc_recomm);
                    $("#Variance_VS_QBOM_Price").val(response.variance_vs_qbomprice);

                    var status = $("#Status").val(response.Request_Status);

                    if (status.val() !== null && status.val() !== "") {
                        $("#BCA, #APV").show();
                    } else {
                        $("#BCA, #APV").hide();
                    }
                    // Remove all classes first
                    status.removeClass("text-success text-danger");
                    if (status.val() === "Approved") {
                        status.addClass("text-success");
                    } else if (response.Request_Status === "Disapproved") {
                        status.addClass("text-danger");
                    }

                    if (response.Chargable2Customer === "true") {
                        $("#C2C").show();
                        $("#Chargable_to_Customer").val(response.VarianceChargable2Cohu);
                    } else {
                        $("#C2C").hide();
                    }
                    if (response.For_Checking_of_CCP_analyst === "true") {
                        $("#CCP").show();
                        $("#Remarks_from_CCP_analyst").val(response.Remarks_from_CCP_analyst);
                    } else {
                        $("#CCP").hide();
                    }

                    $("#Remarks").val(response.Remarks);
                    // Show the modal
                    $("#viewModal").modal("show");
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed with status: " + status);
                }
            });
        }

        $(document).ready(function() {
            function handleTableSearch(tableId, searchInputId, columnIndex) {
                $(searchInputId).on('input', function() {
                    const searchTerm = $(this).val().toLowerCase();

                    $(tableId + ' tbody tr').each(function() {
                        const partNumber = $(this).find('td:eq(' + columnIndex + ')').text().toLowerCase();

                        if (partNumber.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            }

            handleTableSearch('#pendingTable', '#partNumberSearch1', 4);
            handleTableSearch('#approvedTable', '#partNumberSearch2', 4);
            handleTableSearch('#disapprovedTable', '#partNumberSearch3', 4);

            $('.deltaPN-row').each(function() {
                var deltaPN = $(this).data('id');
                var cell = $(this);

                // Perform AJAX request
                $.ajax({
                    type: 'POST',
                    url: '../controllers/get_ppv_data.php',
                    dataType: "JSON",
                    data: {
                        check: true,
                        deltaPN: deltaPN
                    },
                    success: function(response) {
                        var data = response;
                        if (data.status === 'exists') {
                            cell.addClass('text-danger fw-bold');
                        } else {
                            cell.removeClass('text-danger fw-bold');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>