<?php require_once 'bc_nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View QBOMS</title>
    <link rel="stylesheet" href="../assets/DataTables/Buttons-2.4.2/css/buttons.dataTables.min.css">
    <script src="../assets/DataTables/Buttons-2.4.2/js/buttons.dataTables.min.js"></script>
    <script src="../assets/DataTables/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
    <style>
        table.dataTable th {
            font-size: 14px;
        }

        table.dataTable td {
            font-size: 14px;
        }

        /* Define styles for hovered content */
        #result:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-light">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="qbom-tab" data-mdb-toggle="tab" data-mdb-target="#search_qbom" type="button" role="tab" aria-controls="search_qbom" aria-selected="true"><i class="fa-solid fa-magnifying-glass"></i> ALL QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="home-tab" data-mdb-toggle="tab" data-mdb-target="#pnp_tab_pane" type="button" role="tab" aria-controls="pnp_tab_pane" aria-selected="true"><i class="fa-regular fa-folder-open"></i> PNP QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pnpcable-tab" data-mdb-toggle="tab" data-mdb-target="#pnpcable_tab_pane" type="button" role="tab" aria-controls="pnpcable_tab_pane" aria-selected="true"><i class="fa-regular fa-folder-open"></i> PNP CABLE QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="jlp-tab" data-mdb-toggle="tab" data-mdb-target="#jlp_tab_pane" type="button" role="tab" aria-controls="jlp_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> JLP QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="jlpcable-tab" data-mdb-toggle="tab" data-mdb-target="#jlpcable_tab_pane" type="button" role="tab" aria-controls="jlpcable_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> JLP CABLE QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="jtp-tab" data-mdb-toggle="tab" data-mdb-target="#jtp_tab_pane" type="button" role="tab" aria-controls="jtp_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> JTP QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="mtp-tab" data-mdb-toggle="tab" data-mdb-target="#mtp_tab_pane" type="button" role="tab" aria-controls="mtp_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> MTP QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="olb-tab" data-mdb-toggle="tab" data-mdb-target="#olb_tab_pane" type="button" role="tab" aria-controls="olb_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> OLB QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="flipper-tab" data-mdb-toggle="tab" data-mdb-target="#flipper_tab_pane" type="button" role="tab" aria-controls="flipper_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> FLIPPER QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="highmag-tab" data-mdb-toggle="tab" data-mdb-target="#highmag_tab_pane" type="button" role="tab" aria-controls="highmag_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> HIGHMAG QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ionizer-tab" data-mdb-toggle="tab" data-mdb-target="#ionizer_tab_pane" type="button" role="tab" aria-controls="ionizer_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> IONIZER QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rcmtp-tab" data-mdb-toggle="tab" data-mdb-target="#rcmtp_tab_pane" type="button" role="tab" aria-controls="rcmtp_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> RCMTP QBOM</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="swap-tab" data-mdb-toggle="tab" data-mdb-target="#swap_tab_pane" type="button" role="tab" aria-controls="swap_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> SWAP QBOM</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="spares-tab" data-mdb-toggle="tab" data-mdb-target="#spares_tab_pane" type="button" role="tab" aria-controls="spares_tab_pane" aria-selected="false"><i class="fa-regular fa-folder-open"></i> SPARES QBOM</button>
        </li> -->
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="search_qbom" role="tabpanel" aria-labelledby="qbom-tab" tabindex="0">
            <!-- <div class="card m-4">
                <div class="input-group">
                    <input type="search" class="form-control rounded" id="search-input" placeholder="Search Part Number" autocomplete="off" aria-label="Search" aria-describedby="search-addon" />
                </div>
                <!-- Loading indicator -->
            <!-- <div id="loading-indicator" style="display: none;">Loading...</div>
                <div id="search-results-content" style="max-height: 300px; overflow-y: auto;"></div>
                <!-- Clear search results button placed outside of the container -->
            <!-- <button class="btn btn-outline-primary" id="clear-results" style="display: none;">Clear Search Results</button> -->
            <!-- </div> -->
            <div class="container-fluid">
                <div class="table-responsive">
                    <!-- <input type="text" placeholder="Search QBOM and Item" id="qbomSearch"> -->
                    <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="allqboms">
                        <thead class="table-primary">
                            <tr>
                                <th>QBOM</th>
                                <!-- <th>ID</th> -->
                                <th>Changes Analysis</th>
                                <th>Level</th>
                                <th>Item</th>
                                <th>Item Description</th>
                                <th>Item Class</th>
                                <th>Qty</th>
                                <th>EXT Qty</th>
                                <th>QPA=0</th>
                                <th>UoM</th>
                                <th>Rev</th>
                                <th>Drawing Sequence Number</th>
                                <th>Sequence</th>
                                <th>Original Unit Price</th>
                                <th>Original Currency</th>
                                <th>Unit Price USD before Mark Up</th>
                                <th>Standard Part Price</th>
                                <th>Purchase Identification</th>
                                <th>Mark Up</th>
                                <th>Unit Price USD after Mark Up</th>
                                <th>Total Price USD</th>
                                <th>Agreement</th>
                                <th>Agreement Price</th>
                                <th>Agreement Currency</th>
                                <th>Spare Part Price USD</th>
                                <th>Supplier MOQ</th>
                                <th>Lead Time</th>
                                <th>Supplier Vendor</th>
                                <th>Supplier Vendor Reference</th>
                                <th>Manufacturer</th>
                                <th>Manufacturer Reference MPN</th>
                                <th>Agreement Supplier Name</th>
                                <th>Agreement Supplier Code</th>
                                <th>Life Cycle</th>
                                <th>Purchasing Restriction</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pnp_tab_pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="pnp_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="pnpcable_tab_pane" role="tabpanel" aria-labelledby="pnpcable-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="pnpcable_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="jlp_tab_pane" role="tabpanel" aria-labelledby="jlp-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="jlp_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="jlpcable_tab_pane" role="tabpanel" aria-labelledby="jlpcable-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="jlpcable_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="jtp_tab_pane" role="tabpanel" aria-labelledby="jtp-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="jtp_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="mtp_tab_pane" role="tabpanel" aria-labelledby="mtp-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="mtp_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty 1</th>
                            <th>EXT Qty 2</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty 1</th>
                            <th>EXT Qty 2</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="olb_tab_pane" role="tabpanel" aria-labelledby="olb-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="olb_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="flipper_tab_pane" role="tabpanel" aria-labelledby="flipper-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="flipper_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="highmag_tab_pane" role="tabpanel" aria-labelledby="highmag-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="highmag_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="ionizer_tab_pane" role="tabpanel" aria-labelledby="ionizer-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="ionizer_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Purchase Vendor</th>
                            <th>Vendor Part Number</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Purchase Vendor</th>
                            <th>Vendor Part Number</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="rcmtp_tab_pane" role="tabpanel" aria-labelledby="rcmtp-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered text-nowrap table-sm" style="width:100%" id="rcmtp_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item Class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item Class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="swap_tab_pane" role="tabpanel" aria-labelledby="swap-tab" tabindex="0">
            <div class="table-responsive my-2 mx-1">
                <table class="table table-striped table-hover table-bordered table-sm text-nowrap" style="width:100%" id="swap_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA 0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- <div class="tab-pane fade" id="spares_tab_pane" role="tabpanel" aria-labelledby="spares-tab" tabindex="0">
            <div class="table-responsive py-2 my-2 mx-1">
                <table class="table table-striped table-hover text-nowrap" style="width:100%" id="spares_qbom_table">
                    <thead class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item Class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <th>ID</th>
                            <th>Changes Analysis</th>
                            <th>Level</th>
                            <th>Item</th>
                            <th>Item Description</th>
                            <th>Item Class</th>
                            <th>Qty</th>
                            <th>EXT Qty</th>
                            <th>QPA=0</th>
                            <th>UoM</th>
                            <th>Rev</th>
                            <th>Drawing Sequence Number</th>
                            <th>Sequence</th>
                            <th>Original Unit Price</th>
                            <th>Original Currency</th>
                            <th>Unit Price USD before Mark Up</th>
                            <th>Standard Part Price</th>
                            <th>Purchase Identification</th>
                            <th>Mark Up</th>
                            <th>Unit Price USD after Mark Up</th>
                            <th>Total Price USD</th>
                            <th>Agreement</th>
                            <th>Agreement Price</th>
                            <th>Agreement Currency</th>
                            <th>Spare Part Price USD</th>
                            <th>Supplier MOQ</th>
                            <th>Lead Time</th>
                            <th>Supplier Vendor</th>
                            <th>Supplier Vendor Reference</th>
                            <th>Manufacturer</th>
                            <th>Manufacturer Reference MPN</th>
                            <th>Agreement Supplier Name</th>
                            <th>Agreement Supplier Code</th>
                            <th>Life Cycle</th>
                            <th>Purchasing Restriction</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div> -->
    </div>
    <script>
        $(document).ready(function() {
            try {
                var table = $('#allqboms').DataTable({
                    ajax: {
                        url: "../controllers/get_qbom_datas.php?allqboms=1",
                        method: "GET",
                        dataType: "json",
                        dataSrc: ""
                    },
                    dom: '<"row m-1"<"col-sm-8"Bl><"col-sm-4"f>>t<"row"<"col-sm-6"i><"col-sm-6"p>>',
                    columns: [{
                            data: "QBOM"
                        },
                        {
                            data: "Changes_Analysis"
                        },
                        {
                            data: "Level"
                        },
                        {
                            data: "Item"
                        },
                        {
                            data: "Item_Description"
                        },
                        {
                            data: "Item_class",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('Item_class')) {
                                    return row.Item_class;
                                }
                                return null;
                            }
                        },
                        {
                            data: "Qty"
                        },
                        {
                            data: "EXT_Qty",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('EXT_Qty')) {
                                    return row.EXT_Qty;
                                }
                                return null;
                            }
                        },
                        {
                            data: "QPA_0",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('QPA_0')) {
                                    return row.QPA_0;
                                }
                                return null;
                            }
                        },
                        {
                            data: "UoM",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('UoM')) {
                                    return row.UoM;
                                }
                                return null;
                            }
                        },
                        {
                            data: "Rev",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('Rev')) {
                                    return row.Rev;
                                }
                                return null;
                            }
                        },
                        {
                            data: "Drawing_Sequence_Number",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('Drawing_Sequence_Number')) {
                                    return row.Drawing_Sequence_Number;
                                }
                                return null;
                            }
                        },
                        {
                            data: "Sequence",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('Sequence')) {
                                    return row.Sequence;
                                }
                                return null;
                            }
                        }, {
                            data: "Original_Unit_Price"
                        },
                        {
                            data: "Original_Currency"
                        },
                        {
                            data: "Unit_Price_USD_before_Mark_Up"
                        },
                        {
                            data: "Standard_Part_Price"
                        },
                        {
                            data: "Purchase_Identification"
                        },
                        {
                            data: "Mark_Up"
                        },
                        {
                            data: "Unit_Price_USD_after_Mark_Up"
                        },
                        {
                            data: "Total_Price_USD"
                        },
                        {
                            data: "Agreement"
                        },
                        {
                            data: "Agreement_Price"
                        },
                        {
                            data: "Agreement_Currency"
                        },
                        {
                            data: "Spare_Part_Price_USD"
                        },
                        {
                            data: "Supplier_MOQ"
                        },
                        {
                            data: "Lead_Time"
                        },
                        {
                            data: "Supplier_Vendor",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('Supplier_Vendor')) {
                                    return row.Supplier_Vendor;
                                }
                                return null;
                            }
                        },
                        {
                            data: "Supplier_Vendor_Reference",
                            render: function(data, type, row) {
                                if (['HIGHMAG', 'FLIPPER', 'MTP', 'OLB', 'PNP', 'JLP', 'JLP CABLE', 'PNP CABLE', 'JTP', 'RCMTP', 'IONIZER', 'SWAP'].includes(row.QBOM) && row.hasOwnProperty('Supplier_Vendor_Reference')) {
                                    return row.Supplier_Vendor_Reference;
                                }
                                return null;
                            }
                        },
                        {
                            data: "Manufacturer"
                        },
                        {
                            data: "Manufacturer_Reference_MPN"
                        },
                        {
                            data: "Agreement_Supplier_Name"
                        },
                        {
                            data: "Agreement_Supplier_Code"
                        },
                        {
                            data: "Life_Cycle"
                        },
                        {
                            data: "Purchasing_Restriction"
                        },
                    ],
                    order: [
                        [0, "asc"]
                    ],
                    columnDefs: [{
                        visible: false,
                        targets: [1, 2, 6, 7, 9, 10, 11, 12, 13, 14, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34]
                    }],
                    buttons: [{
                            extend: "copyHtml5",
                            text: '<i class="fas fa-copy"></i> Copy',
                            exportOptions: {
                                columns: ":visible",
                            },
                        }, {
                            extend: "excelHtml5",
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            exportOptions: {
                                columns: ":visible",
                            },
                        },
                        {
                            extend: "colvis",
                            text: '<i class="fas fa-filter"></i> Filter columns',
                            collectionLayout: "fixed columns",
                            collectionTitle: "Column Visibility Control",
                        },
                        {
                            text: "<i class='fa-solid fa-arrow-rotate-left'></i> Reset",
                            action: function(e, dt, button, config) {
                                dt.columns().visible(true);
                                dt.colReorder.reset();
                            },
                        },
                    ],
                    colReorder: true,
                    scrollX: true,
                    scrollY: "50vh",
                    scrollCollapse: true,
                    deferRender: true,
                    searching: true,
                    initComplete: function() {
                        // Add a custom search input for the "QBOM" and "Item" columns
                        var customSearchInput = $('#allqboms_filter input[type="search"]');
                        customSearchInput.off().on('input', function() {
                            var searchTerm = this.value;
                            table.column(3).search(searchTerm).draw();
                        });
                    }
                });
                // Add a placeholder to the search input field
                $('#allqboms_filter input[type="search"]').attr("placeholder", "Enter Part Number");
            } catch (error) {
                console.error("An error occurred:", error);
            }
        });
    </script>
    <script src="../js/qbom_tables.js"></script>
    <script src="../js/search_qboms.js"></script>
</body>

</html>