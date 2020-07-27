<!DOCTYPE html>
<html lang="en">
<head>
<title>Akono | </title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="styles/style.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body class="page">
<div id="wrap">
 <div id="header">
     <?php
require_once("includes/header.php");	// подключаем наш header.php
if ($_GET["id"]!=NULL AND $_GET["idd"]!=NULL){
    $task_id=$_GET["id"];
    $proj_id=$_GET["idd"];
}
else{
    echo '<script>window.location.href = "total_task_list.php";</script>';
}
if ($_SESSION['id_system_roles']==3)
    {
        echo '<script>window.location.href = "total_task_list.php";</script>';
    }
$query1 = mysqli_query($db,"SELECT * FROM Task_card WHERE Task_card.id='$task_id'");
$row1 = mysqli_fetch_array($query1);
?>
      <!--end nav-->
    </div>
 <br>
<!-- Button trigger modal -->
<?php if($_SESSION['id_system_roles'] != 4){
  ?>
<button type="button" class="badge badge-danger" data-toggle="modal" data-target="#exampleModalCenter" style='float:right;font-size:20px'>
  Удалить задачу 
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Подтверждение </h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы точно хотите удалить задачу
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <form action="task_delete.php?id=<?php echo $task_id;?>" method="post">
        <button type="submit" class="btn btn-success">Да</button>
       </form>
      </div>
    </div>
  </div>
</div>
<?php
 }
  ?>
<div class="page-headline"style='margin-left:120px;'>
    <?php echo $row1['task_card_name'];?>
</div>

<div class="page-headline" style='margin-top:50px;'>
    <?php echo 'Карточка задачи №'.$row1['id'];?>
</div>

  
<form action="edit_task.php?id=<?php echo $task_id.'&idd='.$proj_id;?>" method="post">
    <div id="footer">
        <div style="width:50%;float:left;">
            <p style="text-align:center;border-width:5px;border-style:solid;">Описание задачи </p>
            <?php if($_SESSION['id_system_roles']==4){
            echo '<textarea name="description" id="description" cols="65" rows="6" disabled>'.$row1['description'].'</textarea>';}
            else{
            echo '<textarea name="description" id="description" cols="65" rows="6">'.$row1['description'].'</textarea>';
            }?>
        </div>
    <div style="width:44%;float:right;margin:0 0 0 50px ;">
    <table class="blueTable">
    <tr>
      <td>Дедлайн</td>
      <?php if($_SESSION['id_system_roles']==4){
            echo '<td>'.$row1['deadlines'].'</td>';
        }
        else{?>
      <td><input type="date" name="deadlines" value="<?php echo $row1['deadlines'];?>"></td>
      <?php }?>
    </tr>
    <tr>
      <td>Статус</td>
	  <td>
		<select name="status">
		    <?php if($row1['id_status']==4 and $_SESSION['id_system_roles']==4){?>
		    <option>Решено</option>
	        <?php }else{?>
	        <option <?php if($row1['id_status']==1) {echo 'selected';}?>>Новая</option>
		    <option <?php if($row1['id_status']==2) {echo 'selected';}?>>В работе</option>
		    <?php if($row1['startworkdate']!=0){?><option <?php if($row1['id_status']==3) {echo 'selected';}?>>В ожидании</option><?php }?>
		    <?php if($row1['startworkdate']!=0 and $_SESSION['id_system_roles']==2){?><option <?php if($row1['id_status']==4) {echo 'selected';}?>>Решено</option><?php }?>

	        <?php }?>
	        
	    </select>
	  </td>
      <!--<td><input type="text" name="adress"></td>-->
    </tr>
    <tr>
        <td>Трудоёмкость</td>
        <?php if($_SESSION['id_system_roles']==4){
            echo '<td>'.$row1['laboriousness'].' дней</td>';
        }
        else{?>
        <td><input type="float" name="laboriousness" placeholder=<?php echo $row1['laboriousness'];?>> дней</td>
        <?php }?>
    </tr>
    <tr>
      <td>Приоритет</td>
      <td>
        <select name="priority">
            <?php if($_SESSION['id_system_roles']==4){
            if($row1['id_priority']==1) {echo '<option>Высокий</option>';}
		    if($row1['id_priority']==2) {echo '<option>Средний</option>';}
		    if($row1['id_priority']==3) {echo '<option>Низкий</option>';}
            }
            else{?>
		    <option <?php if($row1['id_priority']==1) {echo 'selected';}?>>Высокий</option>
		    <option <?php if($row1['id_priority']==2) {echo 'selected';}?>>Средний</option>
		    <option <?php if($row1['id_priority']==3) {echo 'selected';}?>>Низкий</option>
		    <?php }?>
	    </select>
      </td>
    </tr>
    <tr>
      <td>Назначена</td>
        <td>
	      	<select name="members">
	      	<?php
	      	$query2 = mysqli_query($db,"SELECT * FROM Users, Members WHERE Members.id=Users.id_members AND Members.id_projects='$proj_id' AND (Users.id_system_roles = 2 OR Users.id_system_roles = 4)");
	        while($row23=mysqli_fetch_array($query23)){
	        }
	      	if($_SESSION['id_system_roles']==4)
	      	{
	      	    $query141 = mysqli_query($db,"SELECT * FROM Users, Members, Task_card WHERE Members.id=Users.id_members AND Task_card.id='$task_id' AND Members.id=Task_card.id_members");
	      	    $row141 = mysqli_fetch_array($query141);
                //while($row3 = mysqli_fetch_array($query2)){
                echo '<option ';
                //if ($row3['id_members']==$row1['id_members']){ echo 'selected';}
                echo ' >';
                echo $row141['fio'];
                echo '</option>';
	      	//}
            }
            else
            {
	      	    while ($row2 = mysqli_fetch_array($query2))
	      	    {
	      	        $fios = $row2['fio'];
	      	        $query23 = mysqli_query($db,"SELECT * FROM Members, Users, Task_card WHERE Members.id=Users.id_members AND Members.id=Task_card.id_members AND Users.id_system_roles = 4 AND Users.fio='$fios'");
	      	        while($row23=mysqli_fetch_array($query23)){
	                    $count = $count + 1;
	                }
	                if ($count<3){
	      		    echo '<option ';
	      		    if ($row2['id_members']==$row1['id_members']){ echo 'selected';}
	      		    echo '>';
	      		    echo $fios;
	      		    echo '</option>';
	                }
	                $fios = 0;
	      	    }
	      	}?>
	      	</select>
	    </td>
    </tr>
    <tr>
      <td>Тип задачи</td>
      <td>
      	 <select name="tasktype">
      	     <?php if($_SESSION['id_system_roles']==4){
            if($row1['id_task_type']==1) {echo '<option>Дизайн</option>';}
		    if($row1['id_task_type']==2) {echo '<option>Документация</option>';}
		    if($row1['id_task_type']==3) {echo '<option>Тестирование</option>';}
		    if($row1['id_task_type']==4) {echo '<option>Аналитика</option>';}
		    if($row1['id_task_type']==5) {echo '<option>Разработка</option>';}
		    if($row1['id_task_type']==6) {echo '<option>Поиск решений</option>';}
            }
            else{?>
		    <option <?php if($row1['id_task_type']==1) {echo 'selected';}?>>Дизайн</option>
		    <option <?php if($row1['id_task_type']==2) {echo 'selected';}?>>Документация</option>
		    <option <?php if($row1['id_task_type']==3) {echo 'selected';}?>>Тестирование</option>
		    <option <?php if($row1['id_task_type']==4) {echo 'selected';}?>>Аналитика</option>
		    <option <?php if($row1['id_task_type']==5) {echo 'selected';}?>>Разработка</option>
		    <option <?php if($row1['id_task_type']==6) {echo 'selected';}?>>Поиск решений</option>
	        <?php }?>
	    </select>
      </td>
      <!--<td><input type="text" name="maker"></td>-->
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Сохранить изменения"></td>
    </tr>
  </table>
  </div>
 
