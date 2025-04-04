<?php
$saldoFile = "saldo.txt";

// Jeśli plik nie istnieje, ustaw domyślne saldo
if (!file_exists($saldoFile)) {
    file_put_contents($saldoFile, "2137.69");
}

$saldo = floatval(file_get_contents($saldoFile));
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kwota = isset($_POST['kwota']) ? floatval($_POST['kwota']) : 0;

    if ($kwota > 0 && $kwota <= $saldo) {
        $saldo -= $kwota;
        file_put_contents($saldoFile, strval($saldo));
        $message = "<p>Przelano kwotę: <strong>" . number_format($kwota, 2, ',', ' ') . " zł</strong></p>";
    } else {
        $message = "<p style='color: red;'>Błąd: niewystarczające środki lub błędna kwota!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potwierdzenie przelewu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Potwierdzenie przelewu</h2>
    <?php echo $message; ?>
    <p>Twoje nowe saldo: <strong><?php echo number_format($saldo, 2, ',', ' '); ?> zł</strong></p>
    <button onclick="window.location.href='index.html'">Powrót do strony głównej</button>
</div>
</body>
</html>
