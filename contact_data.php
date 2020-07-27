
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
  <div class="page-headline"><?php 
        if ($_SESSION['id_system_roles']==2 OR $_SESSION['id_system_roles']==4){echo "Контакты";} else {echo "Пользователи";};?></div>
  <div id="main">
      
 <?php 
//var_dump($_SESSION["id"]);
$sys="SELECT `id_system_roles` FROM `Users`,`Members` WHERE Users.id_members=Members.id AND Users.id=".$_SESSION["id"];
//var_dump($cont);
$my_system_role=mysqli_query($db, $sys);
$my_system_role=mysqli_fetch_array($my_system_role);
//var_dump($my_system_role['id_system_roles']);
?>
     



    <div id="content">
      <div class="post" >
          
          
        <?php 
       # if ($my_system_role['id_system_roles']==2 OR $my_system_role['id_system_roles']==4){
      # $query="SELECT `FIO`,`sys_role_name`, `Email`,`Phone`,`groupname`,`proj_role_name`FROM  `Users`,`Members`, `System_roles`, `Project_roles` WHERE Users.id_members=Members.id AND Users.id!=".$_SESSION["id"]." AND Users.id_system_roles!=1 AND System_roles.id=Users.id_system_roles AND Project_roles.id=Members.id_project_roles AND  Members.id_projects=(SELECT id_projects FROM `Members`,`Users` WHERE Users.id_members=Members.id AND Users.id=".$_SESSION["id"].")";}
      # else {
      # $query="SELECT `FIO`,`sys_role_name`, `Email`,`Phone`,`groupname`,`proj_role_name`, `proj_name` FROM `Projects`, `Users`,`Members`, `System_roles`, `Project_roles` WHERE Projects.id=Members.id_projects AND Users.id_members=Members.id AND Users.id!=".$_SESSION["id"]." AND Users.id_system_roles!=1 AND System_roles.id=Users.id_system_roles AND Project_roles.id=Members.id_project_roles";
      # };
      if($my_system_role['id_system_roles']==1){
       $query="SELECT fio, sys_role_name, proj_role_name, email, phone, groupname, proj_name, id_system_roles, u.id as users_id
                FROM `Users` as u, `Projects` as p, `Members` as m, `System_roles` as sr, `Project_roles` as pr 
                WHERE u.id !=".$_SESSION["id"]." and (sr.id = u.id_system_roles and u.id_members = m.id and pr.id = m.id_project_roles and m.id_projects = p.id) 
                or (u.id = p.id_teacher and sr.id = u.id_system_roles and u.id_members = m.id and pr.id = m.id_project_roles)
                GROUP BY u.fio, u.email";
       $contacts=mysqli_query($db, $query);
      }elseif($my_system_role['id_system_roles']==2 or $my_system_role['id_system_roles']==4){
          $query2="SELECT id_projects
                FROM `Users` as u 
                JOIN `Members` as m ON m.id = u.id_members
                WHERE u.id = ".$_SESSION["id"];
          $contacts2=mysqli_query($db, $query2);
          $row2 = mysqli_fetch_array($contacts2);
          
          $query="SELECT fio, sys_role_name, proj_role_name, email, phone, groupname, proj_name
                FROM `Users` as u, `Projects` as p, `Members` as m, `System_roles` as sr, `Project_roles` as pr 
                WHERE u.id !=".$_SESSION["id"]." and (sr.id = u.id_system_roles and u.id_members = m.id and pr.id = m.id_project_roles and m.id_projects = p.id and p.id=".$row2['id_projects'].")
                or (u.id = p.id_teacher and sr.id = u.id_system_roles and u.id_members = m.id and pr.id = m.id_project_roles and p.id=".$row2['id_projects'].")
                GROUP BY u.fio, u.email";
          $contacts=mysqli_query($db, $query);
      }else{
          $query9="SELECT p.id as id_projects
                FROM `Projects` as p 
                JOIN `Users` as u ON u.id = p.id_teacher
                WHERE u.id = ".$_SESSION["id"];
          $contacts9=mysqli_query($db, $query9);
          $list = array();
          $i = 0;
          while($row9 = mysqli_fetch_array($contacts9)){
              $query="SELECT fio, sys_role_name, proj_role_name, email, phone, groupname, proj_name
                    FROM `Users` as u, `Projects` as p, `Members` as m, `System_roles` as sr, `Project_roles` as pr 
                    WHERE u.id !=".$_SESSION["id"]." and (sr.id = u.id_system_roles and u.id_members = m.id and pr.id = m.id_project_roles and m.id_projects = p.id and p.id=".$row9['id_projects'].")
                    or (u.id = p.id_teacher and sr.id = u.id_system_roles and u.id_members = m.id and pr.id = m.id_project_roles and p.id=".$row9['id_projects']." and p.id_teacher !=".$_SESSION["id"].")
                    GROUP BY u.fio, u.email";
              $contacts=mysqli_query($db, $query);
              while ($row = mysqli_fetch_array($contacts)){
                  $list[$i]['fio']=$row['fio'];
                  $list[$i]['sys_role_name']=$row['sys_role_name'];
                  $list[$i]['proj_role_name']=$row['proj_role_name'];
                  $list[$i]['email']=$row['email'];
                  $list[$i]['phone']=$row['phone'];
                  $list[$i]['groupname']=$row['groupname'];
                  $list[$i]['proj_name']=$row['proj_name'];
                  $i++;
              }
          }
      }
      // $contacts=mysqli_fetch_array($cont);
       //var_dump($e_mail['Email']);
        ?>
        <table class="blueTable">
            <thead>
            <tr>
            <th>ФИО</th>
            <th>Роль в системе</th>
            <th>Роль в проекте</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Группа</th>
             <?php if ($my_system_role['id_system_roles']==1 OR $my_system_role['id_system_roles']==3){ echo "<th>Проект </th>";} ?> 
            </tr>
            </thead>

            <tbody>
            <?php if($_SESSION['id_system_roles']==1){
            while ($row = mysqli_fetch_array($contacts)){
                #if($_SESSION['id_system_roles']==1){
                        if($row["id_system_roles"]==3){
                            $query1="SELECT *
                                FROM `Users` as u
                                JOIN `Projects` as p ON u.id = p.id_teacher
                                WHERE id_system_roles=3 and u.id=".$row["users_id"];
                           $contacts1=mysqli_query($db, $query1);
                           ?>
                           <tr>
                            <td><?php echo $row["fio"];?></td>
                            <td><?php echo $row["sys_role_name"];?></td>
                            <td><?php echo $row["proj_role_name"];?></td>
                            <td><?php echo $row["email"];?></td>
                            <td><?php echo $row["phone"];?></td>
                            <td><?php echo $row["groupname"];?></td>
                            <td><?php while ($row1 = mysqli_fetch_array($contacts1)){ echo $row1["proj_name"]; echo ", ";}?></td> 
                            </tr>
                        <?php }else{
                        ?>
                        <tr>
                        <td><?php echo $row["fio"];?></td>
                        <td><?php echo $row["sys_role_name"];?></td>
                        <td><?php echo $row["proj_role_name"];?></td>
                        <td><?php echo $row["email"];?></td>
                        <td><?php echo $row["phone"];?></td>
                        <td><?php echo $row["groupname"];?></td>
                        <?php if ($my_system_role['id_system_roles']==1 or $my_system_role['id_system_roles']==3){
                            echo "<td>".$row["proj_name"]."</td>";
                        }
                        ?> 
                        </tr>
                        <?php } 
                    }
            }
            elseif($_SESSION['id_system_roles']==2 or $_SESSION['id_system_roles']==4){
                    while ($row = mysqli_fetch_array($contacts)){?>
                            <tr>
                            <td><?php echo $row["fio"];?></td>
                            <td><?php echo $row["sys_role_name"];?></td>
                            <td><?php echo $row["proj_role_name"];?></td>
                            <td><?php echo $row["email"];?></td>
                            <td><?php echo $row["phone"];?></td>
                            <td><?php echo $row["groupname"];?></td>
                            <?php if ($my_system_role['id_system_roles']==3){
                                echo "<td>".$row["proj_name"]."</td>";
                            }
                            ?> 
                            </tr>
                        <?php 
                    }
            }
            else{ foreach ($list as $row){?>
                    <tr>
                    <td><?php echo $row["fio"];?></td>
                    <td><?php echo $row["sys_role_name"];?></td>
                    <td><?php echo $row["proj_role_name"];?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["phone"];?></td>
                    <td><?php echo $row["groupname"];?></td>
                    <?php echo "<td>".$row["proj_name"]."</td>";
                    ?> 
                    </tr>
                <?php 
                }
            }
            ?>
            
            <?php /*
            if ($my_system_role['id_system_roles']==2 OR $my_system_role['id_system_roles']==4){
           $q="SELECT `FIO`,`sys_role_name`, `Email`,`Phone`,`groupname`,`proj_role_name` FROM `Users`,`Members`,`System_roles`, `Project_roles` WHERE Users.id_members=Members.id AND Users.id_system_roles=1 AND System_roles.id=Users.id_system_roles AND Project_roles.id=Members.id_project_roles ";
           //var_dump($cont);
           $admin=mysqli_query($db, $q);
          // $contacts=mysqli_fetch_array($cont);
           //var_dump($e_mail['Email']);
            }?>
            <?php while ($admin1 = mysqli_fetch_array($admin)):;?>
            <tr>
            <td><?php echo $admin1["FIO"];?></td>
            <td><?php echo $admin1["sys_role_name"];?></td>
            <td><?php echo $admin1["proj_role_name"];?></td>
            <td><?php echo $admin1["Email"];?></td>
            <td><?php echo $admin1["Phone"];?></td>
            <td><?php echo $admin1["groupname"];?></td>
            </tr>
            <?php endwhile;?>*/
            ?>
            </tbody>
            </table>
       
      </div>
      <!--end post-->
     
      
   <?php
  
   $cont="SELECT `id_members`, `Email`,`Phone` FROM `Users`,`Members` WHERE Users.id_members=Members.id AND Users.id=".$_SESSION["id"];
   //var_dump($cont);
   $e_mail=mysqli_query($db, $cont);
   $e_mail=mysqli_fetch_array($e_mail);
   //var_dump($e_mail['Email']);
   ?>   
   
    </div>
    <!--end content-->