</form>
 
  <!--end footer-->
</div>
<!--end wrap-->
<p>
<?php
$query223 = mysqli_query($db,"SELECT * FROM Users, Task_card, Members, Project_roles, Comments WHERE Project_roles.id=Members.id_project_roles AND Members.id=Comments.id_members AND Comments.id_members = Users.id_members AND Task_card.id=Comments.id_task_card AND Task_card.id='$task_id'");
while($row223 = mysqli_fetch_array($query223)){
echo '<div class="card">';
echo '<div class="card-header" id="headingOne"><h6 class="mb-0"> Коментарий от '.$row223['fio'].' | '.$row223['proj_role_name'].'</h6></div>';
echo '<div id="collapseOne" class="collapse show mb-0" aria-labelledby="headingOne" data-parent="#accordionExample" >';
echo '<div class="card-body">';
echo '<textarea id="comment" cols="128" rows="5" disabled>'.$row223['comment_text'].'</textarea></div>';
echo '</div>';
echo '</div>';
}?>
</p>
<p>
<!--Форма для добавления коммента-->
<form action="add_comment.php?id=<?php echo $task_id.'&idd='.$proj_id.'&iddd='.$myrow['id_members'];?>" method="post">
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h6 class="mb-0"> Коментарий от <?php echo $myrow['fio']; ?></h6>
    </div>
    <div id="collapseOne" class="collapse show mb-0" aria-labelledby="headingOne" data-parent="#accordionExample" >
      <div class="card-body">
        <textarea name="comment" id="comment" cols="128" rows="5" ></textarea>
         <div style="width:50%;margin-top:15px;float:left;">
        <button type="submit" class="btn btn-success" >Добавить комментарий</button>
         </div>
      </div>
    </div>
   </div>
</div>
</form>
</p>
</body>

</html>