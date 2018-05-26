<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title><?php echo $_SESSION["userData"]["ScreenName"]; ?>'s Home Page</title>
        <link href="style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <header>
            <h1>Welcome <?php echo $_SESSION["userData"]["ScreenName"]; ?></h1>
        </header>

        <nav>

        </nav>

        <main id="container">
            <section>
                <h2>Your Characters</h2>
                <ul>
                    <?php
                    foreach ($characters as $character) {
                        echo "<li>";
                        echo "<a href='index.php?action=loadCharacter&characterId=$character[CharacterId]'>";
                        echo "$character[CharacterName], Lv. $character[CharacterLevel] $character[RaceId] $character[ClassId]";
                        echo "</a></li>";
                    }
                    ?>
                </ul>
            </section>
    </body>

    <footer>
    </footer>
</html>
