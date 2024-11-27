function logout(event) {
  event.preventDefault();

  Swal.fire({
    title: "Are you sure?",
    text: "Make sure to save all files before you logout!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#f44335",
    confirmButtonText: "Yes, log out!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "../../logout.php";
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const currentYear = new Date().getFullYear();
  document.getElementById("currentYear").textContent = currentYear;
});
