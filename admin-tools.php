<?php
require 'partials/header.php';



if( isset( $_POST['crea_tool']) ){

    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $corpo = $_POST['corpo'];
    $version = $_POST['version'];
    $data_version = $_POST['data-version'];
    $dev = $_POST['dev'];
    $link_sito = $_POST['link-sito'];

    /* Setto il time local e richiedo l'ora corrente */
    $timelocal = date_default_timezone_set('Europe/Rome');
    $date = date('Y/m/d', time());

    /* Recupero il nome dell'utente loggato */
    $autore = $_SESSION['user_name'];


    $sql = "INSERT INTO `tools`( `tipo`, `nome`, `corpo`, `version`, `data_version`, `dev`, `link_sito`, `autore`, `data_insert`) 
                VALUES ( '".$tipo."','".$nome."','".$corpo."','" .$version."','" .$data_version."','" .$dev. "','".$link_sito. "','".$autore."','" .$date. "' );";

    $result = mysqli_query( $conn, $sql);

    if ( $result == TRUE ) {
        echo 'Tool inserito correttamente';
        header("Refresh:1 ; Location: /innovation/admin-tools.php");
    }
    else {
        echo 'Tool non inserito';
    }
}

?>
<div class="content-body">
    <div class="form">
        <div class="form-input">
            <form action="admin-tools.php" method="POST">
                <p><b>Inserisci un nuovo tool</b></p>
                <input type="text" class="register-field-a" placeholder="Nome" name="nome" required>
                <input type="text" class="register-field-a" placeholder="Tipo" name="tipo" required>
                <input type="text" class="register-field-a" placeholder="Version" name="version" required>
                <input type="date" class="register-field-a" placeholder="Ultima release" name="data-version">
                <input type="text" class="register-field-a" placeholder="Developer" name="dev">
                <input type="text" class="register-field-a" placeholder="Link al sito" name="link-sito">
                <textarea class="register-field-d" rows="15" placeholder="Corpo" maxlength="8000" name="corpo"></textarea>

                <button type="submit" class="submit-button" name="crea_tool">Crea</button>
            </form>
        </div>
    </div>
</div>
<?php
require 'partials/footer.php';
?>