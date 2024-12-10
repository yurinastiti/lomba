<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta</title>
</head>
<body>
    <h1>Daftar Peserta</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Alasan</th>
            <th>Jenis Kelamin</th>
            <th>Jenis Lomba</th>
            <th>Umur</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM participants";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["alamat"] . "</td>
                        <td>" . $row["bio"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["hobbies"] . "</td>
                        <td>" . $row["age"] . "</td>
                        <td>
                            <a href='update.php?id=" . $row["id"] . "'>Edit</a> |
                            <a href='delete.php?id=" . $row["id"] . "'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Tidak ada peserta</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
