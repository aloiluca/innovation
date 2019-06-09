<?php
require 'partials/functions.php';
require 'config/database.php';

/* Recupero delle variabili di sessione */
session_start();

if ( isset($_SESSION['logged']) && $_SESSION['admin'] == true ) {

    $array_migrations = array();
    $migrations = isset($_POST['migrations']) ? $_POST['migrations'] : array();

    /* Ogni migration selezionata nella checkbox la aggiungo all'array $array_migration */
    foreach ($migrations as $migration ) {
        array_push($array_migrations, $migration);
    }

    /* Se $array_migrations è diverso di vuoto */
    if (!empty($array_migrations)) {

        /* Eseguo le query selezionate sul database */
        $risultato = migrate($conn,$array_migrations);

        /* Stampo i messaggi dei risultati */
        foreach ($risultato as $migration => $value) {
            echo "Risultato della migration <b>$migration</b> --> $value <br/>";
        }
    }
}
else {
    /* Se non si è loggati o admin reindirizzo a index.php*/
    header("Location: /innovation/index.php");
}
?>

<form action="migrations.php" method="POST">
        <input type="checkbox" name="migrations[]" value="sql/create_articoli_table">create_articoli_table<br/>
        <input type="checkbox" name="migrations[]" value="sql/create_tools_table">create_tools_table<br/>
        <input type="checkbox" name="migrations[]" value="sql/populate_articoli_table">populate_articoli_table<br/>
        <input type="checkbox" name="migrations[]" value="sql/populate_utenti_table">populate_utenti_table<br/>
        <input type="checkbox" name="migrations[]" value="sql/populate_tools_table">populate_tools_table<br/><br/>
        <button type="submit" >Conferma</button>
</form>