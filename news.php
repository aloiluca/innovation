<?php
require 'partials/header.php';
require 'config/database.php';

/*messaggio: articolo cancellato correttamente */
if ($_SESSION['articolo_cancellato']==TRUE) {
    echo "articolo cancellato correttamente";
    $_SESSION['articolo_cancellato'] = FALSE;
  }

?>


<div class="content-body">

    <div class="searchbar">
        <form action="news.php" method="POST">
            <h1>NEWS</h1>

            <fieldset>

                <legend>Ricerca per Autore e Categoria</legend>

                <!-- Categorie -->
                <div class="search">
                    <input type="checkbox" name="categorie_scelte[]" value="start up"> Start up
                    <input type="checkbox" name="categorie_scelte[]" value="digital marketing"> Digital Marketing
                    <input type="checkbox" name="categorie_scelte[]" value="new technology"> New Technology
                    <input type="checkbox" name="categorie_scelte[]" value="web design"> Web Design
                </div>

                <!-- Autori -->
                <div class="search">
                    <label>Autori</label>
                    <select name="autore">
                        <option value="autore"></option>
                        <option value="admin">admin</option>
                        <option value="Luca">Luca</option>
                        <option value="Gabriele">Gabriele</option>
                        <option value="Matteo">Matteo</option>
                        <option value="Flavio">Flavio</option>
                        <option value="Elisa">Elisa</option>
                        <option value="Rachele">Rachele</option>
                        <option value="Andrea">Andrea</option>
                        <option value="Mahdi">Mahdi</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="search">
                    <input type="submit" name="submit-filter">
                </div>

            </fieldset>
        </form>
    </div>


<?php


