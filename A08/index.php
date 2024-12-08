<?php
include("connect.php");

$departureFilter = $_GET['departureAirportCode'] ?? '';
$arrivalFilter = $_GET['arrivalAirportCode'] ?? '';
$airlineFilter = $_GET['airlineName'] ?? '';
$sortBy = $_GET['sort'] ?? '';
$orderBy = $_GET['order'] ?? 'ASC';

$query = "SELECT * FROM flightLogs";

if ($departureFilter || $arrivalFilter || $airlineFilter) {
    $query .= " WHERE";

    if ($departureFilter) {
        $query .= " departureAirportCode = '$departureFilter'";
    }

    if ($departureFilter && ($arrivalFilter || $airlineFilter)) {
        $query .= " AND";
    }

    if ($arrivalFilter) {
        $query .= " arrivalAirportCode = '$arrivalFilter'";
    }

    if ($arrivalFilter && $airlineFilter) {
        $query .= " AND";
    }

    if ($airlineFilter) {
        $query .= " airlineName = '$airlineFilter'";
    }
}

if ($sortBy) {
    $query .= " ORDER BY $sortBy";

    if ($orderBy) {
        $query .= " $orderBy";
    }
}

$results = executeQuery($query);

$departureOptions = executeQuery("SELECT DISTINCT departureAirportCode FROM flightLogs");
$arrivalOptions = executeQuery("SELECT DISTINCT arrivalAirportCode FROM flightLogs");
$airlineOptions = executeQuery("SELECT DISTINCT airlineName FROM flightLogs");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUP Airport Flight Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">PUP AIRPORT LOGS</h1>
        <form class="my-5">
            <div class="row">
                <div class="col">
                    <label for="departureFilter" class="form-label">Departure Airport</label>
                    <select id="departureFilter" name="departureAirportCode" class="form-select">
                        <option value="">Any</option>
                        <?php while ($row = mysqli_fetch_assoc($departureOptions)) { ?>
                            <option value="<?= $row['departureAirportCode'] ?>"
                                <?= $row['departureAirportCode'] == $departureFilter ? 'selected' : '' ?>>
                                <?= $row['departureAirportCode'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="arrivalFilter" class="form-label">Arrival Airport</label>
                    <select id="arrivalFilter" name="arrivalAirportCode" class="form-select">
                        <option value="">Any</option>
                        <?php while ($row = mysqli_fetch_assoc($arrivalOptions)) { ?>
                            <option value="<?= $row['arrivalAirportCode'] ?>" <?= $row['arrivalAirportCode'] == $arrivalFilter ? 'selected' : '' ?>>
                                <?= $row['arrivalAirportCode'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="airlineFilter" class="form-label">Airline</label>
                    <select id="airlineFilter" name="airlineName" class="form-select">
                        <option value="">Any</option>
                        <?php while ($row = mysqli_fetch_assoc($airlineOptions)) { ?>
                            <option value="<?= $row['airlineName'] ?>" <?= $row['airlineName'] == $airlineFilter ? 'selected' : '' ?>>
                                <?= $row['airlineName'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="sort" class="form-label">Sort By</label>
                    <select id="sort" name="sort" class="form-select">
                        <option value="">Select</option>
                        <option value="departureDatetime" <?= $sortBy == 'departureDatetime' ? 'selected' : '' ?>>Departure
                            Date</option>
                        <option value="arrivalDatetime" <?= $sortBy == 'arrivalDatetime' ? 'selected' : '' ?>>Arrival Date
                        </option>
                        <option value="ticketPrice" <?= $sortBy == 'ticketPrice' ? 'selected' : '' ?>>Ticket Price</option>
                    </select>
                </div>
                <div class="col">
                    <label for="order" class="form-label">Order</label>
                    <select id="order" name="order" class="form-select">
                        <option value="ASC" <?= $orderBy == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                        <option value="DESC" <?= $orderBy == 'DESC' ? 'selected' : '' ?>>Descending</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Flight Number</th>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Duration (Minutes)</th>
                    <th>Airline</th>
                    <th>Aircraft Type</th>
                    <th>Ticket Price</th>
                    <th>Credit Card Number</th>
                    <th>Pilot Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results)) { ?>
                    <tr>
                        <td><?= $row['flightNumber'] ?></td>
                        <td><?= $row['departureAirportCode'] ?></td>
                        <td><?= $row['arrivalAirportCode'] ?></td>
                        <td><?= $row['departureDatetime'] ?></td>
                        <td><?= $row['arrivalDatetime'] ?></td>
                        <td><?= $row['flightDurationMinutes'] ?></td>
                        <td><?= $row['airlineName'] ?></td>
                        <td><?= $row['aircraftType'] ?></td>
                        <td><?= $row['ticketPrice'] ?></td>
                        <td><?= $row['creditCardNumber'] ?></td>
                        <td><?= $row['pilotName'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>