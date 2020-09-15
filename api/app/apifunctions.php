<?php

function getAllCurrencies() {
    try {
        $db = new PDO('mysql:hostname=127.0.0.1;dbname=admin_currency_api', 'root', 'root');
        $db_statement = $db->prepare('SELECT * FROM currency');
        $db_statement->execute();
        $rows = $db_statement->fetchAll(PDO::FETCH_ASSOC);

        $rows_json = json_encode($rows);

        header('Content-Type: application/json');
        echo $rows_json;

    } catch(PDOException $error) {

    }
}