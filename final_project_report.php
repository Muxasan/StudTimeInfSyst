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
  <div class="page-headline">Итоговый отчёт по проектам</div>
  <div id="main">
    <div id="content">
      <div class="post" >
        <table class="blueTable">
            <thead>
            <tr>
            <th>Название проекта</th>
            <th>Год создания</th>
            <th>Общее количество задач</th>
            <th>Общая трудоёмкость</th>
            <th>Фактическое время выполнения задач</th>
            <th>Оценка за проект</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query111 = mysqli_query($db, "SELECT * FROM Projects WHERE Projects.id!=10");
            while($row111 = mysqli_fetch_array($query111))
            {
                $idpr = $row111['id'];
                echo '<tr>';
                echo '<td>'.$row111['proj_name'].'</td>';
                echo '<td>'.$row111['date_creation'].'</td>';
                $query112 = mysqli_query($db, "SELECT * FROM Projects, Task_card, Members WHERE Members.id = Task_card.id_members AND Projects.id = Members.id_projects AND Projects.id = '$idpr'");
                while ($row112 = mysqli_fetch_array($query112)){
                    $tasksum = $tasksum + 1;
                    $trudsum = $trudsum + $row112['laboriousness'];
                    $realtrudsum = $realtrudsum + $row112['worktime'];
                    $memberscount = $memberscount + 1;
                }
                echo '<td>'.$tasksum.'</td>';
                echo '<td>'.$trudsum.'</td>';
                echo '<td>'.$realtrudsum.'</td>';
                if ($realtrudsum == 0){
                    $ocenkatrud = 0;
                }else{
                $ocenkatrud = ($realtrudsum / $trudsum)*100;
                $ocenkatrud = $ocenkatrud / $memberscount;
                $ocenkatrud = number_format($ocenkatrud, 1);
                $iftrud = 200-$ocenkatrud;
                }
                echo '<td>';
                if($trudsu<$realtrudsum){ echo $ifturd;}
                if($trudsu>$realtrudsum){ echo '100';}else
                {echo $ocenkatrud;}
                echo '%</td>';
                echo '</tr>';
                $tasksum = 0;
                $trudsum = 0;
                $realtrudsum = 0;
                $ocenkatrud = 0;
            }?>
            </tbody>
            </table>
       
      </div>
      <!--end post-->
     
      <div class="post-line"></div>
      
    </div>
    <!--end content-->
    <div id="sidebar">
      <div id="hire">
        <h3 class="sidebar-title">Выгрузить статистику <br>по проектам в Excel</h3>
        
        <a class="btn btn-success" style="margin-left:100px;" href="export2.php">Export</a> </div>
      <!--end hire-->
      
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