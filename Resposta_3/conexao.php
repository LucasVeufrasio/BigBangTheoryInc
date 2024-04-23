<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bigbang";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
