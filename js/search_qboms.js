$(document).ready(function () {
  $("#search-input").on("input", function () {
    var searchTerm = $(this).val();
    if (searchTerm.length > 0) {
      $("#loading-indicator").show(); // Show loading indicator

      $.ajax({
        type: "POST",
        url: "../controllers/search.php",
        data: { searchTerm: searchTerm },
        success: function (response) {
          $("#search-results-content").html(response);
          $("#loading-indicator").hide(); // Hide loading indicator
          $("#clear-results").show(); // Show clear results button
        },
      });
    } else {
      // Clear the search results if the search term is too short or empty
      $("#search-results-content").html("");
      $("#loading-indicator").hide(); // Hide loading indicator
      $("#clear-results").hide(); // Hide clear results button
    }
  });

  // Clear search results
  $("#clear-results").click(function () {
    $("#search-input").val(""); // Clear the input field
    $("#search-results-content").html(""); // Clear the search results
    $(this).hide(); // Hide the clear results button
  });
});

// $(document).ready(function () {
//   $("#search-button").click(function () {
//     var searchTerm = $("#search-input").val();
//     $.ajax({
//       type: "POST",
//       url: "../controllers/search.php",
//       data: { searchTerm: searchTerm },
//       success: function (response) {
//         $("#search-results").html(response);
//       },
//     });
//   });
// });
