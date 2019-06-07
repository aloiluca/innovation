<?php
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