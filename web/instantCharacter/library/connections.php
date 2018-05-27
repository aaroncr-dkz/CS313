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

function herokuConnect() {
	try {
       $dbUrl = getenv('DATABASE_URL');
	   $dbopts = parse_url($dbUrl);

       $dbHost = $dbopts["host"];
       $dbPort = $dbopts["port"];
       $dbUser = $dbopts["user"];
       $dbPassword = $dbopts["pass"];
       $dbName = ltrim($dbopts["path"],'/');

       $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex) {
       echo 'Error!: ' . $ex->getMessage();
       die();
	}
}
