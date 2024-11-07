<?php
include('connect.php');

if (isset($_POST['btnSubmitClient'])) {
    $username = $_POST['username'];
    $userInfoID = $_POST['userInfoID'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    $clientQuery = "INSERT INTO clients (username, userInfoID, email, phoneNumber) VALUES ('$username', '$userInfoID', '$email', '$phoneNumber')";
    executeQuery($clientQuery);
}

if (isset($_POST['btnDelete'])) {
    $idako = $_POST['idako'];
    $deleteQuery = "DELETE FROM clients WHERE clientID = '$idako'";
    executeQuery($deleteQuery);
}

$query = "SELECT * FROM clients";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <style>
        .card {
            background-color: #333;
            color: #fff;
        }

        .card:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
        }
    </style>
</head>

<body data-bs-theme="dark">
    <div class="container mt-5">
        <h2>Our Clients</h2>
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($client = mysqli_fetch_assoc($result)) {
                    ?>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card my-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $client['username']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $client['email']; ?></h6>
                                <p class="card-text">Client ID: <?php echo $client['clientID']; ?></p>
                                <p class="card-text">Phone: <?php echo $client['phoneNumber']; ?></p>
                                <form method="post">
                                    <input type="hidden" value="<?php echo $client['clientID']; ?>" name="idako">
                                    <button class="btn btn-danger" name="btnDelete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>

        <form method="post" class="mt-5">
            <h3>Add a New Client</h3>
            <input type="text" name="username" placeholder="Username" class="form-control my-2" required>
            <input type="text" name="userInfoID" placeholder="User Info ID" class="form-control my-2" required>
            <input type="email" name="email" placeholder="Email" class="form-control my-2" required>
            <input type="text" name="phoneNumber" placeholder="Phone Number" class="form-control my-2" required>
            <button type="submit" name="btnSubmitClient" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>