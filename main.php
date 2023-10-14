<?php

function startSystem()
{
  date_default_timezone_set('Asia/Manila');

  $closing_time = 9;

  if (date("H:") == $closing_time - 1) {
    echo "Library will close at $closing_time. Please time out.";
  }
  invalidateSessionsAt($closing_time);
}
