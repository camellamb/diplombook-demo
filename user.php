<div id="friends">

    <?php
    $image = "assets/images/user_male.jpg";
    if ($FRIEND_ROW['gender'] == "Женский") {
        $image = "assets/images/user_female.jpg";
    }
    ?>

    <img id="friends_pic" src="<?php echo $image ?>">
    <br>

    <?php
    echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']
    ?>

</div>