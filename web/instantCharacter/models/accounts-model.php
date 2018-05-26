<?php

// Get client data based on a screenName
function getUser($screenName) {
    
    // Create a connection object using the acme connection function
    $db = localConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT userId, ScreenName, Email, Password '
            . ' FROM Users WHERE ScreenName = :ScreenName';
        
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

