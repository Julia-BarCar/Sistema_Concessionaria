<h1>Cadastrar Marca</h1>
<form action = "?page=salvar-marca" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome
		<input type="text" name="nome_marca" class="form-control" required>
	</label>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">ENVIAR</button>
	</div>
</form>