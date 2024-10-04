<?php
include('../../database/db_conn.php');

// Function to fetch events from a given table
function fetchEvents($conn, $tableName)
{
    // Define the column names based on the table
    if ($tableName === 'globe_table') {
        $idColumn = 'globe_id';
    } elseif ($tableName === 'smart_table') {
        $idColumn = 'smart_id';
    } elseif ($tableName === 'pldt_table') {
        $idColumn = 'pldt_id';
    } else {
        return []; // Return empty if the table is not recognized
    }

    // Query with the appropriate column names
    $announcementrs = mysqli_query($conn, "SELECT $idColumn AS id, duedate, register_name, monthly FROM $tableName WHERE MONTH(duedate) = MONTH(now())");

    if (!$announcementrs) {
        die("Query failed: " . mysqli_error($conn)); // Output error if query fails
    }

    $rows = array();
    while ($r = mysqli_fetch_assoc($announcementrs)) {
        $event = array(
            'id' => $r['id'],
            'name' => $r['register_name'],
            'date' => $r['duedate'],
            'description' => 'Monthly - ' . $r['monthly'],
            'type' => 'event',
            'color' => '#63d867'
        );
        $rows[] = $event; // Add the event to the array
    }

    return $rows; // Return the array of events
}

// Fetch events from each table
$globe_events = fetchEvents($conn, 'globe_table');
$smart_events = fetchEvents($conn, 'smart_table');
$pldt_events = fetchEvents($conn, 'pldt_table');

// Merge all events into one array
$all_events = array_merge($globe_events, $smart_events, $pldt_events);

$data_array = json_encode($all_events);

// Uncomment for debugging
// echo $data_array;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="stylesheet" type="text/css" href="../../evo-calendar/css/evo-calendar.css" />
    <link rel="stylesheet" type="text/css" href="../../evo-calendar/css/evo-calendar.midnight-blue.css" />
    <link rel="stylesheet" type="text/css" href="../../evo-calendar/css/evo-calendar.royal-navy.css" />

    <style type="text/css">
        .hero {
            width: 100%;
            height: 100%;
            position: relative;
        }

        #calendar {
            width: 100%;
            top: 50%;
            line-height: 1;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="hero">
        <div id="calendar"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../evo-calendar/js/evo-calendar.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').evoCalendar({
            theme: "Midnight Blue",
            todayHighlight: true,
            sidebarDisplayDefault: false,
            calendarEvents: <?php echo $data_array; ?> // Directly use the merged JSON array
        });
    });
</script>