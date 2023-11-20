<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task2_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];

        $stmt = $conn->prepare("UPDATE users SET username=:username, email=:email WHERE id=:id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "اطلاعات کاربر با موفقیت به‌روز رسانی شد.";
    } else {
        $id = $_GET["id"];
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="edit_user.php" method="post">
        <div class="mb-3 mt-3">
            <label for="id" class="form-label">id</label>
            <input type="text" class="form-control" name="id">
        </div>
        <div class="mb-3 mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <br>
    </form>
</div>
</body>
</html>