<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    
 <h1>TABELA</h1>

 
 <header>
    <ul>
        <li><a href="consulta.html">Voltar</a></li>
    </ul>
</header>

     <?php
        $servername = "localhost";
        $database = "petshop_db";
        $username = "root";
        $password = "";

        $conn = mysqli_connect(
          $servername,
          $username,
          $password,
          $database
        );

        if (!$conn) {
          die("falha na conexão: " . mysqli_connect_error());
        }
        echo "<p>Conectado com sucesso</p>";

        if (isset($_GET['acao']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $acao = $_GET['acao'];

            if ($acao == 'entrada') {
                $sql_update = "UPDATE `brinquedos/acessorios` SET codigo = codigo + 1 WHERE `idbrinquedos/acessorios` = $id";
                mysqli_query($conn, $sql_update);

                $sql_historico = "INSERT INTO movimentacoes_geral (id_produto, categoria_produto, tipo_movimentacao, quantidade, data_movimento) VALUES ($id, 'brinquedo', 'ENTRADA', 1, NOW())";
                mysqli_query($conn, $sql_historico);

            } elseif ($acao == 'saida') {
                $sql_update = "UPDATE `brinquedos/acessorios` SET codigo = codigo - 1 WHERE `idbrinquedos/acessorios` = $id AND codigo > 0";
                mysqli_query($conn, $sql_update);

                $sql_historico = "INSERT INTO movimentacoes_geral (id_produto, categoria_produto, tipo_movimentacao, quantidade, data_movimento) VALUES ($id, 'brinquedo', 'SAÍDA', 1, NOW())";
                mysqli_query($conn, $sql_historico);
            }
        }

        $sql = "SELECT * FROM `brinquedos/acessorios`";
        $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

        echo "<table>";
        echo "<tr>";
        echo "<th>ID PRODUTOS</th>";
        echo "<th>MARCA</th>";
        echo "<th>NOME</th>";
        echo "<th>MATERIAL</th>";
        echo "<th>CORES</th>";
        echo "<th>FABRICACAO</th>";
        echo "<th>FAIXA ETARIA</th>";
        echo "<th>TAMANHO</th>";
        echo "<th>ESPECIE INDICADA</th>";
        echo "<th>BENEFICIOS</th>";
        echo "<th>ESTOQUE / QTD</th>";
        echo "<th>FABRICANTE</th>";
        echo "<th>VALOR</th>";
        echo "<th>MOVIMENTAÇÃO</th>";
        echo "</tr>";

        while ($linha = mysqli_fetch_assoc($resultado)){
        $id_atual = $linha['idbrinquedos/acessorios'];

        echo "<tr>";
        echo "<td>" . $id_atual . "</td>";
        echo "<td>" . $linha['marca'] . "</td>";
        echo "<td>" . $linha['nome'] . "</td>";
        echo "<td>" . $linha['material'] . "</td>";
        echo "<td>" . $linha['cores'] . "</td>";
        echo "<td>" . $linha['fabricacao'] . "</td>";
        echo "<td>" . $linha['faixa_etaria'] . "</td>";
        echo "<td>" . $linha['tamanho'] . "</td>";
        echo "<td>" . $linha['especie_indicada'] . "</td>";
        echo "<td>" . $linha['beneficios'] . "</td>";
        echo "<td>" . $linha['codigo'] . "</td>";
        echo "<td>" . $linha['fabricante'] . "</td>";
        echo "<td>" . $linha['valor'] . "</td>";
        echo "<td>";
        echo "<a href='?acao=entrada&id=" . $id_atual . "'>[ + Entrada ]</a> ";
        echo "<a href='?acao=saida&id=" . $id_atual . "'>[ - Saída ]</a>";
        echo "</td>";
        echo "</tr>";
        }
        echo "</table>";

        echo "<br><br><h2>HISTÓRICO GLOBAL DE MOVIMENTAÇÕES</h2>";
        $sql_mov = "SELECT * FROM movimentacoes_geral ORDER BY data_movimento DESC";
        $resultado_mov = mysqli_query($conn, $sql_mov);

        echo "<table>";
        echo "<tr>";
        echo "<th>ID MOV</th>";
        echo "<th>ID PRODUTO</th>";
        echo "<th>CATEGORIA</th>";
        echo "<th>TIPO</th>";
        echo "<th>QTD</th>";
        echo "<th>DATA / HORA</th>";
        echo "</tr>";

        while ($linha_mov = mysqli_fetch_assoc($resultado_mov)) {
            echo "<tr>";
            echo "<td>" . $linha_mov['idmovimentacao'] . "</td>";
            echo "<td>" . $linha_mov['id_produto'] . "</td>";
            echo "<td>" . $linha_mov['categoria_produto'] . "</td>";
            echo "<td>" . $linha_mov['tipo_movimentacao'] . "</td>";
            echo "<td>" . $linha_mov['quantidade'] . "</td>";
            echo "<td>" . $linha_mov['data_movimento'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($conn);
    ?>
</body>
</html>