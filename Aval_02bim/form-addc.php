<!-- Conteudo -->
<div class="conteudo">
	<form method="post" action="addc.php" name="formCadastro" enctype="multipart/form-data">
		<h1>Cadastro de cliente</h1>
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
				<td><input type="text" class="cc" name="txtData" readonly></td>
			</tr>
			<tr></tr>
			<tr>
				<td></td>				
				<td>
					<input type="submit" href="addc.php" onclick="chama(this)" value="Cadastrar"></input>
					<input type="reset" name="bntLimpar" value="Limpar"></input>
				</td>
			</tr>
		</table>
	</form>
</div>

