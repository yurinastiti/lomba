<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM participants WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Peserta berhasil dihapus!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: read.php");
exit();
?>
