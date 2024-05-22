<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO books (title, author, year) VALUES ('$title', '$author', '$year')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                window.onload = function() {
                    swal('Success!', 'Buku Berhasil Ditambahkan!', 'success').then((value) => {
                        window.location.href = 'view_books.php';
                    });
                };
             </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Book</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>
        <form method="POST">
            <label for="title">Nama Buku:</label>
            <input type="text" id="title" name="title" required>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
            <label for="year">Tahun:</label>
            <input type="number" id="year" name="year" required>
            <button type="submit">Tambahkan Buku Baru</button>
        </form>
        <p><a href="view_books.php">Lihat List Buku</a> | <a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
