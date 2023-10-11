<?php
require('./inc/dbconn/dbconn.php');

function get_active_session_by_student_id($student_id)
{
  require('./inc/dbconn/dbconn.php');
  $sql = "SELECT * FROM tbl_sessions WHERE student_id = :student_id AND validity = true";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC) ?? null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Attendance</title>
</head>

<body>
  <h1>Library Attendance</h1>
  <form method="post">
    <label for="student_id">Enter Student ID:</label>
    <input type="text" name="student_id" id="student_id" placeholder="e.g., S001">
    <input type="submit" name="search" value="Search">
  </form>

  <?php
  try {
    if (isset($_POST['search'])) {
      $search_id = $_POST['student_id'];
      $sql = "SELECT * FROM tbl_students WHERE student_id = :student_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':student_id', $search_id, PDO::PARAM_STR);
      $stmt->execute();
      $student = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
      <table border='1'>
        <tr>
          <th>Student ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>functions</th>
        </tr>

        <?php

        // echo "<hr>";
        // echo var_dump(get_active_session_by_student_id($_POST['student_id']));
        // echo "<hr>";
        $time_in_button = !get_active_session_by_student_id($_POST['student_id']) ? '<button type="submit" name="time_in">Time In</button>' : '<button disabled type="submit" name="time_in">Time In</button>';

        $time_out_button = !get_active_session_by_student_id($_POST['student_id']) ? '<button disabled type="submit" name="time_out">Time Out</button>' : '<button type="submit" name="time_out">Time Out</button>';

        ?>
        <tr>
          <td><?= $student['student_id'] ?></td>
          <td><?= $student['last_name'] ?></td>
          <td><?= $student['first_name'] ?></td>
          <td>
            <form action="session.php" method="post">
              <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
              <?= $time_in_button ?>
              <?= $time_out_button ?>
            </form>
          </td>
        </tr>
      </table>
    $sql = "SELECT * FROM tbl_students LIMIT 10;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($students = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <table border='1'>
        <tr>
          <th>Student ID</th>
          <th>Last Name</th>
          <th>First Name</th>
        </tr>
        <tr>
          <td><?= $students['student_id'] ?></td>
          <td><?= $students['last_name'] ?></td>
          <td><?= $students['first_name'] ?></td>
        </tr>
      </table>

  <?php
    }
  } catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
  }
  ?>
</body>

</html>

<!-- 

  when I click "time in" button, I want to create a session with that student_id
  
-->