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
    <style>
        .result {
            font-size: 1.5em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Obliczanie czasu czytania Biblii</h1>
        <form id="bibleForm">
            <label for="days">Liczba dni, przez które czytałeś Biblię:</label>
            <input type="number" id="days" name="days" required>
            <label for="percentage">Procent przeczytanej Biblii:</label>
            <input type="text" id="percentage" name="percentage" required pattern="[0-9]+([,.][0-9]+)?">
            <button type="submit">Oblicz</button>
        </form>
        <div id="result" class="result"></div>
    </div>
    <script>
        document.getElementById('bibleForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const days = parseFloat(document.getElementById('days').value);
            let percentage = document.getElementById('percentage').value.replace(',', '.');
            percentage = parseFloat(percentage);

            if (isNaN(days) || isNaN(percentage) || percentage <= 0 || percentage > 100) {
                alert('Proszę wprowadzić prawidłowe dane.');
                return;
            }

            const D = (days / percentage) * 100;
            const C = D - days;

            const roundedD = Math.round(D);
            const roundedC = Math.round(C);

            const endDate = new Date();
            endDate.setDate(endDate.getDate() + roundedC);
            const endDateString = endDate.toISOString().split('T')[0];

            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = `<p>Przeczytasz całą Biblię w: ${roundedD} dni</p>
                                  <p>Pozostało do końca: ${roundedC} dni</p>
                                  <p>Data ukończenia: ${endDateString}</p>`;
        });
    </script>
</body>
</html>