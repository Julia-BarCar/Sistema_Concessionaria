<h1>Listar Funcionario</h1>
<?php 
	$sql = "SELECT * FROM funcionario";
	$res = $conn->query($sql);
	$qtd = $res->num_rows;

	if ($qtd > 0) {
		print "<p>Encontrou <b>$qtd</b> funcionario(s) cadastrado(s)!</p>";
		print "<table class='table table-bordered table-striped table-hover'>";
		print "<tr>";
		print "<th>ID</th>";
		print "<th>Nome</th>";
		print "<th>CPF</th>";
		print "<th>E-mail</th>";
		print "<th>Telefone</th>";
		print "<th>Nascimento</th>";
		print "<th>Ação</th>";
		print "</tr>";

		while ($row = $res->fetch_object()) {
			// Formatar CPF
			$cpf_formatado = $row->cpf_funcionario;
			if (strlen($cpf_formatado) == 11) {
				$cpf_formatado = substr($cpf_formatado, 0, 3) . '.' . 
								 substr($cpf_formatado, 3, 3) . '.' . 
								 substr($cpf_formatado, 6, 3) . '-' . 
								 substr($cpf_formatado, 9, 2);
			}
			
			// Formatar data de nascimento
			$nascimento = $row->nascimento_funcionario ? date('d/m/Y', strtotime($row->nascimento_funcionario)) : '-';
			
			print "<tr>";
			print "<td>".$row->id_funcionario."</td>";
			print "<td>".$row->nome_funcionario."</td>";
			print "<td>".$cpf_formatado."</td>";
			print "<td>".$row->email_funcionario."</td>";
			print "<td>".$row->telefone_funcionario."</td>";
			print "<td>".$nascimento."</td>";
			print "<td>
				<button class='btn btn-success' onclick=\"location.href='?page=editar-funcionario&id_funcionario={$row->id_funcionario}';\">Editar</button>
				<button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-funcionario&acao=excluir&id_funcionario={$row->id_funcionario}';}else{false}\">Excluir</button>	
				</td>";
			print "</tr>";
		}
		print "</table>";
	} else {
		print "<p class='alert alert-warning'>Não há funcionarios cadastrados.</p>";
	}
?>