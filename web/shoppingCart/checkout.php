<?php
session_start();
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
        <title>Checkout| MME</title>
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
                    <h2>Shipping Address</h2>
                    <form method="post" action="confirmation.php">
                        <table id="address-table">
                            <tr>
                                <td><label>House Number and Street: </label></td>
                                <td><input type="text" name="street" placeholder="435 Barn Lane"></td>
                            </tr>
                            <tr>
                                <td><label>City: </label></td>
                                <td><input type="text" name="city" placeholder="Saint Louis"></td>
                            </tr>
                            <tr>
                                <td><label>State: </label></td>
                                <td><input type="text" name="state" placeholder="Missouri"></td>
                            </tr>
                            <tr>
                                <td><label>Zip: </label></td>
                                <td><input type="text" name="zip" placeholder="63376"></td>
                            </tr>
                        </table>
                        
                        <input type="hidden" name="checkout" value="yes">

                        <?php
                        if (count($_SESSION['cart']) >= 1) {
                            echo "<input type='submit' value='Confirm'>";
                        } else {
                            echo "<p>You cannot check out with an empty cart</p>";
                        }
                        ?>

                    </form>
                </section>
            </main>

            <footer>
            </footer>
        </div>
        <script src="script.js" type="text/javascript"></script>
    </body>
</html>
