
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
//var_dump( $_SESSION)?>

         <!--  <li><a href="portfolio.html">Карточка задач</a></li>
          <li><a href="articles.html">Общий список задач</a></li>
          <li><a href="contact.html">Контакты чуваков из одного проекта</a></li>
          <li><a href="">Статистика по закрытым проектам</a></li>
        </ul>    Менюшка строкой если нужно  -->  
      
      <!--end nav-->
    </div>
  <!--end header-->
  <br>
  <div class="page-headline">Добавить новый проект</div>
  <div id="main">
      

<div class="Forma">
<form action="" method="post">
  <table class="blueTable">
    <tr>
      <td>Название проекта:</td>
      <td><input type="text" name="project_name"></td><!--fio, Users-->
    </tr>
    <tr>
      <td>Роль в проекте:</td>
      <td>
          <?php
        $queryT = "SELECT id as users_id, `fio`
                FROM `Users`
                WHERE id_system_roles = 3
                ORDER BY fio";
        $resultT = mysqli_query($db, $queryT) or die(mysqli_error());
        ?>
          <select name="users_id" id="users_id">
              <option selected="selected">Выберите преподавателя</option>';
              <?php
              while ($rowT = mysqli_fetch_array($resultT)){ 
               echo '<option value="'.$rowT['users_id'].'">'.$rowT['fio'].'</option>';
              }
              ?>
          </select>
        </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit"class="btn btn-success" name="button" value="Добавить"></td>
    </tr>
  </table>
</form>

</div>

<?php 
	if (isset($_POST["button"]) and !empty($_POST["project_name"])){
	    $project_name = $_POST['project_name'];
	    $users_id = $_POST['users_id'];
	    $project_name = stripslashes($project_name);
        $project_name = htmlspecialchars($project_name);
        $project_name = trim($project_name);
	    $query = "SELECT id as status_id, `type_status_name`
                FROM `Type_status`
                WHERE `type_status_name`='Новая'";
        
        $result = mysqli_query($db, $query) or die(mysqli_error());
        $row = mysqli_fetch_array($result);
        $data = date("y-m-d");
        $query_2 = "INSERT INTO Projects (proj_name, date_creation, id_status, id_teacher) VALUES ('" . $project_name . "', '". $data ."', " . $row['status_id'] . ", ".$users_id.")";
        $result_2 =  mysqli_query($db, $query_2);
        
        echo '<script>window.location.href = "open_projects.php";</script>';
	    
	}else if(isset($_POST["button"])){
	    echo 'Введите название проекта';
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