
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Film</title>
    <link rel="stylesheet" type="text/css" href="/aplicatie_cinema/app/views/movies/CSS/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Modifica Film</h2>
        <?php if (!isset($_SESSION["request_user"]) || ($_SESSION["request_user"]["rol_id"] != 1)){
        header("Location: /aplicatie_cinema/admin");
        }?>
        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, 'succes') !== false ? 'success' : 'error'; ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="doEditMovie.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titlu">Titlu Film:</label>
                <input type="text" id="titlu" name="titlu" value="<?= $movie['titlu'] ?>" required>
            </div>
            <div class="form-group">
                <label for="gen">Gen Film:</label>
                <input type="text" id="gen" name="gen" value="<?= $movie['gen'] ?>" required>
            </div>
            <div class="form-group">
                <label for="durata">Durată (minute):</label>
                <input type="number" id="durata" name="durata" value="<?= $movie['durata'] ?>" required>
            </div>
            <div class="form-group">
                <label for="limba">Limbă Film:</label>
                <input type="text" id="limba" name="limba" value="<?= $movie['limba'] ?>" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating Film:</label>
                <input type="number" id="rating" name="rating" value="<?= $movie['rating'] ?>" step="0.1" min="0" max="10" required>
            </div>
            <div class="form-group">
                <label for="descriere">Descriere Film:</label>
                <textarea id="descriere" name="descriere" rows="5" required><?= $movie['descriere'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="picture">Imagine Film:</label>
                <input type="file" id="poza" name="poza" accept="image/*" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="fil_id" value="<?= $movie['fil_id'] ?>">
                <button type="submit">Salvează Filmul</button>
            </div>
        </form>
        <a href="index.php" class="btn">Înapoi la Lista Filmelor</a>
    </div>
</body>
</html>