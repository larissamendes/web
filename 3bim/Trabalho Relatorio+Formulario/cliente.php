<!-- Conteudo -->
<div class="conteudo">
	<?php
		require_once 'init.php';
		$PDO = db_connect();
		$sql_count = "SELECT COUNT(*) AS total FROM clientes ORDER BY nomeCliente ASC";
		$sql = "SELECT idCliente, nomeCliente , email, dataCadastro FROM clientes ORDER BY nomeCliente ASC";
 
		$stmt_count = $PDO->prepare($sql_count);
		$stmt_count->execute();
		$total = $stmt_count->fetchColumn();
 
		$stmt= $PDO->prepare($sql);
		$stmt->execute();
	?>
	<h2>Lista de Cliente</h2>
	<p>Total de Clientes: <?php echo $total ?></p>
	<?php if($total > 0): ?>
	<table width="100%" border="1"> 
		<thead>			
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Data</th>
				<th>Acoes</th>
			</tr>
		</thead>
		<tbody>
			<?php while($cliente = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
			<tr>
				<td><?php echo $cliente['idCliente'] ?></td>
				<td><?php echo $cliente['nomeCliente'] ?></td>
				<td><?php echo $cliente['email'] ?></td>
				<td><?php echo dateConvert($cliente['dataCadastro'])?></td>
				<td>
					<links style="color: #3366CC" onclick="chama(this)" href="form-editc.php?id=<?php echo $cliente['idCliente']?> ">Editar</links>
					<a onclick="chama(this)" href="deletec.php?id=<?php echo $cliente['idCliente'] ?>">Excluir</a> 
				</td>
			</tr>
			<?php endwhile; ?>
 		</tbody>
	</table>
 	<?php else: ?>
 	<p> Nenhum Cliente registrado </p>
 	<?php endif; ?>
 	<br>
 	<p><input type="button" href="form-addc.php" onclick="chama(this)" value="Novo Cliente"></input></p>
 	<p><input type="button" href="relatorioc.php" onclick="chama(this)" value="Gerar Relatório"></input></p>
</div>
