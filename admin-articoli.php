<?php
require 'partials/header.php';
require 'config/database.php';

if( isset( $_POST['crea_articolo']) ){

    $titolo = $_POST['titolo'];
    $sottotitolo = $_POST['sottotitolo'];
    $categoria = $_POST['categoria'];
    $corpo = $_POST['corpo'];

    /* Setto il time local e richiedo l'ora corrente */
    $timelocal = date_default_timezone_set('Europe/Rome');
    $date = date('Y/m/d', time());

    /* Recupero il nome dell'utente loggato */
    $autore = $_SESSION['user_name'];

    $sql = "INSERT INTO `articoli`( `titolo`, `sottotitolo`, `autore`, `corpo`, `categoria`, `data`) 
                VALUES ( '". $titolo ."','" . $sottotitolo ."','" . $autore ."','" . $corpo . "','". $categoria . "','" . $date . "' );";

    $result = mysqli_query( $conn, $sql);

    if ( $result == TRUE ) {
        echo 'articolo inserito correttamente';
        header("Refresh:1 ; Location: /innovation/admin-articoli.php");


    }
    else {
        echo 'articolo non inserito';

    }
}



?>

<div>
    <form action="admin-articoli.php" method="POST">
        Titolo: <input type="text" name="titolo"><br>
        Sottotitolo: <input type="text" name="sottotitolo"><br>
        Categoria: <input type="text" name="categoria"><br>
        Corpo: <input type="text" name="corpo"><br>

        <button type="submit" name="crea_articolo">
            Crea
        </button>
    </form>
</div>
