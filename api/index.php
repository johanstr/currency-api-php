<?php

@require_once('app/apifunctions.php');

$cmd = '';

if(!isset($_GET['cmd'])) {
    $cmd = 'ALL';
} else {
    $cmd = str_toupper($_GET['cmd']);
}

switch($cmd) {
    case 'ALL':
        getAllCurrencies();
        break;

    case 'ONE':

        break;

    case 'CALC':

        break;

    default:
        // Foutmeldingen genereren en teruggeven aan de caller
}