<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $bio = $_POST['bio'];
    $gender = $_POST['gender'];
    $hobbies = implode(", ", $_POST['hobbies']);
    $age = $_POST['age'];

    $sql = "UPDATE participants SET name='$name', email='$email', alamat='$alamat', bio='$bio', gender='$gender', hobbies='$hobbies', age='$age' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data peserta berhasil diupdate!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM participants WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Peserta</title>
</head>
<body>
    <h1>Update Peserta</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br><br>
        <label for="bio">Alasan:</label>
        <textarea id="bio" name="bio" rows="4" cols="50"><?php echo $row['bio']; ?></textarea><br><br>
        <label for="gender">Jenis Kelamin:</label><br>
        <input type="radio" id="male" name="gender" value="male" <?php if($row['gender'] == 'male') echo 'checked'; ?>>
        <label for="male">Laki-laki</label><br>
        <input type="radio" id="female" name="gender" value="female" <?php if($row['gender'] == 'female') echo 'checked'; ?>>
        <label for="female">Perempuan</label><br><br>
        <label for="hobbies">Jenis Lomba:</label><br>
        <?php
        $hobbies = explode(", ", $row['hobbies']);
        ?>
        <input type="checkbox" id="coloring" name="hobbies[]" value="coloring" <?php if(in_array('coloring', $hobbies)) echo 'checked'; ?>>
        <label for="coloring">Mewarnai</label><br>
        <input type="checkbox" id="painting" name="hobbies[]" value="painting" <?php if(in_array('painting', $hobbies)) echo 'checked'; ?>>
        <label for="painting">Melukis</label><br>
        <input type="checkbox" id="speech" name="hobbies[]" value="speech" <?php if(in_array('speech', $hobbies)) echo 'checked'; ?>>
        <label for="speech">Pidato</label><br><br>
        <label for="age">Umur:</label>
        <select id="age" name="age">
            <option value="4" <?php if($row['age'] == 4) echo 'selected'; ?>>4 Tahun</option>
            <option value="5" <?php if($row['age'] == 5) echo 'selected'; ?>>5 Tahun</option>
            <option value="6" <?php if($row['age'] == 6) echo 'selected'; ?>>6 Tahun</option>
        </select><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
