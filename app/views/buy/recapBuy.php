<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/aplicatie_cinema/app/views/buy/CSS/recapBuy.css">
    <title>Bilete achizitionate</title>
</head>
<body>
    <p>
        <table width="600px" align=center>
            <tr>
                <td width="70%"><?= $message ?></td>
                <td width="30%"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><button onclick="window.print()">Printează biletele</button></td>
                <td align="right"><a href="index.php">Inapoi la proiectii</a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
        </table>
</body>
</html>