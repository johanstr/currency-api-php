<?php

class DBHelper
{
    private $host = '127.0.0.1';
    private $db_name = 'admin_currency_api';
    private $db_user = 'root';
    private $db_password = 'root';

    private $db_connection = null;
    private $db_statement = null;

    public functon __construct()
    {
        try {
            $this->$db_connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->db_user, $this->db_password );
        } catch(PDOEXception $error) {

        }
    }

    public function query($sql, $args = [])
    {
        if(!is_null($this->db_connection)) {
            try {
                $this->db_statement = $this->db_connection->prepare($sql);
                $this->db_statement->execute($args);
            } catch(PDOException $error) {

            }
        }
    }

    public function getAll()
    {
        if (!is_null($this->db_connection) && !is_null($this->db_statement)) {
            return $this->db_statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function get()
    {
        if (!is_null($this->db_connection) && !is_null($this->db_statement)) {
            return $this->db_statement->fetch(PDO::FETCH_ASSOC);
        }

        return [];
    }
}