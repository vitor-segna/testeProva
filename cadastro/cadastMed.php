<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>med</title>
</head>
<body>
    
<h1>Cadastre os med</h1>

<form method="POST" action="">
    <div class="aliment">

        <label for="marca">Marca do Produto</label>
        <input type="text" id="marca" name="marca">

        <label for="nome">Nome do Produto</label>
        <input type="text" id="nome" name="nome">

        <label for="peso">Peso do Produto</label>
        <input type="text" id="peso" name="peso">

        <label for="validade">Validade do Produto</label>
        <input type="date" id="validade" name="validade">

        <label for="vencimento">Vencimento do Produto</label>
        <input type="date" id="vencimento" name="vencimento">

        <label for="faixa_etaria">Faixa Etária do Produto</label>
        <input type="text" id="faixa_etaria" name="faixa_etaria">

        <label for="especialidade">Especialidade do Produto</label>
        <input type="text" id="especialidade" name="especialidade">

        <label for="beneficios">Beneficios do Produto</label>
        <input type="text" id="beneficios" name="beneficios">

        <label for="precausoes">Precausoes do Produto</label>
        <input type="text" id="precausoes" name="precausoes">

        <label for="finalidade">Finalidade do Produto</label>
        <input type="text" id="finalidade" name="finalidade">

        <label for="codigo">Código do Produto</label>
        <input type="number" id="codigo" name="codigo">

        <label for="fabricante">Fabricante do Produto</label>
        <input type="text" id="fabricante" name="fabricante">

        <label for="valor">Valor do Produto</label>
        <input type="number" id="valor" name="valor" step="0.01">

        <button class="env" type="submit">Enviar</button>
        
    </div>
</form>

<header>
    <li><a href="cadastro.html">Voltar</a></li>
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
    $sql_delete = "DELETE FROM medicamentos WHERE idmedicamentos = $id_excluir OR id = $id_excluir";
    
    if (mysqli_query($conn, $sql_delete)) {
        echo "<br>Medicamento excluído com sucesso!";
    } else {
        echo "<br>Erro ao excluir: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $marca = $_POST['marca'];
    $nome = $_POST['nome'];
    $peso = $_POST['peso'];
    $validade = $_POST['validade'];
    $vencimento = $_POST['vencimento'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $especialidade = $_POST['especialidade'];
    $beneficios = $_POST['beneficios'];
    $precausoes = $_POST['precausoes']; 
    $finalidade = $_POST['finalidade'];
    $codigo = $_POST['codigo'];
    $fabricante = $_POST['fabricante'];
    $valor = $_POST['valor'];

    $sql = "INSERT INTO medicamentos (
        marca, 
        nome, 
        peso, 
        validade, 
        vencimento,
        faixa_etaria,
        especialidade, 
        beneficios,
        precausoes, 
        finalidade, 
        codigo,
        fabricante,
        valor
    ) VALUES (
        '$marca',
        '$nome',
        '$peso', 
        '$validade',
        '$vencimento', 
        '$faixa_etaria',
        '$especialidade',
        '$beneficios',
        '$precausoes',
        '$finalidade',
        '$codigo',
        '$fabricante',
        '$valor'
    );";

    if(mysqli_query($conn, $sql)){
        echo "<br>Medicamento cadastrado com sucesso!";
    } else {
        echo "<br>Erro ao cadastrar: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM medicamentos";
if (isset($_GET['buscar_id']) && $_GET['buscar_id'] != '') {
    $id_busca = $_GET['buscar_id'];
    $sql = "SELECT * FROM medicamentos WHERE idmedicamentos = $id_busca OR id = $id_busca";
}

$resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

echo "<br><br>";
echo "<table>";
echo "<tr>";
echo "<th>ID MEDICAMENTO</th>";
echo "<th>MARCA</th>";
echo "<th>NOME</th>";
echo "<th>PESO</th>";
echo "<th>VALIDADE</th>";
echo "<th>VENCIMENTO</th>";
echo "<th>FAIXA ETÁRIA</th>";
echo "<th>ESPECIALIDADE</th>";
echo "<th>BENEFÍCIOS</th>";
echo "<th>PRECAUÇÕES</th>";
echo "<th>FINALIDADE</th>";
echo "<th>CÓDIGO</th>";
echo "<th>FABRICANTE</th>";
echo "<th>VALOR</th>";
echo "<th>AÇÕES</th>";
echo "</tr>";

while ($linha = mysqli_fetch_assoc($resultado)){
    $id_atual = isset($linha['idmedicamentos']) ? $linha['idmedicamentos'] : (isset($linha['id']) ? $linha['id'] : '');
    
    echo "<tr>";
    echo "<td>" . $id_atual . "</td>";
    echo "<td>" . $linha['marca'] . "</td>";
    echo "<td>" . $linha['nome'] . "</td>";
    echo "<td>" . $linha['peso'] . "</td>";
    echo "<td>" . $linha['validade'] . "</td>";
    echo "<td>" . $linha['vencimento'] . "</td>";
    echo "<td>" . $linha['faixa_etaria'] . "</td>";
    echo "<td>" . $linha['especialidade'] . "</td>";
    echo "<td>" . $linha['beneficios'] . "</td>";
    echo "<td>" . $linha['precausoes'] . "</td>";
    echo "<td>" . $linha['finalidade'] . "</td>";
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