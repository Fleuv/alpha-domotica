<div class="block">
    <h1>Inloggen</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>
            <input type="text" name="username" placeholder="Gebruikersnaam" />
        </p>
        <p>
            <input type="password" name="password" placeholder="Wachtwoord" />
        </p>
        <p>
            <button type="reset">reset</button>
            <button name="login" type="submit">login</button>
        </p>
    </form>
</div>