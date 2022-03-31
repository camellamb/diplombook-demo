<?php

//default image
$corner_image = "images/user_male.jpg";

//sync image
if (isset($user_data)) {
    $image_class = new Image();
    $corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
}

?>

<!--top bar-->
<div id="blue_bar">
    <div style="
            width: 800px;
            margin: auto;
            font-size: 30px;">

        <a href="index.php" style="color: white; text-decoration: none;">Diplombook</a>

        &nbsp &nbsp <input type="text" id="search_box" placeholder="Поиск">

        <a href="profile.php"><img src="<?php echo $corner_image ?>" style="width: 50px; float: right;"></a>

        <a href="logout.php">
            <span style="font-size: 11px; float: right; margin: 10px; color: white;">
                Выйти
            </span>
        </a>

    </div>
</div>