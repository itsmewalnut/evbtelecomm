// Initialize Choices for all dropdowns
var choices = {};

function initializeChoices() {
  // Array of dropdown IDs
  var dropdownIds = ["acc_Branch", "accountStatus", "finalStatus", "acc_type"];
  var filter = [
    "filterBRANCH",
    "filterRNAME",
    "filterACCNO",
    "filterDUEDATE",
    "filterACCSTATUS",
    "filterSTATUS",
  ];

  dropdownIds.forEach(function (id) {
    var element = document.getElementById(id);
    if (element) {
      choices[id] = new Choices(element, {
        searchEnabled: false,
      });
    }
  });

  filter.forEach(function (id) {
    var element = document.getElementById(id);
    if (element) {
      choices[id] = new Choices(element, {
        searchEnabled: true,
      });
    }
  });
}

// Call this function on page load
initializeChoices();

$(document).ready(function () {
  loadSmartTable();

  $("#imageUpload").change(function (data) {
    var imageFile = data.target.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(imageFile);

    reader.onload = function (evt) {
      $("#imagePreview").attr("src", evt.target.result);
      $("#imagePreview").hide();
      $("#imagePreview").fadeIn(650);
    };
  });
});

function loadSmartTable() {
  $.ajax({
    url: "../../query/administrator/network_fetch.php",
    method: "POST",
    data: { networkType: "smart", fetchType: "notFilter" },
    success: function (data) {
      // Destroy the existing DataTable instance
      var existingTable = $("#smartTable").DataTable();
      existingTable.clear().destroy();

      try {
        data = JSON.parse(data);
        var smartTable = $("#smartTable").DataTable({
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          autoWidth: false,
          responsive: true,
          filter: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          data: data.data,
          createdRow: function (row, data, dataIndex) {
            const dueDateString = data[5]; // Assuming data[5] contains the due date string
            const dueDate = new Date(dueDateString); // Convert due date string to Date object
            const currentDate = new Date(); // Current date

            // Calculate five days before the due date
            const fiveDaysBefore = new Date(dueDate);
            fiveDaysBefore.setDate(dueDate.getDate() - 5);

            // Check if current date is within the 5 days before due date
            if (
              data[7] === '<span class="badge bg-gradient-warning">PAID</span>'
            ) {
              $(row).removeClass("bg-gradient-danger text-white");
            } else if (currentDate >= fiveDaysBefore && currentDate < dueDate) {
              $(row)
                .find("td")
                .slice(0, 6)
                .addClass("bg-gradient-danger text-white");
            }
          },
          language: {
            paginate: {
              first: '<i class="fa fa-angle-double-left"></i>',
              previous: '<i class="fa fa-angle-left"></i>',
              next: '<i class="fa fa-angle-right"></i>',
              last: '<i class="fa fa-angle-double-right"></i>',
            },
          },
        });

        smartTable
          .buttons()
          .container()
          .appendTo("#smartTable_wrapper .col-md-6:eq(0)");
      } catch (error) {
        console.error("Error parsing JSON data:", error);
      }
    },
  });
}

