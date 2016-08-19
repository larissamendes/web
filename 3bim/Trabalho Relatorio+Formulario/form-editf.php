<div class="conteudo">
<?php
	require 'init.php';
    // pega o ID da URL
	$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
	// valida o ID
 	if (empty ($id))
{
	echo "ID para alteração não definido";
 	exit;
}
 	// busca os dados do usuário a ser editado
 	$PDO = db_connect();
 	$sql = "SELECT nomeFornecedor,email,dataFundacao FROM fornecedores WHERE idFornecedor = :id";
	$stmt = $PDO->prepare($sql);
 	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 	$stmt->execute();
 	$fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);
 	/* se o método fetch () não retornar um array
 	significa que o ID não corresponde a um usuário válido */
 	if(!is_array($fornecedor))
 	{
 		echo "Nenhum Fornecedor encontrado";
 		exit;
 	}
 	$dataOK = dateConvert($fornecedor['dataFundacao']);
 ?>

 	<form method = "post" name="formAltera" action ="editf.php" enctype="multipart/form-data">
 	<h1> Edição de dados </h1>
 	<table width="100%">
 		<tr>
 		<th width="18%">Nome</th>
 		<td width="82%"><input type="text" name="txtNome" value ="<?php echo $fornecedor['nomeFornecedor']?>"></td>
 		</tr>
 		<tr>
 			<th>Data</th>
 			<td ><input type="text" class="cf" name="txtData" value="<?php echo $dataOK ?>" readonly></td>
		</tr>
 		<tr>
 			<th> Email </th>
 			<td><input type="text" name="txtEmail" value="<?php echo $fornecedor['email']?>"></td>
 		</tr>
 		<tr>
 			<input type="hidden" name="id" value="<?php echo $id ?>">
 			<td><input type="submit" href="editf.php" onclick="chama(this)" value="Alterar"></input></td>
 			<td><input type="reset" name="btnLimpar" value="Limpar"></td>
 				</tr>
 			</table>
 		</form>

</div>
