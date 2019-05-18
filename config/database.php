<?php
/* Questo file serve a configurare il database e verra incluso nel file 'db_connection.php' al momento:
 * 1. Copia il file 'database.example.php' e rinominalo in 'database.php'.
 * 2. Setta le variabili della tua connessione.
 * */

/* Creazione variabili per connessione al database */
$servername = "localhost";
$username = "root";
$password = "laravel";
$db = "innovation";

$conn = mysqli_connect($servername, $username, $password, $db); // $conn = Object(true)
if (!$conn) {
    die("</br>" . "Connection failed: " . mysqli_connect_error());
} else {
//    echo 'Connected to db';
}
