<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title><?php echo $_SESSION["userData"]["screenname"]; ?>'s Home Page</title>
        <link href="style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <header>
            <h1>Welcome <?php echo $_SESSION["userData"]["screenname"]; ?></h1>
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
                        echo "$character[charactername], Lv. $character[characterlevel] $character[raceid] $character[classid]";
                        echo "</a></li>";
                    }
                    ?>
                </ul>
            </section>
	    </main>
    </body>

    <footer>
    </footer>
</html>
