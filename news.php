<?php
require 'partials/header.php';

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
                        <option value="autore"> --Select-- </option>

                        <?php
                        $sql = "SELECT DISTINCT(autore) FROM articoli";
                        $result = mysqli_query($conn,$sql);


                        $autori = ['--Select--'];

                        while ($row = mysqli_fetch_assoc($result)) {
                            $autore = $row["autore"];
                            echo "<option value='$autore'>$autore</option>";
                        }
                        ?>
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
        getNews($conn,'AllNews');

    } else {
        if ( isset($_POST['categorie_scelte']) && $_POST['autore'] == "autore" ) {

            getNews($conn, 'ByCategory');

        } elseif ( (isset($_POST['autore']) && $_POST['autore'] != 'autore') && !isset($_POST['categorie_scelte']) ) {

            getNews($conn,'ByAuthor');

        } else {

            getNews($conn,'ByAllFilter');
        }
    }
}
else {
    getNews($conn,'AllNews');
}

?>
</div>

<?php
require 'partials/footer.php';
?>