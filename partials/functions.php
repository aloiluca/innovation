<?php

/**
 * Questa funzione riceve 4 parametri di tipo stringa ed esegue la connessione al database:
 * - in caso di successo restituisce l'oggetto di tipo mysqli.
 * - in caso di fallimento restituisce false.
 *
 * @param string $servername
 * @param string $username
 * @param string $password
 * @param string $db
 * @return bool|false|mysqli
 */
function getConnection($servername, $username, $password, $db){
    $conn= mysqli_connect($servername, $username, $password, $db);
    if (!$conn) {
        return false;
    }
    else{
        return $conn;
    }
}




/**
 * Questa riceve 2 parametri:
 * - la connessione al database.
 * - un path di un file in cui si trovano 1 o più migration/query da eseguire su un database:
 *
 * Se sono presenti più query vengono separate dalla stringa '--' ed eseguite una alla volta:
 * sempre per ogni query , in caso di fallimento viene stampato un messaggio di errore che stampa la query fallita.
 *
 * @param mysqli $connection
 * @param string $migration_file
 * @throws Exception
 */
function migrate($connection, $migration_file) {

    $sql = file_get_contents($migration_file);
    $array_statement = explode('--', $sql);

    foreach ( $array_statement as $migration) {
        $result = mysqli_query($connection, $migration);

        if (!$result) {
            echo "La seguente query non è stata eseguita: $migration <br>";
        }
    }
}


/**
 * Questa funzione prende una stringa come parametro e versifica se ci sono caratteri speciali e li sostituisce con
 * codici in modo che il browser reinderizza il carattere in modo corrretto.
 * Il pattern è racchiuso da 2 deliitatori identificati da '/' o '#'.
 *
 * @param $text
 * @return mixed
 */
function replace_special_character($text) {
    preg_replace('#à#', '&agrave;', $text);  // Replace à with &agrave;
    preg_replace('#è#', '&egrave;', $text);  // Replace è with &egrave;
    preg_replace('#é#', '&eacute;', $text);  // Replace é with &egrave;
    preg_replace('#ì#', '&igrave;', $text);  // Replace ì with &igrave;
    preg_replace('#ò#', '&ograve;', $text);  // Replace ò with &ograve;
    preg_replace('#£#', '&pound;', $text);  // Replace £ with &pound;
    preg_replace('#§#', '&sect;', $text);  // Replace § with &sect;
    preg_replace('#ç#', '&ccedil;', $text);  // Replace ç with &ccedil;
    preg_replace('#°#', '&deg;', $text);  // Replace ° with &deg;
    preg_replace('#€#', '&euro;', $text);  // Replace € with &euro;
    return $text;
}