<?php require_once 'common.php'; ?>
<html>
<head>
<title>Schools</title>
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
    <h1 style="text-align: center;">Schools</h1>
    <p style="text-align:center;"><a href="/add-school.php" class="button">Add School</a></p>
<?php
$conn = new mysqli('127.0.0.1:3306', 'root', '', 'okul');
if ($conn->connect_error) {
    die("Unable to connect!");
}
$sql = "SELECT * FROM school";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Physics Sections</th>
        <th>Math Sections</th>
        <th>Computer Sections</th>
        <th>History Sections</th>
        <th>Music Sections</th>
        <th></th>
        <th></th>
      </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['physics'] ?></td>
            <td><?= $row['math'] ?></td>
            <td><?= $row['computer'] ?></td>
            <td><?= $row['history'] ?></td>
            <td><?= $row['music'] ?></td>
            <td><p style="text-align:center;"><a href="/update-school.php?id=<?= $row['id'] ?>"  class="button">Update</a></p></td>
            <td><p style="text-align:center;"><a href="/delete-school.php?id=<?= $row['id'] ?>"  class="button">Delete</a></p></td>
        </tr>
        <?php
    } ?>
    </table>
    <?php
} else {
        ?>
    <h2 style="text-align:center;">There is no school. Please add schools.</h2>
    <?php
    }
?>
</div>
</body>
</html>
<?php
$conn->close();
    ?>