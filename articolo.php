<?php
require 'config/database.php';
require 'partials/header.php';

?>

<div class="content-body">

<?php


$id_articolo = $_POST['id'];
$sql = "SELECT * FROM articoli where id = ".$id_articolo.";";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $titolo = $row["titolo"];
        $sottotitolo = $row["sottotitolo"];
        $categoria = $row["categoria"];
        $data = $row["data"];
        $corpo = $row['corpo'];
        $preview = substr($corpo,0,250);
        $autore = $row['autore'];
        echo '
              <div class="divtesto">
                  <p class=\'titolotesto\'>' . $titolo . '</p>
                  <p>' . $data . '</p>
                  <p>Categoria: ' . $categoria . '</p>
                  <p>Autore: '. $autore.' </p>';

        /* Se la sessione è loggata allora mostro tutto il corpo sennò solo la preview*/
        if ( isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            echo "<div class='testo'>  $corpo </div>";
        }
        else {
            echo" <div class='testo'>  $preview  </div>";
        }
    }
}
?>
</div>
</div>

<?php
require 'partials/footer.php';
?>