<div style="float: right; margin-right: 0px;">
    <div id="sidebar">
      <div id="hire">
        
        <div class="syper" style="margin-left:50px;">
            <h3 class="sidebar-title"><?php if ($my_system_role['id_system_roles']!=1){echo "Мои <br> контакты";};?></h3>
        <p><?php if ($my_system_role['id_system_roles']!=1){echo "Email";};?></p>
        <p><?php if ($my_system_role['id_system_roles']!=1){echo $e_mail["Email"];};?></p>
        <p><?php if ($my_system_role['id_system_roles']!=1){echo "Телефон";};?></p>
        <p><?php if ($my_system_role['id_system_roles']!=1) {echo $e_mail["Phone"];};?></p>
        <?php if ($my_system_role['id_system_roles']==1){
        echo '<h3 class="sidebar-title">Добавить нового пользователя</h3>';
        echo '<a class="btn btn-success" href="add_user.php">Добавить</a>';
        
        echo '<h3 class="sidebar-title">Удалить <br> пользователя</h3>';
        echo '<a class="btn btn-danger" style="margin-bottom:5px;" href="delete_user.php">Удалить</a>';
        }?>
        
        </div>
      </div>    


    
    
      <!--end hire-->
      
      <!--end recent-projects-->
    </div>
    <!--end sidebar-->
    
     </div>
    
    
    
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