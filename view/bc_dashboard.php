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

<body>
    <div class="container-fluid my-3">
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
        </div>
    </div>
    <!-- Approved Modal -->
    <div class="modal fade" id="approvedModal" tabindex="-1" aria-labelledby="approvedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-bg-success">
                    <h1 class="modal-title fs-5" id="approvedModalLabel">Approved Request/s</h1>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="table-success">
                                <tr>
                                    <th>Request No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Project</th>
                                    <th>Approved Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($approved_result as $row) : ?>
                                    <tr>
                                        <td><?= $row['No'] ?></td>
                                        <td><?= $row['Date_Received'] ?></td>
                                        <td><?= $row['Requestor'] ?></td>
                                        <td><?= $row['Project'] ?></td>

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
                                        <?php endif; ?>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-bg-warning">
                    <h1 class="modal-title fs-5" id="pendingModalLabel">Pending Request/s</h1>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive rounded-1">
                        <table class="table table-bordered table-sm text-nowrap">
                            <thead class="table-warning">
                                <tr>
                                    <th>Request No</th>
                                    <th>Date Requested</th>
                                    <th>Requestor</th>
                                    <th>Project</th>
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
                                    <th>Disapproved by</th>
                                    <th>Disapproved Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($disapproved_result as $row) : ?>
                                    <tr>
                                        <td><?= $row['No'] ?></td>
                                        <td><?= $row['Date_Received'] ?></td>
                                        <td><?= $row['Requestor'] ?></td>
                                        <td><?= $row['Project'] ?></td>

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
                                        <?php endif; ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    </script>
</body>

</html>