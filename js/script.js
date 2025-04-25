function loadSaldo() {
    fetch('saldo.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('saldo').innerHTML = data;
        })
        .catch(error => console.error('Błąd pobierania salda:', error));
}

window.onload = loadSaldo;
