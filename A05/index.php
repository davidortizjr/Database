<?php
include('connect.php');

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
            margin: 0;
        }
        .navbar {
            background-color: #222;
            border-bottom: 2px solid #444;
        }
        .navbar-brand, .nav-link {
            color: #f2f2f2;
            font-weight: 500;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #bbb;
        }
        .header-section {
            text-align: center;
            padding: 80px 0;
            background: linear-gradient(135deg, #282828 0%, #1a1a1a 100%);
        }
        .header-section h1 {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .header-section p {
            font-size: 1.5em;
            color: #bbb;
            margin-bottom: 50px;
        }
        .clients-section {
            padding: 60px 0;
        }
        .clients-section h2 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 40px;
            color: #bbb;
        }
        .client-card {
            background-color: #333;
            border: none;
            transition: transform 0.2s;
        }
        .client-card:hover {
            transform: scale(1.05);
        }
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #222;
            border-top: 2px solid #444;
            color: #bbb;
        }
        footer p {
            margin: 0;
            font-weight: 300;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
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
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($client = $result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card client-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($client['username']); ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($client['email']); ?></h6>
                                    <p class="card-text">Client ID: <?php echo htmlspecialchars($client['clientID']); ?></p>
                                    <p class="card-text">Phone: <?php echo htmlspecialchars($client['phoneNumber']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No clients found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer class="container">
        <p>&copy; 2024 Client Management. All Rights Reserved.</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>