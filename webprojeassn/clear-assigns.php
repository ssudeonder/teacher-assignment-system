<?php require_once 'common.php';?>
<html>
<head>
<title>Clear</title>
<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
<div class="main">
<?php
if (!isset($_GET['id'])) {
    header("Location:assigns.php");
}
$conn    = new mysqli('127.0.0.1:3306', 'root', '', 'okul') or die('Unable To connect');
$sql = "DELETE FROM assign";
if ($conn->query($sql) === true) {
    header("Location:assigns.php");
} else {
    echo "<p style=\"text-align:center;\">Error.</p>";
}

?>
</div>
</body>
</html>
<?php
$conn->close();
    ?>