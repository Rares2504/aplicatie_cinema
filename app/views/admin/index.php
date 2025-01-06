<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrare cinema</title>
</head>
<body>
    <P>
        <?php
            if (isset($message)) {
                echo $message;
            } 
        ?>
    </P>
    <?php if (isset($_SESSION["request_user"])): ?>
        <h1>Welcome <?= $_SESSION["request_user"]["nume"] ?><?= $_SESSION["request_user"]["prenume"] ?> <form method="post" action="logoutAdmin.php"><button type="submit">Logout</button></form></h1>
        
        <P><a href="movies/index.php">Administrare filme</a></P>
        <P><a href="screenings/index.php">Administrare proiectii</a></P>
    <?php else: ?>
        <form method="post" action="loginAdmin.php">
        <h1>Login administrator</h1>
        <? echo $_SESSION["login_error"] ?>
        
        <table>
            <tr>
                <td>Email</td><td><input type="text" name="email" id="email" require></td>
            </tr>
            <tr>
                <td>Parola</td><td><input type="password" name="parola" id="parola" require></td>
            </tr>
            <tr>
                <td><button type="submit">Login</button></td>
            </tr>
        </table>
        </form>
    <?php endif; ?>
</body>
</html>