/*------------------------------------------------------------------------------
 * 
 -----------------------------------------------------------------------------*/
var outputLevel = document.getElementById("display-level");
var outputRace = document.getElementById("display-race");
var outputClass = document.getElementById("display-class");
var outputBackground = document.getElementById("display-background");
var lockBtn = document.getElementById("lockBtn");

var inputLevel = document.getElementById("level");
var inputRace = document.getElementById("race");
var inputClass = document.getElementById("class");
var inputBackground = document.getElementById("background");

var race = "";
var charClass = "";
var level = 1;
var attsLocked = false;

var totalAtts = [0, 0, 0, 0, 0, 0];


var races = [
    "Mountain Dwarf",
    "Hill Dwarf",
    "High Elf",
    "Wood Elf",
    "Dark Elf",
    "Lightfoot Halfling",
    "Stout Halfling",
    "Human",
    "Dragonborn",
    "Forest Gnome",
    "Rock Gnome",
    "Half-elf",
    "Half-orc",
    "Tiefling"
];
var classes = [
    "Barbarian",
    "Bard",
    "Cleric",
    "Druid",
    "Fighter",
    "Monk",
    "Paladin",
    "Ranger",
    "Rogue",
    "Sorcerer",
    "Warlock",
    "Wizard"
];
var backgrounds = [
    "Acolyte",
    "Charlatan",
    "Criminal",
    "Entertainer",
    "Folk Hero",
    "Guild Artisan",
    "Hermit",
    "Noble",
    "Outlander",
    "Sage",
    "Sailor",
    "Soldier",
    "Urchin"
];
var raceBonus = {
    MountainDwarf: {
        con: "2",
        str: "1"
    },

    HillDwarf: {
        con: "2",
        wis: "1"
    },

    HighElf: {
        dex: "2",
        int: "1"
    },

    WoodElf: {
        dex: "2",
        wis: "1"
    },

    DarkElf: {
        dex: "2",
        cha: "1"
    },

    LightfootHalfling: {
        dex: "2",
        cha: "1"
    },

    StoutHalfling: {
        dex: "2",
        con: "1"
    },

    Human: {
        all: "1"
    },

    Dragonborn: {
        str: "2",
        cha: "1"
    },

    ForestGnome: {
        int: "2",
        dex: "1"
    },

    RockGnome: {
        int: "2",
        con: "1"
    },

    Halfelf: {
        cha: "2",
        any: "1",
        any: "1"
    },

    Halforc: {
        str: "2",
        con: "1"
    },

    Tiefling: {
        cha: "2",
        int: "1"
    }

};

var classAttPrefs = {
    Barbarian: {
        first: "0",
        second: "2"
    },
    Bard: {
        first: "5",
        second: "1"
    },
    Cleric: {
        first: "4",
        second: "2",
        otherSecond: "0"
    },
    Druid: {
        first: "4",
        second: "2"
    },
    Fighter: {
        first: "0",
        second: "2",
        otherSecond: "3",
        otherFirst: "1"
    },
    Monk: {
        first: "1",
        second: "4"
    },
    Paladin: {
        first: "0",
        second: "5"
    },
    Ranger: {
        first: "1",
        second: "4",
        otherFirst: "0"
    },
    Rogue: {
        first: "1",
        second: "3",
        otherSecond: "5"
    },
    Sorcerer: {
        first: "5",
        second: "2"
    },
    Warlock: {
        first: "5",
        second: "2"
    },
    Wizard: {
        first: "3",
        second: "1",
        otherSecond: "5"
    }
};

/*------------------------------------------------------------------------------
 * 
 -----------------------------------------------------------------------------*/
if (inputLevel !== null) {
    inputLevel.addEventListener("input", function () {
        outputLevel.innerHTML = "Lv. " + this.value;
        level = this.value;
        applyLevelUps(charClass, level);
    });
}
if (inputRace !== null) {
    inputRace.addEventListener("input", function () {
        outputRace.innerHTML = races[this.value];
        race = races[this.value];
        addRaceBonus(race);
        applyLevelUps(charClass, level);
    });
}
if (inputClass !== null) {
    inputClass.addEventListener("input", function () {
        outputClass.innerHTML = classes[this.value];
        charClass = classes[this.value];
        rollRandAttributes(charClass);
        applyLevelUps(charClass, level);
    });
}
if (inputBackground !== null) {
    inputBackground.addEventListener("input", function () {
        outputBackground.innerHTML = backgrounds[this.value];
    });
}
if (lockBtn !== null) {
    document.getElementById("lockBtn").addEventListener("click", function (event) {
        event.preventDefault();
    });
}

