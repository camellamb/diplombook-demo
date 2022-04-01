<div id="post">
    <div>

        <?php
        $image = "images/user_male.jpg";
        if ($ROW_USER['gender'] == "Женский") {
            $image = "images/user_female.jpg";
        }

        if (file_exists($ROW_USER['profile_image'])) {
            $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
        }
        ?>

        <img src="<?php echo $image ?>" style="width: 75px; margin-right: 4px; border-radius: 50%">
    </div>

    <div style="width: 100%">
        <div style="font-weight: bold; color: #405d9b; width: 100%">
            <?php
            
            echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']);

            //profile image update
            if ($ROW['profile_image']) {

                $pronoun = "обновил фото профиля";
                if ($ROW_USER['gender'] == "Женский") {
                    $pronoun = "обновила фото профиля";
                }
                echo "<span style='
                        font-weight: normal;
                        color: #aaa'
                        > $pronoun
                        </span>";
            }

            //cover image update
            if ($ROW['cover_image']) {

                $pronoun = "обновил фон профиля";
                if ($ROW_USER['gender'] == "Женский") {
                    $pronoun = "обновила фон профиля";
                }
                echo "<span style='
                        font-weight: normal;
                        color: #aaa'
                        > $pronoun
                        </span>";
            }
            ?>
        </div>

        <!--post data-->
        <?php echo htmlspecialchars($ROW['post']); ?>

        <br><br>

        <?php

        if (file_exists($ROW['image'])) {

            $post_image = $image_class->get_thumb_post($ROW['image']);
            echo "<img src = '$post_image' style='width:80%;'/>";
        }

        ?>
        <!---->

        <br><br>

        <a style="text-decoration: none;" href="">Like</a> <a style="text-decoration: none;" href="">Comment</a>

        <span style="color: #999">
            <?php echo $ROW['date'] ?>
        </span>

        <span style="color: #999; float: right">
            <a style="text-decoration: none;" href="edit.php">
                Edit
            </a>

            <a style="text-decoration: none;" href="delete.php?id=<?php echo $ROW['postid']?>">
                Delete
            </a>
        </span>

    </div>
</div>