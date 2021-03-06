<?php

session_start();

/*
 * Accounts Controller
 */

//get the connection
require_once '../library/connections.php';
require_once '../models/accounts-model.php';
require_once '../models/character-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        if (isset($_SESSION['userData'])) {
            //now get the character's associated with this user
            $characters = getCharacters($_SESSION['userData']['userid']);

            include "../views/userPage.php";
            exit;
        } else {
            include "../views/login.php";
            exit;
        }
        break;
    case 'Login':
        // Filter and store the data
        $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($screenName) || empty($password)) {
            $message = '<p>Both a username and password are required</p>';
            include "../views/login.php";
            exit;
        }

        $userData = getUser($screenName);

        // Compare the password just submitted against the hashed password for the matching client
        $hashCheck = password_verify($password, $userData['password']);

        // If the hashes don't match create an error and return to the login view
        if (!$hashCheck) {
            $message = '<p>Please provide a valid username and password</p>';
            include '../views/login.php';
            exit;
        }

        // Remove the password from the array
        // the array_pop function removes the last element from an array
        array_pop($userData);

        // Store the array into the session
        $_SESSION['userData'] = $userData;

        //now get the character's associated with this user
        $characters = getCharacters($_SESSION['userData']['userid']);

        include "../views/userPage.php";
        break;
    case 'logout':
        session_destroy();
        header("Location: ../instantCharacter.php");
        break;
    case 'go-to-register':
        include "../views/register.php";
        break;
    case 'register':
        // Filter and store the data
        $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //check for existing screenName
        $duplicateUser = checkExistingUsers($screenName);

        if($duplicateUser) {
            $message = "<p>That name is already in use. Do you want to login instead?</p>";
            include '../views/login.php';
            exit;
        }

        // Check for missing data
        if(empty($screenName) || empty($email) || empty($password)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/register.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regUser($screenName, $email, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Thanks for registering. Please use your username and password to login.</p>";
            include '../views/login.php';
            exit;
        } else {
            $message = "<p>Sorry, but the registration failed. Please try again.</p>";
            include '../views/register.php';
            exit;
        }
        break;
    case 'update-account':
        include "../views/edit-account.php";
        break;
    case 'edit-account':
        // Filter and store the data
        $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        

        if($screenName != $_SESSION['userData']['screenname']) {
            //check for existing screenName
            $duplicateUser = checkExistingUsers($screenName);
            
            if($duplicateUser) {
                $message = "<p class='instruction-text-noi'>That username "
                        . "is already in use. Please enter a different one.</p>";
                include '../views/edit-account.php';
                exit;
            }
        }

        // Check for missing data
        if(empty($screenName) || empty($email)){
            $message = '<p>All fields must have be valid in order to update an account</p>';
            include '../views/edit-account.php';
            exit;
        }

        // Send the data to the model
        $updateOutcome = updateUser($screenName, $email, $_SESSION['userData']['userid']);

        // Check and report the result
        if($updateOutcome === 1){
            $message = "<p>Your account has been updated.</p>";
            $userData = getUserById($_SESSION['userData']['userid']);
            $_SESSION['userData'] = $userData;
            header ("Location: ?action=login");
            exit;
        } else {
            $message = "<p>Sorry, an error occured and we were unable to update your account.</p>";
            include '../views/edit-account.php';
            exit;
        }
        break;
}
