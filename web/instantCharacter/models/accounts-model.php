<?php

// Get client data based on a screenName
function getUser($screenName) {
    
    // Create a connection object using the acme connection function
    $db = herokuConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT userId, ScreenName, Email, Password FROM Users WHERE ScreenName = :ScreenName';
        
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
        
    $stmt->bindValue(':ScreenName', $screenName, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
    // Close the database interaction
    $stmt->closeCursor();
        
    // Return the result
    return $userData;  
}

function getUserById($userId) {
    // Create a connection object using the acme connection function
    $db = herokuConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT userId, ScreenName, Email FROM Users WHERE userId = :userId';
        
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
        
    $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
    // Close the database interaction
    $stmt->closeCursor();
        
    // Return the result
    return $userData;  
}

function regUser($screenName, $password) {
// Create a connection object using the acme connection function
   $db = herokuConnect();
   
// The SQL statement
   $sql = 'INSERT INTO users (screenname, email, password) VALUES (:screenName, "", :password)';
   
// Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
   
   $stmt->bindValue(':screenName', $screenName, PDO::PARAM_STR);
   $stmt->bindValue(':password', $password, PDO::PARAM_STR);
   
// Insert the data
   $stmt->execute();
   
// Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   
// Close the database interaction
   $stmt->closeCursor();
   
// Return the indication of success (rows changed)
   return $rowsChanged;
}

//check for already existing email addresses
function checkExistingUsers($screenName) {
    // Create a connection object using the acme connection function
    $db = herokuConnect();
    
    // The SQL statement to be used with the database
    $sql = 'SELECT screenname FROM users WHERE screenname = :screenName';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':screenName', $screenName, PDO::PARAM_STR);
    $stmt->execute();
    $matchName = $stmt->fetch(PDO::FETCH_NUM);
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the result
    if(empty($matchName)) {
        return 0;
    } else {
        return 1;
    }
}

function updateUser($screenName, $email, $userId) {
// Create a connection object using the connection function
   $db = herokuConnect();
   
// The SQL statement
   $sql = 'UPDATE users SET screenname = :modname, Email = :modemail WHERE userId = :userId';
   
// Create the prepared statement using the connection
   $stmt = $db->prepare($sql);
   
// The next lines replace the placeholders in the SQL statement with the actual 
// values in the variables and tells the database the type of data it is
    $stmt->bindValue(':modname', $screenName, PDO::PARAM_STR);
    $stmt->bindValue(':modemail', $email, PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
   
// Insert the data
   $stmt->execute();
   
// Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   
// Close the database interaction
   $stmt->closeCursor();
   
// Return the indication of success (rows changed)
   return $rowsChanged;
}

function updatePassword($password, $userId) {
// Create a connection object using the connection function
   $db = herokuConnect();
   
// The SQL statement
   $sql = 'UPDATE users SET Password = :modpass  WHERE userId = :userId';
   
// Create the prepared statement using the connection
   $stmt = $db->prepare($sql);
   
// The next lines replace the placeholders in the SQL statement with the actual 
// values in the variables and tells the database the type of data it is
    $stmt->bindValue(':modpass', $password, PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
   
// Insert the data
   $stmt->execute();
   
// Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   
// Close the database interaction
   $stmt->closeCursor();
   
// Return the indication of success (rows changed)
   return $rowsChanged;
}