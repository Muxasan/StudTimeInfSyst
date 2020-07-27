
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
  <div class="page-headline">Удалить пользователя</div>
  <div id="main">
      

<div class="Forma">
<form action="" method="post">
  <table class="blueTable">
    <tr>
      <td>Введите email пользователя для удаления: </td>
      <td><input type="text" name="Email"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit"class="btn btn-danger" name="button" value="Удалить"></td>
    </tr>
  </table>
</form>

</div>


<?php 
	if (isset($_POST['button']) and !empty($_POST["Email"])){
		echo "существует"."_______";
	    $delete = $_POST['Email'];
	    $delete = stripslashes($delete);
        $delete = htmlspecialchars($delete);
        $delete = trim($delete);
	   
 // Подключение к базе данных
 
        $del="SELECT `id_members` FROM `Users` WHERE email=".$delete;
        $del2=mysqli_query($db, $del);
        $del2=mysqli_fetch_array($del2);
        var_dump($del2);
	    $db = new PDO("mysql:dbname=$db_name;host=$host", $user, $pass);
	    //$sql1 = $db->prepare("SELECT `id_members` FROM `Users` WHERE email= ?");
	    $sql = $db->prepare("DELETE FROM `Users` WHERE email= ?");
	    $sql2 = $db->prepare("DELETE FROM `Membes` WHERE id= ?");
	    // $result = $sql->execute($_POST);
	    $result = $sql->execute(array($delete));
	    //$result1 = $sql1->execute(array($delete));
	    //var_dump($result1);
	    $result2 = $sql2->execute(array($del2['id_members']));
	    //$result1 = $mysqli->query($sql);
	    //var_dump($result);
	    //var_dump($sql->errorInfo());
	    //var_dump($db->query('SELECT * FROM contractors')->fetchAll());
	    
	     echo "<script>document.location.replace('contact_data.php');</script>";
	    }
	    elseif (isset($_POST["button"]) and !empty($_POST["Email"])) {
	    
	    echo "Пользователь не удален";
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