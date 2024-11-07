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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f2f2f2;
            font-family: 'Montserrat', sans-serif;
        }

        .card {
            background-color: #333;
            color: #fff;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .header-section {
            text-align: center;
            padding: 80px 0;
            background: linear-gradient(135deg, #282828 0%, #1a1a1a 100%);
        }

        .header-section h1 {
            font-size: 3.5em;
            font-weight: 700;
        }

        .clients-section {
            padding: 60px 0;
        }

        .clients-section h2 {
            font-size: 2.5em;
            font-weight: 700;
            color: #bbb;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #222;
            border-top: 2px solid #444;
            color: #bbb;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Client List</a>
        </div>
    </nav>

    <section class="header-section">
        <div class="container">
            <h1>Welcome to the Client List</h1>
        </div>
    </section>

    <section class="clients-section text-center">
        <div class="container">
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
    </section>

    <section class="container my-5">
        <div class="card bg-dark text-light p-4 shadow">
            <h3 class="card-title mb-4">Add a New Client</h3>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" class="form-control"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="userInfoID">User Info ID</label>
                    <input type="text" id="userInfoID" name="userInfoID" placeholder="User Info ID" class="form-control"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number"
                        class="form-control" required>
                </div>
                <button type="submit" name="btnSubmitClient" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Client Management. All Rights Reserved.</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>