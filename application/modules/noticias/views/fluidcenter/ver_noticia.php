<div class="col_12">
	<a href="<?= base_url().NOTICIAS_URL_BASE; ?>">&lt;&lt; Volver a Noticias</a>
</div>
<section id="noticia">
	<?php if($noticia['imagen'] != ''): ?>
	<div class="imagen col_12 center"><img src="<?= Modules::run('noticias/preparar_url_imagen', $noticia['imagen']) ?>" /></div>
	<?php endif; ?>
	<header class="col_12">
		<h2 id="titulo"><?= $noticia['titulo']; ?></h2>
		<address id="fecha_publicacion"><?= date('d-M-Y', strtotime($noticia['fecha_publicacion'])); ?></address>
	</header>
	<div class="col_12 contenido"><?= $noticia['contenido']; ?></div>
</section>