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
            <?php 
               if (!isset($_SESSION['userData'])) {
                   echo "<a href='accounts/?action=login'>Login</a>";
               }
               else {
                   echo "<a href='accounts/?action=login'>Go to Character Select</a>";
               }
            ?>
        </nav>

        <main>
            <section>
                <h2></h2>

                <form method="post" action="characters/?action=saveCharacter">
                    <label>Character Name: </label>
                    <input type="text" placeholder="Character Name" name="name" required 
                        <?php if (isset($character)) {echo "value='$character[CharacterName]'";} ?> 
                           />

                    <table>
                        <tr>
                            <td>Level:</td>
                            <td>
                                <input type="range" min="1" max="20" name="level" class="slider" id="level" 
                            <?php if (isset($character)) {echo "value='$character[CharacterLevel]'";} else {echo "value='1'";}?> 
                                />
                            </td>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Any</td>
                        </tr>

                        <tr>
                            <td>Race:</td>
                            <td>
                                <input type="range" min="0" max="13" name="race" class="slider" id="race" 
                                    <?php if (isset($character)) {echo "value='" . ($character['RaceId'] - 1) . "'";}?> 
                                />
                            </td>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Any</td>
                        </tr>

                        <tr>
                            <td>Class:</td>
                            <td>
                                <input type="range" min="0" max="11" name="class" class="slider" id="class" 
                                    <?php if (isset($character)) {echo "value='" . ($character['ClassId'] - 1) . "'";}?> 
                                />
                            </td>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Any</td>
                        </tr>

                        <tr>
                            <td>Background:</td>
                            <td>
                                <input type="range" min="0" max="12" class="slider" id="background">
                            </td>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Any</td>
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
                                    <td id="strDisplay"></td>
                                    <td id="strMod"></td>
                                </tr>

                                <tr>
                                    <td>Dexterity</td>
                                    <td id="dexDisplay"></td>
                                    <td id="dexMod"></td>
                                </tr>

                                <tr>
                                    <td>Constitution</td>
                                    <td id="conDisplay"></td>
                                    <td id="conMod"></td>
                                </tr>

                                <tr>
                                    <td>Intelligence</td>
                                    <td id="intDisplay"></td>
                                    <td id="intMod"></td>
                                </tr>

                                <tr>
                                    <td>Wisdom</td>
                                    <td id="wisDisplay"></td>
                                    <td id="wisMod"></td>
                                </tr>

                                <tr>
                                    <td>Charisma</td>
                                    <td id="chaDisplay"></td>
                                    <td id="chaMod"></td>
                                </tr>
                            </table>
                            
                            <input type="hidden" name="str" id="strScore" value="">
                            <input type="hidden" name="dex" id="dexScore" value="">
                            <input type="hidden" name="con" id="conScore" value="">
                            <input type="hidden" name="int" id="intScore" value="">
                            <input type="hidden" name="wis" id="wisScore" value="">
                            <input type="hidden" name="cha" id="chaScore" value="">
                            <input type="hidden" name="health" id="health" value="">
                            <?php if(isset($_SESSION["character"])) {
                                echo "<input type='hidden' name='characterId' value='" . $character["CharacterId"] . "'>";
                            }
                            ?>
                            
                            <ul>
                                <li>Hit Points: <span id="hp">
                                    <?php if (isset($character)) {echo $character['CharacterHealth'];}?>
                                                </span>
                                </li>
                            </ul>
                        </div>
                
                       <button id="lockBtn" class="btn-transition" onclick="lockAtts()">Lock</button>
                       <!--<button id="resetBtn" class="btn-transition">Reset All</button>-->
                    </section>
                <?php if(isset($_SESSION["userData"]) && !isset($_SESSION['character'])) {
                    echo "<input type='submit' id='submitBtn' value='Save'>";
                    echo "<input type='hidden' name='action' value='saveCharacter'>";
                } 
                elseif(isset($_SESSION["userData"]) && isset($_SESSION['character'])) {
                    echo "<input type='submit' id='updateBtn' value='Update'>";
                    echo "<input type='hidden' name='action' value='updateCharacter'>";
                } 
                else {
                    echo "<p>You must log in in order to save characters</p>";
                } ?>
            </form>
        </section>
    </main>

    <footer>
    </footer>
        
    <script src="script.js" type="text/javascript"></script>
</body>


</html>
