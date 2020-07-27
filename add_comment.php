<?php
include("bd.php");
$taskk_id=$_GET['id'];
$projj_id=$_GET['idd'];
$id_members=$_GET['iddd'];
$comment = $_POST['comment'];
$comment = stripslashes($comment);
$comment = htmlspecialchars($comment);
$result = mysqli_query($db, "INSERT INTO Comments (comment_text, id_task_card, id_members) VALUES ('$comment','$taskk_id','$id_members')");
echo '<script>window.location.href = "task_card.php?id='.$taskk_id.'&idd='.$projj_id.'";</script>';
?>