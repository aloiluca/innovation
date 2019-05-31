<?php
/* Replace the special html characters */
function replace_special_character($text) {
    preg_replace('à', '&agrave;', $text);  // Replace à with &agrave;
    preg_replace('è', '&egrave;', $text);  // Replace è with &egrave;
    preg_replace('é', '&eacute;', $text);  // Replace é with &egrave;
    preg_replace('ì', '&igrave;', $text);  // Replace ì with &igrave;
    preg_replace('ò', '&ograve;', $text);  // Replace ò with &ograve;
    preg_replace('£', '&pound;', $text);  // Replace £ with &pound;
    preg_replace('§', '&sect;', $text);  // Replace § with &sect;
    preg_replace('ç', '&ccedil;', $text);  // Replace ç with &ccedil;
    preg_replace('°', '&deg;', $text);  // Replace ° with &deg;
    preg_replace('€', '&euro;', $text);  // Replace € with &euro;
    return $text;
}