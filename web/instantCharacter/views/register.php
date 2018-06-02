<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title>Register</title>
        <link href="../style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <header>
            <h1>Register</h1>
        </header>

        <nav>

        </nav>

        <main>
            <section id="form-box">
                <h2 class="display-none"></h2>

                <?php if (isset($message)) {echo $message;} ?>

                <a href='?action=login'>Back to Login</a>
                <form method="post" action="?action=register">
                    <label>Username:</label>
                    <input type="text" name="screenName" required>
					
					<label>Email:</label>
                    <input type="text" name="screenName" required>

                    <label>Password</label>
                    <input type="password" name="password" required>

                    <input type="submit" value="Register">
                </form>
            </section>
        </main>
    </body>

    <footer>
    </footer>
</html>
