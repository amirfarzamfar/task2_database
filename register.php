<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task2_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        echo "ثبت نام با موفقیت انجام شد.";
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
    <title>ثبت نام کاربر</title>
</head>
<body>

<h2>ثبت نام کاربر</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    نام کاربری: <input type="text" name="username" required><br>
    ایمیل: <input type="email" name="email" required><br>
    رمز عبور: <input type="password" name="password" required><br>
    <input type="submit" value="ثبت نام">
</form>

</body>
</html>
