<?php include 'path/to/db_tambah.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta</title>
</head>
<body>
    <h1>Tambah Peserta Baru</h1>
    <form action="create.php" method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br><br>
        <label for="bio">Alasan:</label>
        <textarea id="bio" name="bio" rows="4" cols="50"></textarea><br><br>
        <label for="gender">Jenis Kelamin:</label><br>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Laki-laki</label><br>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Perempuan</label><br><br>
        <label for="hobbies">Jenis Lomba:</label><br>
        <input type="checkbox" id="coloring" name="hobbies[]" value="coloring">
        <label for="coloring">Mewarnai</label><br>
        <input type="checkbox" id="painting" name="hobbies[]" value="painting">
        <label for="painting">Melukis</label><br>
        <input type="checkbox" id="speech" name="hobbies[]" value="speech">
        <label for="speech">Pidato</label><br><br>
        <label for="age">Umur:</label>
        <select id="age" name="age">
            <option value="4">4 Tahun</option>
            <option value="5">5 Tahun</option>
            <option value="6">6 Tahun</option>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $bio = $_POST['bio'];
        $gender = $_POST['gender'];
        $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';
        $age = $_POST['age'];

        // Prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("INSERT INTO participants (name, email, alamat, bio, gender, hobbies, age) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $alamat, $bio, $gender, $hobbies, $age);

        if ($stmt->execute()) {
            echo "Peserta baru berhasil ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
