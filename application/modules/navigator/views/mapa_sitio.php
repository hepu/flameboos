<?php
$mapa = Modules::run('menu/obtener_menu', 1);
if(isset($mapa)){
?>
<div><?= SITIO_NOMBRE; ?></div>
<ul class="clean col_3">
	<?php
	foreach($mapa as $itemMenu){
		$url = modules::run('menu/crear_url_item_menu', $itemMenu);
		?><li><a href="<?= $url ?>"><?= $itemMenu['titulo']; ?></a></li><?php
	}
	?>
</ul>
<?php } ?>