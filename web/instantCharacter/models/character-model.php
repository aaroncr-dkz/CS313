<?php

// get all characters associated with a particular user
function getCharacters($userId) {
    
    // Create a connection object using the connection
    $db = localConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT CharacterId, CharacterName, CharacterLevel, r.RaceName, cl.ClassName'
            . ' FROM Characters c INNER JOIN Races r ON c.RaceId = r.RaceId INNER JOIN Classes cl'
            . ' ON c.ClassId = cl.ClassId WHERE UserId = :userId';
        
    // Create the prepared statement using the connection
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
    
    // Create a connection object using the connection
    $db = localConnect();
        
    // The SQL statement to be used with the database
    $sql = 'SELECT CharacterId, CharacterName, CharacterStrength, CharacterDexterity, CharacterConstitution, CharacterIntelligence, '
            . ' CharacterWisdom, CharacterCharisma, CharacterLevel, CharacterHealth, RaceId, ClassId'
            . ' FROM Characters WHERE CharacterId = :characterId';
        
    // Create the prepared statement using the connection
    $stmt = $db->prepare($sql);
        
    $stmt->bindValue(':characterId', $characterId, PDO::PARAM_INT);
    $stmt->execute();
    $characterData = $stmt->fetch(PDO::FETCH_ASSOC);
        
    // Close the database interaction
    $stmt->closeCursor();
        
    // Return the result
    return $characterData;  
}

function saveCharacter($userId, $name, $race, $class, $str, $dex, $con, $int, $wis, $cha, $level, $hp) {
    // Create a connection object using the connection
    $db = localConnect();
   
    // The SQL statement
    $sql = 'INSERT INTO characters (userId, characterName, characterStrength, characterDexterity, 
                                    characterConstitution, characterIntelligence, characterWisdom,
                                    characterCharisma, characterLevel, characterHealth, raceId, classId)
            VALUES (:id, :name, :str, :dex, :con, :int, :wis, :cha, :lvl, :hp, :race, :class)';
   
    // Create the prepared statement using the connection
    $stmt = $db->prepare($sql);
   
// The next lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':race', $race, PDO::PARAM_INT);
    $stmt->bindValue(':class', $class, PDO::PARAM_INT);
    $stmt->bindValue(':str', $str, PDO::PARAM_INT);
    $stmt->bindValue(':dex', $dex, PDO::PARAM_INT);
    $stmt->bindValue(':con', $con, PDO::PARAM_INT);
    $stmt->bindValue(':int', $int, PDO::PARAM_INT);
    $stmt->bindValue(':wis', $wis, PDO::PARAM_INT);
    $stmt->bindValue(':cha', $cha, PDO::PARAM_INT);
    $stmt->bindValue(':lvl', $level, PDO::PARAM_INT);
    $stmt->bindValue(':hp', $hp, PDO::PARAM_INT);
       
    // Insert the data
    $stmt->execute();
   
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
   
    // Close the database interaction
    $stmt->closeCursor();
   
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function updateCharacter($userId, $characterId, $name, $race, $class, $str, $dex, $con, $int, $wis, $cha, $level, $hp) {
    // Create a connection object using the connection
    $db = localConnect();
   
    // The SQL statement
    $sql = 'UPDATE characters SET userId = :userId, characterName = :name, characterStrength = :str, characterDexterity = :dex, 
                                  characterConstitution = :con, characterIntelligence = :int, characterWisdom = :wis,
                                  characterCharisma = :cha, characterLevel = :lvl, characterHealth = :hp, raceId = :race, 
                                  classId = :class WHERE characterId = :charId';
   
    // Create the prepared statement using the connection
    $stmt = $db->prepare($sql);
   
// The next lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':charId', $characterId, PDO::PARAM_INT);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':race', $race, PDO::PARAM_INT);
    $stmt->bindValue(':class', $class, PDO::PARAM_INT);
    $stmt->bindValue(':str', $str, PDO::PARAM_INT);
    $stmt->bindValue(':dex', $dex, PDO::PARAM_INT);
    $stmt->bindValue(':con', $con, PDO::PARAM_INT);
    $stmt->bindValue(':int', $int, PDO::PARAM_INT);
    $stmt->bindValue(':wis', $wis, PDO::PARAM_INT);
    $stmt->bindValue(':cha', $cha, PDO::PARAM_INT);
    $stmt->bindValue(':lvl', $level, PDO::PARAM_INT);
    $stmt->bindValue(':hp', $hp, PDO::PARAM_INT);
       
    // Insert the data
    $stmt->execute();
   
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
   
    // Close the database interaction
    $stmt->closeCursor();
   
    // Return the indication of success (rows changed)
    return $rowsChanged;
}