<h1>Listar Cliente</h1>
<?php 
	$sql = "SELECT * FROM cliente";
	$res = $conn->query($sql);
	$qtd = $res->num_rows;

	if ($qtd > 0) {
		print "<p>Encontrou <b>$qtd</b> cliente(s) cadastrado(s)!</p>";
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
			$cpf_formatado = $row->cpf_cliente;
			if (strlen($cpf_formatado) == 11) {
				$cpf_formatado = substr($cpf_formatado, 0, 3) . '.' . 
								 substr($cpf_formatado, 3, 3) . '.' . 
								 substr($cpf_formatado, 6, 3) . '-' . 
								 substr($cpf_formatado, 9, 2);
			}
			
			// Formatar data de nascimento
			$nascimento = $row->nascimento_cliente ? date('d/m/Y', strtotime($row->nascimento_cliente)) : '-';
			
			print "<tr>";
			print "<td>".$row->id_cliente."</td>";
			print "<td>".$row->nome_cliente."</td>";
			print "<td>".$cpf_formatado."</td>";
			print "<td>".$row->email_cliente."</td>";
			print "<td>".$row->telefone_cliente."</td>";
			print "<td>".$nascimento."</td>";
			print "<td>
				<button class='btn btn-success' onclick=\"location.href='?page=editar-cliente&id_cliente={$row->id_cliente}';\">Editar</button>
				<button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-cliente&acao=excluir&id_cliente={$row->id_cliente}';}else{false}\">Excluir</button>	
				</td>";
			print "</tr>";
		}
		print "</table>";
	} else {
		print "<p class='alert alert-warning'>Não há clientes cadastrados.</p>";
	}
?>