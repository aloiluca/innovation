<?php
require 'partials/header.php';


if( isset( $_POST['crea_articolo']) ){

    $titolo = $_POST['titolo'];
    $sottotitolo = $_POST['sottotitolo'];
    $categoria = $_POST['categoria'];
    $corpo = $_POST['corpo'];
    $gdrive = $_POST['gdrive'];


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
    <div class="form">
        <div class="form-input">
            <form action="admin-articoli.php" method="POST">
                <p><b>Inserisci un nuovo articolo</b></p>
                <input type="text" class="register-field-a" placeholder="Titolo" name="titolo" required>
                <input type="text" class="register-field-a" placeholder="Sottotitolo" name="sottotitolo" required>
                <input type="text" class="register-field-a" placeholder="Categoria" name="categoria" required>
                <input type="text" class="register-field-a" placeholder="Link Gdrive" name="gdrive">
                <textarea class="register-field-d" rows="15" placeholder="Corpo" maxlength="8000" name="corpo"></textarea>

                <button type="submit" class="submit-button" name="crea_articolo">Crea</button>
            </form>
        </div>
    </div>
</div>

<?php
require 'partials/footer.php';
?>