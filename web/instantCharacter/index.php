<?php

session_start();

/*
 * Main Controller
 */

//get the connection
require_once 'library/connections.php';
require_once 'models/accounts-model.php';
require_once 'models/character-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        if (isset($_SESSION['userData'])) {
            //now get the character's associated with this user
            $characters = getCharacters($_SESSION['userData']['userId']);
            
            include "userPage.php";
            exit;
        } else {
            include "login.php";
            exit;
        }
        break;
    case 'Login':
        // Filter and store the data
        $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($screenName) || empty($password)) {
            $message = '<p>Please provide a valid username and password</p>';
            include "login.php";
            exit;
        }

        $userData = getUser($screenName);

        // Remove the password from the array
        // the array_pop function removes the last element from an array
        array_pop($userData);

        // Store the array into the session
        $_SESSION['userData'] = $userData;
		var_dump($userData);
		var_dump($_SESSION);

        //now get the character's associated with this user
        $characters = getCharacters($_SESSION['userData']['userid']);
		var_dump($characters);

        include "userPage.php";
        break;
    case "loadCharacter":
        // Filter and store the data
        $characterId = filter_input(INPUT_GET, 'characterId', FILTER_SANITIZE_STRING);
        $character = getCharacter($characterId);

        $_SESSION['character'] = $character;
        header("Location: instantCharacter.php");
        break;
    default:
        header("Location: instantCharacter.php");
}
