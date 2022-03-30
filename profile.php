<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['diplombook_userid']);

//posting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $post = new Post();
    $id = $_SESSION['diplombook_userid'];
    $result = $post->create_post($id, $_POST, $_FILES);

    if ($result == "") {
        header("Location: profile.php");
        die;
    } else {
        echo "<div style='text-align: center; font-weight: 12px; color: white; background-color: grey;'>";
        echo "<br>Данные ошибки были замечены:<br><br>";
        echo $result;
        echo "</div>";
    }
}

//collect posts
$post = new Post();
$id = $_SESSION['diplombook_userid'];
$posts = $post->get_posts($id);

//collect friends
$user = new User();
$id = $_SESSION['diplombook_userid'];
$friends = $user->get_friends($id);

$image_class = new Image();


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
    margin-top: -300px;
    border-radius: 50%;
    border: solid 2px white;
}

#menu_buttons {
    width: 100px;
    display: inline-block;
    margin: 2px;
}

#click_link {
    text-decoration: none;
}

#friends_pic {
    width: 75px;
    float: left;
    margin: 8px;
}

#friends_bar {
    background-color: white;
    min-height: 400px;
    margin-top: 20px;
    color: #aaa;
    padding: 8px;
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
    ?>

    <!--cover area-->
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <div style="background-color: white; text-align: center; color: #405d9b;">

            <?php

            $image = "images/123.jpg";
            if (file_exists($user_data['cover_image'])) {
                $image = $image_class->get_thumb_cover($user_data['cover_image']);
            }

            ?>

            <img src="<?php echo $image ?>" style="width: 100%;">

            <span style="font-size: 12px;">

                <?php

                $image = "images/user_male.jpg";
                if ($user_data['gender'] == 'Женский') {
                    $image = "images/user_female.jpg";
                }

                if (file_exists($user_data['profile_image'])) {
                    $image = $image_class->get_thumb_profile($user_data['profile_image']);
                }

                ?>

                <img id="profile_pic" src="<?php echo $image ?>"><br />
                <a href="profile_image.php?change=profile" style="text-decoration: none; color: #f0f;">
                    Изменить Фото Профиля
                </a> |
                <a href="profile_image.php?change=cover" style="text-decoration: none; color: #f0f;">
                    Изменить Фон
                </a>
            </span>
            <br>

            <div style="font-size: 20px; color: black;">
                <?php
                echo $user_data['first_name'] . " " . $user_data['last_name']
                ?>
            </div>
            <br>

            <div id="menu_buttons"><a id="click_link" href="index.php">История</a></div>
            <div id="menu_buttons">Про меня</div>
            <div id="menu_buttons">Друзья</div>
            <div id="menu_buttons">Фотографии</div>
            <div id="menu_buttons">Настройки</div>
        </div>

        <!--below cover area-->
        <div style="display: flex;">

            <!--friends area-->
            <div style="min-height: 400px; flex: 1;">
                <div id="friends_bar">
                    Друзья<br>

                    <?php

                    if ($friends) {
                        foreach ($friends as $FRIEND_ROW) {

                            include("user.php");
                        }
                    }

                    ?>

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

                </div>

            </div>
        </div>

    </div>

</body>

</html>