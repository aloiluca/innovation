<?php
//error_reporting(E_ALL); //Imposta quali errori PHP sono segnalati
//ini_set("display_errors", 1); // Imposta il valore di un'opzione di configurazione ($var,$value)

require 'partials/functions.php';
require 'config/database.php';

session_start();    // Start della sessione

/*evita errori in news riguardo la cancellazione degli articoli quando non si è loggati*/
if (!isset($_SESSION['logged'])) {
    $_SESSION['articolo_cancellato'] = FALSE;
}

?>

<!-- <head> del sito web -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="ict, unito, studenti, html, css" />
    <meta name="description" content="Sito web per studenti di Andrea Carlucci e Rosario Orlando" />
    <meta name="author" content="Andrea Carlucci, Matteo Ninotti, Flavio Pirazzi, Mahdi, Rachele Veronese, Gabriele Gennari, Luca Aloi" />
    <!--favicon della pagina che appare accanto al titolo nel browser-->

    <!-- Link al foglio di stile .css-->
    <link rel="stylesheet" type="text/css" href="resources/css/stile.css" />

    <!-- Set del viewport per il Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Link to FontAwesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Innovation Team</title>
</head>
<body>

<header>

    <!-- Classe navbar -->
    <div class="navbar">

        <!-- Logo -->
        <div id="logo">
            <a href="index.php">
                <img src="resources/img/cactuspen.png" alt="Logo">
            </a>
        </div>
        <!-- Fine logo-->


        <!--Hamburger da gestire tramite CSS o codice javascript volendo?-->
        <!--  <a id="myHamburger" href=""><i class="fa fa-bars"</i></a>-->

        <!-- Elementi della nav bar-->
        <a href="/innovation/index.php">HOME</a>
        <a href="/innovation/news.php">NEWS</a>
        <a href="/innovation/tools.php">TOOLS</a>
        <a href="/innovation/community.php">COMMUNITY</a>
        <a href="/innovation/chiSiamo.php">CHI SIAMO</a>

        <?php
        if ( isset( $_SESSION['admin'])) {
            echo"   <a href='/innovation/admin.php'>Gestione Utenti</a>
                    <a href='/innovation/admin-articoli.php'>Gestione Articoli</a>
                    <a href='/innovation/admin-tools.php'>Gestione Tools</a>
                    ";
        }

        /* Login / Logout e logo utente da fontAwesome */
        if ( isset( $_SESSION['logged']) ){
            echo '<a style="float: right" href="/innovation/logout.php"><i class="fas fa-user"></i> LOG-OUT</a>';
        } else {
            echo '<a style="float: right" href="/innovation/login.php"><i class="fas fa-user"></i> LOG-IN</a>';
        }
        ?>
    </div>
</header>