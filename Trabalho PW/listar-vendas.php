<h1>Listar Vendas</h1>
<?php 
	$sql = "SELECT 
				v.id_venda,
				v.data_venda,
				v.valor_venda,
				c.nome_cliente,
				c.cpf_cliente,
				f.nome_funcionario,
				ma.nome_marca,
				mo.nome_modelo,
				mo.cor_modelo,
				mo.ano_modelo
			FROM venda AS v
			INNER JOIN cliente AS c ON v.cliente_id_cliente = c.id_cliente
			INNER JOIN funcionario AS f ON v.funcionario_id_funcionario = f.id_funcionario
			INNER JOIN modelo AS mo ON v.modelo_id_modelo = mo.id_modelo
			INNER JOIN marca AS ma ON mo.marca_id_marca = ma.id_marca
			ORDER BY v.data_venda DESC, v.id_venda DESC";
	
	$res = $conn->query($sql);
	$qtd = $res->num_rows;

	if ($qtd > 0) {
		print "<p>Encontrou <b>$qtd</b> venda(s) cadastrada(s)!</p>";
		
		// Calcular total de vendas
		$sql_total = "SELECT SUM(valor_venda) as total FROM venda";
		$res_total = $conn->query($sql_total);
		$row_total = $res_total->fetch_object();
		$total_vendas = $row_total->total ? number_format($row_total->total, 2, ',', '.') : '0,00';
		
		print "<p><strong>Valor Total de Vendas: R$ {$total_vendas}</strong></p>";
		
		print "<table class='table table-bordered table-striped table-hover'>";
		print "<tr>";
		print "<th>ID</th>";
		print "<th>Data</th>";
		print "<th>Cliente</th>";
		print "<th>CPF</th>";
		print "<th>Funcionário</th>";
		print "<th>Veículo</th>";
		print "<th>Valor</th>";
		print "<th>Ação</th>";
		print "</tr>";

		while ($row = $res->fetch_object()) {
			$data_formatada = date('d/m/Y', strtotime($row->data_venda));
			$valor_formatado = number_format($row->valor_venda, 2, ',', '.');
			$veiculo = "{$row->nome_marca} {$row->nome_modelo} ({$row->cor_modelo} - {$row->ano_modelo})";
			
			print "<tr>";
			print "<td>{$row->id_venda}</td>";
			print "<td>{$data_formatada}</td>";
			print "<td>{$row->nome_cliente}</td>";
			print "<td>{$row->cpf_cliente}</td>";
			print "<td>{$row->nome_funcionario}</td>";
			print "<td>{$veiculo}</td>";
			print "<td>R$ {$valor_formatado}</td>";
			print "<td>
				<button class='btn btn-success btn-sm' onclick=\"location.href='?page=editar-vendas&id_venda={$row->id_venda}';\">Editar</button>
				<button class='btn btn-danger btn-sm' onclick=\"if(confirm('Tem certeza que deseja excluir esta venda?')){location.href='?page=salvar-vendas&acao=excluir&id_venda={$row->id_venda}';}else{false}\">Excluir</button>	
				</td>";
			print "</tr>";
		}
		print "</table>";
	} else {
		print "<p class='alert alert-warning'>Não há vendas cadastradas.</p>";
	}
?>