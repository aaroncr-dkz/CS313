<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title>Edit Account</title>
        <link href="../style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <header>
            <h1>Edit Account</h1>
        </header>

        <nav>

        </nav>

        <main>
            <section id="form-box">
                <h2 class="display-none"></h2>
                
                <?php if (isset($message)) {echo $message;} ?>

                <form method="post" action="?action=edit-account">
                    <label>Username:</label>
                    <input type="text" name="screenName" 
                        <?php echo "value='" . $_SESSION["userData"]["ScreenName"] . "'" ?> required>
                    
                    <label>Email:</label>
                    <input type="text" name="email" 
                        <?php echo "value='" . $_SESSION["userData"]["Email"] . "'" ?> required>
                    
                    <input type="submit" value="Update Account">
                    
                </form>
                
                <form method="post" action="?action=edit-password">
                    <label>Password:</label>
                    <input type="password" name="password" required>

                    <input type="submit" value="Update Password">
                </form>
            </section>
        </main>
    </body>

    <footer>
    </footer>
</html>
