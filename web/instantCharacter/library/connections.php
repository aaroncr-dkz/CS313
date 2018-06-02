<?php

/*
 * Database Connections
 */

function localConnect() {
    $server = "localhost";
    $database = "instant_character";
    $username = "iClient";
    $password = "z15H8rpmxGo7luVS";

    $dsn = "mysql:host=$server;dbname=$database;";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch (Exception $ex) {
        echo "Server Error";
    }
}
