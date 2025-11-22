<h1>Salvar Venda</h1>
<?php 
	switch (@$_REQUEST['acao']) {
		case 'cadastrar':
			$cliente_id = $_POST['cliente_id_cliente'];
			$funcionario_id = $_POST['funcionario_id_funcionario'];
			$modelo_id = $_POST['modelo_id_modelo'];
			$data_venda = $_POST['data_venda'];
			$valor_venda = $_POST['valor_venda'];

			// Buscar o CPF correto do cliente no banco de dados
			$sql_cpf = "SELECT cpf_cliente FROM cliente WHERE id_cliente = {$cliente_id}";
			$res_cpf = $conn->query($sql_cpf);
			
			if ($res_cpf && $res_cpf->num_rows > 0) {
				$row_cpf = $res_cpf->fetch_object();
				$cliente_cpf = $row_cpf->cpf_cliente;

				$sql = "INSERT INTO venda (
							data_venda, 
							valor_venda, 
							cliente_id_cliente, 
							cliente_cpf_cliente, 
							funcionario_id_funcionario, 
							modelo_id_modelo
						) VALUES (
							'{$data_venda}', 
							'{$valor_venda}', 
							{$cliente_id}, 
							'{$cliente_cpf}', 
							{$funcionario_id}, 
							{$modelo_id}
						)";
				
				$res = $conn->query($sql);

				if ($res == true) {
					print "<script>alert('Venda cadastrada com sucesso!');</script>";
					print "<script>location.href='?page=listar-vendas';</script>";
				} else {
					print "<script>alert('Não foi possível cadastrar a venda! Erro: {$conn->error}');</script>";
					print "<script>location.href='?page=cadastrar-vendas';</script>";
				}
			} else {
				print "<script>alert('Cliente não encontrado! Por favor, cadastre o cliente primeiro.');</script>";
				print "<script>location.href='?page=cadastrar-vendas';</script>";
			}
			break;

		case 'editar':
			$id_venda = $_POST['id_venda'];
			$cliente_id = $_POST['cliente_id_cliente'];
			$funcionario_id = $_POST['funcionario_id_funcionario'];
			$modelo_id = $_POST['modelo_id_modelo'];
			$data_venda = $_POST['data_venda'];
			$valor_venda = $_POST['valor_venda'];

			// Buscar o CPF correto do cliente no banco de dados
			$sql_cpf = "SELECT cpf_cliente FROM cliente WHERE id_cliente = {$cliente_id}";
			$res_cpf = $conn->query($sql_cpf);
			
			if ($res_cpf && $res_cpf->num_rows > 0) {
				$row_cpf = $res_cpf->fetch_object();
				$cliente_cpf = $row_cpf->cpf_cliente;

				$sql = "UPDATE venda SET 
							data_venda = '{$data_venda}',
							valor_venda = '{$valor_venda}',
							cliente_id_cliente = {$cliente_id},
							cliente_cpf_cliente = '{$cliente_cpf}',
							funcionario_id_funcionario = {$funcionario_id},
							modelo_id_modelo = {$modelo_id}
						WHERE id_venda = {$id_venda}";
				
				$res = $conn->query($sql);

				if ($res == true) {
					print "<script>alert('Venda editada com sucesso!');</script>";
					print "<script>location.href='?page=listar-vendas';</script>";
				} else {
					print "<script>alert('Não foi possível editar a venda! Erro: {$conn->error}');</script>";
					print "<script>location.href='?page=editar-vendas&id_venda={$id_venda}';</script>";
				}
			} else {
				print "<script>alert('Cliente não encontrado!');</script>";
				print "<script>location.href='?page=editar-vendas&id_venda={$id_venda}';</script>";
			}
			break;

		case 'excluir':
			$id_venda = $_REQUEST['id_venda'];
			$sql = "DELETE FROM venda WHERE id_venda = {$id_venda}";
			$res = $conn->query($sql);

			if ($res == true) {
				print "<script>alert('Venda excluída com sucesso!');</script>";
				print "<script>location.href='?page=listar-vendas';</script>";
			} else {
				print "<script>alert('Não foi possível excluir a venda! Erro: {$conn->error}');</script>";
				print "<script>location.href='?page=listar-vendas';</script>";
			}
			break;

		default:
			print "<script>alert('Ação inválida!');</script>";
			print "<script>location.href='?page=listar-vendas';</script>";
			break;
	}
?>