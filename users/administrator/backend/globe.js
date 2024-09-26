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
      $("#globe_username").val(result.username);
      $("#globe_password").val(result.password);
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
  mydata = {
    slip_id: $(this).data("id"),
    slip_type: "globe",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#viewGlobe_title").text(result.register_name + " Information");
      $("#acc_name").text(result.register_name);
      $("#acc_branch").text(result.branch);
      $("#acc_billing").text(result.account_type);
      $("#acc_datepaid").text(result.date_paid);
      $("#acc_no").text(result.account_no);
      $("#acc_email").text(result.email);
      $("#acc_rno").text(result.register_no);
      $("#acc_address").text(result.register_address);
      $("#acc_username").text(result.username);
      $("#acc_password").text(result.password);
      $("#acc_phone").text(result.phone);
      $("#acc_sno").text(result.serial_no);
      $("#acc_imei1").text(result.imei1);
      $("#acc_imei2").text(result.imei2);

      if (result.paid_amount) {
        $("#acc_amount").text(result.paid_amount);
      } else {
        $("#acc_amount").text("-");
      }

      if (result.final_status == "TRANSMITTED") {
        $("#acc_finalstatus").text("TRANSMITTED");
      } else if (result.final_status == "PAID") {
        $("#acc_finalstatus").text("PAID");
      } else {
        $("#acc_finalstatus").text("UNPAID");
      }

      if (result.remarks) {
        $("#acc_remarks").text(result.remarks);
      } else {
        $("#acc_remarks").text("Encoder has no remarks!");
      }

      // Format the due date
      var dueDate = new Date(result.duedate);
      var options = { year: "numeric", month: "long", day: "numeric" };
      var formattedDueDate = dueDate.toLocaleDateString("en-US", options);
      $("#acc_duedate").text(formattedDueDate);

      // Format the acquisition date
      var acquisitionDate = new Date(result.acquisition_date);
      var formattedAcquisitionDate = acquisitionDate.toLocaleDateString(
        "en-US",
        options
      );
      $("#acc_acqdate").text(formattedAcquisitionDate);

      var $accStatus = $("#acc_status");
      $accStatus.removeClass("bg-gradient-success bg-gradient-secondary");
      if (result.account_status === "ACTIVE") {
        $accStatus.text(result.account_status).addClass("bg-gradient-success");
      } else {
        $accStatus
          .text(result.account_status)
          .addClass("bg-gradient-secondary");
      }
    },
  });
});

// Delete Account query
$("#deleteGlobeForm").submit(function (e) {
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
      $("#deleteGlobe").modal("hide");
      loadGlobeTable();
      $("#deleteGlobeForm")[0].reset();
    },
  });
});

// Delete Account
$(document).on("click", "#getGlobeDelete", function () {
  $("#deleteAction").val("Delete");
  $("#deleteGlobeID").val($(this).data("id"));
  $("#deleteMessage").text(
    "Are you sure to delete the account with name of " +
      $(this).data("name") +
      "?"
  );
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
    allowInput: true,
    // altInput: true,
    // altFormat: "F j, Y",
    dateFormat: "Y-m-d",
  }); // flatpickr
}

Dropzone.autoDiscover = false;
var drop = document.getElementById("dropzone");
var myDropzone = new Dropzone(drop, {
  url: "../../image/user_avatar",
  addRemoveLinks: true,
  acceptedFiles: ".jpg, .png, .jpeg",
});
