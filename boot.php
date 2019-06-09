<?php
require 'partials/functions.php';
require 'config/database.php';

/* Nella pagina boot.php viene richiamta la funzione custom migrate() che eseguirà la query sul database */

    $array_migrations = ['sql/create_utenti_table','sql/populate_utenti_table_admin'];
    $risultato = migrate($conn,$array_migrations);

    /* Vengono stampati i messaggi contentuti nell'array */
    foreach ($risultato as $migration => $value) {
        echo "Risultato della migration <b>$migration</b> --> $value <br/>";
    }