
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
            require_once("includes/header.php");
            $proj_id=$_GET["idd"];
            ?>

         <!--  <li><a href="portfolio.html">Карточка задач</a></li>
          <li><a href="articles.html">Общий список задач</a></li>
          <li><a href="contact.html">Контакты чуваков из одного проекта</a></li>
          <li><a href="">Статистика по закрытым проектам</a></li>
        </ul>    Менюшка строкой если нужно  -->  
      
      <!--end nav-->
    </div>
  <!--end header-->
  <br>
  <div class="page-headline">Добавить новую задачу</div>
  <div id="main">
      

<div class="Forma">
<form action="" method="post">
  <table class="blueTable">
    <tr>
      <td>Название задачи:</td>
      <td><input type="text" name="task_name"></td><!--fio, Users-->
    </tr>
    <tr>
        <td>Дедлайн(Дата):</td>
        <td><input type="date" name="deadline"></td>
    </tr>
    <tr>
        <td>Трудоёмкость(количство дней):</td>
        <td><input type="text" name="laboriousness"></td>
    </tr>
    <tr>
      <td>Назначить:</td>
      <td>
          <?php
        $queryT = "SELECT * FROM Users, Members
                WHERE Members.id_projects = '$proj_id' AND Members.id = Users.id_members AND (Users.id_system_roles=2 OR Users.id_system_roles=4)";
        $resultT = mysqli_query($db, $queryT) or die(mysqli_error());
        ?>
          <select name="id_members" id="id_members">
              <option selected="selected">Выберите назначаемого</option>';
              <?php
              while ($rowT = mysqli_fetch_array($resultT)){ 
                $fios = $rowT['fio'];
	      	    $query233 = mysqli_query($db,"SELECT * FROM Members, Users, Task_card WHERE Members.id=Users.id_members AND Members.id=Task_card.id_members AND Task_card.id_status != 4 AND Users.id_system_roles = 4 AND Users.fio='$fios'");
	      	    while($row233=mysqli_fetch_array($query233)){
	                $count = $count + 1;
	            }
	            if ($count<3){
                echo '<option value="'.$rowT['id_members'].'">'.$rowT['fio'].'</option>';
	            }
	            $fios = 0;
              }
              ?>
          </select>
        </td>
    </tr>
    <tr>
        <td>Приоритет:</td>
        <td>
            <?php
            $queryY = "SELECT * FROM Type_priority";
            $resultY = mysqli_query($db, $queryY) or die(mysqli_error());
            ?>
          <select name="priority" id="priority">
              <option selected="selected">Выберите приоритет задачи</option>';
              <?php
              while ($rowY = mysqli_fetch_array($resultY)){ 
               echo '<option value="'.$rowY['id'].'">'.$rowY['type_priority_name'].'</option>';
              }
              ?>
          </select>
        </td>
    </tr>
    <tr>
        <td>Тип задачи:</td>
        <td>
            <?php
            $queryЕ = "SELECT * FROM Task_type";
            $resultЕ = mysqli_query($db, $queryЕ) or die(mysqli_error());
            ?>
          <select name="tasktype" id="tasktype">
              <option selected="selected">Выберите тип задачи</option>';
              <?php
              while ($rowЕ = mysqli_fetch_array($resultЕ)){ 
               echo '<option value="'.$rowЕ['id'].'">'.$rowЕ['task_type_name'].'</option>';
              }
              ?>
          </select>
        </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" class="btn btn-success" name="button" value="Добавить"></td>
    </tr>
  </table>
</form>

</div>

<?php 
	if (isset($_POST["button"]) and !empty($_POST["task_name"]) and !empty($_POST["deadline"]) and !empty($_POST["laboriousness"]) and !empty($_POST["id_members"]) and !empty($_POST["priority"]) and !empty($_POST["tasktype"]) ){
	    $task_name = $_POST['task_name'];
	    $deadline = $_POST['deadline'];
	    $laboriousness = $_POST['laboriousness'];
	    $id_members = $_POST['id_members'];
	    $priority = $_POST['priority'];
	    $tasktype = $_POST['tasktype'];
	    $task_name = stripslashes($task_name);
        $task_name = htmlspecialchars($task_name);
        $task_name = trim($task_name);
        $deadline = stripslashes($deadline);
        $deadline = htmlspecialchars($deadline);
        $deadline = trim($deadline);
        $laboriousness = stripslashes($laboriousness);
        $laboriousness = htmlspecialchars($laboriousness);
        $laboriousness = trim($laboriousness);
        $id_status = 1;
        $result =  mysqli_query($db, "INSERT INTO Task_card (task_card_name, deadlines, id_priority, laboriousness, id_task_type, id_members, id_status) VALUES ('$task_name', '$deadline', '$priority', '$laboriousness', '$tasktype', '$id_members', '$id_status')");
        echo '<script>window.location.href = "total_task_list.php?idd='.$proj_id.'";</script>';
	    
	}else if(isset($_POST["button"])){
	    echo 'Заполните все поля';
	}

?>    
    
    
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