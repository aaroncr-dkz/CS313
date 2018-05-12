<?php
session_start();

$checkout = htmlspecialchars($_POST['checkout']);

if($checkout != "yes") {
    header("Location: home.php");
}

$street = htmlspecialchars($_POST['street']);
$city = htmlspecialchars($_POST['city']);
$state = htmlspecialchars($_POST['state']);
$zip = htmlspecialchars($_POST['zip']);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title>Confirmation | MME</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="container">
            <header>
                <h1>Meldanen's Mystic Emporium</h1>
            </header>

            <nav></nav>

            <main>
                <section>
                    <h2>Thank You for Your Purchase</h2>
                    <p>Ship to: <?php echo $street . ", " . $city . ", " . $state . ", " . $zip; ?></p>
                    <p>The Following: </p>
                    <ul>
                        <?php
                        foreach ($_SESSION['cart'] as $item) {
                            echo "<li>$item</li>";
                        }
                        $_SESSION['cart'] = array();
                        $_SESSION['price'] = array();
                        ?>
                    </ul>
                </section>
            </main>

            <footer>
            </footer>
        </div>
        <script src="script.js" type="text/javascript"></script>
    </body>
</html>
