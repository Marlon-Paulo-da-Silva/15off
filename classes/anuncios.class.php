<?php

class Anuncios
{

	public function getTotalAnuncios($filtros)
	{
		global $pdo;

		$filtroString = array('1=1');
		if (!empty($filtros['categoria'])) {
			$filtroString[] = 'anuncios.id_categoria = :id_categoria';
		}
		if (!empty($filtros['preco'])) {
			$filtroString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
		}
		if (!empty($filtros['estado'])) {
			$filtroString[] = 'anuncios.estado = :estado';
		}

		$sql = $pdo->prepare("SELECT count(*) as c from anuncios where pendente = 0 AND " . implode(' AND ', $filtroString));

		if (!empty($filtros['categoria'])) {
			$sql->bindValue(":id_categoria", $filtros['categoria']);
		}
		if (!empty($filtros['preco'])) {
			$preco = explode('-', $filtros['preco']);
			$sql->bindValue(":preco1", $preco[0]);
			$sql->bindValue(":preco2", $preco[1]);
		}
		if (!empty($filtros['estado'])) {
			$sql->bindValue(":estado", $filtros['estado']);
		}

		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getTotalAnunciosPendentes($pendencia)
	{
		global $pdo;

		$sql = $pdo->prepare("SELECT count(*) as c from anuncios where pendente = :pendencia");

		$sql->bindValue(":pendencia", $pendencia);
		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getUltimosAnunciosComFiltro($page, $perPage, $filtros)
	{
		global $pdo;

		$offset = ($page - 1) * $perPage;

		$array = array();

		$filtroString = array('1=1');

		if (!empty($filtros['categoria'])) {
			$filtroString[] = 'anuncios.id_categoria = :id_categoria';
		}
		if (!empty($filtros['preco'])) {
			$filtroString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
		}
		if (!empty($filtros['estado'])) {
			$filtroString[] = 'anuncios.estado = :estado';
		}


		$sql = $pdo->prepare("SELECT
			*,
			(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url,
			(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
			(select usuarios.nome from usuarios where anuncios.id_usuario = usuarios.id) as nomeDoVendedor
			from anuncios where pendente = 0 AND " . implode(' AND ', $filtroString) . " order by id desc limit $offset, $perPage");
		if (!empty($filtros['categoria'])) {
			$sql->bindValue(":id_categoria", $filtros['categoria']);
		}
		if (!empty($filtros['preco'])) {
			$preco = explode('-', $filtros['preco']);
			$sql->bindValue(":preco1", $preco[0]);
			$sql->bindValue(":preco2", $preco[1]);
		}
		if (!empty($filtros['estado'])) {
			$sql->bindValue(":estado", $filtros['estado']);
		}
		$sql->execute();

		if ($sql->rowCount() > 0)
			$array = $sql->fetchAll();

		return $array;
	}

	public function getUltimosAnunciosPendentes($page, $perPage, $pendencia)
	{
		global $pdo;

		$offset = ($page - 1) * $perPage;

		$array = array();

		$sql = $pdo->prepare("SELECT
			*,
			(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url,
			(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
			(select usuarios.nome from usuarios where anuncios.id_usuario = usuarios.id) as nomeDoVendedor
			from anuncios where pendente = :pendencia order by id desc limit $offset, $perPage");

		$sql->bindValue(":pendencia", $pendencia);
		$sql->execute();

		if ($sql->rowCount() > 0)
			$array = $sql->fetchAll();

		return $array;
	}


	public function getMeusAnuncios()
	{
		global $pdo;

		$array = array();
		$sql = $pdo->prepare("SELECT
			*,
			(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url from anuncios
			where id_usuario = :id_usuario");
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->execute();

		if ($sql->rowCount() > 0)
			$array = $sql->fetchAll();

		return $array;
	}

	public function addAnuncio($titulo, $categoria, $valor, $descricao, $estado, $redesocial, $fotos, $site)
	{
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO anuncios set id_categoria = :id_categoria ,id_usuario = :id_usuario, titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado, pendente = true, redesocial = :redesocial, site = :site");
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":estado", $estado);
		$sql->bindValue(":redesocial", $redesocial);
		$sql->bindValue(":site", $site);
		$sql->execute();

		$id = $pdo->lastInsertId();


		if (count($fotos) > 0) {
			for ($i = 0; $i < count($fotos['tmp_name']); $i++) {

				$tipo = $fotos['type'][$i];

				if (in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time() . rand(0, 8888)) . '.jpg';

					move_uploaded_file($fotos['tmp_name'][$i], 'assets/images/anuncios/' . $tmpname);

					list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/' . $tmpname);

					$ratio = $width_orig / $height_orig;

					$width = 500;
					$height = 500;

					if ($width / $height > $ratio) {
						$width = $height * $ratio;
					} else {
						$height = $width / $ratio;
					}


					$img = imagecreatetruecolor($width, $height);

					if ($tipo == 'image/jpeg') {
						$origin = imagecreatefromjpeg('assets/images/anuncios/' . $tmpname);
					} else if ($tipo == 'image/png') {
						$origin = imagecreatefrompng('assets/images/anuncios/' . $tmpname);
					}

					imagecopyresampled($img, $origin, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, 'assets/images/anuncios/' . $tmpname, 75);

					$sql = $pdo->prepare("INSERT into anuncios_imagens set id_anuncio = :id_anuncio, url = :url");
					$sql->bindValue(":id_anuncio", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();
				}
			}
		}
	}




	public function editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id)
	{
		global $pdo;
		$sql = $pdo->prepare("UPDATE anuncios set titulo = :titulo, id_categoria = :categoria, descricao = :descricao, valor = :valor, estado = :estado where anuncios.id = :id");
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":categoria", $categoria);
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":estado", $estado);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if (count($fotos) > 0) {
			for ($i = 0; $i < count($fotos['tmp_name']); $i++) {

				$tipo = $fotos['type'][$i];

				if (in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time() . rand(0, 8888)) . '.jpg';

					move_uploaded_file($fotos['tmp_name'][$i], 'assets/images/anuncios/' . $tmpname);

					list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/' . $tmpname);

					$ratio = $width_orig / $height_orig;

					$width = 500;
					$height = 500;

					if ($width / $height > $ratio) {
						$width = $height * $ratio;
					} else {
						$height = $width / $ratio;
					}


					$img = imagecreatetruecolor($width, $height);

					if ($tipo == 'image/jpeg') {
						$origin = imagecreatefromjpeg('assets/images/anuncios/' . $tmpname);
					} else if ($tipo == 'image/png') {
						$origin = imagecreatefrompng('assets/images/anuncios/' . $tmpname);
					}

					imagecopyresampled($img, $origin, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, 'assets/images/anuncios/' . $tmpname, 75);

					$sql = $pdo->prepare("INSERT into anuncios_imagens set id_anuncio = :id_anuncio, url = :url");
					$sql->bindValue(":id_anuncio", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();
				}
			}
		}
	}
	public function getAnuncio($id)
	{
		$array = array();
		global $pdo;


		$sql = $pdo->prepare("SELECT *,
			(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
			(select usuarios.telefone from usuarios where anuncios.id_usuario = usuarios.id) as telefone,
			(select usuarios.nome from usuarios where anuncios.id_usuario = usuarios.id) as nomeDoVendedor
			from anuncios where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();



		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();
			$sql = $pdo->prepare("SELECT id,url
				from anuncios_imagens where id_anuncio = :id_anuncio");
			$sql->bindValue(":id_anuncio", $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}
		}

		return $array;
	}

	public function deleteAnuncio($id)
	{
		global $pdo;


		$sql = $pdo->prepare("DELETE from anuncios_imagens where id_anuncio = :id_anuncio");
		$sql->bindValue(":id_anuncio", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE from anuncios where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluiFoto($id)
	{
		global $pdo;

		$id_anuncio = 0;

		$sql = $pdo->prepare("SELECT id_anuncio from anuncios_imagens where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$id_anuncio = $row['id_anuncio'];
		}


		$sql = $pdo->prepare("DELETE from anuncios_imagens where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $id_anuncio;
	}

	public function confirmarAnuncio($id)
	{
		global $pdo;

		$sql = $pdo->prepare("UPDATE anuncios SET pendente = 0 WHERE anuncios.id = :id");

		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}
