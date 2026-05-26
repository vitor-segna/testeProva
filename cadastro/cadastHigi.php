<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>higiene</title>
</head>
<body>
    
  <h1>Cadatre o seu produto de higiene</h1>

  <div class="higiene">

  <form action="" method="POST">

   <label for="marca">Marca do Produto </label>
   <input type="text" id="marca" name="marca">

     <label for="nome">Nome do Produto </label>
   <input type="text" id="nome" name="nome">

     <label for="beneficios">Beneficios do Produto </label>
   <input type="text" id="beneficios" name="beneficios">

     <label for="finalidade">Finalidade do Produto </label>
   <input type="text" id="finalidade" name="finalidade">

      <label for="precausoes">Precaucoes do Produto </label>
   <input type="text" id="precausoes" name="precausoes">

     <label for="validade">Validade do Produto </label>
   <input type="date" id="validade" name="validade">

     <label for="material">Material do Produto </label>
   <input type="text" id="material" name="material">

     <label for="alertas">Alertas do Produto </label>
   <input type="text" id="alertas" name="alertas">

     <label for="codigo">Codigo do Produto </label>
   <input type="number" id="codigo" name="codigo">

     <label for="fabricante">Fabricante do Produto </label>
   <input type="text" id="fabricante" name="fabricante">

     <label for="valor">Valor do Produto </label>
   <input type="number" id="valor" name="valor" step="0.01">

   <button class="env" type="submit"> Enviar </button>

   <header>
    <ul>
        <li><a href="cadastro.html">Voltar</a></li>
    </ul>
</header>
</form>
</div>

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

    if (!$conn){
        die("a conexao falhou:" . mysqli_connect_error());
    }

if (isset($_GET['excluir'])) {
    $id_excluir = $_GET['excluir'];
    $sql_delete = "DELETE FROM higiene WHERE idhigiene = $id_excluir OR id = $id_excluir";
    
    if (mysqli_query($conn, $sql_delete)) {
        echo "<br>Produto excluído com sucesso!";
    } else {
        echo "<br>Erro ao excluir: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $marca = $_POST['marca'];
    $nome = $_POST['nome'];
    $beneficios = $_POST['beneficios'];
    $finalidade = $_POST['finalidade'];
    $precausoes = $_POST['precausoes'];
    $validade = $_POST['validade'];
    $material = $_POST['material'];
    $alertas = $_POST['alertas'];
    $codigo = $_POST['codigo'];
    $fabricante = $_POST['fabricante'];
    $valor = $_POST['valor'];

   $sql = "INSERT INTO higiene (
    marca,
    nome,
    beneficios,
    finalidade,
    precausoes,
    validade,
    material,
    alertas,
    codigo,
    fabricante,
    valor
   ) VALUES (
    '$marca',
    '$nome',
    '$beneficios',
    '$finalidade',
    '$precausoes',
    '$validade',
    '$material',
    '$alertas',
    '$codigo',
    '$fabricante',
    '$valor'
   )";

   if (mysqli_query($conn, $sql)) {
    echo "<br>cadastrado com sucesso";
   } else {
    echo "<br>erro: " . mysqli_error($conn);
   }
}

$sql = "SELECT * FROM higiene";
if (isset($_GET['buscar_id']) && $_GET['buscar_id'] != '') {
    $id_busca = $_GET['buscar_id'];
    $sql = "SELECT * FROM higiene WHERE idhigiene = $id_busca OR id = $id_busca";
}

$resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

echo "<br><br>";
echo "<table>";
echo "<tr>";
echo "<th>ID HIGIENE</th>";
echo "<th>MARCA</th>";
echo "<th>NOME</th>";
echo "<th>BENEFÍCIOS</th>";
echo "<th>FINALIDADE</th>";
echo "<th>PRECAUÇÕES</th>";
echo "<th>VALIDADE</th>";
echo "<th>MATERIAL</th>";
echo "<th>ALERTAS</th>";
echo "<th>CÓDIGO</th>";
echo "<th>FABRICANTE</th>";
echo "<th>VALOR</th>";
echo "<th>AÇÕES</th>";
echo "</tr>";

while ($linha = mysqli_fetch_assoc($resultado)){
    $id_atual = isset($linha['idhigiene']) ? $linha['idhigiene'] : (isset($linha['id']) ? $linha['id'] : '');
    
    echo "<tr>";
    echo "<td>" . $id_atual . "</td>";
    echo "<td>" . $linha['marca'] . "</td>";
    echo "<td>" . $linha['nome'] . "</td>";
    echo "<td>" . $linha['beneficios'] . "</td>";
    echo "<td>" . $linha['finalidade'] . "</td>";
    echo "<td>" . $linha['precausoes'] . "</td>";
    echo "<td>" . $linha['validade'] . "</td>";
    echo "<td>" . $linha['material'] . "</td>";
    echo "<td>" . $linha['alertas'] . "</td>";
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