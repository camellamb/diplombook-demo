<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['diplombook_userid']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        if ($_FILES['file']['type'] == "image/jpeg") {
            $max_size = (1024 * 1024) * 7;
            if ($_FILES['file']['size'] < $max_size) {
                //ok
                $filename = "uploads/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                $image = new Image();
                $image->crop_image($filename, $filename, 800, 800);

                if (file_exists($filename)) {
                    $userid = $user_data['userid'];
                    $query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
                    $DB = new Database();
                    $DB->save($query);

                    header(("Location: profile.php"));
                    die;
                }
            } else {
                echo "<div style='text-align: center; font-weight: 12px; color: white; background-color: grey;'>";
                echo "<br>Данные ошибки были замечены:<br><br>";
                echo "Только изображения с размером не больше 7mb могут быть добавлены!";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align: center; font-weight: 12px; color: white; background-color: grey;'>";
            echo "<br>Данные ошибки были замечены:<br><br>";
            echo "Только изображения с расширением JPEG могут быть добавлены!";
            echo "</div>";
        }
    } else {
        echo "<div style='text-align: center; font-weight: 12px; color: white; background-color: grey;'>";
        echo "<br>Данные ошибки были замечены:<br><br>";
        echo "Пожалуйста, добавьте фото!";
        echo "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Изменить фото профиля | Diplombook</title>
</head>
<style type="text/css">
#blue_bar {
    height: 50px;
    background-color: #405d9b;
    color: #d9dfeb;
}

#search_box {
    width: 400px;
    height: 20px;
    border-radius: 5px;
    border: none;
    padding: 4px;
    font-size: 14px;
    background-image: url(assets/images/search.png);
    background-repeat: no-repeat;
    background-position: right;
}

#post_button {
    float: right;
    background-color: #405d9b;
    border: none;
    color: white;
    padding: 4px;
    font-size: 14px;
    border-radius: 2px;
    width: 100px;
}

#post_bar {
    margin-top: 20px;
    background-color: white;
    padding: 10px;
}

#post {
    padding: 4px;
    font-size: 13px;
    display: flex;
    margin-bottom: 20px;
}
</style>

<body style="
    font-family: tahoma;
    background-color: #d0d8e4;">

    <br>

    <?php
    include("header.php");
    ?>

    <!--cover area-->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <!--below cover area-->
        <div style="display: flex;">

            <!--posts area-->
            <div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">

                <form method="post" enctype="multipart/form-data">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <input type="file" name="file"><br>
                        <input id="post_button" type="submit" value="Добавить">
                        <br>
                    </div>
                </form>

            </div>
        </div>

</body>

</html>