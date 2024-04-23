<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados dos Pedidos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Antonio', sans-serif;
        }
    </style>
</head>
<body>
    <h1>Dados dos Pedidos</h1>
    <?php
    include 'conexao.php';

    $sql = "SELECT u.user_name, u.user_city, u.user_country, o.order_date, o.order_total
            FROM `User` u
            JOIN `Orders` o ON u.user_id = o.order_user_id
            WHERE u.user_id IN (1, 3, 5)
            ORDER BY u.user_name";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>City</th><th>Country</th><th>Date</th><th>Total</th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_name"] . "</td>";
            echo "<td>" . $row["user_city"] . "</td>";
            echo "<td>" . $row["user_country"] . "</td>";
            echo "<td>" . $row["order_date"] . "</td>";
            echo "<td>" . $row["order_total"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado";
    }
    $conn->close();
    ?>
    <button onclick="goBack()">Voltar</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
