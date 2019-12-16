<?php
class Usuarios{
	public function getTotalUsuarios(){
		global $pdo;

		$sql = $pdo->query("SELECT count(*) as c from usuarios");
		$row = $sql->fetch();

		return $row['c'];
	}

	public function cadastrar($nome, $email, $senha, $telefone, $cpf) {
		global $pdo;
		$sql = $pdo->prepare("SELECT id from usuarios where email = :email");
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() == 0) {
			$sql = $pdo->prepare("INSERT INTO usuarios set nome = :nome, email = :email, senha = :senha, telefone = :telefone, cpf = :cpf, pendente = 1");

			$sql->bindValue(":email", $email);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":senha", md5($senha));
			$sql->bindValue(":telefone", $telefone);
			$sql->bindValue(":cpf", $cpf);
			$sql->execute();

			return true;
		}else{
			return false;
		}
	}

	public function getUsuarios(){
		global $pdo;

		$array = array();
		$sql = $pdo->prepare("SELECT * from usuarios where usuarios.pendente = 0");
		$sql->execute();

		if($sql->rowCount() > 0)
			$array = $sql->fetchAll();

		return $array;
	}

	public function primeiroCadastro($nome, $email, $senha, $telefone, $cpf) {
		global $pdo;
		$sql = $pdo->prepare("SELECT id from usuarios where email = :email");
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() == 0) {
			$sql = $pdo->prepare("INSERT INTO usuarios set nome = :nome, email = :email, senha = :senha, telefone = :telefone, cpf = :cpf, pendente = 1");

			$sql->bindValue(":email", $email);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":senha", md5($senha));
			$sql->bindValue(":telefone", $telefone);
			$sql->bindValue(":cpf", $cpf);
			$sql->execute();

			return true;
		}else{
			return false;
		}
	}

	public function login($email, $senha){
		global $pdo;
		$sql = $pdo->prepare("SELECT id,nivelusuario, pendente from usuarios where email = :email and senha = :senha");
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0){
			$dado = $sql->fetch();
			$_SESSION['cLogin'] = $dado['id'];
			$_SESSION['nivel'] = $dado['nivelusuario'];
			$_SESSION['pendente'] = $dado['pendente'];
			
			return true;

		}
		else{
			return false;
		}

	}

	public function usuarioLogado($id){
		global $pdo;
		$sql = $pdo->prepare("SELECT nome from usuarios where id = :id");
		$sql->bindValue(":id",$id);
		$sql->execute();


		if($sql->rowCount() > 0){
			$usuaLogado = $sql->fetch();
			$_SESSION['usuLogado'] = $usuaLogado['nome'];
			return true;
		}
		else{
			return false;
		}

	}

	public function getUltimosUsuariosPendentes($page, $perPage, $pendencia){
		global $pdo;

		$offset = ($page - 1) * $perPage;

		$array = array();

		$sql = $pdo->prepare("SELECT
			* from usuarios where pendente = :pendencia order by id desc limit $offset, $perPage");

		$sql->bindValue(":pendencia", $pendencia);
		$sql->execute();

		if($sql->rowCount() > 0)
			$array = $sql->fetchAll();

		return $array;
	}

	public function getTotalUsuariosPendentes($pendencia){
		global $pdo;

		$sql = $pdo->prepare("SELECT count(*) as c from usuarios where pendente = :pendencia");

		$sql->bindValue(":pendencia",$pendencia);
		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function confirmarUsuario($id){
		global $pdo;

		$sql = $pdo->prepare("UPDATE usuarios SET pendente = 0 WHERE usuarios.id = :id");

		$sql->bindValue(":id", $id);
		$sql->execute();

	}

	public function deleteUsuario($id){
		global $pdo;

		$sql = $pdo->prepare("DELETE from usuarios where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

	}
}

?>