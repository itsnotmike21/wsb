<?php
$plikSaldo = 'saldo.txt';
$komunikat = '';

// Sprawdź, czy plik salda istnieje – jeśli nie, utwórz z wartością 1000
if (!file_exists($plikSaldo)) {
    file_put_contents($plikSaldo, '1000');
}

$saldo = floatval(file_get_contents($plikSaldo));

// Obsługa formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kwota = floatval($_POST['kwota'] ?? 0);

    if ($kwota > 0) {
if ($kwota <= $saldo) {
$saldo -= $kwota;
file_put_contents($plikSaldo, $saldo);
$komunikat = "✅ Przelew w wysokości {$kwota} zł został wykonany.";
} else {
$komunikat = "❌ Brak wystarczających środków.";
}
} else {
$komunikat = "❌ Wprowadź poprawną kwotę.";
}
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>System Bankowy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/bank_favicon.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="header-content">
        <img src="images/bank_logo.png" alt="Logo Banku" class="logo">
        <h1>Witaj!</h1>
    </div>

    <?php if (!empty($komunikat)): ?>
    <p class="komunikat"><?= htmlspecialchars($komunikat) ?></p>
    <?php endif; ?>

    <p>Twoje aktualne saldo: <strong><?= number_format($saldo, 2, ',', ' ') ?> zł</strong></p>

    <form action="" method="post">
        <label for="kwota">Kwota przelewu:</label>
        <input type="number" id="kwota" name="kwota" step="0.01" min="0.01" required>
        <button type="submit">Wykonaj przelew</button>
    </form>
</div>
</body>
</html>
