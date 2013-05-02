<?php foreach($noticias as $noticia): ?>
	<div class="col_12" style="margin: 10px 0; padding: 10px; background: #DDD;">
		<article class="col_12">
			<div id="imagen" class="col_3 center">
				<img src="<?= Modules::run('noticias/preparar_url_imagen', $noticia['imagen']) ?>" />
			</div>
			<div class="col_1">&nbsp;</div>
			<div id="contenido" class="col_8">
				<a href="<?= Modules::run('noticias/obtener_url_noticia', $noticia); ?>">
					<header class="col_12">
						<?= $noticia['titulo'] ?>
					</header>
				</a>
				<div id="fecha_pub" class="col_12">
					<?= $noticia['fecha_publicacion'] ?>
				</div>
				<div class="col_12">
					<?= substr($noticia['contenido'], 0, 60).'...' ?>
				</div>
			</div>
		</article>
	</div>
<?php endforeach; ?>