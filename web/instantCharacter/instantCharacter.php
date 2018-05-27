<?php
session_start();

if (isset($_SESSION['character'])) {
    $character = $_SESSION['character'];

    $str = $character['CharacterStrength'];
    $dex = $character['CharacterDexterity'];
    $con = $character['CharacterConstitution'];
    $int = $character['CharacterIntelligence'];
    $wis = $character['CharacterWisdom'];
    $cha = $character['CharacterCharisma'];
}

session_destroy();
?>

<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title>Insta Character</title>
        <link href="style.css" rel="stylesheet" type="text/css" />

    </head>

    <body <?php if (isset($character)) {
    echo "onload='loadCharacter($character[CharacterLevel], $character[RaceId], $character[ClassId], $str, $dex, $con, $int, $wis, $cha)'";
} ?>>
        <header>
            <h1>Instant Character Generator</h1>
        </header>

        <nav>
            <a href="index.php?action=login">Login</a>
        </nav>

        <main>
            <section>
                <h2></h2>

                <!--<form>-->
                    <label>Character Name: </label>
                    <input type="text" placeholder="Character Name" required 
                        <?php if (isset($character)) {echo "value='$character[CharacterName]'";} ?> 
                           />

                    <table>
                        <tr>
                            <td>Level:</td>
                            <td>
                                <input type="range" min="1" max="20" class="slider" id="level" 
                            <?php if (isset($character)) {echo "value='$character[CharacterLevel]'";} else {echo "value='1'";}?> 
                                />
                            </td>
                            <td>
                                <input type="checkbox"> Any
                            </td>
                        </tr>

                        <tr>
                            <td>Race:</td>
                            <td>
                                <input type="range" min="0" max="13" class="slider" id="race" 
                                    <?php if (isset($character)) {echo "value='" . ($character['RaceId'] - 1) . "'";}?> 
                                />
                            </td>
                            <td>
                                <input type="checkbox"> Any
                            </td>
                        </tr>

                        <tr>
                            <td>Class:</td>
                            <td>
                                <input type="range" min="0" max="11" class="slider" id="class" 
                                    <?php if (isset($character)) {echo "value='" . ($character['ClassId'] - 1) . "'";}?> 
                                />
                            </td>
                            <td>
                                <input type="checkbox"> Any
                            </td>
                        </tr>

                        <tr>
                            <td>Background:</td>
                            <td>
                                <input type="range" min="0" max="12" class="slider" id="background">
                            </td>
                            <td>
                                <input type="checkbox"> Any
                            </td>
                        </tr>
                    </table>

                    <div class="slider-display">
                        <p>
                            <span id="display-level">Lv. 1</span>
                            <span id="display-race">?????</span>
                            <span id="display-class">?????</span>
                            <span id="display-background">?????</span>
                        </p>


                    </div>

                    <section>
                        <h2>Statistics</h2>

                        <div id="statisticals">
                            <table id="attributes">
                                <tr>
                                    <td>Strength</td>
                                    <td id="strScore"></td>
                                    <td id="strMod"></td>
                                </tr>

                                <tr>
                                    <td>Dexterity</td>
                                    <td id="dexScore"></td>
                                    <td id="dexMod"></td>
                                </tr>

                                <tr>
                                    <td>Constitution</td>
                                    <td id="conScore"></td>
                                    <td id="conMod"></td>
                                </tr>

                                <tr>
                                    <td>Intelligence</td>
                                    <td id="intScore"></td>
                                    <td id="intMod"></td>
                                </tr>

                                <tr>
                                    <td>Wisdom</td>
                                    <td id="wisScore"></td>
                                    <td id="wisMod"></td>
                                </tr>

                                <tr>
                                    <td>Charisma</td>
                                    <td id="chaScore"></td>
                                    <td id="chaMod"></td>
                                </tr>
                            </table>
                            <ul>
                                <li>Hit Points: <span id="hp">
                                    <?php if (isset($character)) {echo $character['CharacterHealth'];}?>
                                                </span>
                                </li>
                            </ul>
                        </div>

                        
                <!--<input type="submit" value="Submit">-->
                <!--</form>-->
                <button id="lockBtn" class="btn-transition" onclick="lockAtts()">Lock</button>
                <button id="resetBtn" class="btn-transition">Reset All</button>
            </section>

        </section>
    </main>

    <footer>
    </footer>
</body>
<script src="script.js" type="text/javascript"></script>

</html>
