<?php
    $host = "localhost";
    $user = "i912491v_bd";
    $pass = "123456";
    $db_name = "i912491v_bd";
    $db = mysqli_connect($host, $user, $pass, $db_name);
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
?>