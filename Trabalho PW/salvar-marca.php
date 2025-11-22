<h1>Salvar Marca</h1>
<?php 
	switch (@$_REQUEST['acao']) {
		case 'cadastrar':
			$nome = mysqli_real_escape_string($conn, $_POST['nome_marca']);
			
			// Buscar o próximo ID disponível
			$sql_max = "SELECT COALESCE(MAX(id_marca), 0) + 1 as proximo_id FROM marca";
			$res_max = $conn->query($sql_max);
			$row_max = $res_max->fetch_object();
			$proximo_id = $row_max->proximo_id;

			$sql = "INSERT INTO marca (id_marca, nome_marca) VALUES ({$proximo_id}, '{$nome}')";
			$res = $conn->query($sql);

			if ($res == true) {
				print"<script>alert('Cadastrou com sucesso!');</script>";
				print"<script>location.href='?page=listar-marca';</script>";
			} else {
				print"<script>alert('Não cadastrou!');</script>";
				print"<script>location.href='?page=listar-marca';</script>";
			}
			break;
		case 'editar':
			$nome = mysqli_real_escape_string($conn, $_POST['nome_marca']);
			$sql = "UPDATE marca SET nome_marca='{$nome}' WHERE id_marca=".$_REQUEST['id_marca'];
			$res = $conn->query($sql);
			if ($res == true) {
				print "<script>alert('Editou com sucesso!');</script>";
				print "<script>location.href='?page=listar-marca';</script>";
			} else {
				print "<script>alert('Não editou!');</script>";
				print "<script>location.href='?page=listar-marca';</script>";
			}
			break;
		case 'excluir':
			$sql = "DELETE FROM marca WHERE id_marca=".$_REQUEST['id_marca'];
			$res = $conn->query($sql);
			if ($res == true) {
				print "<script>alert('Excluiu com sucesso!');</script>";
				print "<script>location.href='?page=listar-marca';</script>";
			} else {
				print "<script>alert('Não excluiu!');</script>";
				print "<script>location.href='?page=listar-marca';</script>";
			}
			break;
	}
 ?>