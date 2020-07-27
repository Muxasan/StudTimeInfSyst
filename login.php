<?php
    session_start();
	header("Content-Type: text/html; charset=utf-8");
	if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } 
	//заносим введенный пользователем емайл в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
	if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
        echo '<script>window.location.href = "index.php?error=1";</script>';
    }
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);
    $password = trim($password);
	// подключаемся к базе
	include("bd.php");
	//извлекаем из базы все данные о пользователе с введенным логином
	$result = mysqli_query($db,"SELECT * FROM Users WHERE email='$login'");
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['password']))
    {
        //если пользователя с введенным логином не существует
        echo '<script>window.location.href = "index.php?error=2";</script>';
    }
    else {
        //если существует, то сверяем пароли
        if ($myrow['password']==$password) {
        //если пароли совпадают, то запускаем пользователю сессию
        $_SESSION['id']=$myrow['id'];
        if ($myrow['id_system_roles']==4)
        {
            echo '<script>window.location.href = "List_my_open_task.php";</script>';
        }
        else
        {
            if ($myrow['id_system_roles']==2)
            {
                echo '<script>window.location.href = "total_task_list.php";</script>';
            }
            else
            {
                echo '<script>window.location.href = "open_projects.php";</script>';
            }
        }
        }
	else {
        //если пароли не сошлись
        echo '<script>window.location.href = "index.php?error=3";</script>';
        }
    }
?>