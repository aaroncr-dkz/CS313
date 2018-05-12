<?php

session_start();

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['price'] = array();
}

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width">
    <title>Browse Items | MME</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <header>
            <h1>Meldanen's Mystic Emporium</h1>
            <a href="viewCart.php">View Cart</a>
        </header>

        <nav></nav>

        <main>
            <p></p>

            <section>
                <h2>Inventory</h2>
                
                <div id="item-details">
                    
                </div>
                
                <table>
                    <tr>
                        <td><button onclick="addToCart('Potion of Healing', 50)">Add to Cart</button></td>
                        <td onmouseenter="itemDetails(0)" onmouseout="removeDetails()">Potion of Healing</td>
                        <td>50 Gold Pieces per vial</td>
                    </tr>
                    <tr>
                        <td><button onclick="addToCart('Philter of Love', 90)">Add to Cart</button></td>
                        <td onmouseenter="itemDetails(1)" onmouseout="removeDetails()">Philter of Love</td>
                        <td>90 Gold Pieces per vial</td>
                    </tr>
                    <tr>
                        <td><button onclick="addToCart('Dust of Dryness', 120)">Add to Cart</button></td>
                        <td onmouseenter="itemDetails(2)" onmouseout="removeDetails()">Dust of Dryness</td>
                        <td>120 Gold Pieces per pinch</td>
                    </tr>
                    <tr>
                        <td><button onclick="addToCart('Elixir of Health', 120)">Add to Cart</button></td>
                        <td onmouseenter="itemDetails(3)" onmouseout="removeDetails()">Elixir of Health</td>
                        <td>120 Gold Pieces per vial</td>
                    </tr>
                    <tr>
                        <td><button onclick="addToCart('Marvelous Pigments', 200)">Add to Cart</button></td>
                        <td onmouseenter="itemDetails(4)" onmouseout="removeDetails()">Marvelous Pigments</td>
                        <td>200 Gold Pieces per box</td>
                    </tr>
                    <tr>
                        <td><button onclick="addToCart('Sovereign Glue', 400)">Add to Cart</button></td>
                        <td onmouseenter="itemDetails(5)" onmouseout="removeDetails()">Sovereign Glue</td>
                        <td>400 Gold Pieces per vial</td>
                    </tr>
                </table>
            </section>
        </main>

        <footer>
        </footer>
    </div>
    <script src="script.js" type="text/javascript"></script>
</body>

</html>
