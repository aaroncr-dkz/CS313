<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width">
    <title>Login</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <header>
        <h1>Login</h1>
    </header>

    <nav>
        
    </nav>

    <main>
        <section>
            <h2></h2>
            
            <?php if(isset($message)) {echo $message;}  ?>
            
            <form method="post" action="index.php?action=Login">
                <label>Username:</label>
                <input type="text" name="screenName" required>
                
                <label>Password</label>
                <input type="password" name="password" required>
                
                <input type="submit" value="Login">
            </form>
        </section>
    </body>
    
    <footer>
    </footer>
</html>
