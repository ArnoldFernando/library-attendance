<?php
require('./inc/dbconn/dbconn.php');

  <form method="post">
    <label for="student_id">Enter Student ID:</label>
    <input type="text" name="student_id" id="student_id" placeholder="e.g., S001">
    <input type="submit" name="search" value="Search">
  </form>

    if (isset($_POST['search'])) {
      $search_id = $_POST['student_id'];
      $sql = "SELECT * FROM tbl_students WHERE student_id = :student_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':student_id', $search_id, PDO::PARAM_STR);
      $stmt->execute();
      $student = $stmt->fetch(PDO::FETCH_ASSOC);
        $time_in_button = !get_active_session_by_student_id($_POST['student_id']) ? '<button type="submit" name="time_in">Time In</button>' : '<button disabled type="submit" name="time_in">Time In</button>';

        $time_out_button = !get_active_session_by_student_id($_POST['student_id']) ? '<button disabled type="submit" name="time_out">Time Out</button>' : '<button type="submit" name="time_out">Time Out</button>';

