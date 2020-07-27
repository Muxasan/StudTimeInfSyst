<?php
    include("bd.php");
    $taskk_id = $_GET["id"];
    $result=mysqli_query($db,"SELECT id FROM Comments WHERE id_task_card='$taskk_id'");
    if($row=mysqli_fetch_array($result)){
        mysqli_query($db,"DELETE FROM `Comments` WHERE Comments.id='$taskk_id'");
    }
    mysqli_query($db,"DELETE FROM `Task_card` WHERE Task_card.id='$taskk_id'");
    echo '<script>window.location.href = "task_card.php";</script>';
?>