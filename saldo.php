<?php
$saldoFile = "saldo.txt";

// Jeśli plik nie istnieje, ustaw domyślne saldo
if (!file_exists($saldoFile)) {
    file_put_contents($saldoFile, "2137.69");
}

// Pobierz saldo i zwróć jako tekst
$saldo = floatval(file_get_contents($saldoFile));
echo number_format($saldo, 2, ',', ' ') . " zł";
?>
