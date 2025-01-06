<?php
// Variabilă pentru mesaje
$message = '';

// Procesarea formularului
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        ScreeningController::insertScreening();

        // Mesaj de succes
        $message = "Proiectie adăugată cu succes!";
    } catch (Exception $e) {
        // Mesaj de eroare
        $message = "Eroare la adăugarea proiectiei: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/aplicatie_cinema/app/views/screenings/CSS/create.css">
    <title>Creare Proiecție</title>
</head>
<body>
    
    <div class="form-container">
        <h2>Creare Proiecție</h2>
        <?php if (!isset($_SESSION["request_user"]) || ($_SESSION["request_user"]["rol_id"] != 1)){
        header("Location: /aplicatie_cinema/admin");
        }?>
        <?php if (!empty($message)): ?>
        <div class="message <?= strpos($message, 'succes') !== false ? 'success' : 'error'; ?>">
            <?= htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
        
        <form method="POST" action="createScreening.php">
            <!-- Câmp pentru ID-ul filmului -->
            <div class="form_group">
                <label for="fil_id">Film:</label>
                <select id="fil_id" name="fil_id" required>
                    <option value="">Selecteaza filmul</option>
                    <?php foreach ($movies as $movie): ?>
                        <option value="<?= htmlspecialchars($movie['fil_id']) ?>">
                        <?= htmlspecialchars($movie['titlu']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
            </div>

            <div class="form_group">
                <!-- Câmp pentru ID-ul sălii -->
                <label for="sal_id">Sală:</label>
                <select id="sal_id" name=sal_id required>
                    <option value="">Selecteaza sala</option>
                    <?php foreach ($cinemaHalls as $cinemaHall): ?>
                        <option value="<?= htmlspecialchars($cinemaHall['sal_id']) ?>">
                            <?= htmlspecialchars(($cinemaHall['nume'])) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>  
            </div>

            <div class="form_group">
                <!-- Câmp pentru data -->
                <label for="data">Data difuzarii:</label>
                <input type="date" id="data" name="data" required>
                <br>   
            </div>

            <div class="form_group">
                <!-- Câmp pentru ora de început -->
                <label for="ora">Ora de început:</label>
                <select name="ora" id="ora">
                <?php
                $options = ["08:00", "10:00", "12:00", "14:00", "16:00", "18:00", "20:00", "22:00", "24:00"]; 
                foreach ($options as $option) {
                    echo "<option value=\"$option\">$option</option>";
                }
                ?>
                </select>
                <br>   
            </div>

            <div class="form_group">
                <label for="pret">Pret bilet:</label>
                <input type="number" id="pret" name="pret" required>
                <br>   
            </div>
            
            <button type="submit">Crează Proiecție</button>
        </form>

        <a href="index.php" class="btn">Înapoi la Lista Proiectiilor</a>
    </div>
</body>
</html>