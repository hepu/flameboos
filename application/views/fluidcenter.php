<!DOCTYPE html>
<html><head>
<title><?= $titulo; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="<?= SITIO_DESC ?>" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/html_kickstart/js/prettify.js"></script>                                   <!-- PRETTIFY -->
<script type="text/javascript" src="<?= base_url(); ?>assets/html_kickstart/js/kickstart.js"></script>                                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/html_kickstart/css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet/less" type="text/css" href="<?= base_url(); ?>assets/plantillas/<?= PLANTILLA ?>/css/style.less" media="all" />	<!-- CUSTOM STYLES -->
<?php if(isset($_styles)){ echo $_styles; } ?>
<?php if(isset($_scripts)){ echo $_scripts; } ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/less.js"></script>                                  					<!-- LESS -->

</head>
<body>

<div class="grid">
<!-- ===================================== FIN CABECERA ===================================== -->

<header id="header" class="col_12">
	<div class="wrapper_1200">
		<div id="logo">LOGO</div>
	</div>
	<div id="menu">
		<div class="wrapper_1200">
			<?= Modules::run('menu/imprimir_menu') ?>
		</div>
	</div>
</header>

<section id="pre_contenido" class="col_12">
	<div class="wrapper_1200">
		<?= $pre_contenido ?>
	</div>
</section>

<section id="cuerpo">
	<div class="wrapper_1200">
		<?php if($sidebar != ''){ ?>
		<div class="col_3">
			<aside id="sidebar" class="col_12">
				<?php if($sidebar != ''){ echo $sidebar; } ?>
			</aside>
		</div>
		<?php } ?>
		<div <?php if($sidebar != ''){ ?>class="col_9"<?php }else{ ?>class="col_12"<?php } ?>>
			<section id="contenedor_contenido" class="col_12">
				<?= $contenido ?>
			</section>
		</div>
	</div>
</section>

<footer class="col_12">
	<div class="wrapper_1200">
		<div id="mapa_sitio">
			<?= Modules::run('navigator/mapa_sitio'); ?>
		</div>
		<div id="copyright" class="col_12">
			<div class="wrapper_1200">
				<?= Modules::run('navigator/copyright'); ?>
			</div>
		</div>
	</div>
</footer>

<!-- ===================================== INICIO PIECERA ===================================== -->
</div><!-- END GRID-->

</body></html>