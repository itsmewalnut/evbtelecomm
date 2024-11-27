$(document).ready(function () {
  $.ajax({
    url: "../../upcoming.php", // Adjust if needed
    method: "POST",
    dataType: "json",
    success: function (result) {
      // If there are no upcoming due dates
      if (result.message) {
        console.log(result.message);
        return; // Exit if no upcoming due dates
      }

      let foundUpcomingDue = false; // Flag to track if we find any upcoming due

      // Create a container for all the carousel items
      let carouselItems = "";
      let carouselIndicators = ""; // To store indicators

      // Get current date
      const currentDate = new Date();

      result.forEach(function (record, index) {
        const dueDateString = record.duedate; // Get the due date from the record
        const dueDate = new Date(dueDateString);

        // Calculate 5 days before the due date
        const fiveDaysBefore = new Date(dueDate);
        fiveDaysBefore.setDate(dueDate.getDate() - 5);

        // Check if the current date is between 5 days before and the due date
        if (currentDate >= fiveDaysBefore && currentDate < dueDate) {
          // Set flag to true since we found an upcoming due date
          foundUpcomingDue = true;

          // Create the carousel item for this record
          carouselItems += `
            <div class="carousel-item ${index === 0 ? "active" : ""}">
              <div class="card shadow-none upcomingBG" style="background-image: url('../../assets/img/small-logos/${
                record.table_type
              }.png');">
                <div class="card-header bg-transparent text-center">
                  <div class="row justify-content-between">
                    <div class="col-md-4 text-start">
                      <img class="mb-2 w-30 p-2" src="../../image/EVBGOC.png" alt="Logo">
                      <h6 class="text-white">${record.branch}</h6>
                      <p class="d-block text-white">Register No: <span class="text-bold">${
                        record.register_no
                      }</span></p>
                    </div>
                    <div class="col-lg-3 col-md-7 text-md-end text-start mt-4">
                      <h6 class="d-block mt-2 mb-0 text-white">Billed to: <span>${
                        record.register_name
                      }</span></h6>
                      <p class="text-white mb-0">${record.email}</p>
                      <p class="text-white">${record.register_address}</p>
                    </div>
                  </div>
                  <br>
                  <div class="row justify-content-md-between">
                    <div class="col-md-4 mt-auto">
                      <h6 class="mb-0 text-start text-white font-weight-normal">Network ID</h6>
                      <h6 class="mb-0 text-start text-white">#${record.id}</h6>
                    </div>
                    <div class="col-lg-5 col-md-7 mt-auto">
                      <div class="row mt-md-5 mt-4 text-md-end text-start">
                        <div class="col-md-6">
                          <h6 class="text-white font-weight-normal mb-0">Acquisition date:</h6>
                        </div>
                        <div class="col-md-6">
                          <h6 class="text-white mb-0">${formatDate(
                            record.acquisition_date
                          )}</h6>
                        </div>
                      </div>
                      <div class="row text-md-end text-start">
                        <div class="col-md-6">
                          <h6 class="text-white font-weight-normal mb-0">Due date:</h6>
                        </div>
                        <div class="col-md-6">
                          <h6 class="text-white mb-0">${formatDate(
                            record.duedate
                          )}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body mb-3">
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table text-right text-white">
                          <thead>
                            <tr>
                              <th scope="col" class="pe-2 text-start ps-2">Account No</th>
                              <th scope="col" class="pe-2">Payment Plan</th>
                              <th scope="col" class="pe-2" colspan="2">Subscription</th>
                              <th scope="col" class="pe-2">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-start">${record.account_no}</td>
                              <td class="ps-4">${record.account_type}</td>
                              <td class="ps-4" colspan="2">1 month</td>
                              <td class="ps-4">${record.monthly}</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th></th>
                              <th></th>
                              <th class="h5 ps-4 text-white" colspan="2">Total Amount</th>
                              <th colspan="1" class="text-right text-white h5 ps-4">${
                                record.monthly
                              }</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>`;

          // Create the indicator for this record
          carouselIndicators += `
            <li data-bs-target="#upcomingCarousel" data-bs-slide-to="${index}" class="${
            index === 0 ? "active" : ""
          }"></li>`;
        }
      });

      // If there are any upcoming due dates, display them in the carousel
      if (foundUpcomingDue) {
        $("#carouselUpcoming").html(carouselItems); // Insert all carousel items into the carousel container
        $("#carouselIndicators").html(carouselIndicators); // Insert all indicators into the indicators container
        $("#upcomingCarousel").carousel("cycle"); // Start the carousel automatically if needed
        setTimeout(function () {
          $("#upcoming").modal("show"); // Show the modal
        }, 900);
      } else {
        console.log("No upcoming due date. Take rest!");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", status, error);
    },
  });
});

// Format date to "MM/DD/YYYY" format
const formatDate = (date) => {
  const options = { year: "numeric", month: "long", day: "numeric" };
  return new Date(date).toLocaleDateString("en-US", options);
};
