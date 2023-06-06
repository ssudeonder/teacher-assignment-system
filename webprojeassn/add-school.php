<?php require_once 'common.php';?>
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
    <h1 style="text-align: center;">Add School</h1>
    <p style="text-align:center;"><a href="/schools.php" class="button">Return</a></p>
<?php
if (count($_POST) > 0) {
    $name = $_POST['name'];
    $physics = $_POST['physics'];
    $math = $_POST['math'];
    $computer = $_POST['computer'];
    $history = $_POST['history'];
    $music = $_POST['music'];
    if ($name && $music >= 0 && $history >=0 && $computer >= 0 && $math >=0 && $physics >=0) {
        $conn    = new mysqli('127.0.0.1:3306', 'root', '', 'okul') or die('Unable To connect');
        $sql = "INSERT INTO school (name, physics, math, computer, history, music) VALUES ('".$name."', ".$physics.", ".$math.", ".$computer.", ".$history.", ".$music.");";
        if ($conn->query($sql) === true) {
            header("Location:schools.php");
        } else {
            echo "<p style=\"text-align:center;\">Error. Please check your input.</p>";
        }
    } else {
        echo "<p style=\"text-align:center;\">Error. Please check your input.</p>";
    }
}
?>
<form name="form" method="post" action="" align="center">
  <div>
    <div><label>School Name:</label></div>
    <div><input type="text" name="name"></div>
  </div>
  <div>
    <div><label>Physics Section Count:</label></div>
    <div><input type="number" name="physics" value="0"></div>
  </div>
  <div>
    <div><label>Math Section Count:</label></div>
    <div><input type="number" name="math" value="0"></div>
  </div>
  <div>
    <div><label>Computer Section Count:</label></div>
    <div><input type="number" name="computer" value="0"></div>
  </div>
  <div>
    <div><label>History Section Count:</label></div>
    <div><input type="number" name="history" value="0"></div>
  </div>
  <div>
    <div><label>Music Section Count:</label></div>
    <div><input type="number" name="music" value="0"></div>
  </div>
  <input type="submit" name="submit" value="Submit">
  <input type="reset">
</form>
</div>
</body>
</html>
<?php
$conn->close();
    ?>