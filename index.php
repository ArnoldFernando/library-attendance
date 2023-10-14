<?php
require('./main.php');
require('./inc/dbconn/db-library.conn.php');
require('./helpers/queries/db-library/tbl_students.queries.php');
require('./helpers/queries/db-library/tbl_sessions.queries.php');
require('./session.php');

startSystem();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Attendance</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Library Attendance</h1>
  <form method="post">
    <label for="student_id">Enter Student ID:</label>
    <input type="text" name="student_id" id="student_id" placeholder="e.g., S001">
    <input type="submit" name="search" value="Search" required>
  </form>

  <?php
  try {
    if (isset($_POST['search'])) {
      $search_id = $_POST['student_id'];
      $student = getOneById($search_id);
      if (!$student) {
  ?>
        <h1 class="error">No student found!</h1>
      <?php
      } else {
      ?>
        <table border='1'>
          <tr>
            <th>Student ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>TIME IN/OUT</th>
          </tr>

          <tr>
            <td><?= $student['student_id'] ?></td>
            <td><?= $student['last_name'] ?></td>
            <td><?= $student['first_name'] ?></td>
            <td>
              <form action="session.php" method="post">
                <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
                <button <?= (hasActiveSession($search_id) ? "disabled" : "") ?> type="submit" name="time_in">Time In</button>
                <button <?= (!hasActiveSession($search_id) ? "disabled" : "") ?> type="submit" name="time_out">Time Out</button>
              </form>
            </td>
          </tr>
        </table>


        <div class="active-session">


          <table>
            <tr>
              <th>Student Id</th>
              <th>Student Name</th>
              <th>Student Session</th>
            </tr>

        <?php
      }
    }

    echo "<h2>Active Sessions</h2>";

    $active_sessions = getAllActiveSessions();
        ?>


        <?php
        // print_r($active_sessions);
        foreach ($active_sessions as $active_session) {
          // Process each session
        ?>
          <tr>
            <td><?php echo $active_session['session_id']; ?></td>
            <td><?php echo $active_session['first_name']; ?></td>
            <td><?php echo  "<strong class='session-sec'>" .  $active_session['session_seconds'] . "</strong> seconds" ?></td>
            <!-- echo "<div class='session-details'>Session ID: " . $active_session['session_id'] . "</div>";
            echo "<div class='student-name'>Student name: " . $active_session['first_name'] . " " . $active_session['last_name'] . "</div>";
            echo "<div class='session-duration'>Student session duration in seconds: <strong class='session-sec'>" .  $active_session['session_seconds'] . "</strong> seconds</div>";
             -->
        <?php
        }
      } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
      }
        ?>

          </table>
        </div>


        <script src="./script.js" defer></script>
</body>

</html>