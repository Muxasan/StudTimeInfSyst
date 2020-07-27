<!DOCTYPE html>
<html lang="en">
<head>
<title>Akono | Articles</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="styles/style.css" />
<!--[if IE 6]>
<script src="js/ie6-transparency.js"></script>
<script>DD_belatedPNG.fix('#header img, #featured-section h2, #circles img, #frontpage-sidebar .read-more, .blue-bullets li, #sidebar .sidebar-button, #project-content .read-more, .more-link, #contact-form .submit, .jcarousel-skin-tango .jcarousel-next-horizontal, .jcarousel-skin-tango .jcarousel-prev-horizontal, #commentform .submit');</script>
<style>body { behavior: url("styles/ie6-hover-fix.htc"); }</style>
<link rel="stylesheet" href="styles/ie6.css" />
<![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="styles/ie7.css" /><![endif]-->
<!--[if IE 8]><link rel="stylesheet" href="styles/ie8.css" /><![endif]-->
</head>
<body class="page">
  <div id="wrap">
    <div id="header"> 
               <?php
require_once("includes/header.php");	// подключаем наш header.php
if ($_GET["idd"]!=NULL){
    $proj_id=$_GET["idd"];
}
else
{
    $proj_id=$myrow['id_projects'];
}
?>
      <!--end nav-->
    </div>
  <!--end header-->
  <br>
  <div class="page-headline">Общий список задач</div>
  <div id="main">
    
    <div id="content">
      <div class="post" >
        <table class="blueTable">
            <thead>
            <tr>
            <th>№ задачи</th>
            <th>Название</th>
            <th>Назначена</th>
            <th>Статус</th>
            <th>Трудоёмкость</th>
            </tr>
            </thead>
            <!--
            <tfoot>
            <tr>
            <td colspan="5">
            <div class="links"><a href="#">&laquo;</a> <a class="active" href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a></div>
            </td>
            </tr>
            </tfoot>-->
            <tbody>
            <?php
            $query22 = mysqli_query($db, "SELECT Task_card.id, Type_status.type_status_name, Users.fio, Task_card.laboriousness, Task_card.task_card_name 
                                            FROM Type_status, Task_card, Members, Users 
                                            WHERE '$proj_id'=Members.id_projects AND Task_card.id_members=Members.id 
                                            AND Users.id_members=Members.id AND Type_status.id=Task_card.id_status ORDER BY Type_status.id");
            while($row22 = mysqli_fetch_array($query22)){
                echo '<tr>';
                echo '<td>'.$row22['id'].'</td>';
                if($_SESSION['id_system_roles']!=3){echo '<td><a href="task_card.php?id='.$row22['id'].'&idd='.$proj_id.'">'.$row22['task_card_name'].'</td>';}
                else{echo '<td>'.$row22['task_card_name'].'</td>';}
                echo '<td>'.$row22['fio'].'</td>';
                echo '<td>'.$row22['type_status_name'].'</td>';
                echo '<td>'.$row22['laboriousness'].' дней</td>';
                echo '</tr>';
            }?>
            </tbody>
            </table>
       
      </div>
      <!--end post-->
      <div class="post-line"></div>
    </div>
    <!--end content-->
    <div id="sidebar">
      <div id="hire" style="margin-left:20px;">
        <form action="export1.php?idd=<?php echo $proj_id; ?>" method="post">
        <h4 class="sidebar-title">Выгрузить статисику по</h4>  
        <select name="id" style="margin-left:20px; width:260px;">
            <?php
	      	$query26 = mysqli_query($db,"SELECT * FROM Users, Members WHERE Members.id=Users.id_members AND Members.id_projects='$proj_id' AND (Users.id_system_roles=2 OR Users.id_system_roles=4)");
	      	while ($row26 = mysqli_fetch_array($query26))
	      	{
	      	    echo '<option value="'.$row26['id_members'].'">'.$row26['fio'].'</option>';
	      	}?>
        </select>
        <br>
        <br>
        <input type="submit" class="btn btn-success" value ='Export' name="button" style="margin-left:100px;"></div>
        </form>
      <!--end hire-->
       <?php if($_SESSION['id_system_roles']==2 or $_SESSION['id_system_roles']==1) {?> <div id="hire"style="margin-top:10px;margin-left:20px;border:1px solid #d7d7d7;">
       <h4 class="sidebar-title" >Создать новую задачу</h4>
       <a class="btn btn-success" href="add_task.php?idd=<?php echo $proj_id; ?>" role="button" style="margin-left:100px;margin-bottom:5px">Создать</a>
     </div><?php } ?>
      <!--end recent-projects-->
    </div>
    
    <!--end sidebar-->
  </div>

  <!--end main-->
  <div id="footer">
    
  </div>
  <!--end footer-->
</div>
<!--end wrap-->
</body>
<div class="cache-images"><img src="images/red-button-bg.png" width="0" height="0" alt="" /><img src="images/black-button-bg.png" width="0" height="0" alt="" /></div>
<!--end cache-images-->
</html>