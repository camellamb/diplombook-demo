<?php

include("classes/autoloader.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['diplombook_userid']);

//posting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $post = new Post();
    $id = $_SESSION['diplombook_userid'];
    $result = $post->create_post($id, $_POST, $_FILES);

    if ($result == "") {
        header("Location: index.php");
        die;
    } else {
        echo "<div style='text-align: center; font-weight: 12px; color: white; background-color: grey;'>";
        echo "<br>Данные ошибки были замечены:<br><br>";
        echo $result;
        echo "</div>";
    }
}

$post = new Post();
$id = $user_data['userid'];
$posts = $post->get_posts($id);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Профиль | Diplombook</title>
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
        background-image: url(images/search.png);
        background-repeat: no-repeat;
        background-position: right;
    }

    #profile_pic {
        width: 150px;
        border-radius: 50%;
        border: solid 2px white;
    }

    #menu_buttons {
        width: 100px;
        display: inline-block;
        margin: 2px;
    }

    #friends_pic {
        width: 75px;
        float: left;
        margin: 8px;
    }

    #friends_bar {
        min-height: 400px;
        margin-top: 20px;
        padding: 8px;
        text-align: center;
        font-size: 20px;
        color: #405d9b;
    }

    #friends {
        clear: both;
        font-size: 12px;
        font-weight: bold;
        color: #405d9b;
    }

    textarea {
        width: 100%;
        border: none;
        font-family: tahoma;
        font-size: 14px;
        height: 60px;
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

    $image = "images/user_male.jpg";
    if ($user_data['gender'] == 'Женский') {
        $image = "images/user_female.jpg";
    }

    if (file_exists($user_data['profile_image'])) {
        $image = $image_class->get_thumb_profile($user_data['profile_image']);
    }

    ?>

    <!--cover area-->
    <div style="
        width: 800px;
        margin: auto;
        min-height: 400px;">

        <!--below cover area-->
        <div style="display: flex;">

            <!--friends area-->
            <div style="min-height: 400px; flex: 1;">

                <div id="friends_bar">
                    <img id="profile_pic" src="<?php echo $image ?>"><br>
                    <a href="profile.php" style="text-decoration: none;">
                        <?php
                        echo $user_data['first_name'] . "<br> " . $user_data['last_name']
                        ?>
                    </a>
                </div>

            </div>

            <!--posts area-->
            <div style="
                min-height: 400px;
                flex: 2.5;
                padding: 20px;
                padding-right: 0px;">

                <div style="
                    border: solid thin #aaa;
                    padding: 10px;
                    background-color: white;">

                    <!--create a post-->
                    <form method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="Опишите детали вашего проекта..."></textarea>
                        <input type="file" name="file">
                        <input id="post_button" type="submit" value="Опубликовать">
                        <br>
                    </form>

                </div>

                <!--posts-->
                <div id="post_bar">

                    <?php

                    if ($posts) {
                        foreach ($posts as $ROW) {

                            $user = new User();
                            $ROW_USER = $user->get_user($ROW['userid']);

                            include("post.php");
                        }
                    }

                    ?>

                    <!--post 1-->
                    <div id="post">
                        <div>
                            <img src="images/user_male.jpg" style="width: 75px; margin-right: 4px; border-radius: 50%">
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b">Саконджи Урокодаки</div>
                            Тема проекта: Разработка мобильного ПО для бронирования отеля
                            Технологии для разработки: Dart/Flutter
                            Подробности в файле
                            <br><br>
                            <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">February 26
                                2022</span>
                        </div>
                    </div>

                    <!--post 2-->
                    <div id="post">
                        <div>
                            <img src="images/user_female.jpg" style="width: 75px; margin-right: 4px; border-radius: 50%">
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b">Шинобу Коку</div>
                            Тема проекта: Разработка веб-сайта для круиза
                            Технологии для разработки: Java
                            Подробности в файле
                            <br><br>
                            <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">February 26
                                2022</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
</body>

</html>