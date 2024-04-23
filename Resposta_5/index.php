<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar País</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Alterar País do Usuário</h1>
        <?php
       include 'conexao.php';

        $availableUsersQuery = "SELECT `user_id` FROM `user`";
        $availableUsersResult = $conn->query($availableUsersQuery);
        $availableUsers = [];

        if ($availableUsersResult->num_rows > 0) {
            while ($row = $availableUsersResult->fetch_assoc()) {
                $availableUsers[] = $row["user_id"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST['userId'];
            $newCountry = $_POST['newCountry'];

            if (in_array($userId, $availableUsers)) {
                
                $sql = "UPDATE `user` SET `user_country` = '$newCountry' WHERE `user_id` = $userId";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>País atualizado com sucesso!</p>";
                } else {
                    echo "<p>Erro ao atualizar o país: " . $conn->error . "</p>";
                }
            } else {
                echo "<p>ID de usuário inválido. Por favor, escolha um dos IDs disponíveis.</p>";
            }
        }

        echo "<form action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"POST\">";
        echo "<label for=\"userId\">ID do Usuário:</label>";
        echo "<select id=\"userId\" name=\"userId\" required>";
        foreach ($availableUsers as $user) {
            echo "<option value=\"$user\">$user</option>";
        }
        echo "</select>";
        echo "<label for=\"newCountry\">Novo País:</label>";
        echo "<input type=\"text\" id=\"newCountry\" name=\"newCountry\" required>";
        echo "<button type=\"submit\">Alterar País</button>";
        echo "</form>";

        $query = "SELECT * FROM `user`";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>Lista de Países</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Endereço</th><th>Cidade</th><th>País</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["user_name"] . "</td><td>" . $row["user_address"] . "</td><td>" . $row["user_city"] . "</td><td>" . $row["user_country"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum país encontrado.</p>";
        }

        $conn->close();
        ?>
        <button1 id="voltar" onclick="goBack()">Voltar</button1>

<script>
    function goBack() {
        window.history.back();
    }
</script>
    </div>
</body>
</html>
