// Initialize Choices for all dropdowns
var choices = {};

function initializeChoices() {
  // Array of dropdown IDs
  var dropdownIds = ["role", "branch", "department"];

  dropdownIds.forEach(function (id) {
    var element = document.getElementById(id);
    if (element) {
      choices[id] = new Choices(element, {
        searchEnabled: false,
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
  $("#addGlobe-title").text("Add New Account");
  $("#fname").text("");
  $("#fname_active, #mname_active, #lname_active, #uname_active").removeClass(
    "focused is-focused"
  );
  $("#imagePreview").attr("src", "");
  $("#addGlobe_form")[0].reset();
});

// Add Account
$(document).on("click", "#AddNewGlobe", function () {
  $("#Addaction").val("AddGlobe");
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
  $("#Addaction").val("updateGlobe");
  $("#fname_active, #mname_active, #lname_active, #uname_active").addClass(
    "focused is-focused"
  );
  $("#addGlobe-title").text("Update Account Information");

  var mydata = {
    slip_id: $(this).data("id"),
    forPage: "others",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#accountID").val(result.globe_id);
      $("#imagePreview").attr("src", result.avatar);
      $("#fname").text(result.fullname);
      $("#fullname").text(result.fullname);
      $("#firstname").val(result.firstname);
      $("#middlename").val(result.middlename);
      $("#lastname").val(result.lastname);

      // Update Choices values
      if (choices["role"]) {
        choices["role"].setChoiceByValue(result.role);
      } else if (choices["branch"]) {
        choices["branch"].setChoiceByValue(result.branch);
      } else if (choices["department"]) {
        choices["department"].setChoiceByValue(result.department);
      }

      $("#username").val(result.username);
    },
  });
});

// Fetching Account info in modal
$(document).on("click", "#getGlobeView", function () {
  mydata = {
    slip_id: $(this).data("id"),
    forPage: "others",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#viewUserImage").attr("src", result.avatar);
    },
  });
});

// Delete Account query
$("#deleteGlobeForm").submit(function (e) {
  e.preventDefault();
  $.ajax({
    url: "../../query/administrator/network_query.php",
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
