<ul class="breadcrumbs">
	<?php foreach($ruta as $titulo => $url): ?>
	<li><a href="<?= $url ?>"><?= $titulo ?></a></li>
	<?php endforeach ?>
</ul>