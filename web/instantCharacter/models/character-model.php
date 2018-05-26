<?php

// get all characters associated with a particular user
function getCharacters($userId) {
    
    // Create a connection object using the acme connection function
    $db = localConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT CharacterId, CharacterName, CharacterLevel, RaceId, ClassId'
            . ' FROM Characters WHERE UserId = :userId';
        
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
        
    $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    // Close the database interaction
    $stmt->closeCursor();
        
    // Return the result
    return $characters;  
}

//get one character based on id
function getCharacter($characterId) {
    
    // Create a connection object using the acme connection function
    $db = localConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT CharacterName, CharacterStrength, CharacterDexterity, CharacterConstitution, CharacterIntelligence, '
            . ' CharacterWisdom, CharacterCharisma, CharacterLevel, CharacterHealth, RaceId, ClassId'
            . ' FROM Characters WHERE CharacterId = :characterId';
        
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
        
    $stmt->bindValue(':characterId', $characterId, PDO::PARAM_INT);
    $stmt->execute();
    $characterData = $stmt->fetch(PDO::FETCH_ASSOC);
        
    // Close the database interaction
    $stmt->closeCursor();
        
    // Return the result
    return $characterData;  
}