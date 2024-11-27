$(document).ready(function () {
  $.ajax({
    url: "../../upcoming.php", // Adjust URL if needed
    method: "POST",
    dataType: "json",
    success: function (result) {
      // If no upcoming due dates, return early
      if (!result || result.length === 0) {
        console.log("No upcoming due dates.");
        return;
      }

      let cardsHtml = ""; // Variable to store HTML for all cards
      let foundUpcomingDue = false; // Flag to track if we find any upcoming due dates

      // Loop through each record in the result to build a card for each due date
      result.forEach(function (record) {
        const dueDateString = record.duedate;
        const dueDate = new Date(dueDateString);
        const currentDate = new Date();

        // Calculate 5 days before the due date
        const fiveDaysBefore = new Date(dueDate);
        fiveDaysBefore.setDate(dueDate.getDate() - 5);

        // Check if current date is within 5 days before the due date
        if (currentDate >= fiveDaysBefore && currentDate < dueDate) {
          foundUpcomingDue = true; // Set flag to true if any due date matches the criteria

          // Create the HTML for the card (one card per record)
          cardsHtml += `
            <div class="card shadow-lg mb-3">
              <div class="card-header text-center">
                <div class="row justify-content-between">
                  <div class="col-md-4 text-start">
                    <img class="mb-2 w-30 p-2" src="../../image/EVBGOC.png" alt="Logo">
                    <h6>${record.branch}</h6>
                    <p class="d-block text-secondary">Register No: <span class="text-bold text-dark">${
                      record.register_no
                    }</span></p>
                  </div>
                  <div class="col-lg-3 col-md-7 text-md-end text-start mt-4">
                    <h6 class="d-block mt-2 mb-0">Billed to: <span>${
                      record.register_name
                    }</span></h6>
                    <p class="text-secondary mb-0">${record.email}</p>
                    <p class="text-secondary">${record.register_address}</p>
                  </div>
                </div>
                <br>
                <div class="row justify-content-md-between">
                  <div class="col-md-4 mt-auto">
                    <h6 class="mb-0 text-start text-secondary font-weight-normal">Status</h6>
                    <span class="float-start badge bg-gradient-danger">unpaid</span>
                  </div>
                  <div class="col-lg-5 col-md-7 mt-auto">
                    <div class="row mt-md-5 mt-4 text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary font-weight-normal mb-0">Acquisition date:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">${new Date(
                          record.acquisition_date
                        ).toLocaleDateString("en-US")}</h6>
                      </div>
                    </div>
                    <div class="row text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary font-weight-normal mb-0">Due date:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">${new Date(
                          record.duedate
                        ).toLocaleDateString("en-US")}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="position-absolute d-flex justify-content-center z-index-1 start-0 bottom-40">
                  <img src="../../assets/img/small-logos/${
                    record.table_type
                  }.png" class="opacity-2 w-80 h-100" alt="Invoice Background Image">
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table text-right">
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
                            <td class="ps-4" colspan="2">${record.monthly}</td>
                            <td class="ps-4">${record.paid_amount || "-"}</td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th></th>
                            <th class="h5 ps-4" colspan="2">Total Amount</th>
                            <th colspan="1" class="text-right h5 ps-4">${
                              record.paid_amount || "-"
                            }</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>`;
        }
      });

      // If there are any upcoming due dates, display them in the modal
      if (foundUpcomingDue) {
        // Insert all the cards into the modal body
        $("#upcomingCardsContainer").html(cardsHtml);
        $("#upcoming").modal("show"); // Show the modal
      } else {
        console.log("No upcoming due date found within the next 5 days.");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", status, error);
    },
  });
});

//html

// <div class="modal fade" id="upcoming" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
//             <div class="modal-dialog modal-dialog-scrollable modal-xl">
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h1 class="modal-title fs-5" id="exampleModalLabel">Upcoming Due Dates</h1>
//                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                     </div>
//                     <div class="modal-body">
//                         <div id="upcomingCardsContainer">
//                             <!-- Cards will be dynamically inserted here -->
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>
