<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
include("bd.php");
if ($_SESSION['id']==0)
{
    echo '<script>window.location.href = "index.php";</script>';
}
$di = $_SESSION['id'];
$result = mysqli_query($db,"SELECT * FROM Users, Members, Projects, Project_roles, System_roles WHERE Users.id='$di' AND System_roles.id = Users.id_system_roles AND Project_roles.id = Members.id_project_roles AND Users.id_members = Members.id");
$myrow = mysqli_fetch_array($result);
$_SESSION['id_system_roles'] = $myrow['id_system_roles'];
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<meta charset="utf-8">
<img src="images/logo.png" />
<div id="wrap">
 <div style="text-align:right;">
    <?php
    if ($myrow['id_system_roles']==1 OR $myrow['id_system_roles']==3)
    {
        echo "<smal class='badge badge-info' style='font-size:21px;margin-left:5px;'>"; 
        echo $myrow['sys_role_name'];
        echo "</smal>";
    }
    else
    { 
        echo "<smal class='badge badge-info' style='font-size:21px;'>";
        echo $myrow['proj_name'];
        echo "</smal>";
        
        echo "<smal class='badge badge-info' style='font-size:21px;margin-left:5px;'>"; 
        echo $myrow['proj_role_name'];
        echo "</smal>";
        
    }
    ?>
    <smal class='badge badge-info' style='font-size:21px;'>
    <?php if (empty($_SESSION['id']))
			{ echo "Гость"; }
				else
			{ echo $myrow['fio']; }
    ?>
    </smal>
    <a class="badge badge-danger" style='font-size:21px;' href="sessiondelete.php" role="button">Выход</a>
 </div>
      <div id="nav">
 <?php if($_SESSION['id_system_roles'] == 1){
  ?>
  <nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link " href="contact_data.php">Пользователи</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="open_projects.php">Список проектов</a>
  <a class="flex-sm-fill text-sm-center nav-link " href="final_project_report.php">Итоговый отчет по проектам</a>
  </nav>
<?php
 }
else if($_SESSION['id_system_roles'] == 4){
  ?>
  <nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link " href="contact_data.php">Контактные данные</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="List_my_open_task.php">Список моих задач</a>
  </nav>
<?php
 }
else if($_SESSION['id_system_roles'] == 2){
  ?>
  <nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link " href="contact_data.php">Контактные данные</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="total_task_list.php">Общий список задач</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="List_my_open_task.php">Список моих задач</a>
  </nav>
<?php
 }
else if($_SESSION['id_system_roles'] == 3){
  ?>
  <nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link " href="contact_data.php">Пользователи</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="open_projects.php">Список проектов</a>
  <a class="flex-sm-fill text-sm-center nav-link " href="final_project_report.php">Итоговый отчет по проектам</a>
  </nav>
<?php
 }
 ?>
         <!--  <li><a href="portfolio.html">Карточка задач</a></li>
          <li><a href="articles.html">Общий список задач</a></li>
          <li><a href="contact.html">Контакты чуваков из одного проекта</a></li>
          <li><a href="">Статистика по закрытым проектам</a></li>
        </ul>    Менюшка строкой если нужно  -->  
      </div>
       
      <!--end nav-->
    </div>
  <!--end header-->
  