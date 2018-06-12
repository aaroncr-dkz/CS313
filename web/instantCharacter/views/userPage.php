<?php
   if(isset($_SESSION["character"])) {
       unset($_SESSION["character"]);
   }
?>

<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title><?php echo $_SESSION["userData"]["screenname"]; ?>'s Home Page</title>
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <script src="../script.js" type="text/javascript"></script>
    </head>

    <body>
        <header>
            <h1>Welcome <?php echo $_SESSION["userData"]["screenname"]; ?></h1>
        </header>

        <nav>

        </nav>

        <main id="character-display">
            <?php if(isset($_SESSION["message"])) {echo $_SESSION["message"]; session_unset($_SESSION["message"]); } ?>
            <a href="?action=logout">Logout</a>
            
            <section>
                <h2>Your Profile</h2>
                <ul>
                    <li>Username: <?php echo $_SESSION["userData"]["screenname"] ?></li>
                    <li>Email: <?php echo $_SESSION["userData"]["email"] ?></li>
                </ul>
                <a class="anchor-no-visited" href="?action=update-account">Edit Account</a> 
            </section>
            
            <section>
                <h2>Your Characters</h2>
                <ul>
                    <?php foreach ($characters as $character) {
                        echo "<li>";
                        echo "<a class='anchor-no-visited' onclick='return confirmDelete(this, $character[characterid])' "
                           . "href='#'>Delete</a> ";
                        echo "<a class='anchor-no-visited anchor-no-underline' "
                           . "href='../characters/?action=loadCharacter&characterId=$character[characterid]'>";
                        echo "$character[charactername], Lv. $character[characterlevel] "
                           . "$character[racename] $character[classname]";
                        echo "</a></li>";
                    } ?>
                </ul>
                <a  class="anchor-no-visited" href="../instantCharacter.php">Create a New Character</a>
            </section>
        </main>
        
        <footer>
        </footer>
        
    </body>

</html>
