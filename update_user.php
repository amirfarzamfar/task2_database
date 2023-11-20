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
    <form action="update_user.php" method="post">
        <div class="mb-3 mt-3">
            <label for="username2" class="form-label">Username2</label>
            <input type="text" class="form-control" name="username2">
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

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=task2_database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare("UPDATE users
                           SET username = ?,
                               email = ?
                           WHERE username = ?");

    $sql->bindParam(1, $username);
    $sql->bindParam(2, $email);
    $sql->bindParam(3, $username2);
    $sql->execute();

    echo "Record updated successfully";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
} finally {
    $conn = null; // Close the connection
}
?>
