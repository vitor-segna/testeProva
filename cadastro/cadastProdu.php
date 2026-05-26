<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produtos</title>
</head>
<body>
    
<h1>Aqui podemos cadastrar os produtos</h1>

<form class="produ" method="POST" action="">

    <label for="marca">Marca do Produto</label>
    <input type="text" id="marca" name="marca">

    <label for="nome">Nome do Produto</label>
    <input type="text" id="nome" name="nome">

    <label for="material">Material do Produto</label>
    <input type="text" id="material" name="material">

    <label for="cores">Cores do Produto</label>
    <input type="text" id="cores" name="cores">

    <label for="fabricacao">Fabricacoa do Produto</label>
    <input type="date" id="fabricacao" name="fabricacao">

    <label for="faixa_etaria">Faixa etaria do Produto</label>
    <input type="text" id="faixa_etaria" name="faixa_etaria">

    <label for="tamanho">Tamanho do Produto</label>
    <input type="text" id="tamanho" name="tamanho">

    <label for="especie_indicada">Especie indicada</label>
    <input type="text" id="especie_indicada" name="especie_indicada">

    <label for="beneficios">Beneficios do Produto</label>
    <input type="text" id="beneficios" name="beneficios">

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

    if (!$conn){
        die("a conexão falhou " . mysqli_connect_error());
    }

  if (isset($_GET['excluir'])) {
      $id_excluir = $_GET['excluir'];
      $sql_delete = "DELETE FROM `brinquedos/acessorios` WHERE id = $id_excluir";
      
      if (mysqli_query($conn, $sql_delete)) {
          echo "<br>Produto excluído com sucesso!";
      } else {
          echo "<br>Erro ao excluir: " . mysqli_error($conn);
      }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $marca = $_POST['marca'];
    $nome = $_POST['nome'];
    $material = $_POST['material'];
    $cores = $_POST['cores'];
    $fabricacao = $_POST['fabricacao'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $tamanho = $_POST['tamanho'];
    $especie_indicada = $_POST['especie_indicada'];
    $beneficios = $_POST['beneficios'];
    $codigo = $_POST['codigo'];
    $fabricante = $_POST['fabricante'];
    $valor = $_POST['valor'];

    echo "conectado com sucesso";

    $sqli = "INSERT INTO `brinquedos/acessorios` (
        marca, 
        nome, 
        material, 
        cores, 
        fabricacao, 
        faixa_etaria, 
        tamanho, 
        especie_indicada, 
        beneficios, 
        codigo, 
        fabricante, 
        valor
       )VALUES(
       '$marca',
       '$nome',
       '$material',
       '$cores',
       '$fabricacao',
       '$faixa_etaria',
       '$tamanho',
       '$especie_indicada',
       '$beneficios',
        $codigo,
       '$fabricante',
        $valor
       )";
   
     if (mysqli_query($conn, $sqli)){
        echo "<br>sEU PRODUTO FOI CADASTRADO ";
     }else{
        echo "<br>erro" . mysqli_error($conn);
     }
  }

$sql = "SELECT * FROM `brinquedos/acessorios`";
if (isset($_GET['buscar_id']) && $_GET['buscar_id'] != '') {
    $id_busca = $_GET['buscar_id'];
    $sql = "SELECT * FROM `brinquedos/acessorios` WHERE id = $id_busca";
}

$resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

echo "<br><br>";
echo "<table>";
echo "<tr>";
echo "<th>ID PRODUTO</th>";
echo "<th>MARCA</th>";
echo "<th>NOME</th>";
echo "<th>MATERIAL</th>";
echo "<th>CORES</th>";
echo "<th>FABRICAÇÃO</th>";
echo "<th>FAIXA ETÁRIA</th>";
echo "<th>TAMANHO</th>";
echo "<th>ESPÉCIE INDICADA</th>";
echo "<th>BENEFÍCIOS</th>";
echo "<th>CÓDIGO</th>";
echo "<th>FABRICANTE</th>";
echo "<th>VALOR</th>";
echo "<th>AÇÕES</th>";
echo "</tr>";

while ($linha = mysqli_fetch_assoc($resultado)){
    $id_atual = isset($linha['id']) ? $linha['id'] : '';
    
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
    echo "<td><a href='?excluir=" . $id_atual . "' onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a></td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($conn);
?>

</body>
</html>