if ( isset($_POST['submit-filter']) ) {

    if (!isset($_POST['categorie_scelte']) && $_POST['autore'] == "autore") {

        echo '<div>Non hai selezionato nessun filtro</div>';
    } else {
        if ( isset($_POST['categorie_scelte']) && $_POST['autore'] == "autore" ) {

            $categorie_scelte = $_POST["categorie_scelte"];

            $stringa_categorie = implode(",", $categorie_scelte);

            $singola_categoria = explode(",", $stringa_categorie);

            /* Se è settata $singola_categoria[0] è uguale al valore, altrimenti uguale a stringa " "! */
            $categoria1 = isset($singola_categoria[0]) ? $singola_categoria[0] : ' ';
            $categoria2 = isset($singola_categoria[1]) ? $singola_categoria[1] : ' ';
            $categoria3 = isset($singola_categoria[2]) ? $singola_categoria[2] : ' ';
            $categoria4 = isset($singola_categoria[3]) ? $singola_categoria[3] : ' ';

            $sql = "SELECT * FROM articoli WHERE categoria = '" . $categoria1 . "' OR categoria = '" . $categoria2 .
                "' OR categoria = '" . $categoria3 . "' OR categoria = '" . $categoria4 . "';";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $titolo = $row["titolo"];
                    $sottotitolo = $row["sottotitolo"];
                    $categoria = $row["categoria"];
                    $data = $row["data"];
                    $id = $row["id"];
                    $autore = $row["autore"];

                    /* Il nome dell'immagine dell'articolo è data dalla stringa 'articolo' + id + '.jpg' */
                    $img = 'articolo' . $id . '.jpg'; // articolo1.jpg

                    echo '
                       <div style="background-image:url(resources/img/articoli/' . $img . ')"; class="articolo">
                           <form action="/innovation/articolo.php" method="POST">
                                <div id="submit">
                                    <h1><button type="submit" name="submit">' . $titolo . '</button></h1>
                                </div>
                                 <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                                 <h4>' . $sottotitolo . '</h4>
                                 <p>Data: ' . $data . '</p>
                                 <p>Categoria: ' . $categoria . '</p>
                                 <p>Autore: ' . $autore . '</p>
                            </form>
                       </div>
                                
                        ';
                }

            } else {
                echo '<p class="messaggio-avviso">Non ci sono articoli per la categoria scelta.</p> ';
            }
        } elseif ( (isset($_POST['autore']) && $_POST['autore'] != 'autore') && !isset($_POST['categorie_scelte']) ) {

            $autore = $_POST["autore"];

            $sql = "SELECT * FROM articoli WHERE autore = '" . $autore . "';";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $titolo = $row["titolo"];
                    $sottotitolo = $row["sottotitolo"];
                    $categoria = $row["categoria"];
                    $data = $row["data"];
                    $id = $row["id"];
                    $autore = $row["autore"];

                    /* Il nome dell'immagine dell'articolo è data dalla stringa 'articolo' + id + '.jpg' */
                    $img = 'articolo' . $id . '.jpg'; // articolo1.jpg

                    echo '
                       <div style="background-image:url(resources/img/articoli/' . $img . ')"; class="articolo">
                           <form action="/innovation/articolo.php" method="POST">
                                <h1><button type="submit" id="submit" name="submit">' . $titolo . '</button></h1>
                                 <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                                 <h4>' . $sottotitolo . '</h4>
                                 <h6>Data: ' . $data . '</h6>
                                 <p>Categoria: ' . $categoria . '</p>
                                 <p>Autore: ' . $autore . '</p>
                            </form>
                       </div>
                                
                        ';
                }

            } else {
                echo '<p class="messaggio-avviso">Non ci sono articoli per l\'autore scelto.</p> ';
            }
        } else {

            $categorie_scelte = $_POST["categorie_scelte"];

            $stringa_categorie = implode(",", $categorie_scelte);

            $singola_categoria = explode(",", $stringa_categorie);

            /* Se è settata $singola_categoria[0] è uguale al valore, altrimenti uguale a stringa " "! */
            $categoria1 = isset($singola_categoria[0]) ? $singola_categoria[0] : ' ';
            $categoria2 = isset($singola_categoria[1]) ? $singola_categoria[1] : ' ';
            $categoria3 = isset($singola_categoria[2]) ? $singola_categoria[2] : ' ';
            $categoria4 = isset($singola_categoria[3]) ? $singola_categoria[3] : ' ';

            $autore = $_POST["autore"];

            $sql = "SELECT * FROM articoli WHERE (autore = '" . $autore . "') && (categoria = '" . $categoria1 . "' OR categoria = '" . $categoria2 .
                "' OR categoria = '" . $categoria3 . "' OR categoria = '" . $categoria4 . "');";
            $result = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $titolo = $row["titolo"];
                    $sottotitolo = $row["sottotitolo"];
                    $categoria = $row["categoria"];
                    $data = $row["data"];
                    $id = $row["id"];

                    /* Il nome dell'immagine dell'articolo è data dalla stringa 'articolo' + id + '.jpg' */
                    $img = 'articolo' . $id . '.jpg'; // articolo1.jpg

                    echo '
                       <div style="background-image:url(resources/img/articoli/' . $img . ')"; class="articolo">
                           <form action="/innovation/articolo.php" method="POST">
                                <h1><button type="submit" id="submit" name="submit">' . $titolo . '</button></h1>
                                 <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                                 <h4>' . $sottotitolo . '</h4>
                                 <h6>Data: ' . $data . '</h6>
                                 <p>Categoria: ' . $categoria . '</p>
                                 <p>Autore: ' . $autore . '</p>
                            </form>
                       </div>
                                
                        ';
                }

            } else {
                echo '<p class="messaggio-avviso">Non ci sono articoli per i filtri scelti </p>' ;
            }
        }
    }
}
else {
    /* Stampo tutti gli articoli presenti nel database */
    $sql = "SELECT * FROM articoli";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $titolo = $row["titolo"];
            $sottotitolo = $row["sottotitolo"];
            $categoria = $row["categoria"];
            $data = $row["data"];
            $id = $row["id"];
            $autore = $row["autore"];

            /* Il nome dell'immagine dell'articolo è data dalla stringa 'articolo' + id + '.jpg' */
            $img = 'articolo' . $id . '.jpg'; // articolo1.jpg

            echo '
                                
                                
                                <div style="background-image:url(resources/img/articoli/' . $img . ')"; class="articolo">
                                    <form action="/innovation/articolo.php" method="POST">
                                        <h1><button type="submit" id="submit" name="submit">' . $titolo . '</button></h1>
                                        <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                                        <h4>' . $sottotitolo . '</h4>
                                        <h6>Data: ' . $data . '</h6>
                                        <p>Categoria: ' . $categoria . '</p>
                                        <p>Autore: ' . $autore . '</p>
                                    </form>
                                </div> 
                        ';
        }
    }
    else {
        echo '<p class="messaggio-avviso">Non è presente alcun articolo </p>';
    }
}

?>
</div>

<?php
require 'partials/footer.php';
?>