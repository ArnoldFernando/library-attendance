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
