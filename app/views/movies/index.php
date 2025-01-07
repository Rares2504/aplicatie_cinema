<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/aplicatie_cinema/app/views/movies/CSS/movies.css">
    <title>Movies</title>
</head>
<body>
    <h1>Administrare Filme</h1>
    <?php if (!isset($_SESSION["request_user"]) || ($_SESSION["request_user"]["rol_id"] != 1)){
    header("Location: /aplicatie_cinema/admin");
    }?>
    <table>
        <tr>
            <td colspan=7 align=right>
                <button onclick="window.location.href='createMovie.php'">Adauga</button>
            </td>
        </tr> 
        <tr>
            <th>Titlu</th>
            <th>Gen</th>
            <th>Durata</th>
            <th>Limba</th>
            <th>Rating</th>
            <th>Descriere</th>
            <th>Imagine</th>
            <th></th>
        </tr>  
        <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?= $movie["titlu"] ?></td>
                <td><?= $movie["gen"] ?></td>
                <td><?= $movie["durata"] ?></td>
                <td><?= $movie["limba"] ?></td>
                <td><?= $movie["rating"] ?></td>
                <td><?= $movie["descriere"] ?></td>
                <td>
                    <img src="displayImage.php?id=<?php echo $movie["fil_id"]?>" width="100">
                 </td>
                <td align=right>
                    <button onclick="window.location.href='editMovie.php?fil_id=<?= $movie['fil_id'] ?>'">Modifica</button>
                    <button onclick="window.location.href='deleteMovie.php?fil_id=<?= $movie['fil_id'] ?>'">Sterge</button>
                    <!-- cum este apelat deleteMovie? -->
                    </form>                    
                </td>
            </tr>  
        
        <?php endforeach; ?>
        <tr><td colspan=8 align="right"><P><a href="../admin">Inapoi la Administrare</a></P></td></tr>
    </table>
</body>
</html>
<!-- --------------------------------- -->