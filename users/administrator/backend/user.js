// Update user
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
  loadUserTable();

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

function loadUserTable() {
  $.ajax({
    url: "../../query/administrator/user_fetch.php",
    method: "POST",
    data: { fetchType: "notFilter" },
    success: function (data) {
      // Destroy the existing DataTable instance
      var existingTable = $("#userTable").DataTable();
      existingTable.clear().destroy();

      try {
        data = JSON.parse(data);
        var userTable = $("#userTable").DataTable({
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          autoWidth: false,
          responsive: true,
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

        userTable
          .buttons()
          .container()
          .appendTo("#userTable_wrapper .col-md-6:eq(0)");
      } catch (error) {
        console.error("Error parsing JSON data:", error);
      }
    },
  });
}

$("#addUser").on("hidden.bs.modal", function () {
  $("#adduser-title").text("Add New User");
  $("#fname").text("");
  $("#fname_active, #mname_active, #lname_active, #uname_active").removeClass(
    "focused is-focused"
  );
  $("#imagePreview").attr("src", "");
  $("#adduser_form")[0].reset();
  $(':input[type="submit"]').prop("disabled", false);

  // Update Choices values
  if (choices["role"]) {
    choices["role"].setChoiceByValue("");
  }
  if (choices["branch"]) {
    choices["branch"].setChoiceByValue("");
  }
  if (choices["department"]) {
    choices["department"].setChoiceByValue("");
  }
});

// Add user
$(document).on("click", "#AddNewUser", function () {
  $("#Addaction").val("AddUser");
});

// Add user query
$("#adduser_form").submit(function (e) {
  $(':input[type="submit"]').prop("disabled", true);
  e.preventDefault();

  $.ajax({
    url: "../../query/administrator/user_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      if ($("#action").val() == "AddUser") {
        Swal.fire({
          icon: "success",
          titleText: "Succesfully Added!",
          text: "New user has been created!",
          showConfirmButton: false,
          timer: 2500,
        });
      } else {
        Swal.fire({
          icon: "success",
          titleText: "User  Updated!",
          text: "User information has been updated!",
          showConfirmButton: false,
          timer: 2500,
        });
      }
      $("#addUser").modal("hide");
      loadUserTable();
      $("#adduser_form")[0].reset();
    },
  });
});

$(document).on("click", "#getUserUpdate", function () {
  $("#Addaction").val("updateUser");
  $("#fname_active, #mname_active, #lname_active, #uname_active").addClass(
    "focused is-focused"
  );
  $("#adduser-title").text("Update User Information");

  var mydata = {
    slip_id: $(this).data("id"),
    forPage: "others",
  };

  $.ajax({
    url: "../../query/administrator/user_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#accountID").val(result.user_id);
      $("#imagePreview").attr("src", result.avatar);
      $("#fname").text(result.fullname);
      $("#fullname").text(result.fullname);
      $("#firstname").val(result.firstname);
      $("#middlename").val(result.middlename);
      $("#lastname").val(result.lastname);

      // Update Choices values
      if (choices["role"]) {
        choices["role"].setChoiceByValue(result.role);
      }
      if (choices["branch"]) {
        choices["branch"].setChoiceByValue(result.branch);
      }
      if (choices["department"]) {
        choices["department"].setChoiceByValue(result.department);
      }

      $("#username").val(result.username);
    },
  });
});

// Fetching user info in modal
$(document).on("click", "#getUserView", function () {
  mydata = {
    slip_id: $(this).data("id"),
    forPage: "others",
  };

  $.ajax({
    url: "../../query/administrator/user_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#viewUserImage").attr("src", result.avatar);
    },
  });
});

// Activate user
$(document).on("click", "#getUserActivate", function () {
  $("#deactivateID").val($(this).data("id"));
  $("#action").val("Activate");
  $("#DeactivateModalLabel").text("Activate User");
  $("#deactivate").val("activate");
  $("#deactivateMessage").text(
    "Are you sure want to ACTIVATE this account? " + $(this).data("name")
  );
});

// Deactivate user
$(document).on("click", "#getUserDeactivate", function () {
  $("#deactivateID").val($(this).data("id"));
  $("#action").val("Deactivate");
  $("#deactivate").val("deactivate");
  $("#DeactivateModalLabel").text("Deactivate User");
  $("#deactivateMessage").text(
    "Are you sure want to DEACTIVATE this account? " + $(this).data("name")
  );
});

// Deactivate user query
$("#deactivate_form").on("submit", function (a) {
  a.preventDefault();
  $.ajax({
    url: "../../query/administrator/user_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      if ($("#action").val() == "deactivate") {
        Swal.fire({
          icon: "success",
          titleText: "Account Deactivated!",
          text: "Account Deactivated Successfully!",
          showConfirmButton: false,
          timer: 2500,
        });
      } else {
        Swal.fire({
          icon: "success",
          titleText: "Account Activated!",
          text: "Account Activated Successfully!",
          showConfirmButton: false,
          timer: 2500,
        });
      }
      $("#deactivate_form")[0].reset();
      $("#deactivateUser").modal("hide");
      loadUserTable();
    },
  });
});

// Delete user query
$("#deleteUserForm").submit(function (e) {
  e.preventDefault();
  $.ajax({
    url: "../../query/administrator/user_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        icon: "success",
        titleText: "User Deleted!",
        text: "User has been deleted!",
        showConfirmButton: false,
        timer: 2500,
      });
      $("#deleteUser").modal("hide");
      loadUserTable();
      $("#deleteUserForm")[0].reset();
    },
  });
});

// Delete user
$(document).on("click", "#getUserDelete", function () {
  $("#deleteAction").val("Delete");
  $("#deleteUserID").val($(this).data("id"));
  $("#deleteMessage").text(
    "Are you sure to delete the account with name of " +
      $(this).data("name") +
      "?"
  );
});
