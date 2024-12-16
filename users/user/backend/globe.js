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
  loadGlobeTable();

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

function loadGlobeTable() {
  $.ajax({
    url: "../../query/administrator/network_fetch.php",
    method: "POST",
    data: { networkType: "globe", fetchType: "notFilter" },
    success: function (data) {
      // Destroy the existing DataTable instance
      var existingTable = $("#globeTable").DataTable();
      existingTable.clear().destroy();

      try {
        data = JSON.parse(data);
        var globeTable = $("#globeTable").DataTable({
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

        globeTable
          .buttons()
          .container()
          .appendTo("#globeTable_wrapper .col-md-6:eq(0)");
      } catch (error) {
        console.error("Error parsing JSON data:", error);
      }
    },
  });
}

$("#addGlobe").on("hidden.bs.modal", function () {
  $(':input[type="submit"]').prop("disabled", false);
  $("#addGlobe-title").text("Add New Account");
  $("#fname").text("");
  $(".textive").removeClass("focused is-focused");
  $("#imagePreview").attr("src", "");
  $("#addGlobe_form")[0].reset();

  // Remove Choices values
  if (choices["acc_Branch"]) {
    choices["acc_Branch"].setChoiceByValue("");
  }
  if (choices["accountStatus"]) {
    choices["accountStatus"].setChoiceByValue("");
  }
  if (choices["finalStatus"]) {
    choices["finalStatus"].setChoiceByValue("");
  }
  if (choices["acc_type"]) {
    choices["acc_type"].setChoiceByValue("");
  }
});

$('#paymentModal, #transmitModal').on("hidden.bs.modal", function () {
  $(':input[type="submit"]').prop("disabled", false);
});

// Add Account
$(document).on("click", "#AddNewGlobe", function () {
  $("#action").val("AddGlobe");
  $(".main-content").removeClass("ps ps--scrolling-y");
});

// Add Account query
$("#addGlobe_form").submit(function (e) {
  $(':input[type="submit"]').prop("disabled", true);
  e.preventDefault();

  $.ajax({
    url: "../../query/administrator/network_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      if ($("#action").val() == "AddGlobe") {
        Swal.fire({
          icon: "success",
          titleText: "Succesfully Added!",
          text: "New Account has been created!",
          showConfirmButton: false,
          timer: 2500,
        });
      } else {
        console.log(data);
        Swal.fire({
          icon: "success",
          titleText: "Account Updated!",
          text: "Account information has been updated!",
          showConfirmButton: false,
          timer: 2500,
        });
      }
      $("#addGlobe").modal("hide");
      loadGlobeTable();
      $("#addGlobe_form")[0].reset();
    },
  });
});

// Update Account
$(document).on("click", "#getGlobeUpdate", function () {
  $("#action").val("updateGlobe");
  $(".textive").addClass("focused is-focused");
  $(".main-content").removeClass("ps ps--scrolling-y");

  var mydata = {
    slip_id: $(this).data("id"),
    slip_type: "globe",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#addGlobe-title").text(
        "Update " + result.register_name + " of " + result.branch
      );
      $("#networkID").val(result.globe_id);
      $("#accountNO").val(result.account_no);
      $("#registerNO").val(result.register_no);
      $("#registerName").val(result.register_name);
      $("#dueDate").val(result.duedate);
      $("#acqui_date").val(result.acquisition_date);
      $("#register_add").val(result.register_address);
      $("#account_username").val(result.username);
      $("#account_password").val(result.password);
      $("#accMonthly").val(result.monthly);
      $("#accEmail").val(result.email);
      $("#accPhone").val(result.phone);
      $("#acc_serialno").val(result.serial_no);
      $("#accImei1").val(result.imei1);
      $("#accImei2").val(result.imei2);

      // Update Choices values
      if (choices["acc_Branch"]) {
        choices["acc_Branch"].setChoiceByValue(result.branch);
      }
      if (choices["accountStatus"]) {
        choices["accountStatus"].setChoiceByValue(result.account_status);
      }
      if (choices["finalStatus"]) {
        choices["finalStatus"].setChoiceByValue(result.final_status);
      }
      if (choices["acc_type"]) {
        choices["acc_type"].setChoiceByValue(result.account_type);
      }

      $("#username").val(result.username);
    },
  });
});

