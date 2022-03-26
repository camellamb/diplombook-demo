<?php

session_start();
if (isset($_SESSION['diplombook_userid'])) {
    $_SESSION['diplombook_userid'] = NULL;
    unset($_SESSION['diplombook_userid']);
}

header("Location: login.php");
die;