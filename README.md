# BigBangTheoryInc
Você precisa elaborar novas páginas para o projeto da Big Bang Theory Inc. Eles possue uma relação de pedidos online não estão conseguindo visualizar as informações como gostariam. Contamos com você para ajudá-los. 
                                        


##                                    As tabelas para o teste estão disponíveis aqui.
                https://drive.google.com/drive/folders/111U3pmED2rG9My5VXE0Gfdj-ILVsNIED?usp=sharing

Agora o passo a passo para você colar o banco de dados que está no link acima na sua máquina.

1. Na sua barra de pesquisa abra "localhost".
2. Agora procure por "phpMyAdmin", e clique nele.
3. No canto esquerdo da tela voce vai clicar em "Novo".
4. Coloque o nome do seu banco de dados no campo "Nome do banco de dados", aperte o botão no lado "Criar".
5. Depois que preencher o campo, procure por "Importar" na parte superior da tela, e dê um clique.
6. Agora vá no campo "Escolher ficheiro" e cole a tabela que voce baixou.
7. Role para baixo e você verá um botão escrito "Importar". Quando você clicar nesse botão, o seu banco de dados está pronto para uso.



###    Conexao.php

                                            http://localhost/bigbangtheoryinc/

```PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bigbang";
```

### Consulta no Banco de Dados


O código PHP abaixo está realizando uma consulta no banco de dados para obter informações sobre pedidos. Em seguida, exibe esses dados em uma tabela HTML, destacando as linhas de acordo com a média de vendas por dia. 
```PHP
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
```
### Alterando o País 
 Esse código em PHP está consultando o banco de dados para obter os IDs de usuários disponíveis. Em seguida, exibe um formulário onde o usuário pode selecionar um ID de usuário e inserir um novo país. Quando o formulário é enviado, o código verifica se o ID do usuário está disponível e, se sim, atualiza o país do usuário no banco de dados. 
``` PHP
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
```


## Sobre o Teste

Adorei o desafio! Sou um grande fã da série The Big Bang Theory e fiquei muito entusiasmado ao descobrir que o teste estava relacionado a isso. Gostaria de ter um pouco mais de tempo com o projeto, mas compreendo a importância de entregá-lo o quanto antes para a avaliação.

Aprendi muito trabalhando nesse projeto. Esta foi a minha primeira experiência com PHP, e até comecei um curso para aprofundar meus conhecimentos. Além disso, recebi muitas orientações sobre PHP de alguns professores da faculdade.

Enfrentei algumas dificuldades, especialmente ao alterar o país, e incrivelmente, o que mais me exigiu estudo foi o README, já que nunca havia feito um antes.

Espero que tenham apreciado o meu trabalho. Se eu for escolhido para a vaga, ficarei extremamente feliz também.
