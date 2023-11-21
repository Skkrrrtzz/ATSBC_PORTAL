<?php require_once 'bc_nav.php';
include_once '../controllers/opt_approver_dashboard_data.php';

if ($Role === "Optional Approver") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sourcing Dashboard</title>
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
                                            <h4 class="fs-1"><?php echo $pendingCount; ?></h4>
                                        </div>
                                        <div class="text-end text-white">
                                            <h4 class="fs-6">Pending</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-2">
                        <div class="card shadow bg-success border-3 border-success-subtle">
                            <div class="card-body" type="button" data-mdb-toggle="modal" data-mdb-target="#doneModal">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fa-solid fa-circle-check fa-3x text-white"></i>
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-white text-end">
                                            <h4 class="fs-1"><?= $doneCount ?></h4>
                                        </div>
                                        <div class="text-end text-white">
                                            <h4 class="fs-6">Done</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Done Modal -->
        <div class="modal fade" id="doneModal" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-bg-success">
                        <h1 class="modal-title fs-5" id="doneModalLabel">Done Items</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-nowrap">
                                <thead class="table-success">
                                    <tr>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
                                        <th>Remarks</th>
                                        <th>Checked Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) :
                                        if ($item['status'] === 'done') { ?>
                                            <tr>
                                                <td><?= $item['Date_Received'] ?></td>
                                                <td><?= $item['Requestor'] ?></td>
                                                <td><?= $item['Project'] ?></td>
                                                </td>
                                                <td><?= $item['Remarks_from_CCP_analyst'] ?></td>
                                                <td>
                                                    <?php
                                                    $CCP_Checked_date = $item['CCP_Checked_date'];
                                                    $timestamp = strtotime($CCP_Checked_date);
                                                    $formattedDate = date('m/d/y h:i A', $timestamp);
                                                    echo $formattedDate;
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-primary btn-sm" data-id="<?= $item['No'] ?>" onclick="viewStatus(this)">View</button>
                                                </td>
                                            </tr><?php } ?>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-bg-warning">
                        <h1 class="modal-title fs-5" id="pendingModalLabel">Pending Items</h1>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive rounded-1">
                            <table class="table table-bordered table-sm">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Date Requested</th>
                                        <th>Requestor</th>
                                        <th>Project</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) :
                                        if ($item['status'] === 'pending') { ?>
                                            <tr>
                                                <td><?= $item['Date_Received'] ?></td>
                                                <td><?= $item['Requestor'] ?></td>
                                                <td><?= $item['Project'] ?></td>
                                                <td>
                                                    <button class="btn btn-outline-primary btn-sm" data-id="<?= $item['No'] ?>" onclick="viewStatus(this)">View</button>
                                                </td>
                                            </tr><?php } ?>
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

                // Navigate to a new page and pass the ID as a parameter
                window.location.href = "sor_opt_approver.php?No=" + No;
            }
        </script>
    </body>

    </html>
<?php } else {
    exit();
} ?>