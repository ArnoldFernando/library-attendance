<?php
require('./helpers/queries/tbl_sessions.queries.php');
require('./helpers/queries/tbl_students.queries.php');

$search_id = $_POST['student_id'];
$student = getOneById($search_id);
