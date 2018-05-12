itemDescrips = [
    "This potion's red liquid glimmers when agitated. Drink to speed up the body's natural healing mechanisms.",
    "This potion's rose-hued, effervescent liquid contains one easy-to-miss bubble shaped like a heart. The first person you see within 10 minutes after drinking this philter, you become infatiuated with for 1 hour.",
    "The dust turns a cube of water 15 feet on a side into one marble-sized pellet. You can smash the pellet against a hard surface, causing the pellet to shatter and release the water the dust absorbed. Doing so ends that pellet's magic.",
    "When you drink this potion, it cures any disease afflicting you. The clear red liquid has tiny bubbles of light in it.",
    "These pigments allow you to create three-dimensional objects by painting them in two dimensions. The paint flows from the brush to form the desired object as you concentrate on its image.",
    "This viscous, milky-white substance can form a permanent adhesive bond between any two objects. The glue takes 1 minute to set. Once it has done so, the bond it creates can be broken only by the application of Universal Solvent"
];

function addToCart(item, price) {
    var httpRequest = new XMLHttpRequest();
    httpRequest.open("GET", "cart.php?action=add&item=" + item + "&price=" + price, true);
    httpRequest.send();
}

function removeFromCart(index, price) {
    document.getElementById(index).style.display = "none";
    
    var total = document.getElementById("orderTotal").innerText;
    total -= price;
    document.getElementById("orderTotal").innerHTML = total;
    
    var httpRequest = new XMLHttpRequest();
    httpRequest.open("GET", "cart.php?action=remove&item=" + index, true);
    httpRequest.send();
}

function itemDetails(index) {
    document.getElementById("item-details").innerHTML = itemDescrips[index];
}

function removeDetails() {
    document.getElementById("item-details").innerHTML = "";
}