// Fetching Account info in modal
$(document).on("click", "#getSmartView", function () {
  $(".main-content").removeClass("ps ps--scrolling-y");
  const mydata = {
    slip_id: $(this).data("id"),
    slip_type: "smart",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      // Set values in the modal
      $("#viewSmart_title").text(`${result.register_name} Information`);
      $("#acc_name").text(result.register_name);
      $("#acc_branch").text(result.branch);
      $("#acc_billing").text(result.account_type);
      $("#acc_datepaid").text(result.date_paid || "-");
      $("#acc_no").text(result.account_no);
      $("#acc_id").text(result.smart_id);
      $("#acc_email").text(result.email);
      $("#acc_rno").text(result.register_no);
      $("#acc_address").text(result.register_address);
      $("#acc_username").text(result.username);
      $("#acc_password").text(result.password);
      $("#acc_phone").text(result.phone);
      $("#acc_sno").text(result.serial_no);
      $("#acc_imei1").text(result.imei1);
      $("#acc_imei2").text(result.imei2);
      $("#acc_amount").text(result.paid_amount || "-");
      $("#acc_remarks").text(result.remarks || "Encoder has no remarks!");

      // Final status handling
      if (result.final_status == "TRANSMITTED") {
        $("#acc_finalstatus").text(result.final_status);
        $("#PAID_BUTTON").show();
        $("#TRANSMIT_BUTTON").hide();
        $("#accImage").attr("src", "../../image/pdf-transmit.png");
      } else if (result.final_status == "PAID") {
        $("#acc_finalstatus").text(result.final_status);
        $("#PAID_BUTTON").hide();
        $("#TRANSMIT_BUTTON").hide();
        $("#accImage").attr("src", "../../image/pdf-paid.png");
      } else {
        $("#acc_finalstatus").text(result.final_status);
        $("#PAID_BUTTON").hide();
        $("#TRANSMIT_BUTTON").show();
        $("#accImage").attr("src", "../../image/pdf-unpaid.png");
      }

      // Format dates
      const formatDate = (date) =>
        new Date(date).toLocaleDateString("en-US", {
          year: "numeric",
          month: "long",
          day: "numeric",
        });
      $("#acc_duedate").text(formatDate(result.duedate));
      $("#acc_acqdate").text(formatDate(result.acquisition_date));

      // Account status styling
      const $accStatus = $("#acc_status");
      $accStatus
        .removeClass("bg-gradient-success bg-gradient-secondary")
        .addClass(
          result.account_status === "ACTIVE"
            ? "bg-gradient-success"
            : "bg-gradient-secondary"
        )
        .text(result.account_status);

      // Pay Button handling
      $(document).on("click", "#payButton", function () {
        $("#paid_ID").val(result.smart_id);
      });

      // Transmit Button handling
      $(document).on("click", "#transmitButton", function () {
        $("#transmitID").val(result.smart_id);
        $("#transmitType").val("paidSmart");
        $("#transmitMessage").text(
          `Transmit the account with the register name of ${result.register_name}`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", status, error);
    },
  });
});

// View SOA in offcanvas
$(document).on("click", "#getSmartSOA", function () {
  $(".main-content").removeClass("ps ps--scrolling-y");
  $("#offcanvasRightLabel").text("SOA - " + $(this).data("name"));

  var mydata = {
    soa_id: $(this).data("id"),
    soa_type: "smart",
  };

  $.ajax({
    url: "../../query/administrator/view_attachment.php",
    type: "POST",
    data: JSON.stringify(mydata),
    success: function (response) {
      $("#attachment_container").html(response);
      $(".pdf-thumbnail").EZView();
      $(".payment-thumbnail").EZView();
    },
  });
});

// Delete Account query
$("#deleteSmartForm").submit(function (e) {
  e.preventDefault();
  $.ajax({
    url: "../../query/administrator/delete_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        icon: "success",
        titleText: "Account Deleted!",
        text: "Account has been deleted!",
        showConfirmButton: false,
        timer: 2500,
      });
      $("#deleteSmart").modal("hide");
      loadSmartTable();
      $("#deleteSmartForm")[0].reset();
    },
  });
});

// Search Account
$("#accountSearchForm").submit(function (a) {
  a.preventDefault();
  $.ajax({
    url: "../../query/administrator/filter_fetch.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      data = JSON.parse(data);
      var newTable = $("#smartTable").DataTable();
      newTable.clear().destroy();

      var newTable = $("#smartTable")
        .DataTable({
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          autoWidth: false,
          responsive: true,
          searching: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          language: {
            paginate: {
              first: '<i class="fa fa-angle-double-left"></i>',
              previous: '<i class="fa fa-angle-left"></i>',
              next: '<i class="fa fa-angle-right"></i>',
              last: '<i class="fa fa-angle-double-right"></i>',
            },
          },
          data: data.data,
          createdRow: function (row, data, dataIndex) {
            const dueDateString = data[5]; // Assuming data[5] contains the due date string
            const dueDate = new Date(dueDateString);
            const currentDate = new Date();
            const fiveDaysBefore = new Date(dueDate);
            fiveDaysBefore.setDate(dueDate.getDate() - 5);

            // Check if current date is within the 5 days before due date
            if (
              data[7] === '<span class="badge bg-gradient-warning">PAID</span>'
            ) {
              $(row).removeClass("bg-gradient-danger text-white");
            } else if (currentDate >= fiveDaysBefore && currentDate < dueDate) {
              $(row)
                .find("td")
                .slice(0, 6)
                .addClass("bg-gradient-danger text-white");
            }
          },
        })
        .buttons()
        .container()
        .appendTo("#smartTable_wrapper .col-md-6:eq(0)");
    },
  });
});

// Delete Account
$(document).on("click", "#getSmartDelete", function () {
  $("#deleteAction").val("Delete");
  $("#deleteNetworkID").val($(this).data("id"));
  $("#deleteNetworkNAME").val($(this).data("name"));
  $("#deleteMessage").text(
    "Are you sure to delete the account with name of " +
      $(this).data("name") +
      "?"
  );
});

// Reset Table
$("#resetTable").click(function (x) {
  $("#accountSearchForm")[0].reset();
  var newTable = $("#smartTable").DataTable();
  newTable.clear().destroy();
  loadSmartTable();
});

if (document.querySelector(".datetimepicker")) {
  flatpickr(".datetimepicker", {
    allowInput: false,
    disableMobile: true,
    // enableTime: true,
    // altInput: true,
    // altFormat: "F j, Y",
    dateFormat: "Y-m-d",
  }); // flatpickr
}