/*------------------------------------------------------------------------------
 * 
 -----------------------------------------------------------------------------*/
function loadCharacter(theLevel, theRace, theClass, str, dex, con, int, wis, cha) {
    outputLevel.innerHTML = "Lv. " + theLevel;
    outputRace.innerHTML = races[theRace - 1];
    outputClass.innerHTML = classes[theClass - 1];

    atts = [str, dex, con, int, wis, cha];
    applyToScreen(atts);
    lockAtts();
}

function confirmDelete(element, characterId) {
    var result = confirm("Do you really want to delete that character?");
    
    if(result === false) {
        return false;
    }
    else {
        element.href = "../characters/?action=deleteCharacter&characterId=" + characterId;
        return true;
    }
}
/*------------------------------------------------------------------------------
 * 
 -----------------------------------------------------------------------------*/
function rollRandAttributes(chosenClass) {

    //return of atts are locked
    if (attsLocked === true)
        return;

    // clear out the total atts array
    for (var i = 0; i < 6; i++)
        totalAtts[i] = 0;

    // continue on as normal
    var stats = [];

    // assign each rolled attribute to the stats array
    for (var i = 0; i < 6; i++)
        stats[i] = rollOneAtt();

    // create temp array
    var tempAtts = [0, 0, 0, 0, 0, 0];

    // assign largest value to most prefered stat for that class
    // then, zero out that value
    var index = indexOflargestInArray(stats);
    tempAtts[classAttPrefs[chosenClass].first] = stats[index];
    stats[index] = 0;

    // assign largest value to second prefered stat for that class
    // then, zero out that value
    index = indexOflargestInArray(stats);
    tempAtts[classAttPrefs[chosenClass].second] = stats[index];
    stats[index] = 0;

    // fill in the rest of the temp array
    for (var i = 0; i < 6; i++) {
        if (stats[i] !== 0) {
            for (var j = 0; j < 6; j++) {
                if (tempAtts[j] === 0) {
                    tempAtts[j] = stats[i];
                    stats[i] = 0;
                }
            }
        }
    }

    // copy back into the original stats array
    for (var i = 0; i < 6; i++) {
        stats[i] = tempAtts[i];
        totalAtts[i] = stats[i];
    }

    applyToScreen(stats);
}

function applyLevelUps(chosenClass, lvl) {
    // can't appropiately apply level ups without knowing what
    // class is being used
    if (chosenClass === "")
        return;

    var hp = 0;
    var conMod = Number(document.getElementById("conMod").innerText);

    // apply hit points
    if (chosenClass === "Barbarian") {
        hp = 12 + conMod + ((7 + conMod) * (lvl - 1));
    } else if (chosenClass === "Fighter" || chosenClass === "Paladin" || chosenClass === "Ranger") {
        hp = 10 + conMod + ((6 + conMod) * (lvl - 1));
    } else if (chosenClass === "Sorcerer" || chosenClass === "Wizard") {
        hp = 6 + conMod + ((4 + conMod) * (lvl - 1));
    } else {
        hp = 8 + conMod + ((5 + conMod) * (lvl - 1));
    }
    document.getElementById("hp").innerHTML = hp;
    document.getElementById("health").value = hp;

    /*
     var lvldAtts = [0,0,0,0,0,0];
     // apply ability score increases
     if(lvl >= 4) {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 6 && chosenClass === "Fighter") {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 8) {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 10 && chosenClass === "Rogue") {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 12) {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 14 && chosenClass === "Fighter") {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 16) {
     lvldAtts[rollOneDie()] += 2;
     }
     if(lvl >= 19) {
     lvldAtts[rollOneDie()] += 2;
     }
     
     for(var i = 0; i < 6; i++) {
     totalAtts[i] += lvldAtts[i];
     }
     */
}

