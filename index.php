<!DOCTYPE html>
<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
$error=$_GET["error"];
?>
<html lang="en">
    <head>
        <title>WTS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <link type="text/css" rel="stylesheet" href="styles/skin.css" />
    </head>
    <body class="home">
        <div id="wrap">
            
            <div id="header"> 
            <img src="images/logo.png" />
            <h2 style='text-align:center;margin-left:52px;'>Система учета времени работы студента</h2>
            </div>
            
            <h3 style='text-align:center;margin-left:52px;'>Авторизация в системе</h3>
            <div style='border:5px solid #ffffff'>
                <div id="frontpage-sidebar">
                    <h4 style='margin-left:55px;' >Введите учетные данные пользователя</h4>
                    <form style='margin-left:75px;' action="login.php" method="post">
                        <table border="0px">
                            <tr >
                                <td><label for="loginField">Логин</label></td>
                                
                                <td><input style='margin-bottom:5px;' type="email"name="login" class="form-control" id="loginField"  placeholder="Введите эл. почту "></td>
                            </tr>
                            <tr>
                                <td><label for="passwor">Пароль</label></td>
                                <td><input type="password"name="password" class="form-control" id="passwor"  placeholder="Введите пароль"></td>
                            </tr>
                        </table>
                        <?php 
                        if ($error==1)
                        {
                            echo '<p style="margin-left:95px;margin-top:10px;color: red;">Вы ввели не всю информацию, заполните все поля!</p>';
                        }
                        if ($error==2)
                        {
                            echo '<p style="margin-left:95px;margin-top:10px;color: red;">Пользователя с таким E-mail не существует</p>';
                        }
                        if ($error==3)
                        {
                            echo '<p style="margin-left:95px;margin-top:10px;color: red;">Неверный пароль</p>';
                        }
                        ?>
                        <p><button type="submit"style='margin-left:115px;margin-top:5px;' class="btn btn-primary">Войти</button></p>
                    </form>
                </div>
            </div>
    </body>
</html>