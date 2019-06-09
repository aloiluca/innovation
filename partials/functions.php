<?php

/**
 * Questa funzione riceve 4 parametri di tipo stringa ed esegue la connessione al database:
 *
 * 1. Esegue la connessione all HostServer.
 * 2. Si connette al database richiesto.
 *
 * - in caso di successo restituisce un oggetto di tipo mysqli.
 * - in caso di fallimento restituisce false.
 *
 * @param string $servername
 * @param string $username
 * @param string $password
 * @param string $database
 * @return bool|false|mysqli
 */
function getConnection($servername, $username, $password, $database){
    $conn= mysqli_connect($servername, $username, $password );
    $db = mysqli_select_db($conn, $database);

    if (!$conn) {
        return false;
    }
    elseif (!$db) {
        return false;
    }
    else{
//        echo "connessi al database: $database";
        return $conn;
    }
}

/**
 *
 *  La funzione riceve 2 parametri:
 * - la connessione al database.
 * - un array contenente i path dei file in cui si trovano gli statement da eseguire sul database:
 *
 * Se sono presenti più query all'interno dello stesso file vengono separate dalla stringa '--' ed eseguite una alla volta:
 *
 * Per ogni query, in caso di errore viene inserito l'elemento $nome_file => $query all'iterno dell'array $result_array.
 * Nel caso in cui la query avvenga con successo viene inserito invece l'elemento $nome_file => 'Eseguita correttamente'.
 *
 * In ogni caso la funzione restituisce l'array $result_array che contiene appunto quali query sono eseguite correttamente
 * e quali invece hanno riscontrato degli errori.
 *
 * @param mysqli $connection
 * @param array $migration_files
 * @return array $result_array
 */
function migrate($connection, array $migration_files) {

    $result_array = array();

    foreach ($migration_files as $index => $migration ) {

        $content = file_get_contents($migration);
        $array_statements = explode('--', $content);

        foreach ($array_statements as $statement) {
            $result = mysqli_query($connection, $statement);

            if (!$result) {
                $error = [$migration => 'Errore' ];
                $result_array = array_merge($result_array , $error);
            }
            else {
                $success = [$migration => 'Eseguita correttamente' ];
                $result_array = array_merge($result_array , $success);
            }
        }
    }
    return $result_array;
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
    preg_replace('#á#', '&aacute;', $text);  // Replace á with &aacute;
    preg_replace('#è#', '&egrave;', $text);  // Replace è with &egrave;
    preg_replace('#é#', '&eacute;', $text);  // Replace é with &eacute;
    preg_replace('#ì#', '&igrave;', $text);  // Replace ì with &igrave;
    preg_replace('#í#', '&igrave;', $text);  // Replace í with &iacute;
    preg_replace('#ò#', '&ograve;', $text);  // Replace ò with &ograve;
    preg_replace('#ó#', '&ograve;', $text);  // Replace ó with &oacute;
    preg_replace('#ù#', '&ugrave;', $text);  // Replace ù with &ugrave;
    preg_replace('#ù#', '&ugrave;', $text);  // Replace ú with &uacute;
    preg_replace('#À#', '&Agrave;', $text);
    preg_replace('#Á#', '&Aacute;', $text);
    preg_replace('#È#', '&Egrave;', $text);
    preg_replace('#É#', '&Eacute;', $text);
    preg_replace('#Ì#', '&Igrave;', $text);
    preg_replace('#Í#', '&Iacute;', $text);
    preg_replace('#Ò#', '&Ograve;', $text);
    preg_replace('#Ó#', '&Oacute;', $text);
    preg_replace('#Ù#', '&Ugrave;', $text);
    preg_replace('#Ú#', '&Uacute;', $text);
    preg_replace('#£#', '&pound;', $text);  // Replace £ with &pound;
    preg_replace('#§#', '&sect;', $text);  // Replace § with &sect;
    preg_replace('#ç#', '&ccedil;', $text);  // Replace ç with &ccedil;
    preg_replace('#°#', '&deg;', $text);  // Replace ° with &deg;
    preg_replace('#€#', '&euro;', $text);  // Replace € with &euro;
    return $text;
}