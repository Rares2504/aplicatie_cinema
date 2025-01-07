<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/aplicatie_cinema/app/views/buy/CSS/buy.css">

    <title>Document</title>
</head>
<body>
    <h1>Cumpara bilete </h1>
    <form method="GET" action="index.php">
        <label for="search">Selecteaza un film</label>
        <select name="search" id="search">
        <option value="">Toate filmele</option>
            <?php
            // Obține toate titlurile filmelor disponibile
            $movies = Buy::getFutureScreenings();
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
            <th></th>
            <th></th>
            <th></th>
            <th></th> 
        </tr>
        <form method="POST" action="selectPlace.php">  
        <?php 
            foreach ($screenings as $screening) {
        ?>
            <tr>
                <td width="100">
                <img src="../movies/displayImage.php?id= <?php echo $screening["film_id"]?>" width="100">
                </td>
                <td valign="top" width="200"><?= $screening["film_titlu"] ?>
                <p>
                <?= $screening["film_descriere"] ?>
                </td>
                <td width="200" valign="top">
                    <?= $screening["proiectie_data"] ?> <select name="pro_id" id="pro_id" valign="top">
                    <?php
                    $proiectii = explode(",", $screening["ore_difuzare"]);
                    foreach ($proiectii as $proiectie) {
                        $detalii = explode("-", $proiectie);
                        ?>
                        <option value="<?=$detalii[1]?>"><?=$detalii[0]?></option>
                        <?php } ?>
                    </select>
                </td>
                <td align = right valign="top">
                    <button>Cumpara</button>
                                   
                </td>
            </tr>  
            <?php } ?>
</body>
</html>