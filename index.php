<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredPassword = $_POST['password'];
    $correctPassword = 'opee'; // Twoje hasło

    if ($enteredPassword === $correctPassword) {
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit;
    } else {
        $errorMessage = 'Nieprawidłowe hasło. Spróbuj ponownie.';
    }
}

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Podaj hasło</h1>
        <form method="post">
            <input type="password" name="password" placeholder="Hasło" required>
            <button type="submit">Zaloguj</button>
        </form>
        <?php if (isset($errorMessage)) { echo '<p style="color: red;">' . $errorMessage . '</p>'; } ?>
    </div>
</body>
</html>
<?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obliczanie czasu czytania Biblii</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Obliczanie czasu czytania Biblii</h1>
        <form id="bibleForm">
            <label for="days">Liczba dni, przez które czytałeś Biblię:</label>
            <input type="number" id="days" name="days" required>
            <label for="percentage">Procent przeczytanej Biblii:</label>
            <input type="number" id="percentage" name="percentage" required inputmode="decimal" step="0.01" min="0" max="100">
            <button type="submit">Oblicz</button>
        </form>
        <div id="result" class="result"></div>
    </div>
    <script src="script.js"></script>
</body>
</html>