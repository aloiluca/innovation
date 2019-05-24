<?php

require 'config/database.php';
require 'partials/header.php';
?>
<div class="content-body">
    <div class="searchbar">
        <form action="news.php" method="POST">
            <h1>NEWS</h1>
            <!-- Categorie -->
            <div class="argomenti">
            <input type="checkbox" name="categorie_scelte[]" value="start up"> Start up
            <input type="checkbox" name="categorie_scelte[]" value="digital marketing"> Digital Marketing
            <input type="checkbox" name="categorie_scelte[]" value="new technology"> New Technology
            <input type="checkbox" name="categorie_scelte[]" value="web design"> Web Design



            <!-- Submit -->
            <button type="submit" id="submit-filter" name="submit-filter" value="Submit">Submit</button>
            </div>
        </form>
    </div>


<?php


if ( isset($_POST['submit-filter']) ) {

    $categorie_scelte = $_POST["categorie_scelte"];

    $stringa_categorie = implode(",", $categorie_scelte);

    $singola_categoria = explode(",", $stringa_categorie);

    /* Se è settata $singola_categoria[0] è uguale al valore, altrimenti uguale a stringa " "! */
    $categoria1 = isset( $singola_categoria[0]) ? $singola_categoria[0] : ' ';
    $categoria2 = isset( $singola_categoria[1]) ? $singola_categoria[1] : ' ';
    $categoria3 = isset( $singola_categoria[2]) ? $singola_categoria[2] : ' ';
    $categoria4 = isset( $singola_categoria[3]) ? $singola_categoria[3] : ' ';


    $sql = "SELECT * FROM articoli WHERE categoria = '" . $categoria1 . "' OR categoria = '" . $categoria2 .
            "' OR categoria = '" . $categoria3 . "' OR categoria = '" . $categoria4 ."';";

    $result = mysqli_query($conn, $sql);

    if ( mysqli_num_rows($result) > 0 ) {

        while ($row = mysqli_fetch_assoc($result)) {

            $titolo = $row["titolo"];
            $sottotitolo = $row["sottotitolo"];
            $categoria = $row["categoria"];
            $data = $row["data"];
            $id = $row["id"];

            /* Il nome dell'immagine dell'articolo è data dalla stringa 'articolo' + id + '.jpg' */
            $img = 'articolo'.$id.'.jpg'; // articolo1.jpg

            echo '
                       <div style="background-image:url(resources/img/articoli/'.$img.')"; class="articolo">
                           <form action="/innovation/articolo.php" method="POST">
                                <h1><button type="submit" id="submit" name="submit">'. $titolo .'</button></h1>
                                 <input style="display:none" type="hidden" name="id" value="'.$id.'"></p>
                                 <h4>' . $sottotitolo . '</h4>
                                 <h6>Data: ' . $data . '</h6>
                            </form>
                       </div>
                                
                        ';
            }

        } else {
            echo 'Non ci sono articoli per la categoria scelta. ';
        }

}
else {

    /* Stampo tutti gli articoli presenti nel database */
    $sql = "SELECT * FROM articoli";
    $result = mysqli_query($conn, $sql);

    if ( mysqli_num_rows($result) > 0 )

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
                                    </form>
                                </div>
                                
                        ';
        }
}



?>
</div>

<?php
require 'partials/footer.php';
?>
