<?php
// Variabilă pentru mesaje
$message = '';

// Procesarea formularului
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Apelează metoda insertMovie din MovieController
        MovieController::insertMovie();

        // Mesaj de succes
        $message = "Film adăugat cu succes!";
    } catch (Exception $e) {
        // Mesaj de eroare
        $message = "Eroare la adăugarea filmului: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Film</title>
    <?php if (!isset($_SESSION["request_user"]) || ($_SESSION["request_user"]["rol_id"] != 1)){
    header("Location: /aplicatie_cinema/admin");
    }?>
    <link rel="stylesheet" type="text/css" href="/aplicatie_cinema/app/views/movies/CSS/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Adaugă un Film Nou</h2>
        
        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, 'succes') !== false ? 'success' : 'error'; ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="createMovie.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titlu">Titlu Film:</label>
                <input type="text" id="titlu" name="titlu" placeholder="Introdu titlul filmului" required>
            </div>
            <div class="form-group">
                <label for="gen">Gen Film:</label>
                <input type="text" id="gen" name="gen" placeholder="Introdu genul filmului (ex: Comedie, Dramă)" required>
            </div>
            <div class="form-group">
                <label for="durata">Durată (minute):</label>
                <input type="number" id="durata" name="durata" placeholder="Introdu durata filmului în minute" required>
            </div>
            <div class="form-group">
                <label for="limba">Limbă Film:</label>
                <input type="text" id="limba" name="limba" placeholder="Introdu limba filmului (ex: Română, Engleză)" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating Film:</label>
                <input type="number" id="rating" name="rating" placeholder="Introdu rating-ul (ex: 8.5)" step="0.1" min="0" max="10" required>
            </div>
            <div class="form-group">
                <label for="descriere">Descriere Film:</label>
                <textarea id="descriere" name="descriere" placeholder="Introdu o scurtă descriere a filmului" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="picture">Imagine Film:</label>
                <input type="file" id="poza" name="poza" placeholder="Selecteaza o poza" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit">Salvează Filmul</button>
            </div>
        </form>
        <a href="index.php" class="btn">Înapoi la Lista Filmelor</a>
    </div>
</body>
</html>