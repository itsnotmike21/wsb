<?php
$plikSaldo = 'saldo.txt';
$komunikat = '';

// Sprawdzenie, czy saldo zostało zapisane
$saldo = floatval(file_get_contents($plikSaldo));

// Obsługa formularza wniosku o kredyt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kwota_kredytu = floatval($_POST['kwota_kredytu'] ?? 0);

    // Walidacja wniosku
    if ($kwota_kredytu > 0) {
        // Zaktualizowanie salda
        $saldo += $kwota_kredytu;
        file_put_contents($plikSaldo, $saldo);
        $komunikat = "Wniosek o kredyt został zatwierdzony. Nowe saldo: {$saldo} zł.";
    } else {
        $komunikat = "Kwota kredytu musi być większa niż 0.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wniosek o kredyt</title>
    <link rel="icon" href="images/bank_favicon.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="header-content">
        <img src="images/bank_logo.png" alt="Logo Banku" class="logo">
        <h1>Wniosek o kredyt</h1>
    </div>

    <!-- Formularz wniosku o kredyt -->
    <form action="wniosek.php" method="post">
        <div class="form-group">
            <label for="kwota_kredytu" class="font-weight-bold">Kwota kredytu:</label>
            <!-- Rozwijana lista z kwotami, zachowując spójność z Twoimi stylami -->
            <select id="kwota_kredytu" name="kwota_kredytu" class="form-control" required>
                <option value="100">100 zł</option>
                <option value="1000">1000 zł</option>
                <option value="10000">10000 zł</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Złóż wniosek</button>
    </form>

    <!-- Wyświetlenie komunikatu -->
    <?php if (isset($komunikat)): ?>
        <p class="mt-3"><?= htmlspecialchars($komunikat) ?></p>
    <?php endif; ?>

    <!-- Przycisk powrotu do strony głównej -->
    <form action="index.php" method="get">
        <button type="submit" class="btn btn-secondary mt-3">Powrót do strony głównej</button>
    </form>
</div>

</body>
</html>
