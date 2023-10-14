<?php

function getOneById($student_id)
{
  require('./inc/dbconn/db-library.conn.php');

  $sql = "SELECT * FROM tbl_students WHERE student_id = :student_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
