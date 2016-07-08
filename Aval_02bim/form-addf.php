
<div class="conteudo">
<?php
	require 'init.php';
?>
		<form method="post" name="formCadastro" action="addf.php" enctype="multipart/form-data">
				<h2>Cadastro de Fornecedor<h2>
			<table width="100%">
				<tr>
					<th width="18%">Nome</th>
					<td width="82%"><input type="text" name="txtNome"></td>
				</tr>				
				<tr>
					<th>Email</th>
					<td><input type="text" name="txtEmail"></td>
				</tr>
				
				<tr>
					<th>Data</th>
					<td><input type="text" class="cf" name="txtData" readonly></td>
				</tr>
				<tr></tr>
				<tr>
					<td></td>				
					<td><input type="submit" href="fornecedores.php" onclick="chama(this)" value="Cadastrar"></input>
					<input type="reset" name="bntLimpar" value="Limpar"></td>
				</tr>

			</table>
		</form>
</div>


