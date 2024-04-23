<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados dos Pedidos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

</head>
<body>
    <h1>Média dos Pedidos por Dia</h1>
    <?php
    
    include 'conexao.php';

    $sql = "SELECT order_id, order_user_id, order_total, DATE_FORMAT(order_date, '%Y-%m-%d') AS data_completa, SUM(order_total) AS total_dia, COUNT(*) AS num_pedidos FROM orders GROUP BY DATE_FORMAT(order_date, '%Y-%m-%d')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<table>";
        echo "<tr><th>ID do Pedido</th><th>ID do Usuário</th><th>Total do Pedido</th><th>Data do Pedido</th><th>Média dos Pedidos</th></tr>";
        
        while($row = $result->fetch_assoc()) {    
            $media = $row["total_dia"] / $row["num_pedidos"];

            $cor_linha = '';
            if ($media < 3000) {
                $cor_linha = 'red';
            } elseif ($media > 3000) {
                $cor_linha = 'green';
            } else {
                $cor_linha = 'grey';
            }

            echo "<tr class='$cor_linha'>";
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["order_user_id"] . "</td>";
            echo "<td>" . $row["order_total"] . "</td>";
            echo "<td>" . $row["data_completa"] . "</td>";
            echo "<td>" . round($media, 2) . "</td>";
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
