<?php
	$url = explode('/',$_GET['url']);

	$verifica_categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$categoria_info = $verifica_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
		if($post->rowCount() == 0){
			Painel::redirect(INCLUDE_PATH.'noticias');
		}

		$post = $post->fetch();
?>
<section class="noticia-single">
	<div class="center">
		<header>
			<h1><i class="fa fa-calendar"></i> <?php echo $post['data'] ?> - <?php echo $post['titulo'] ?></h1>
		</header>
		<article>
			<?php echo $post['conteudo']; ?>
		</article>
		<?php
			if(Painel::logado() == false){
		?>
		<div class="container-erro-login">
			<p><i class="fa fa-times"></i> Você precisa estar logado para comentar, clique <a href="<?php echo INCLUDE_PATH ?>painel">aqui</a>
			para efetuar o login.</p>
		</div>
		<?php
		}else{?>
			<?php
				if(isset($_POST['postar_comentario'])){
					$nome = $_POST['nome'];
					$comentario = $_POST['mensagem'];
					$noticia_id = $_POST['noticia_id'];

					$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.comentarios` VALUES (null,?,?,?)");
					$sql->execute(array($nome,$comentario,$noticia_id));
					echo '<script>alert("Comentario realizado com sucesso!")</script>';
				}
			?>
			<h2 class="postar_comentario">Faça um comentário <i class="fa fa-comment"></i></h2>
			<form method="post">
				<input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">
				<textarea name="mensagem" placeholder="Seu comentário..."></textarea>
				<input type="hidden" name="noticia_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="postar_comentario" value="Comentar">
			</form>
			<br>
			<h2 class="postar_comentario">Comentário existentes<i class="fa fa-comment"></i></h2>
			<?php
				$comentario = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentarios` WHERE noticia_id = ?");
				$comentario->execute(array($post['id']));
				$comentario = $comentario->fetchAll();
				foreach($comentario as $key => $value){
			?>
			<div class="box-coment-noticia">
				<h3><?php echo $value['nome'] ?></h3>
				<p><?php echo $value['comentario'] ?></p> /*id | comentario_id | nome | comentario*/
			<form method="post">
				<input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">
				<textarea name="mensagem" placeholder="Seu comentário..."></textarea>
				<input type="hidden" name="noticia_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="postar_comentario" value="Comentar">
			</form>
			</div>
		<?php } ?>
	<?php } ?>
	</div>
</section>