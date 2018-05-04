<!DOCTYPE html>
<html>
    <head>
        <title>Test it, It's Amazing</title>
    </head>

    <body>
        <?php
           for($i = 1; $i <= 10; $i++)
           {
               if($i % 2 == 0)
               {
                   echo "<div style='color: red' id='div$i'>Hello</div>";
               }
               else
               {
                   echo "<div id='div$i'>Hello</div>";
               }
           }

           if(isset($_GET["username"]))
           {
               $user = $_GET["username"];
               echo "Welcome $user";
           }
           else
           {
               echo "You are not logged in, sorrry.";
           }
        ?>
    </body>
</html>

