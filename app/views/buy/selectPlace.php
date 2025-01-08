<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/aplicatie_cinema/app/views/buy/CSS/selectPlace.css">
    <title>Document</title>
    <script>
        // Definirea unei funcții JavaScript
        function changePlace(element) {
            places = document.querySelector('[name="places"]');
            //alert(element.getAttribute("place"));
            if (element.getAttribute("sel")=="0") {
                element.style.backgroundColor = "blue";
                element.setAttribute("sel", "1");
                places.value = places.value + element.getAttribute("place") + ",";
            } else {
                element.style.backgroundColor = "green";
                element.setAttribute("sel", "0");
                places.value = places.value.replace((element.getAttribute("place") + ","),"");
            }
        }

        function verifyPlaces() {
            places = document.querySelector('[name="places"]');
            if (places.value == "") {
                alert("Va rugam sa selectati cel putin un loc");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <form method="post" action="doSelectPlace.php">
    <p>Cumpara bilete pentru filmul <b><?= $details['film_titlu']?></b></p>
    <p>Difuzat in data de <b><?= $details['proiectie_data']?></b> la ora <b><?= $details['proiectie_ora']?></b>
    <?php
        echo "<table border='0' style='border-spacing: 10px;'>";
        echo "<tr><Td></td><td bgcolor='black' height='5px' colspan=".$details["sala_locuri_rand"]."></td></tr>";
        echo "<tr><td></td></tr>";

        // Loop pentru generarea rândurilor
        for ($i = 1; $i <= $details["sala_randuri"]; $i++) {
            echo "<tr><td>R".$i."</td>"; 
            for ($j = 1; $j <= $details["sala_locuri_rand"]; $j++) {
                $currentplace = $i."-".$j;
                if (in_array($currentplace, $occupiedSeats)) {
                    echo "<td bgcolor='red' style='padding: 10px;'>$j</td>"; 
                } else {
                    echo "<td bgcolor='green' style='padding: 10px;' place='".$i."-".$j."' onClick='changePlace(this)' sel=0>$j</td>";
                }
            }
            echo "</tr>"; 
        }
        
    ?>
    <tr><td></td><td align="left" colspan="<?=$details["sala_locuri_rand"]?>">Email: <input type="text" name="user_email" id="user_email" required></td></tr>
    <tr><td></td><td align="left" colspan="<?=$details["sala_locuri_rand"]?>"><button type="submit" onClick="return verifyPlaces()"> Cumpara bilete </button></td></tr>
    <tr><td></td><td align="right" colspan="<?=$details["sala_locuri_rand"]?>"><a href="index.php">Inapoi la proiectii</a></td></tr>
    </table>
    <input type="hidden" name="places" id="places" value="" required>
    <input type="hidden" name="title" id="title" value="<?= $details['film_titlu']?>">
    <input type="hidden" name="day" id="day" value="<?= $details['proiectie_data']?>">
    <input type="hidden" name="hour" id="hour" value="<?= $details['proiectie_ora']?>">
    <input type="hidden" name="screening_id" id="screening_id" value="<?=$_POST["pro_id"]?>">
    </form>

</body>
</html>