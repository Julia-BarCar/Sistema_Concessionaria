<h1>Editar Venda</h1>
<?php 
	$sql = "SELECT * FROM venda WHERE id_venda = ".$_REQUEST['id_venda'];
	$res = $conn->query($sql);
	$row = $res->fetch_object();
?>
<form action="?page=salvar-vendas" method="POST">
	<input type="hidden" name="acao" value="editar">
	<input type="hidden" name="id_venda" value="<?php print $row->id_venda; ?>">
	
	<div class="mb-3">
		<label>Cliente
			<select name="cliente_id_cliente" class="form-control" required>
				<option value="">-= Escolha o Cliente =-</option>
				<?php 
					$sql_cliente = "SELECT * FROM cliente ORDER BY nome_cliente";
					$res_cliente = $conn->query($sql_cliente);
					$qtd_cliente = $res_cliente->num_rows;
					if ($qtd_cliente > 0) {
						while ($row_cliente = $res_cliente->fetch_object()) {
							$selected = ($row->cliente_id_cliente == $row_cliente->id_cliente) ? 'selected' : '';
							print "<option value='{$row_cliente->id_cliente}' data-cpf='{$row_cliente->cpf_cliente}' {$selected}>{$row_cliente->nome_cliente} - {$row_cliente->cpf_cliente}</option>";
						}
					} else {
						print "<option>Não há clientes cadastrados</option>";
					}
				?>
			</select>
		</label>
	</div>

	<div class="mb-3">
		<label>CPF do Cliente
			<input type="text" name="cliente_cpf_cliente" class="form-control" id="cpf_cliente" value="<?php print $row->cliente_cpf_cliente; ?>" readonly required>
		</label>
	</div>

	<div class="mb-3">
		<label>Funcionário
			<select name="funcionario_id_funcionario" class="form-control" required>
				<option value="">-= Escolha o Funcionário =-</option>
				<?php 
					$sql_func = "SELECT * FROM funcionario ORDER BY nome_funcionario";
					$res_func = $conn->query($sql_func);
					$qtd_func = $res_func->num_rows;
					if ($qtd_func > 0) {
						while ($row_func = $res_func->fetch_object()) {
							$selected = ($row->funcionario_id_funcionario == $row_func->id_funcionario) ? 'selected' : '';
							print "<option value='{$row_func->id_funcionario}' {$selected}>{$row_func->nome_funcionario}</option>";
						}
					} else {
						print "<option>Não há funcionários cadastrados</option>";
					}
				?>
			</select>
		</label>
	</div>

	<div class="mb-3">
		<label>Modelo do Veículo
			<select name="modelo_id_modelo" class="form-control" required>
				<option value="">-= Escolha o Modelo =-</option>
				<?php 
					$sql_modelo = "SELECT mo.*, ma.nome_marca 
								   FROM modelo AS mo
								   INNER JOIN marca AS ma ON mo.marca_id_marca = ma.id_marca
								   ORDER BY ma.nome_marca, mo.nome_modelo";
					$res_modelo = $conn->query($sql_modelo);
					$qtd_modelo = $res_modelo->num_rows;
					if ($qtd_modelo > 0) {
						while ($row_modelo = $res_modelo->fetch_object()) {
							$selected = ($row->modelo_id_modelo == $row_modelo->id_modelo) ? 'selected' : '';
							print "<option value='{$row_modelo->id_modelo}' {$selected}>{$row_modelo->nome_marca} - {$row_modelo->nome_modelo} ({$row_modelo->cor_modelo} - {$row_modelo->ano_modelo})</option>";
						}
					} else {
						print "<option>Não há modelos cadastrados</option>";
					}
				?>
			</select>
		</label>
	</div>

	<div class="mb-3">
		<label>Data da Venda
			<input type="date" name="data_venda" class="form-control" value="<?php print $row->data_venda; ?>" required>
		</label>
	</div>

	<div class="mb-3">
		<label>Valor da Venda (R$)
			<input type="number" name="valor_venda" class="form-control" step="0.01" min="0" value="<?php print $row->valor_venda; ?>" required>
		</label>
	</div>

	<div>
		<button type="submit" class="btn btn-primary">SALVAR</button>
		<a href="?page=listar-vendas" class="btn btn-secondary">CANCELAR</a>
	</div>
</form>

<script>
	// Script para preencher automaticamente o CPF quando selecionar o cliente
	document.querySelector('select[name="cliente_id_cliente"]').addEventListener('change', function() {
		var selectedOption = this.options[this.selectedIndex];
		var cpf = selectedOption.getAttribute('data-cpf');
		document.getElementById('cpf_cliente').value = cpf || '';
	});
</script>