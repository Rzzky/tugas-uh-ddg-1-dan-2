<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

// Membuat fungsi untuk mengonversi array hasil dari database menjadi tampilan tabel
function generateTable($result) {
    $table = '<table>';
    $table .= '<tr><th>Title</th><th>Author</th><th>Year</th><th>Action</th></tr>';
    while($row = $result->fetch_assoc()) {
        $table .= "<tr>";
        $table .= "<td>".$row['title']."</td>";
        $table .= "<td>".$row['author']."</td>";
        $table .= "<td>".$row['year']."</td>";
        $table .= "<td><button onclick=\"deleteBook('".$row['id']."','".$row['title']."')\">Delete</button></td>";
        $table .= "</tr>";
    }
    $table .= '</table>';
    return $table;
}

// Mendapatkan semua buku dari tabel 'books'
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Books</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>My Books</h2>
        <?php 
            if ($result->num_rows > 0) {
                echo generateTable($result);
            } else {
                echo "<p>Belum Ada Buku Yang Ditambahkan.</p>";
            }
        ?>
        <p><a href="add_book.php">Tambahkan Buku Baru</a> | <a href="logout.php">Logout</a></p>
    </div>

    <script>
        function deleteBook(id, title) {
            swal({
                title: "Apakah Kamu Yakin Ingin Menghapus Bukunya?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    fetch("delete_book.php?id=" + id)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Success!", "Buku Berhasil Di Hapus", "success")
                            .then(() => {
                                location.reload();
                            });
                        } else {
                            swal("Error!", "ErRoR !?" + data.error, "error");
                        }
                    })
                    .catch(error => {
                        swal("Error!", "ErRoR !?", "error");
                    });
                } else {
                    swal("The book '" + title + "' is safe!");
                }
            });
        }
    </script>
</body>
</html>
