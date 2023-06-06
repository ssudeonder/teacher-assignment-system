<?php require_once 'common.php'; ?>
<html>
<head>
<title>Teachers</title>
<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>

<div class="top">
  <div class="bar white padding card" style="letter-spacing:4px;">
    <a href="/" class="bar-item button">Teacher management</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="right hide-small">
      <a href="/schools.php" class="bar-item button">Schools</a>
      <a href="/teachers.php" class="bar-item button">Teachers</a>
      <a href="/assigns.php" class="bar-item button">Assigns</a>
    </div>
  </div>
</div>
<div class="main">
    <h1 style="text-align: center;">Teachers</h1>
    <p style="text-align:center;"><a href="/add-teacher.php" class="button">Add Teacher</a></p>
<?php
$conn = new mysqli('127.0.0.1:3306', 'root', '', 'okul');
if ($conn->connect_error) {
    die("Unable to connect!");
}
$sql = "SELECT * FROM teacher";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Section</th>
        <th></th>
        <th></th>
      </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['section'] ?></td>
            <td><p style="text-align:center;"><a href="/update-teacher.php?id=<?= $row['id'] ?>"  class="button">Update</a></p></td>
            <td><p style="text-align:center;"><a href="/delete-teacher.php?id=<?= $row['id'] ?>"  class="button">Delete</a></p></td>
        </tr>
        <?php
    } ?>
    </table>
    <?php
} else {
        ?>
    <h2 style="text-align:center;">There is no teacher. Please add teachers.</h2>
    <?php
    }
?>
</div>
</body>
</html>
<?php
$conn->close();
    ?>