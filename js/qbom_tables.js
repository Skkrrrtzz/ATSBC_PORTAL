$(document).ready(function () {
  function initializeDataTable(tableId, url, columns) {
    var table = $(tableId).DataTable({
      ajax: {
        url: url,
        method: "GET",
        dataType: "json",
        dataSrc: "",
      },
      dom: '<"row m-1"<"col-sm-8"Bl><"col-sm-4"f>>t<"row"<"col-sm-6"i><"col-sm-6"p>>',
      columns: columns,
      order: [[0, "asc"]],
      buttons: [
        {
          extend: "copyHtml5",
          text: '<i class="fas fa-copy"></i> Copy',
          exportOptions: {
            columns: ":visible",
          },
        },
        {
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
          action: function (e, dt, button, config) {
            dt.columns().visible(true);
            dt.colReorder.reset();
          },
        },
      ],
      colReorder: true,
      scrollX: true,
      scrollY: "50vh",
      scrollCollapse: true,
      // stateSave: true,
      deferRender: true,
      // responsive: true,
      // lengthChange: true,
    });
  }

  // Define columns for pnp_qbom_table
  var pnpColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for pnpcable_qbom_table
  var pnpCableColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for jlp_qbom_table
  var jlpColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for jlpcable_qbom_table
  var jlpCableColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for jtp_qbom_table
  var jtpColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for mtp_qbom_table
  var mtpColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty_1",
    },
    {
      data: "EXT_Qty_2",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for olb_qbom_table
  var olbColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for flipper_qbom_table
  var flipperColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for highmag_qbom_table
  var highmagColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for ionizer_qbom_table
  var ionizerColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Purchase_Vendor",
    },
    {
      data: "Vendor_PN",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  // Define columns for rcmtp_qbom_table
  var rcmtpColumns = [
    {
      data: "ID",
    },
    {
      data: "Changes_Analysis",
    },
    {
      data: "Level",
    },
    {
      data: "Item",
    },
    {
      data: "Item_Description",
    },
    {
      data: "Item_class",
    },
    {
      data: "Qty",
    },
    {
      data: "EXT_Qty",
    },
    {
      data: "QPA_0",
    },
    {
      data: "UoM",
    },
    {
      data: "Rev",
    },
    {
      data: "Drawing_Sequence_Number",
    },
    {
      data: "Sequence",
    },
    {
      data: "Original_Unit_Price",
    },
    {
      data: "Original_Currency",
    },
    {
      data: "Unit_Price_USD_before_Mark_Up",
    },
    {
      data: "Standard_Part_Price",
    },
    {
      data: "Purchase_Identification",
    },
    {
      data: "Mark_Up",
    },
    {
      data: "Unit_Price_USD_after_Mark_Up",
    },
    {
      data: "Total_Price_USD",
    },
    {
      data: "Agreement",
    },
    {
      data: "Agreement_Price",
    },
    {
      data: "Agreement_Currency",
    },
    {
      data: "Spare_Part_Price_USD",
    },
    {
      data: "Supplier_MOQ",
    },
    {
      data: "Lead_Time",
    },
    {
      data: "Supplier_Vendor",
    },
    {
      data: "Supplier_Vendor_Reference",
    },
    {
      data: "Manufacturer",
    },
    {
      data: "Manufacturer_Reference_MPN",
    },
    {
      data: "Agreement_Supplier_Name",
    },
    {
      data: "Agreement_Supplier_Code",
    },
    {
      data: "Life_Cycle",
    },
    {
      data: "Purchasing_Restriction",
    },
  ];

  initializeDataTable(
    "#pnp_qbom_table",
    "../controllers/get_qbom_datas.php?pnp=1",
    pnpColumns
  );
  initializeDataTable(
    "#pnpcable_qbom_table",
    "../controllers/get_qbom_datas.php?pnp_cable=1",
    pnpCableColumns
  );
  initializeDataTable(
    "#jlp_qbom_table",
    "../controllers/get_qbom_datas.php?jlp=1",
    jlpColumns
  );
  initializeDataTable(
    "#jlpcable_qbom_table",
    "../controllers/get_qbom_datas.php?jlp_cable=1",
    jlpCableColumns
  );
  initializeDataTable(
    "#jtp_qbom_table",
    "../controllers/get_qbom_datas.php?jtp=1",
    jtpColumns
  );
  initializeDataTable(
    "#mtp_qbom_table",
    "../controllers/get_qbom_datas.php?mtp=1",
    mtpColumns
  );
  initializeDataTable(
    "#olb_qbom_table",
    "../controllers/get_qbom_datas.php?olb=1",
    olbColumns
  );
  initializeDataTable(
    "#flipper_qbom_table",
    "../controllers/get_qbom_datas.php?flipper=1",
    flipperColumns
  );
  initializeDataTable(
    "#highmag_qbom_table",
    "../controllers/get_qbom_datas.php?highmag=1",
    highmagColumns
  );
  initializeDataTable(
    "#ionizer_qbom_table",
    "../controllers/get_qbom_datas.php?ionizer=1",
    ionizerColumns
  );
  initializeDataTable(
    "#rcmtp_qbom_table",
    "../controllers/get_qbom_datas.php?rcmtp=1",
    rcmtpColumns
  );
});