// Fetching Account info in modal
$(document).on("click", "#getGlobeView", function () {
  $(".main-content").removeClass("ps ps--scrolling-y");
  const mydata = {
    slip_id: $(this).data("id"),
    slip_type: "globe",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      // Set values in the modal
      $("#viewGlobe_title").text(`${result.register_name} Information`);
      $("#acc_name").text(result.register_name);
      $("#acc_branch").text(result.branch);
      $("#acc_billing").text(result.account_type);
      $("#acc_datepaid").text(result.date_paid || "-");
      $("#acc_no").text(result.account_no);
      $("#acc_id").text(result.globe_id);
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
        $("#paid_ID").val(result.globe_id);
      });

      // Transmit Button handling
      $(document).on("click", "#transmitButton", function () {
        $("#transmitID").val(result.globe_id);
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
$(document).on("click", "#getGlobeSOA", function () {
  $(".main-content").removeClass("ps ps--scrolling-y");
  $("#offcanvasRightLabel").text("SOA - " + $(this).data("name"));

  var mydata = {
    soa_id: $(this).data("id"),
    soa_type: "globe",
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

// PAID query
$("#payment_form").submit(function (e) {
  $(':input[type="submit"]').prop("disabled", true);
  e.preventDefault(); // Prevent the default form submission

  var formData = new FormData(this); // Create FormData object with the form data

  // Append files from Dropzone to FormData
  paymentDropzone.files.forEach(function (file) {
    formData.append("attachment[]", file); // Append each file
  });

  $.ajax({
    url: "../../query/administrator/paid_query.php",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        icon: "success",
        titleText: "Thank You!",
        text: "Payment Transaction Complete!",
        showConfirmButton: false,
        timer: 2500,
      });
      $("#paymentModal").modal("hide");
      loadGlobeTable();
      $("#payment_form")[0].reset();
      paymentDropzone.removeAllFiles(); // Clear Dropzone after submission
    },
    error: function (error) {
      console.error("Submission error: ", error);
    },
  });
});

// Transmit Form query
$("#TransmitForm").submit(function (e) {
  $(':input[type="submit"]').prop("disabled", true);
  e.preventDefault();

  var formData = new FormData(this); // Create FormData object with the form data

  // Append files from Dropzone to FormData
  transmitDropzone.files.forEach(function (file) {
    formData.append("transmit_attachment[]", file); // Append each file
  });

  $.ajax({
    url: "../../query/administrator/transmit_query.php",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        icon: "success",
        titleText: "Thank You!",
        text: "Transmitted Complete!",
        showConfirmButton: false,
        timer: 2500,
      });
      $("#transmitModal").modal("hide");
      loadGlobeTable();
      $("#TransmitForm")[0].reset();
      transmitDropzone.removeAllFiles(); // Clear Dropzone after submission
    },
    error: function (error) {
      console.error("Submission error: ", error);
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
      var newTable = $("#globeTable").DataTable();
      newTable.clear().destroy();

      var newTable = $("#globeTable")
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
        .appendTo("#globeTable_wrapper .col-md-6:eq(0)");
    },
  });
});

// Reset Table
$("#resetTable").click(function (x) {
  $("#accountSearchForm")[0].reset();
  var newTable = $("#globeTable").DataTable();
  newTable.clear().destroy();
  loadGlobeTable();
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

Dropzone.autoDiscover = false;
var drop1 = document.getElementById("transmit_dropzone");
var transmitDropzone = new Dropzone(drop1, {
  url: "../../query/administrator/transmit_query.php",
  addRemoveLinks: true,
  acceptedFiles: ".pdf",
  paramName: "transmit_attachment[]",
  maxFiles: 1,
  success: function (file, response) {
    console.log("File uploaded successfully: ", file.name);
    file.previewElement.classList.add("dz-success");

    if (file.type === "application/pdf") {
      // Set a custom thumbnail for PDF files
      var pdfThumbnailUrl = "../../image/pdf.png"; // Update with your thumbnail path
      file.previewElement.classList.add("dz-image-preview");
      file.previewElement.classList.remove("dz-file-preview");
      var thumbnailElement = file.previewElement.querySelector(
        "[data-dz-thumbnail]"
      );
      if (thumbnailElement) {
        thumbnailElement.src = pdfThumbnailUrl; // Set the thumbnail image source
        thumbnailElement.style.width = "100%";
        thumbnailElement.style.height = "100%";
      }
    } else {
    }
  },
  error: function (file, response) {
    console.error("Upload error: ", response);
    file.previewElement.classList.add("dz-error");
  },
  removedfile: function (file) {
    // Remove the preview element
    var _ref = file.previewElement;
    if (_ref) {
      _ref.parentNode.removeChild(_ref);
    }

    // Optionally handle server-side removal logic here if needed
    console.log("File removed: ", file.name);
  },
});

var drop2 = document.getElementById("payment_dropzone");
var paymentDropzone = new Dropzone(drop2, {
  url: "../../query/administrator/paid_query.php",
  addRemoveLinks: true,
  acceptedFiles: ".pdf",
  paramName: "attachment[]",
  maxFiles: 1,
  success: function (file, response) {
    console.log("File uploaded successfully: ", file.name);
    file.previewElement.classList.add("dz-success");

    if (file.type === "application/pdf") {
      // Set a custom thumbnail for PDF files
      var pdfThumbnailUrl = "../../image/pdf.png"; // Update with your thumbnail path
      file.previewElement.classList.add("dz-image-preview");
      file.previewElement.classList.remove("dz-file-preview");
      var thumbnailElement = file.previewElement.querySelector(
        "[data-dz-thumbnail]"
      );
      if (thumbnailElement) {
        thumbnailElement.src = pdfThumbnailUrl; // Set the thumbnail image source
        thumbnailElement.style.width = "100%";
        thumbnailElement.style.height = "100%";
      }
    } else {
    }
  },
  error: function (file, response) {
    console.error("Upload error: ", response);
    file.previewElement.classList.add("dz-error");
  },
  removedfile: function (file) {
    // Remove the preview element
    var _ref = file.previewElement;
    if (_ref) {
      _ref.parentNode.removeChild(_ref);
    }

    // Optionally handle server-side removal logic here if needed
    console.log("File removed: ", file.name);
  },
});
