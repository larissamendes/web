<div class="conteudo">
<?php
  // inclui classes necessárias
  spl_autoload_register(function ($class_name)
  {
    include 'html/'.$class_name.'.class.php';
  });
	require_once 'init.php';
		$PDO = db_connect();
 $sql_count = "SELECT COUNT(*) AS total FROM fornecedores ORDER BY nomeFornecedor ASC";
 
$sql = "SELECT idFornecedor, nomeFornecedor , email, dataFundacao FROM fornecedores ORDER BY nomeFornecedor ASC";
 
 $stmt_count = $PDO->prepare($sql_count);
 $stmt_count->execute();
 $total = $stmt_count->fetchColumn();
 
 $stmt= $PDO->prepare($sql);
 $stmt->execute();
	
		
  $html = new TElement('html');
  $html->lang = 'pt-br';
  $body = new TElement('body');
  $html->add($body);
  $tabela = new TTable;
  $tabela->width = 600;
  $tabela->border = 1;
  $cabecalho = $tabela->addRow();
  $cabecalho->bgcolor = '#a0a0a0';
  $cabecalho->addCell('Id');
  $cabecalho->addCell('Nome');
  $cabecalho->addCell('E-Mail');
  $cabecalho->addCell('Data');
  
  $i = 0;
 
  while($fornecedores = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    
    $bgcolor = ($i % 2) == 0 ? '#d0d0d0' : '#ffffff';
    $linha = $tabela->addRow();
    $linha->bgcolor = $bgcolor;
   
    $linha->addCell($fornecedores['idFornecedor']);
    $linha->addCell($fornecedores['nomeFornecedor']);
    $linha->addCell($fornecedores['email']);
    $linha->addCell(dateConvert($fornecedores['dataFundacao']));
    
    $i++;
  }
?>	<div class="tabela">
	<?php
  $body->add($tabela);
  $html->show();
  ?>
 </div><?php
 
 
?>
</div>
