<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
	$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	$infoSite->execute();
	$infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $infoSite['titulo']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,300&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="descrition" content="Descrição do meu website">
	<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico">
	<meta charset="utf-8">
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'depoimentos':
				echo '<target target="depoimentos">';
				break;
			
			case 'servicos':
				echo '<target target="servicos">';
				break;
		}
	?>

	<?php new Email(); ?>

	<div class="sucesso">Formulário enviado com sucesso!</div>

	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH; ?>images/ajax-loader.gif">
	</div><!--overlay-->

	<header>
		<div class="center">
		<div class="logo left"><a href="">Jhonw_Black</a></div><!--Logo-->
		<nav class="desktop right">
			<ul>
				<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
				<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
			</ul>
		</nav><!--Desktop-->
		<nav class="mobile right">
			<div class="botao-menu-mobile">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div><!--bars-->
			<ul>
				<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
				<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
			</ul>
		</nav><!--Mobile-->
		<div class="clear"></div>
	</div><!--center-->
	</header>
	<div class="container-principal">
	<?php

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			//Podemos fazer o que quiser, pois a página não existe.
			if($url != 'depoimentos' && $url != 'servicos'){
				$urlPar = explode('/',$url)[0];
				if($urlPar != 'noticias'){
				$pagina404 = true;
				include('pages/404.php');
				}else{
					include('pages/noticias.php');
				}
			}else{
				include('pages/home.php');
			}
		}

	?>
	</div><!--container-principal-->

	<footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'; ?>>
		<div class="center">
			<p>Todos os direitos resercados</p>
		</div><!--center-->
	</footer>
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>

	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

	<?php
		if(is_array($url) && strstr($url[0],'noticias') !== false){
	?>
		<script>
			$(function(){
				$('select').change(function(){
					location.href=include_path+"noticias/"+$(this).val();
				})
			})
		</script>
	<?php
		}
	?>

	<?php 
		if($url == 'contato'){
	?>
	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBnv7y3NuVB3H7-6XXXbtFUYOsvWql_d-8&'></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
	<?php } ?>
	<!-- <script src="<1?php// echo INCLUDE_PATH; ?>js/exemplo.js"></script> -->
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
</body>
</html>