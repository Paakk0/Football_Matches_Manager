<?php
class DatabaseConnector {

    public static function connect() {
        $host = 'localhost';
        $db_name = 'fma';
        $username = 'root';
        $password = '';

        $conn = new mysqli($host, $username, $password, $db_name);

        if ($conn->connect_error) {
            die('Connection Error: ' . $conn->connect_error);
        }

        return $conn;
    }
}
?>
