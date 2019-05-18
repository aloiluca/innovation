<?php

require 'config/database.php';
require 'partials/header.php';
?>
<div class="content-body">
    <div class="searchbar">
        <form action="/innovazione/news.php" method="POST">
            <h1>NEWS</h1>
            <div class="cerca">
            <input type="text" placeholder="cerca" class="cerca" value="Cerca per titolo o per autore">
            </div>
            <!-- Categorie -->
            <div class="argomenti">
            <input type="checkbox" name="categoria_scelta" value="Start_up"> Start up
            <input type="checkbox" name="categoria_scelta" value="Digital_Marketing"> Digital Marketing
            <input type="checkbox" name="categoria_scelta" value="New Technogy"> New Technology
            <input type="checkbox" name="categoria_scelta" value="Web Design"> Web Design



            <!-- Submit -->
            <button type="submit" id="submit-filter" name="submit-filter" value="Submit">Submit</button>
            </div>
        </form>
    </div>


<?php

$sql = "SELECT * FROM articoli";
$result = mysqli_query($conn, $sql);
mysqli_num_rows($result);
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

?>
</div>

