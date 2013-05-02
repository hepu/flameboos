<ul class="menu">
<?php
	foreach($menu as $itemMenu){
		$url = modules::run('menu/crear_url_item_menu', $itemMenu);
		$claseItem = modules::run('menu/item_menu_seleccionado', $itemMenu['alias'], TRUE);
		?>
		<li <?= $claseItem ?>><a href="<?= $url ?>"><?= $itemMenu['titulo']; ?></a>
	       <?= modules::run('menu/imprimir_submenu', $itemMenu['id']) ?>
     	</li>
		<?php
	}
?>
</ul>