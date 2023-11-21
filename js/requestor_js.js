$(document).ready(function () {
  // Initially hide the "other_ppv_type" input field
  $("#other_ppv_type").hide();

  // Listen for changes in the "PPV_Type" dropdown
  $("#PPV_Type").change(function () {
    // Check if "OTHERS" is selected
    if ($(this).val() === "OTHERS") {
      // Show the "other_ppv_type" input field
      $("#other_ppv_type").show();
    } else {
      // Hide the "other_ppv_type" input field if any other option is selected
      $("#other_ppv_type").hide();
    }
  });
  $("#requestForm").submit(function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Show a SweetAlert confirmation dialog
    Swal.fire({
      title: "Confirm Submission",
      text: "Are you sure you want to submit this form?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Proceed",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        // User confirmed, proceed with form submission
        Swal.fire({
          title: "Processing...",
          html: '<div class="m-2" id="loading-spinner"><div class="loader3"><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div><div class="circle1"></div></div></div>',
          showCancelButton: false,
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
        });
        var formData = new FormData(this);
        formData.append("submit", "1");
        $.ajax({
          type: "POST",
          url: "../controllers/req_commands.php",
          data: formData,
          processData: false,
          contentType: false,
          dataType: "json",
          success: function (response) {
            if (response.success) {
              Swal.close();
              // Show a SweetAlert success message
              Swal.fire({
                icon: "success",
                title: "Success",
                text: response.message,
              }).then(function () {
                // Redirect after the user clicks OK
                window.location.href = response.redirect;
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
          error: function (xhr, status, error) {
            Swal.close();
            console.error("AJAX request failed with status: " + status);
          },
        });
      }
    });
  });
});

// Assuming you have a change event handler for the SAP_No field
$("#SAP_No").on("change", function () {
  var sapNo = $(this).val(); // Get the SAP_No entered by the user
  //   console.log(sapNo);
  // Make an AJAX request to your server-side script
  $.ajax({
    url: "../controllers/get_bu_data.php",
    type: "POST",
    dataType: "json",
    data: {
      sapNo: sapNo,
    }, // Send the SAP_No to the server
    success: function (response) {
      if (response.success) {
        // Update the Delta_PN and Description fields with the data from the response
        $("#Delta_PN").val(response.deltaPN);
        $("#desc").val(response.description);
      } else {
        // Handle the case where no matching SAP_No was found
        $("#Delta_PN").val(""); // Clear Delta_PN field
        $("#desc").val(""); // Clear Description field
        Swal.fire({
          title: "SAP Number not found.",
          // text: 'SAP_No not found.',
          icon: "info",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    },
    error: function (xhr, status, error) {
      // Handle AJAX errors here
      console.error(error);
    },
  });
});
// Add event listeners to the input fields
$("#Current_Vendor_Price, #Qty_to_Purchase_from_Vendor_1").on(
  "input",
  function () {
    // Get the values from the input fields
    var currentVendorPrice = parseFloat($("#Current_Vendor_Price").val()) || 0;
    var qtyToPurchaseFromVendor =
      parseInt($("#Qty_to_Purchase_from_Vendor_1").val()) || 0;
    // Calculate the total amount
    var totalAmt = currentVendorPrice * qtyToPurchaseFromVendor;

    // Update the Total_Amt field
    $("#Total_Amt_1").val(totalAmt.toFixed(2)); // Display the total amount with 2 decimal places
  }
);
// Add event listeners to the input fields
$("#New_Vendor_Price, #Qty_to_Purchase_from_Vendor_2").on("input", function () {
  // Get the values from the input fields
  var NewVendorPrice = parseFloat($("#New_Vendor_Price").val()) || 0;
  var qtyToPurchaseFromVendor2 =
    parseInt($("#Qty_to_Purchase_from_Vendor_2").val()) || 0;
  // Calculate the total amount
  var totalAmt2 = NewVendorPrice * qtyToPurchaseFromVendor2;

  // Update the Total_Amt field
  $("#Total_Amt_2").val(totalAmt2.toFixed(2)); // Display the total amount with 2 decimal places
});
