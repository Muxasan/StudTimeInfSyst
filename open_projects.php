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
?>
      <!--end nav-->
    </div>
  <!--end header-->
  <br>
  <div class="page-headline">Открытые проекты</div>
  <div id="main">
    
    <div id="content">
      <div class="post" >
        
        <?php
        if($_SESSION['id_system_roles']==1){
        $query_2 = "SELECT pr.id as pr_id, `proj_name`, DATE_FORMAT(date_creation,'%d.%m.%Y') as date_t, `type_status_name`, fio
                FROM `Projects` as pr 
                JOIN `Type_status` as ts ON pr.id_status = ts.id
                JOIN `Users` as us ON pr.id_teacher = us.id
                WHERE ts.id !=3 and pr.id!=10
                ORDER BY proj_name";
        }else if($_SESSION['id_system_roles']==3){
            $query_2 = "SELECT pr.id as pr_id, `proj_name`, DATE_FORMAT(date_creation,'%d.%m.%Y') as date_t, `type_status_name`
                FROM `Projects` as pr 
                JOIN `Type_status` as ts ON pr.id_status = ts.id
                JOIN `Users` as us ON us.id = pr.id_teacher
                WHERE ts.id !=3 and pr.id!=10 and us.id=".$_SESSION['id']; #### Запрос соеденить таблицы
        }
        $result_2 = mysqli_query($db, $query_2) or die(mysqli_error());
        ?>
        
        <table class="blueTable">
            <thead>
            <tr>
            <th>№ проекта</th>
            <th>Название проекта</th>
            <th>Год создания</th>
            <th>Статус</th>
            <?php if($_SESSION['id_system_roles']==1){ ?>
            <th>Преподаватель</th>
            <?php }?>
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
            while($row_2 = mysqli_fetch_array($result_2)){
               echo '<tr>';
                echo '<td>'.$row_2['pr_id'].'</td>';
                echo '<td><a href="total_task_list.php?idd='.$row_2['pr_id'].'">'.$row_2['proj_name'].'</a></td>';
                echo '<td>'.$row_2['date_t'].'</td>';
                echo '<td>'.$row_2['type_status_name'].'</td>';
                if($_SESSION['id_system_roles']==1){
                echo '<td>'.$row_2['fio'].'</td>';
                }
                echo '</tr>';
            }?> 
            </tbody>
            </table>
       
      </div>
      <!--end post-->
     
      <div class="post-line"></div>
      
   </div>
    <!--end content-->
    <!--<div id="sidebar">
      <div id="hire" style="margin-left:20px;">
        <h4 class="sidebar-title">Выгрузить статисику по</h4>  
        <select name="filtr" style="margin-left:20px;">
            <option>Выводить из БД ФИ студента</option>
        </select>
        <br>
        <br>
        <input type="submit"class="btn btn-success"  value ='Export'style="margin-left:100px;"> </div>
      <!--end hire
       <div id="hire"style="margin-top:200px;margin-left:20px;">
       <h4 class="sidebar-title" >Создать новую задачу</h4>
       <a class="btn btn-success" href="task_card.php" role="button" style="margin-left:100px;">Создать</a>
 </div> 
      <!--end recent-projects
    </div>
    <!--end sidebar
    
  </div>
-->
    <div id="sidebar">
          <div id="hire">
            <?php if ($_SESSION['id_system_roles']==1){
            echo '<h3 class="sidebar-title">Добавить проект</h3>';
            
            echo '<a style="margin-left:100px" class="btn btn-success" href="add_project.php">Добавить</a>'; 
            }?>
            </div>
          <!--end hire-->
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