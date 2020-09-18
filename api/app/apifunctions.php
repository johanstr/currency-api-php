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
        header('Content-Type: application/json');
        echo json_encode([ 'error' => $error ]);
    }
}

function calculate($from_currency, $value, $to_currency) {
    try {
        $db = new PDO('mysql:hostname=127.0.0.1;dbname=admin_currency_api', 'root', 'root');
        $db_statement = $db->prepare('SELECT * FROM currency WHERE abbr = :abbr');
        $db_statement->execute(
            [ ':abbr' => $from_currency ]
        );
        $from_currency_row = $db_statement->fetch(PDO::FETCH_ASSOC);
        
        $db_statement->execute(
            [ ':abbr' => $to_currency ]
        );
        $to_currency_row = $db_statement->fetch(PDO::FETCH_ASSOC);
        
        $valueInEuros = floatval($value) / floatval($from_currency_row['value']);
        $valueInToCurrency = floatval($valueInEuros) * floatval($to_currency_row['value']);

        header('HTTP/1.1 200 Het is gelukt');
        header('Content-Type: application/json');
        echo json_encode([
            'calculated_value' => $valueInToCurrency,
            'from' => $from_currency,
            'amount' => $value,
            'to' => $to_currency
        ]);
    } catch(PDOException $error) {
        header('HTTP/1.1 404 Not found');
        header('Content-Type: application/json');
        echo json_encode([ 'error' => $error ]);
    }
}