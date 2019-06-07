<?php
require 'partials/functions.php';
require 'config/database.php';

/* Creazione della tabella utenti ed inserimento dell'utente amministartore*/
migrate($conn, 'sql/create_utenti_table');
migrate($conn, 'sql/populate_utenti_table_admin');

/* Recupero delle variabili di sessione */
session_start();


/* Se la sessione è loggata e si è amministratori si esegeue il seguente codice:
   da commentare quando non si vuole che venga eseguito
*/
if ( $_SESSION['logged'] && $_SESSION['admin'] == true ) {

    migrate($conn, 'sql/create_articoli_table');
    migrate($conn, 'sql/create_utenti_table');
    migrate($conn, 'sql/create_tools_table');
    migrate($conn, 'sql/populate_articoli_table');
    migrate($conn, 'sql/populate_utenti_table');
    migrate($conn, 'sql/populate_tools_table');

}
else {

    /* Se l'utente non è amministratore reindirizzo a index.php senza eseguire */
    header("Location: /innovation/index.php");
}