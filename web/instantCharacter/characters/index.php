<?php

session_start();

/*
 * Character Controller
 */

//get the connection
require_once '../library/connections.php';
require_once '../models/character-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'saveCharacter':
        $userId = $_SESSION["userData"]["userId"];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_NUMBER_INT);
        $race = filter_input(INPUT_POST, 'race', FILTER_SANITIZE_NUMBER_INT) + 1;
        $class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT) + 1;

        $str = filter_input(INPUT_POST, 'str', FILTER_SANITIZE_NUMBER_INT);
        $dex = filter_input(INPUT_POST, 'dex', FILTER_SANITIZE_NUMBER_INT);
        $con = filter_input(INPUT_POST, 'con', FILTER_SANITIZE_NUMBER_INT);
        $int = filter_input(INPUT_POST, 'int', FILTER_SANITIZE_NUMBER_INT);
        $wis = filter_input(INPUT_POST, 'wis', FILTER_SANITIZE_NUMBER_INT);
        $cha = filter_input(INPUT_POST, 'cha', FILTER_SANITIZE_NUMBER_INT);
        $hp = filter_input(INPUT_POST, 'health', FILTER_SANITIZE_NUMBER_INT);

        saveCharacter($userId, $name, $race, $class, $str, $dex, $con, $int, $wis, $cha, $level, $hp);

        header("Location: ../accounts/?action=login");
        break;
    case "updateCharacter":
        $userId = $_SESSION["userData"]["userId"];
        $characterId = filter_input(INPUT_POST, 'characterId', FILTER_SANITIZE_NUMBER_INT);

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_NUMBER_INT);
        $race = filter_input(INPUT_POST, 'race', FILTER_SANITIZE_NUMBER_INT) + 1;
        $class = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT) + 1;

        $str = filter_input(INPUT_POST, 'str', FILTER_SANITIZE_NUMBER_INT);
        $dex = filter_input(INPUT_POST, 'dex', FILTER_SANITIZE_NUMBER_INT);
        $con = filter_input(INPUT_POST, 'con', FILTER_SANITIZE_NUMBER_INT);
        $int = filter_input(INPUT_POST, 'int', FILTER_SANITIZE_NUMBER_INT);
        $wis = filter_input(INPUT_POST, 'wis', FILTER_SANITIZE_NUMBER_INT);
        $cha = filter_input(INPUT_POST, 'cha', FILTER_SANITIZE_NUMBER_INT);
        $hp = filter_input(INPUT_POST, 'health', FILTER_SANITIZE_NUMBER_INT);

        updateCharacter($userId, $characterId, $name, $race, $class, $str, $dex, $con, $int, $wis, $cha, $level, $hp);

        header("Location: ../accounts/?action=login");
        break;
    case "loadCharacter":
        // Filter and store the data
        $characterId = filter_input(INPUT_GET, 'characterId', FILTER_SANITIZE_STRING);
        $character = getCharacter($characterId);

        $_SESSION['character'] = $character;
        header("Location: ../instantCharacter.php");
        break;
    case "deleteCharacter":
        $characterId = filter_input(INPUT_GET, 'characterId', FILTER_SANITIZE_NUMBER_INT);
        $userId = $_SESSION["userData"]["userId"];
        
        $result = deleteCharacter($characterId, $userId);
        
        if($result !== 1) {
            $_SESSION["message"] = "<p>Something went wrong, that character could not be deleted</p>";
            header("Location: ../accounts/?action=login");
        }
        else {
            header("Location: ../accounts/?action=login");
        }
        
        break;
    default:
        header("Location: ../instantCharacter.php");
}

