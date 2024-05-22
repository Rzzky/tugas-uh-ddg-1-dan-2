<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #333;
        }

        .welcome {
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome h2 {
            color: #333;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .links a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Selamat Datang Di Dashboard</h2>
        </div>
        <div class="welcome">
            <h2>Welcome, <?php echo $username; ?>!</h2>
        </div>
        <div class="links">
            <a href="add_book.php">Tambah Buku Baru</a>
            <a href="view_books.php">Tampilkan List Buku</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
