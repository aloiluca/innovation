<?php
require 'partials/header.php';
$userName=$_SESSION["user_name"];
if ($_SESSION['logged']) {
    echo '<p class="comm">Welcome '. $userName .'</p>';
} else {
    // Redirect them to the login page
    header("Location: /innovation/login.php");
}

require 'partials/footer.php';

?>