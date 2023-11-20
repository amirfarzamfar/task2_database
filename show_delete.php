<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task2_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete"])) {
            $id = $_POST["delete"];
            $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "کاربر با موفقیت حذف شد.";
        } elseif (isset($_POST["edit"])) {
            $id = $_POST["edit"];
            header("Location: edit_user.php?id=$id");
            exit();
        }
    }

    $stmt = $conn->prepare("SELECT id, username, email FROM users");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>نمایش اطلاعات کاربران</title>
</head>
<body>

<h2>لیست کاربران</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>نام کاربری</th>
        <th>ایمیل</th>
        <th>عملیات</th>
    </tr>
    <?php
    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>
                    <form method='post'>
                        <button type='submit' name='edit' value='" . $row["id"] . "'>ویرایش</button>
                        <button type='submit' name='delete' value='" . $row["id"] . "'>حذف</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>هیچ کاربری یافت نشد.</td></tr>";
    }
    ?>
</table>

</body>
</html>
