<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total de Vendas por Mês/Ano</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Total de Vendas por Mês/Ano</h1>
        <?php
        include 'conexao.php';

        $query = "SELECT MONTH(order_date) AS month, YEAR(order_date) AS year, SUM(order_total) AS total_sales
                  FROM `orders`
                  GROUP BY YEAR(order_date), MONTH(order_date)";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<div class=\"table-container\">";
            echo "<table class=\"custom-table\">";
            echo "<tr><th>Mês</th><th>Ano</th><th>Total de Vendas</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $month = date("F", mktime(0, 0, 0, $row['month'], 1));
                echo "<tr><td>" . $month . "</td><td>" . $row["year"] . "</td><td>" . $row["total_sales"] . "</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>Nenhuma venda encontrada.</p>";
        }

        $conn->close();
        ?>
        <!-- Botão de voltar no canto inferior esquerdo -->
        <button onclick="goBack()" class="back-button">Voltar</button>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
