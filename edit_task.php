<?php
include("bd.php");
header("Content-Type: text/html; charset=utf-8");
$taskk_id=$_GET['id'];
$projj_id=$_GET['idd'];
$status = $_POST['status'];
$priority = $_POST['priority'];
$tasktype = $_POST['tasktype'];
$member = $_POST['members'];
$query11 = mysqli_query($db,"SELECT * FROM Type_status WHERE '$status' = type_status_name");
$row11 = mysqli_fetch_array($query11);
$query12 = mysqli_query($db,"SELECT * FROM Type_priority WHERE '$priority' = type_priority_name");
$row12 = mysqli_fetch_array($query12);
$query13 = mysqli_query($db,"SELECT * FROM Task_type WHERE '$tasktype' = task_type_name");
$row13 = mysqli_fetch_array($query13);
$query14 = mysqli_query($db,"SELECT * FROM Users WHERE '$member' = fio");
$row14 = mysqli_fetch_array($query14);
$status = $row11['id'];
$priority = $row12['id'];
$tasktype = $row13['id'];
$member = $row14['id_members'];
$query14 = mysqli_query($db,"SELECT * FROM Task_card WHERE id='$taskk_id'");
$row14 = mysqli_fetch_array($query14);
if ($_POST['description']==null){
    $desc = $row14['description'];
}else{
    $desc = $_POST['description'];
}
if ($_POST['deadlines']==0){
    $dead = $row14['deadlines'];
}else{
    $dead = $_POST['deadlines'];
}
if ($_POST['laboriousness']==0){
    $labor = $row14['laboriousness'];
}else{
    $labor = $_POST['laboriousness'];
}
$dead = stripslashes($dead);
$dead = htmlspecialchars($dead);
$dead = trim($dead);
$labor = stripslashes($labor);
$labor = htmlspecialchars($labor);
$labor = trim($labor);
$desc = stripslashes($desc);
$desc = htmlspecialchars($desc);
$datenow = date('Y-m-d');
if($status==$row14['id_status']){
$resultz = mysqli_query($db, "UPDATE Task_card SET description='$desc', deadlines='$dead', id_status='$status', laboriousness='$labor', id_priority='$priority', id_members='$member', id_task_type='$tasktype' WHERE id='$taskk_id'");}
else{
$resultx = mysqli_query($db, "UPDATE Task_card SET description='$desc', deadlines='$dead', id_status='$status', laboriousness='$labor', id_priority='$priority', id_members='$member', id_task_type='$tasktype' WHERE id='$taskk_id'");
if ($status==4)
{
    $iddd = $row14['id_members'];
    $difference = intval(abs(strtotime($row14['actual_time']) - strtotime($row14['startworkdate'])));
    $worktime = $difference / 86400;
    if ($worktime == 0){$worktime=1;}
    if ($worktime > 500){$worktime=0;}
    $query15 = mysqli_query($db,"SELECT * FROM Members WHERE id = '$iddd'");
    $row15 = mysqli_fetch_array($query15);
    if ($row15['worktime']!=0)
    {
        $worktime = $worktime + $row15['worktime'];
    }
    $resu = mysqli_query($db,"UPDATE Members SET worktime='$worktime' WHERE id='$iddd'");
    $resulttt = mysqli_query($db,"UPDATE Task_card SET actual_time='$datenow' WHERE id='$taskk_id'");
}
if ($status==3)
{
    $iddd = $row14['id_members'];
    $difference = intval(abs(strtotime($row14['actual_time']) - strtotime($row14['startworkdate'])));
    $worktime = $difference / 86400;
    if ($worktime == 0){$worktime=1;}
    if ($worktime > 500){$worktime=0;}
    $query15 = mysqli_query($db,"SELECT * FROM Members WHERE id = '$iddd'");
    $row15 = mysqli_fetch_array($query15);
    if ($row15['worktime']!=0)
    {
        $worktime = $worktime + $row15['worktime'];
    }
    $resu = mysqli_query($db,"UPDATE Members SET worktime='$worktime' WHERE id='$iddd'");
    $resulttt = mysqli_query($db,"UPDATE Task_card SET actual_time='$datenow' WHERE id='$taskk_id'");
    $resultttt = mysqli_query($db,"UPDATE Task_card SET startworkdate='$datenow' WHERE id='$taskk_id'");
}
if ($status==2 AND $row14['startworkdate']==0)
{
    $resultttt = mysqli_query($db,"UPDATE Task_card SET startworkdate='$datenow' WHERE id='$taskk_id'");
}
}
echo '<script>window.location.href = "task_card.php?id='.$taskk_id.'&idd='.$projj_id.'";</script>';
?>