<?php
function db_connect() {
    static $connection;

    if(!isset($connection)) {
        $config = parse_ini_file('config.ini');
        $connection = mysqli_connect($config['dbserver'],$config['username'],$config['password'],$config['dbname']);
        if ($connection->connect_error)
            return null;
    }

    if($connection === false)
        return null;

    return $connection;
}
?>