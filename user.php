<div id="friends">

    <?php
    $image = "images/user_male.jpg";
    if ($FRIEND_ROW['gender'] == "Женский") {
        $image = "images/user_female.jpg";
    }
    ?>

    <img id="friends_pic" src="<?php echo $image ?>">
    <br>

    <?php
    echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']
    ?>

</div>