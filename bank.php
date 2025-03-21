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
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
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