function addRaceBonus(chosenRace) {
    chosenRace = removeSpaceAndDash(chosenRace);
    bonuses = raceBonus[chosenRace];

    var atts = [0, 0, 0, 0, 0, 0];
    var mods = [0, 0, 0, 0, 0, 0];

    if (bonuses.str !== undefined)
        atts[0] += Number(bonuses.str);

    if (bonuses.dex !== undefined)
        atts[1] += Number(bonuses.dex);

    if (bonuses.con !== undefined)
        atts[2] += Number(bonuses.con);

    if (bonuses.int !== undefined)
        atts[3] += Number(bonuses.int);

    if (bonuses.wis !== undefined)
        atts[4] += Number(bonuses.wis);

    if (bonuses.cha !== undefined)
        atts[5] += Number(bonuses.cha);

    for (var i = 0; i < 6; i++)
        atts[i] += totalAtts[i];

    applyToScreen(atts);
}

function indexOflargestInArray(theArray) {
    Array.max = function (theArray) {
        return Math.max.apply(Math, theArray);
    };

    var max = Array.max(theArray);
    var index = theArray.indexOf(max);

    return index;
}

function lockAtts() {
    if (attsLocked === true) {
        attsLocked = false;
        document.getElementById("lockBtn").style.border = "2px outset gold";
        document.getElementById("lockBtn").innerHTML = "Lock";
    } else {
        attsLocked = true;
        document.getElementById("lockBtn").style.border = "2px inset gold";
        document.getElementById("lockBtn").innerHTML = "Unlock";
    }
}

function removeSpaceAndDash(string) {
    var length = string.length;
    var newString = string;

    for (var i = 0; i < length; i++) {
        if (string[i] === ' ' || string[i] === '-') {
            newString = string.slice(0, i);
            newString += string.slice(i + 1);
        }
    }
    return newString;
}

function rollOneAtt() {
    var rolls = [];
    var total = 0;

    for (var i = 0; i < 4; i++) {
        rolls[i] = rollOneDie();
    }

    Array.min = function (rolls) {
        return Math.min.apply(Math, rolls);
    };

    var minimum = Array.min(rolls);
    var index = rolls.indexOf(minimum);
    rolls[index] = 0;

    for (var i = 0; i < 4; i++) {
        total += rolls[i];
    }

    return total;
}

function rollOneDie() {
    var min = Math.ceil(1);
    var max = Math.floor((6));
    var result = Math.floor(Math.random() * (max - min + 1)) + min; //The maximum is inclusive and the minimum is inclusive
    return result;
}

function applyToScreen(atts) {
    mods = [0, 0, 0, 0, 0, 0];

    document.getElementById("strScore").value = atts[0];
    document.getElementById("strDisplay").innerHTML = atts[0];
    mods[0] = Math.floor((atts[0] / 2) - 5);
    document.getElementById("strMod").innerHTML = mods[0];

    document.getElementById("dexScore").value = atts[1];
    document.getElementById("dexDisplay").innerHTML = atts[1];
    mods[1] = Math.floor((atts[1] / 2) - 5);
    document.getElementById("dexMod").innerHTML = mods[1];

    document.getElementById("conScore").value = atts[2];
    document.getElementById("conDisplay").innerHTML = atts[2];
    mods[2] = Math.floor((atts[2] / 2) - 5);
    document.getElementById("conMod").innerHTML = mods[2];

    document.getElementById("intScore").value = atts[3];
    document.getElementById("intDisplay").innerHTML = atts[3];
    mods[3] = Math.floor((atts[3] / 2) - 5);
    document.getElementById("intMod").innerHTML = mods[3];

    document.getElementById("wisScore").value = atts[4];
    document.getElementById("wisDisplay").innerHTML = atts[4];
    mods[4] = Math.floor((atts[4] / 2) - 5);
    document.getElementById("wisMod").innerHTML = mods[4];

    document.getElementById("chaScore").value = atts[5];
    document.getElementById("chaDisplay").innerHTML = atts[5];
    mods[5] = Math.floor((atts[5] / 2) - 5);
    document.getElementById("chaMod").innerHTML = mods[5];
}

function resetAll() {
    outputLevel;
    outputRace;
    outputClass;
    outputBackground;
}