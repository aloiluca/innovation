<?php
require 'partials/header.php';
require 'partials/functions.php';
require 'config/database.php';


if( isset( $_POST['crea_tool']) ){

    $nome = replace_special_character($_POST['nome']);
    $tipo = replace_special_character($_POST['tipo']);
    $corpo = replace_special_character($_POST['corpo']);
    $version = $_POST['version'];
    $data_version = $_POST['data-version'];
    $dev = replace_special_character($_POST['dev']);
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
    <form action="admin-tools.php" method="POST">
        Nome: <input type="text" name="nome" required><br>
        Tipo: <input type="text" name="tipo" required><br>
        Corpo: <input type="text" name="corpo"><br>
        Version: <input type="text" name="version" required><br>
        Data Version: <input type="date" name="data-version"><br>
        Developer: <input type="text" name="dev"><br>
        Link al sito: <input type="text" name="link-sito"><br>

        <button type="submit" name="crea_tool">Crea</button>
    </form>
</div>
<?php
require 'partials/footer.php';
?>