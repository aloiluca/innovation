<?php
include_once('partials/header.php');
if ($_SESSION['logged']) {
    echo 'Welcome '.$_SESSION['user_name'];
} else {
    // Redirect them to the login page
    header("Location: /innovation/login.php");
}

include_once('partials/footer.php');

?>