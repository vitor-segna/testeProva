<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alimentos</title>
</head>
<body>
    
<h1>Cadastre os alimentos</h1>

<form class="aliment" method="POST" action="">

    <label for="nome">Nome do Produto</label>
    <input type="text" id="nome" name="nome">

    <label for="sabor">Sabor do Produto</label>
    <input type="text" id="sabor" name="sabor">

    <label for="marca">Marca do Produto</label>
    <input type="text" id="marca" name="marca">

    <label for="peso">Peso do Produto</label>
    <input type="text" id="peso" name="peso">

    <label for="validade">Validade do Produto</label>
    <input type="date" id="validade" name="validade">

    <label for="faixa_etaria">Faixa etaria do Produto</label>
    <input type="text" id="faixa_etaria" name="faixa_etaria">

    <label for="codigo">Codigo do Produto</label>
    <input type="number" id="codigo" name="codigo">

    <label for="fabricante">Fabricante do Produto</label>
    <input type="text" id="fabricante" name="fabricante">

    <label for="valor">Valor do Produto</label>
    <input type="number" id="valor" name="valor" step="0.01">

    <button class="env" type="submit">Enviar</button>
        
</form>

<header>
    <ul>
        <li><a href="cadastro.html">Voltar</a></li>
    </ul>
</header>

<br><br>
<form method="GET" action="">
    <label for="buscar_id">Pesquisar por ID: </label>
    <input type="number" id="buscar_id" name="buscar_id">
    <button type="submit">Buscar</button>
    <a href="?">Limpar Busca</a>
</form>

<?php
$host = "localhost";
$user = "root";
$password = "";
$banco = "petshop_db";

$conn = mysqli_connect($host, $user, $password, $banco);

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

if (isset($_GET['excluir'])) {
    $id_excluir = $_GET['excluir'];
    $sql_delete = "DELETE FROM alimentos WHERE idalimentos = $id_excluir OR id = $id_excluir";
    
    if (mysqli_query($conn, $sql_delete)) {
        echo "<br>Alimento excluído com sucesso!<br>";
    } else {
        echo "<br>Erro ao excluir: " . mysqli_error($conn) . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nome = $_POST['nome'];
    $sabor = $_POST['sabor'];
    $marca = $_POST['marca'];
    $peso = $_POST['peso']; 
    $validade = $_POST['validade'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $codigo = $_POST['codigo'];
    $fabricante = $_POST['fabricante'];
    $valor = $_POST['valor']; 

    $sql = "INSERT INTO alimentos (nome, sabor, marca, peso, validade, faixa_etaria, codigo, fabricante, valor) 
            VALUES ('$nome', '$sabor', '$marca', '$peso', '$validade', '$faixa_etaria', '$codigo', '$fabricante', '$valor');";

    if(mysqli_query($conn, $sql)){
        echo "<br>Alimento cadastrado com sucesso!<br>";
    } else {
        echo "<br>Erro ao cadastrar: " . mysqli_error($conn) . "<br>";
    }
}

$sql = "SELECT * FROM alimentos";
if (isset($_GET['buscar_id']) && $_GET['buscar_id'] != '') {
    $id_busca = $_GET['buscar_id'];
    $sql = "SELECT * FROM alimentos WHERE idalimentos = $id_busca OR id = $id_busca";
}

$resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

echo "<br><br>";
echo "<table>";
echo "<tr>";
echo "<th>ID ALIMENTO</th>";
echo "<th>NOME</th>";
echo "<th>SABOR</th>";
echo "<th>CATEGORIA</th>";
echo "<th>MARCA</th>";
echo "<th>PESO</th>";
echo "<th>VALIDADE</th>";
echo "<th>FAIXA ETARIA</th>";
echo "<th>CODIGO</th>";
echo "<th>FABRICANTE</th>";
echo "<th>VALOR</th>";
echo "<th>AÇÕES</th>";
echo "</tr>";

while ($linha = mysqli_fetch_assoc($resultado)){
    $id_atual = isset($linha['idalimentos']) ? $linha['idalimentos'] : (isset($linha['id']) ? $linha['id'] : '');
    
    echo "<tr>";
    echo "<td>" . $id_atual . "</td>";
    echo "<td>" . $linha['nome'] . "</td>";
    echo "<td>" . $linha['sabor'] . "</td>";
    echo "<td>" . (isset($linha['categoria']) ? $linha['categoria'] : '') . "</td>";
    echo "<td>" . $linha['marca'] . "</td>";
    echo "<td>" . $linha['peso'] . "</td>";
    echo "<td>" . $linha['validade'] . "</td>";
    echo "<td>" . $linha['faixa_etaria'] . "</td>";
    echo "<td>" . $linha['codigo'] . "</td>";
    echo "<td>" . $linha['fabricante'] . "</td>";
    echo "<td>" . $linha['valor'] . "</td>";
    echo "<td><a href='?excluir=" . $id_atual . "' onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a></td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($conn);
?>

</body>
</html>