<?php require "pages/header.php" ?>

<div class="container">
	<h1><strong>Login</strong></h1>


	<?php
	$usuarios = new Usuarios();

	if(isset($_POST['email']) && !empty($_POST['email'])){
		$email = addslashes($_POST['email']);
		$senha = $_POST['senha'];

		if($usuarios->login($email, $senha)){
			$id = $_SESSION['cLogin'];
			if ($usuarios->usuarioLogado($id)) {
				if($_SESSION['pendente'] == 0){
				?>

				<script type="text/javascript">window.location.href="./";</script>
				<?php
				}
				else{
					?>
					<div class="alert alert-danger">
						Usuario ainda pendente !!<br/>
						Espere o administrador confirma-lo<br/>
						Em até 24 horas
					</div>
					<?php
				}
			}
		}else{
			?>
			<div class="alert alert-danger">
				Usuario e/ou senha errados!!!
			</div>
			<?php
		}
	}



	?>
</div>

<div class="container">
	<form method="POST">

		<div class="form-group">
			<label for="email">Email: </label>
			<input type="email" name="email" id="email" class="form-control">
		</div>

		<div class="form-group">
			<label for="senha">Senha: </label>
			<input type="password" name="senha" id="senha" class="form-control">
		</div>

		<button type="submit" class="btn btn-default">Fazer Login</button>
	</form>
</div>

<?php require "pages/footer.php" ?>