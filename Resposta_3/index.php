<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soma dos Totais de Venda por País</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Antonio', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="total-wrapper">
            <h2>Soma dos Totais de Venda por País</h2>
            <ul>
                <?php
                include 'conexao.php';
                // Consulta SQL para obter dados de vendas por país
                $sql = "SELECT u.user_country, SUM(o.order_total) AS total_por_pais
                        FROM orders o
                        INNER JOIN user u ON o.order_user_id = u.user_id
                        GROUP BY u.user_country";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Exibir a soma dos totais de venda por país
                    while($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["user_country"] . ": " . $row["total_por_pais"] . "</li>";
                    }
                } else {
                    echo "0 resultados";
                }
                $conn->close();
                ?>
            </ul>
        </div>
        <div class="filtro-wrapper">
            <h2>Filtrar por País</h2>
            <form method="get">
                <label for="pais">País:</label>
                <select name="pais" id="pais">
                    <option value="">Todos</option>
                    <?php
                    // Preencher o dropdown com os países
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    $sql_countries = "SELECT DISTINCT user_country FROM user";
                    $result_countries = $conn->query($sql_countries);

                    if ($result_countries->num_rows > 0) {
                        while($row_country = $result_countries->fetch_assoc()) {
                            echo "<option value='" . $row_country["user_country"] . "'>" . $row_country["user_country"] . "</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
                <button type="submit" class="filter-button">Filtrar</button>
            </form>

            <?php
            if (isset($_GET['pais'])) {
                // Conexão com o banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);

                $pais_filtrado = $_GET['pais'];
                $sql_vendas_pais = "SELECT u.user_name, o.order_total
                                    FROM orders o
                                    INNER JOIN user u ON o.order_user_id = u.user_id
                                    WHERE u.user_country = '$pais_filtrado'";

                $result_vendas_pais = $conn->query($sql_vendas_pais);

                if ($result_vendas_pais->num_rows > 0) {
                    echo "<div class='vendas-wrapper'>";
                    echo "<h2>Vendas para $pais_filtrado</h2>";
                    echo "<ul>";
                    while($row_venda_pais = $result_vendas_pais->fetch_assoc()) {
                        echo "<li>Total de Venda para " . $row_venda_pais["user_name"] . ": " . $row_venda_pais["order_total"] . "</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<div class='vendas-wrapper'>";
                    echo "<h2>Vendas para $pais_filtrado</h2>";
                    echo "<p>Nenhuma venda encontrada para este país.</p>";
                    echo "</div>";
                }
                $conn->close();
            }
            ?>
        </div>
    </div>
    <button onclick="goBack()" class="btn-voltar">Voltar</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
