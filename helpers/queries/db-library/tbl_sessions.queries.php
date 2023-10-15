<?php
function hasActiveSession($student_id)
{
  require('./inc/dbconn/db-library.conn.php');
  $sql = "SELECT * FROM tbl_sessions WHERE student_id = :student_id AND validity = true";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
}

function getAllActiveSessions()
{
  require('./inc/dbconn/db-library.conn.php');
  $sql = "SELECT s.session_id, s.student_id, st.last_name, st.first_name, s.time_in, s.time_out, TIMESTAMPDIFF(SECOND, s.time_in, NOW()) AS session_seconds 
        FROM tbl_sessions AS s 
        LEFT JOIN tbl_students AS st ON s.student_id = st.student_id 
        WHERE s.validity = 1 AND s.time_out IS NULL
        ORDER BY session_seconds DESC;";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
