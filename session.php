function open_session($student_id)
{
  require('./inc/dbconn/dbconn.php');
  $currentDateTime = date('Y-m-d H:i:s');
  $randomBytes = random_bytes(12);
  $session_id = bin2hex($randomBytes);
  $sql = "INSERT INTO tbl_sessions (session_id, student_id, time_in, validity) VALUES (:session_id, :student_id, :current_date_time, true)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
  $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
  $stmt->bindParam(':current_date_time', $currentDateTime, PDO::PARAM_STR);
  $stmt->execute();
}

