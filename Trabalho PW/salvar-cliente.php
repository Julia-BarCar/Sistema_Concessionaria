<h1>Salvar Cliente</h1>
<?php 
	switch (@$_REQUEST['acao']) {
		case 'cadastrar':
			$nome = $_POST['nome_cliente'];
			$cpf = $_POST['cpf_cliente'];
			$email = $_POST['email_cliente'];
			$telefone = $_POST['telefone_cliente'];
			$nascimento = isset($_POST['nascimento_cliente']) ? $_POST['nascimento_cliente'] : null;

			// Validar CPF (apenas números)
			$cpf = preg_replace('/[^0-9]/', '', $cpf);
			
			if (strlen($cpf) != 11) {
				print"<script>alert('CPF inválido! Deve conter 11 dígitos.');</script>";
				print"<script>location.href='?page=cadastrar-cliente';</script>";
				break;
			}

			$sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, telefone_cliente, nascimento_cliente) 
					VALUES ('{$nome}', '{$cpf}', '{$email}', '{$telefone}', " . ($nascimento ? "'{$nascimento}'" : "NULL") . ")";
			$res = $conn->query($sql);

			if ($res == true) {
				print"<script>alert('Cadastrou com sucesso!');</script>";
				print"<script>location.href='?page=listar-cliente';</script>";
			} else {
				print"<script>alert('Não cadastrou! Erro: {$conn->error}');</script>";
				print"<script>location.href='?page=listar-cliente';</script>";
			}
			break;
			
		case 'editar':
			$nome = $_POST['nome_cliente'];
			$cpf = $_POST['cpf_cliente'];
			$email = $_POST['email_cliente'];
			$telefone = $_POST['telefone_cliente'];
			$nascimento = isset($_POST['nascimento_cliente']) ? $_POST['nascimento_cliente'] : null;
			
			// Validar CPF (apenas números)
			$cpf = preg_replace('/[^0-9]/', '', $cpf);
			
			if (strlen($cpf) != 11) {
				print"<script>alert('CPF inválido! Deve conter 11 dígitos.');</script>";
				print"<script>location.href='?page=editar-cliente&id_cliente={$_REQUEST['id_cliente']}';</script>";
				break;
			}

			$sql = "UPDATE cliente SET 
						nome_cliente='{$nome}', 
						cpf_cliente='{$cpf}',
						email_cliente='{$email}', 
						telefone_cliente='{$telefone}',
						nascimento_cliente=" . ($nascimento ? "'{$nascimento}'" : "NULL") . "
					WHERE id_cliente=".$_REQUEST['id_cliente'];
			$res = $conn->query($sql);
			
			if ($res == true) {
				print "<script>alert('Editou com sucesso!');</script>";
				print "<script>location.href='?page=listar-cliente';</script>";
			} else {
				print "<script>alert('Não editou! Erro: {$conn->error}');</script>";
				print "<script>location.href='?page=listar-cliente';</script>";
			}
			break;
			
		case 'excluir':
			$sql = "DELETE FROM cliente WHERE id_cliente=".$_REQUEST['id_cliente'];
			$res = $conn->query($sql);
			if ($res == true) {
				print "<script>alert('Excluiu com sucesso!');</script>";
				print "<script>location.href='?page=listar-cliente';</script>";
			} else {
				print "<script>alert('Não excluiu!');</script>";
				print "<script>location.href='?page=listar-cliente';</script>";
			}
			break;
	}
?>