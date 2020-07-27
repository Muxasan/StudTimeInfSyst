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
include("password.php");
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
  <div class="page-headline">Добавить нового пользователя</div>
  <div id="main">
      

<div class="Forma">
<form action="" method="post">
  <table class="blueTable">
    <tr>
      <td>Фамилия Имя Отчество:</td>
      <td><input type="text" name="FIO"></td><!--fio, Users-->
    </tr>
    <tr>
      <td>Роль в системе:</td>
      <td>
          <?php
        $query_3 = "SELECT id as system_id, `sys_role_name`
                FROM `System_roles` 
                WHERE `sys_role_name` != 'Администратор'
                ORDER BY sys_role_name";
        $result_3 = mysqli_query($db, $query_3) or die(mysqli_error());
        ?>
          <select name="sys_role" id="sys_role">
              <option selected="selected">Выберите системную роль</option>';
              <?php
              while ($row_3 = mysqli_fetch_array($result_3)){ 
               echo '<option value="'.$row_3['system_id'].'">'.$row_3['sys_role_name'].'</option>';
              }
              ?>
          </select>
        </td><!--id_system_roles, Users, sys_role_name-->
    </tr>
    <tr>
      <td>Роль в проекте:</td>
      <td>
          <?php
        $query_4 = "SELECT id as proj_id, `proj_role_name`
                FROM `Project_roles` 
                ORDER BY proj_role_name";
        $result_4 = mysqli_query($db, $query_4) or die(mysqli_error());
        ?>
          <select name="proj_role" id="proj_role">
              <option selected="selected">Выберите роль в проекте</option>';
              <?php
              while ($row_4 = mysqli_fetch_array($result_4)){ 
               echo '<option value="'.$row_4['proj_id'].'">'.$row_4['proj_role_name'].'</option>';
              }
              ?>
          </select>
        </td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input type="text" name="Email"></td>
    </tr>
    <tr>
      <td>Телефон:</td>
      <td><input type="varchar" name="Phone"></td>
    </tr>
	<tr>
      <td>Группа:</td>
      <td><input type="varchar" name="Group"></td>
    </tr>
	<tr>
      <td>Проект:</td>
      <?php
        $query_5 = "SELECT id as id_proj, `proj_name`
                FROM `Projects` 
                ORDER BY proj_name";
        $result_5 = mysqli_query($db, $query_5) or die(mysqli_error());
        ?>
      <td><select name="proj" id="proj">
          <option selected="selected">Выберите проект</option>';
              <?php
              while ($row_5 = mysqli_fetch_array($result_5)){ 
               echo '<option value="'.$row_5['id_proj'].'">'.$row_5['proj_name'].'</option>';
              }
              ?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" class="btn btn-success" name="button" value="Добавить"></td>
    </tr>
  </table>
</form>

</div>


<?php 
//var_dump($host);

	if (isset($_POST["button"]) and !empty($_POST["Email"]) and !empty($_POST["FIO"]) and !empty($_POST["sys_role"]) and !empty($_POST["proj_role"]) and !empty($_POST["Phone"]) and !empty($_POST["Group"])and !empty($_POST["proj"])){
	//	echo "существует"."_______";
	    $FIO = $_POST['FIO'];
	    $sys_role = $_POST['sys_role'];
	    $proj_role = $_POST['proj_role'];
	    $Email = $_POST['Email'];
	    $Phone = $_POST['Phone'];
	    $Group = $_POST['Group'];
	    $proj = $_POST['proj'];
	    $FIO = stripslashes($FIO);
        $FIO = htmlspecialchars($FIO);
        $Email = stripslashes($Email);
        $Email = htmlspecialchars($Email);
        $Email = trim($Email);
        $Phone = stripslashes($Phone);
        $Phone = htmlspecialchars($Phone);
        $Phone = trim($Phone);
        $Group = stripslashes($Group);
        $Group = htmlspecialchars($Group);
	    //$id_proj = $_POST['id_proj'];
	    
	    
	    
	    // Подключение к базе данных
	    $db1 = new PDO("mysql:dbname=$db_name;host=$host", $user, $pass);
	    //var_dump($db);
	    $sql = $db1->prepare("INSERT INTO `Members`(`phone`,`groupname`,`id_project_roles`,`id_projects` ) VALUES (?, ?, ?, ?)");
	    // $result = $sql->execute($_POST);
	    
	    $result = $sql->execute(array($Phone, $Group, $proj_role, $proj));
	    //$result1 = $mysqli->query($sql);
	    //var_dump($result);
	    //var_dump($sql->errorInfo());
	    //var_dump($db->query('SELECT * FROM products')->fetchAll());
	    // Подключение к базе данных
	    //var_dump($db);

	    $mem="SELECT `id` FROM `Members` WHERE phone='".$Phone."'";
        $mem2=mysqli_query($db, $mem);
        //var_dump($mem2);
        $mem2=mysqli_fetch_array($mem2);
        
        //var_dump($mem2);
        //echo $mem2['id'];
	    // Подключение к базе данных
	    //$db2 = new PDO("mysql:dbname=$db_name;host=$host", $user, $pass);
	    //var_dump($db);
	    //var_dump($Phone);

	    $sql2 = $db1->prepare("INSERT INTO `Users`(`email`,`password`,`fio`,`id_members`, `id_system_roles` ) VALUES (?, ?, ?, ?, ?)");
	    // $result = $sql->execute($_POST);
	    
	    $result2 = $sql2->execute(array($Email, $_SESSION['passw'], $FIO, $mem2["id"], $sys_role));
	    unset($_SESSION['passw']);
        echo "<script>document.location.replace('contact_data.php');</script>";
	//exit('<meta http-equiv="refresh" content="0; url=products.php"/>');   
	}
	elseif (isset($_POST["button"]) and (!empty($_POST["Email"]) or !empty($_POST["FIO"]) or !empty($_POST["sys_role"]) or !empty($_POST["proj_role"]) or !empty($_POST["Phone"]) or !empty($_POST["Group"]) or !empty($_POST["proj"]))) {
	    
	    echo "Пользователь не добавлен";
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