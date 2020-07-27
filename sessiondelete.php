<?php
    session_start();
    $_SESSION['id'] = 0;
    Header('Location:index.php')
?>