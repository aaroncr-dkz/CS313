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
        <title><?php echo $_SESSION["userData"]["ScreenName"]; ?>'s Home Page</title>
        <link href="../style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <header>
            <h1>Welcome <?php echo $_SESSION["userData"]["ScreenName"]; ?></h1>
        </header>

        <nav>

        </nav>

        <main id="character-display">
            <section>
                <h2></h2>
                <a href="?action=logout">Logout</a>
            </section>
            
            <section>
                <h2>Your Characters</h2>
                <ul>
                    <?php foreach ($characters as $character) {
                        echo "<li>";
                        echo "<a class='anchor-no-visited anchor-no-underline' "
                           . "href='../characters/?action=loadCharacter&characterId=$character[CharacterId]'>";
                        echo "$character[CharacterName], Lv. $character[CharacterLevel] "
                           . "$character[RaceName] $character[ClassName]";
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
