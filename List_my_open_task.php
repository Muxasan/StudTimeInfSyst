
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
  <div class="page-headline">Список моих открытых задач</div>
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
            $fio = $myrow['fio']; 
            $query22 = mysqli_query($db, "SELECT Task_card.id, Type_status.type_status_name, Users.fio, Task_card.laboriousness, Task_card.task_card_name, Task_card.deadlines, Task_card.startworkdate, Task_card.actual_time, Task_card.id_status
                                            FROM Type_status, Task_card, Members, Users 
                                            WHERE '$proj_id'=Members.id_projects AND Task_card.id_members=Members.id 
                                            AND Users.id_members=Members.id AND Type_status.id=Task_card.id_status AND Users.fio = '$fio' ORDER BY Type_status.id");
            while($row22 = mysqli_fetch_array($query22))
            {
                echo '<tr>';
                echo '<td>'.$row22['id'].'</td>';
                echo '<td><a href="task_card.php?id='.$row22['id'].'&idd='.$proj_id.'">'.$row22['task_card_name'].'</td>';
                echo '<td>'.$row22['fio'].'</td>';
                echo '<td>'.$row22['type_status_name'].'</td>';
                echo '<td>'.$row22['laboriousness'].' дней</td>';
                echo '</tr>';
                $summ = $summ + $row22['laboriousness'];
                $difference11 = intval(abs(strtotime($row22['deadline']) - strtotime($row22['startworkdate'])));
                $difference2 = intval(abs(strtotime($row22['actual_time']) - strtotime($row22['startworkdate'])));
                $worktime11 = $difference11 / 86400;
                $worktime2 = $difference2 / 86400;
                if ($worktime11 == 0){$worktime11=1;}
                if ($worktime2 == 0){$worktime2=1;}
                if($worktime11>=$worktime2){
                    $procent = ($worktime2 / $row22['laboriousness'])*100;
                    $procent = number_format($procent, 1);
                    if($row22['id_status']==4){
                        $summprocent = $summprocent + 100;
                    }else{
                        $summprocent = $summprocent + $procent;
                    }
                }
                $count = $count + 1;
            }?>
            </tbody>
            </table>
       
      </div>
      <!--end post-->
     
      
    </div>
    <!--end content-->
    <div id="sidebar">
      <div id="hire">
        <h3 class="sidebar-title">Текущая трудоёмкость</h3>
        <br>
        <p class = "Ydaha">
        <?php
        $worktime1 = $myrow['worktime'];
        echo $worktime1.'/'.$summ.' дней';
        ?>
        </p>
          <br>
        <h3 class="sidebar-title">Текущая оценка</h3>
        <br>
        <p class = "Ydaha2">
            <?php 
            if ($worktime1==0){
                echo '0%';
            }
            else{
                $srprocent = $summprocent / $count;
                $srprocent = number_format($srprocent, 1);
                echo $srprocent.'%';
            }
            ?>
        </p>
        
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