<?php
require_once 'bc_nav.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPV Files</title>
</head>

<body class="bg-light">
    <div class="container my-3">
        <div class="table-responsive">
            <table class="table table-sm" border="1" id="fileTable" style="width: 100%;">
                <thead class="table-primary">
                    <tr>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Viewing PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-gray-300 my-0">
                    <h5 class="modal-title fw-bold" id="pdfModalLabel">PDF Viewer</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Make AJAX request to get file list
            $.ajax({
                url: '../controllers/get_ppv_files.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Initialize DataTable with file names and icons
                    $('#fileTable').DataTable({
                        data: response.map(function(file) {
                            return [
                                file,
                                '<a href="#" onclick="viewPDF(\'' + encodeURIComponent(file) + '\')" title="View PDF" data-mdb-toggle="modal" data-mdb-target="#pdfModal"><button class="btn btn-outline-primary btn-sm">View</button></a>'
                            ];
                        }),
                        columns: [{
                                title: 'File Name'
                            },
                            {
                                title: 'Action'
                            }
                        ]
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching file list:", error);
                }
            });
        });

        // Function to handle "View PDF" action
        function viewPDF(file) {
            // Set the src attribute of the iframe in the modal to an empty string initially
            $('#pdfViewer').attr('src', '');

            // Get the filename from the URL
            var filename = decodeURIComponent(file.split('/').pop());

            // Set the modal title to the filename
            $('#pdfModalLabel').text('PDF Viewer - ' + filename);

            // Set the src attribute of the iframe when the modal is fully shown
            $('#pdfModal').on('shown.bs.modal', function() {
                $('#pdfViewer').attr('src', 'download.php?file=' + encodeURIComponent(file));
            });
        }
    </script>

</body>

</html>