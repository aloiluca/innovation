<?php
/* Recupero i dati della sessione, destroy della sessione e redirect a index.php */

session_start();
session_destroy();
header("Location: /innovation/index.php");

?>