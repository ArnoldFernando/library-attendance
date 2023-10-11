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

function close_session($student_id)
{
  require('./inc/dbconn/dbconn.php');
  $currentDateTime = date('Y-m-d H:i:s'); //fix
  $sql = "SELECT * FROM tbl_sessions WHERE student_id = :student_id AND validity = true";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
  $stmt->execute();
  $session = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($session) {
    var_dump($session);

    // setting session timeout
    $sql_time_out = "UPDATE tbl_sessions SET time_out = :time_out WHERE session_id = :session_id ";
    $stmt = $pdo->prepare($sql_time_out);
    $stmt->bindParam(':time_out', $currentDateTime, PDO::PARAM_STR);
    $stmt->bindParam(':session_id', $session['session_id'], PDO::PARAM_STR);
    $stmt->execute();

