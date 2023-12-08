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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-bg-warning">
                        <h1 class="modal-title fs-5" id="pendingModalLabel">Pending Request/s</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light rounded-bottom">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-sm table-hover text-nowrap">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Request No</th>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
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
                                            <td><span class="badge badge-success"><?= $row['Status'] ?></span>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-primary btn-sm" type="button" onclick="viewModal(<?= $row['No'] ?>)"> View</button>
                                                <button class="btn btn-outline-danger btn-sm" type="button" onclick="deleteNo(<?= $row['No'] ?>)"> Delete</button>
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header text-bg-success">
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
                                            <td><?= $row['Approver_Name_1']; ?><?= $row['Approver_Name_2'] ? ', ' . $row['Approver_Name_2'] : ''; ?><?= $row['Approver_Name_3'] ? ', ' . $row['Approver_Name_3'] : ''; ?></td>
                                            <td><?= formatApprovalDate($row['Date_Approved_1']); ?></td>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-bg-danger">
                        <h1 class="modal-title fs-5" id="disapprovedModalLabel">Disapproved Request/s</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-danger">
                                    <tr>
                                        <th>Request No</th>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
                                        <th>Disapproved By</th>
                                        <th>Disapproved Date</th>
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
                                            <td><?= $row['DisApprover_Name'] ?></td>
                                            <td><?= formatApprovalDate($row['Date_Approved_1']); ?></td>
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
                                        <input type="text" class="form-control bg-light" id="Purchasing_Recom" value="<?= $Purchasing_Recom; ?>" readonly>
                                        <label class="form-label fw-bold text-dark" for="Purchasing_Recom">Purchasing Recommendation</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function viewModal(No) {
                $.ajax({
                    url: "../controllers/requestor_dashboard_data.php",
                    method: "POST",
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
        </script>
    </body>

    </html>
<?php } else {
    exit();
} ?>