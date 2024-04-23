<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Pedidos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Relatório de Usuários</h1>
    <table>
        <thead>
            <tr>
                <th>ID do Usuário</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>País</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'conexao.php';

            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["user_name"] . "</td>";
                    echo "<td>" . $row["user_address"] . "</td>";
                    echo "<td>" . $row["user_city"] . "</td>";
                    echo "<td>" . $row["user_country"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum resultado encontrado</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <a href="javascript:void(0);" onclick="window.print();" class="print-button">Imprimir</a>
    <button onclick="goBack()">Voltar</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
