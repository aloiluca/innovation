<?php
require 'partials/header.php';


?>

<div class="content-body">

<?php


$id_articolo = $_POST['id'];
$sql = "SELECT * FROM articoli where id = ".$id_articolo.";";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $titolo = replace_special_character($row["titolo"]);
        $sottotitolo = replace_special_character($row["sottotitolo"]);
        $categoria = replace_special_character($row["categoria"]);
        $data = $row["data"];
        $corpo = $row['corpo'];
        $preview = substr($corpo,0,250);
        $autore = replace_special_character($row['autore']);
        $gdrive = replace_special_character($row['gdrive']);
        echo '
              <div class="divtesto">
                  <p class=\'titolotesto\'>' . $titolo . '</p>
                  <p>' . $data . '</p>
                  <p>Categoria: ' . $categoria . '</p>
                  <p>Autore: '. $autore.' </p>';

        /* Se la sessione è loggata allora mostro tutto il corpo e, se presente, il link, sennò solo la preview*/
        if ( isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            if ($gdrive) {
                echo "<div class='divtesto'> 
                          <a target='_blank' href='$gdrive'>Link utile: $gdrive</a> 
                     </div>";
                }
            echo "<div class='testo'> $corpo </div>";
            }
        else {
            echo" <div class='testo'>  $preview  </div>
                  <div class='testo'>
                      <p>Effettua il <a href='/innovation/login.php'>login</a> per visualizzare l'articolo completo</p>
                  </div>";
            }
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            echo "<form action='articolo.php' method='POST'>
            <input type='hidden' name='id' value='" . $_POST['id'] . "'>
            <button type='submit' name='delete_articolo' class='delete_button'>DELETE</button>
            </form>";
            }
        }
    }

/*Cancellazione articolo */
if ( isset( $_POST['delete_articolo'])) {
    $sql = "DELETE FROM articoli WHERE id = ". $_POST['id'] .";";
    $result = mysqli_query( $conn, $sql);
    header("Location: /innovation/news.php");
    $_SESSION['articolo_cancellato']= TRUE;
}
if (!$result) {
    echo "<div class='error-message'>articolo non cancellato</div>";
}

?>
</div>

<?php
require 'partials/footer.php';
?>