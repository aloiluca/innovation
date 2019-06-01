<?php
require 'partials/header.php';
require 'partials/functions.php';
require 'config/database.php';


if( isset( $_POST['crea_articolo']) ){

    $titolo = replace_special_character($_POST['titolo']);
    $sottotitolo = replace_special_character($_POST['sottotitolo']);
    $categoria = replace_special_character($_POST['categoria']);
    $corpo = replace_special_character($_POST['corpo']);
    $gdrive = replace_special_character($_POST['gdrive']);


    /* Setto il time local e richiedo l'ora corrente */
    $timelocal = date_default_timezone_set('Europe/Rome');
    $date = date('Y/m/d', time());

    /* Recupero il nome dell'utente loggato */
    $autore = $_SESSION['user_name'];


    $sql = "INSERT INTO `articoli`( `titolo`, `sottotitolo`, `autore`, `corpo`, `categoria`, `data`, `gdrive`) 
                VALUES ( '". $titolo ."','" . $sottotitolo ."','" . $autore ."','" . $corpo . "','". $categoria . "','" . $date . "','". $gdrive ."' );";

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
<div class="content-body">
    <form action="admin-articoli.php" method="POST">
        Titolo: <input type="text" name="titolo" required><br>
        Sottotitolo: <input type="text" name="sottotitolo"><br>
        Categoria: <input type="text" name="categoria" required><br>
        Corpo: <input type="text" name="corpo" required><br>
        Link Gdrive: <input type="text" name="gdrive"><br>

        <button type="submit" name="crea_articolo">
            Crea
        </button>
    </form>
</div>
<?php
require 'partials/footer.php';
?>