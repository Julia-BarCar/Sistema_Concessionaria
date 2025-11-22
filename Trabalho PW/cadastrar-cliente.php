<h1>Cadastrar Cliente</h1>
<form action="?page=salvar-cliente" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome
			<input type="text" name="nome_cliente" class="form-control" required>
		</label>
	</div>
	<div class="mb-3">
		<label>CPF
			<input type="text" name="cpf_cliente" class="form-control" maxlength="11" placeholder="Somente números" required>
		</label>
		<small class="form-text text-muted">Digite apenas números (11 dígitos)</small>
	</div>
	<div class="mb-3">
		<label>E-mail
			<input type="email" name="email_cliente" class="form-control" required>
		</label>
	</div>
	<div class="mb-3">
		<label>Telefone
			<input type="text" name="telefone_cliente" class="form-control" required>
		</label>
	</div>
	<div class="mb-3">
		<label>Data de Nascimento
			<input type="date" name="nascimento_cliente" class="form-control">
		</label>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">ENVIAR</button>
	</div>
</form>