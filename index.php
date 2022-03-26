<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['diplombook_userid']);

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
                    <img id="profile_pic" src="images/user_male.jpg"><br>
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

                    <textarea placeholder="Поделитесь мыслями?"></textarea>
                    <input id="post_button" type="submit" value="Опубликовать">
                    <br>
                </div>

                <!--posts-->
                <div id="post_bar">

                    <!--post 1-->
                    <div id="post">
                        <div>
                            <img src="images/user_male.jpg" style="width: 75px; margin-right: 4px;">
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b">Саконджи Урокодаки</div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mollis diam quis ornare
                            fringilla. Nullam eu tempus augue. Vivamus vestibulum maximus magna, non porttitor dui
                            mollis nec. Vivamus ex libero, luctus sit amet massa non, fringilla luctus nisi. Vestibulum
                            pharetra urna orci, nec bibendum leo auctor in. Suspendisse molestie pellentesque libero.
                            Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                            <br><br>
                            <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">February 26
                                2022</span>
                        </div>
                    </div>

                    <!--post 2-->
                    <div id="post">
                        <div>
                            <img src="images/user_male.jpg" style="width: 75px; margin-right: 4px;">
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b">Кагая Убуяшики</div>
                            Aenean vel tellus a odio bibendum finibus nec vitae ipsum. Fusce felis nisl, gravida in
                            mauris non, ornare dignissim odio. Curabitur tincidunt, magna scelerisque venenatis cursus,
                            sem metus dapibus erat, eu vehicula sapien dolor posuere nisl. Pellentesque dignissim leo
                            felis, ac aliquam tortor laoreet eleifend.
                            <br><br>
                            <a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;">February 26
                                2022</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</body>

</html>