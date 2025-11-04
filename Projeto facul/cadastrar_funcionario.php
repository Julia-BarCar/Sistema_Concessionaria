<h2>Área de Cadastramento de Funcionários</h2>
<form action="?page=salvar_funcionario" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome
			<input type="text" name="nome_funcionario" class="form-control" required>
		</label>
	</div>
	<div class="mb-3">
		<label>E-mail
			<input type="email" name="email_funcionario" class="form-control" required>
		</label>
	</div>
	<div class="mb-3">
		<label>Telefone
			<input type="number" name="telefone_funcionario" class="form-control" required>
		</label>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">ENVIAR</button>
	</div>
</form>