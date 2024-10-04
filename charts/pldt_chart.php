<?php
include('../../database/db_conn.php');

$sql = mysqli_query($conn, "SELECT COUNT(final_status) AS paid_status FROM pldt_table WHERE final_status = 'PAID'");
while ($row = $sql->fetch_assoc()) {
    $count = $row['paid_status'];
}
$sql = mysqli_query($conn, "SELECT COUNT(final_status) AS transmitted_status FROM pldt_table WHERE final_status = 'TRANSMITTED'");
while ($row = $sql->fetch_assoc()) {
    $count1 = $row['transmitted_status'];
}
$sql = mysqli_query($conn, "SELECT COUNT(final_status) AS unpaid_status FROM pldt_table WHERE final_status = 'UNPAID'");
while ($row = $sql->fetch_assoc()) {
    $count2 = $row['unpaid_status'];
}

$sql = mysqli_query($conn, "SELECT COUNT(*) AS pldt_status FROM pldt_table");
while ($row = $sql->fetch_assoc()) {
    $pldt_status = $row['pldt_status'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Donut</title>
</head>

<body>
    <div class="row">
        <div class="col-5 text-center">
            <div class="chart">
                <canvas id="chart-pldt" class="chart-canvas" height="197"></canvas>
            </div>
            <h4 class="font-weight-bold mt-n8">
                <span id="pldt_stats" countto="<?php echo $pldt_status; ?>"><?php echo $pldt_status; ?></span>
                <span class="d-block text-body text-sm">TOTAL</span>
            </h4>
        </div>
        <div class="col-7">
            <div class="table-responsive mt-4">
                <table class="table align-items-center mb-0">
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-0">
                                    <span class="badge bg-gradient-warning me-3"> </span>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">PAID</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs"> <?php echo $count; ?> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-0">
                                    <span class="badge bg-gradient-success me-3"> </span>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">TRANSMITTED</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs"> <?php echo $count1; ?> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-0">
                                    <span class="badge bg-gradient-danger me-3"> </span>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">UNPAID</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs"> <?php echo $count2; ?> </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var ctx1 = document.getElementById("chart-pldt").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        new Chart(ctx1, {
            type: "doughnut",
            data: {
                labels: ['PAID', 'TRANSMITTED', 'UNPAID'],
                datasets: [{
                    label: "Status",
                    weight: 9,
                    cutout: 60,
                    tension: 0.9,
                    pointRadius: 3,
                    borderWidth: 1,
                    backgroundColor: ['#fb8c00', '#43a047', '#e53935'],
                    data: [<?php echo $count; ?>, <?php echo $count1; ?>, <?php echo $count2; ?>],
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });
    </script>
</body>

</html>