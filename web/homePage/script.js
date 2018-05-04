var crossroadDeals = [
    "$5 Chef's Point meal",
    "$4 Raisu bowls",
    "BOGO pasta bowls at Pasta Primo",
    "$2 silver breakfast burrito",
    "$1 Fresh baked demi loaves",
    "$1 Small gelato while supplies last",
    "$3 Calzones while they last",
    "$5 Quesadilla with french fries",
    "$0.99 Cheesecake day"
];

var dealImages = [
    "",
    "",
    "",
    "breakfast_burrito.png",
    "",
    "",
    "",
    "",
    ""
];

function displayDeal(day) {
    var deal = crossroadDeals[day];
    var path = dealImages[day];
    document.getElementById("deal-text").innerHTML = deal;
    document.getElementById("deal-pic").src = path;
}

function removeDeal() {
    document.getElementById("deal-text").innerHTML = "";
    document.getElementById("deal-pic").src = "";
}
