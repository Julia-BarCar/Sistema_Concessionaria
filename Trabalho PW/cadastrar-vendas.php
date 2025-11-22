<h1>Cadastrar Venda</h1>
<form action="?page=salvar-vendas" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	
	<div class="mb-3">
		<label>Cliente
			<select name="cliente_id_cliente" class="form-control" required>
				<option value="">-= Escolha o Cliente =-</option>
				<?php 
					$sql = "SELECT * FROM cliente ORDER BY nome_cliente";
					$res = $conn->query($sql);
					$qtd = $res->num_rows;
					if ($qtd > 0) {
						while ($row = $res->fetch_object()) {
							print "<option value='{$row->id_cliente}' data-cpf='{$row->cpf_cliente}'>{$row->nome_cliente} - {$row->cpf_cliente}</option>";
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
			<input type="text" name="cliente_cpf_cliente" class="form-control" id="cpf_cliente" readonly required>
		</label>
	</div>

	<div class="mb-3">
		<label>Funcionário
			<select name="funcionario_id_funcionario" class="form-control" required>
				<option value="">-= Escolha o Funcionário =-</option>
				<?php 
					$sql = "SELECT * FROM funcionario ORDER BY nome_funcionario";
					$res = $conn->query($sql);
					$qtd = $res->num_rows;
					if ($qtd > 0) {
						while ($row = $res->fetch_object()) {
							print "<option value='{$row->id_funcionario}'>{$row->nome_funcionario}</option>";
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
					$sql = "SELECT mo.*, ma.nome_marca 
							FROM modelo AS mo
							INNER JOIN marca AS ma ON mo.marca_id_marca = ma.id_marca
							ORDER BY ma.nome_marca, mo.nome_modelo";
					$res = $conn->query($sql);
					$qtd = $res->num_rows;
					if ($qtd > 0) {
						while ($row = $res->fetch_object()) {
							print "<option value='{$row->id_modelo}'>{$row->nome_marca} - {$row->nome_modelo} ({$row->cor_modelo} - {$row->ano_modelo})</option>";
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
			<input type="date" name="data_venda" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
		</label>
	</div>

	<div class="mb-3">
		<label>Valor da Venda (R$)
			<input type="number" name="valor_venda" class="form-control" step="0.01" min="0" placeholder="0.00" required>
		</label>
	</div>

	<div>
		<button type="submit" class="btn btn-primary">ENVIAR</button>
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