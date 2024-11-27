$(document).ready(function () {
  loadActivityLog();
  setInterval(loadActivityLog, 1000);
});

function loadActivityLog() {
  const formatDate = (date) =>
    dateFns.formatDistanceToNow(new Date(date), { addSuffix: true });

  $.ajax({
    url: "../../query/administrator/activity_log.php",
    method: "POST",
    success: function (data) {
      data = JSON.parse(data);

      // Clear existing timeline entries
      $("#timeline_container").empty();

      // Loop through all entries and append to the timeline
      data.data.forEach(function (row) {
        // Determine the icon based on the action (row[4])
        let icon, action;
        if (row[4] === "ADD") {
          icon =
            '<span class="timeline-step bg-secondary"><i class="material-icons text-white">add</i></span>';
          action = '<span class="badge bg-gradient-secondary">ADD</span>';
        } else if (row[4] === "UPDATE") {
          icon =
            '<span class="timeline-step bg-info"><i class="material-icons text-white">update</i></span>';
          action = '<span class="badge bg-gradient-info">UPDATE</span>';
        } else if (row[4] === "DELETE") {
          icon =
            '<span class="timeline-step bg-danger"><i class="material-icons text-white">delete</i></span>';
          action = '<span class="badge bg-gradient-danger">DELETE</span>';
        } else if (row[4] === "TRANSMITTED") {
          icon =
            '<span class="timeline-step bg-success"><i class="material-icons text-white">inventory</i></span>';
          action = '<span class="badge bg-gradient-success">TRANSMIT</span>';
        } else if (row[4] === "PAID") {
          icon =
            '<span class="timeline-step bg-warning"><i class="material-icons text-white">payments</i></span>';
          action = '<span class="badge bg-gradient-warning">PAID</span>';
        } else {
          icon =
            '<i class="material-icons text-secondary text-gradient">info</i>';
        }

        var timelineEntry = `
            <div class="timeline-block mb-2 mt-2">
                ${icon}
                <div class="timeline-content">
                    <div class="d-flex my-2 float-end">${action}</div>
                    <h6 class="text-white text-sm font-weight-bold mb-0">${
                      row[1]
                    }</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                    <i class="fa fa-clock-o me-1 text-sm"></i>${formatDate(
                      row[2]
                    )}</p>
                </div>
            </div>`;

        $("#timeline_container").append(timelineEntry);
      });
    },
  });
}
