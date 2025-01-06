<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/aplicatie_cinema/app/views/screenings/CSS/style.css">
    <title>Screening</title>
</head>
<body>
<h1>Administrare proiectii</h1>

    <form method="GET" action="index.php">
        <label for="search">Selecteaza un film:</label>
        <select name="search" id="search">
            <option value="">Toate filmele</option>
            <?php
            // Obține toate titlurile filmelor disponibile
            $movies = Screening::getAllScreenings();
            $uniqueTitles = array_unique(array_column($movies, 'film_titlu'));
            foreach ($uniqueTitles as $title) {
                $selected = (isset($_GET['search']) && $_GET['search'] == $title) ? 'selected' : '';
                echo "<option value=\"$title\" $selected>$title</option>";
            }
            ?>
        </select>
        <button type="submit">Cauta</button>
    </form>


    <table>
        <tr>
            <td colspan=7 align=right>
                <button onclick="window.location.href='createScreening.php'">Adauga</button>
            </td>
        </tr> 
        <tr>
            <th>Titlu</th>
            <th>Data</th>
            <th>Ora</th>
            <th>Sala</th> 
            <th></th>
        </tr>  
        <?php 
            foreach ($screenings as $screening):
        ?>
            <tr>

                <td><?= $screening["film_titlu"] ?></td>
                <td><?= $screening["proiectie_data"] ?></td>
                <td><?= substr($screening["proiectie_ora"],0,5) ?></td>
                <td><?= $screening["sala_nume"] ?></td>
                <td align = right>
                    <button onclick="window.location.href='deleteScreening.php?pro_id=<?= $screening['pro_id'] ?>'">Sterge</button>
                    </form>                    
                </td>
            </tr>  
        <?php endforeach; ?>
        <tr><td colspan=5 align="right"><P><a href="../admin">Inapoi la Administrare</a></P></td></tr>
    </table>
</body>
</html>