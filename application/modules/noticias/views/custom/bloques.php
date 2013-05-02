<?php
//Asegurando el numero de columnas en caso de numeros erroneos
if(!isset($columnas)){ $columnas = NOTICIAS_VISTA_BLOQUE_COLUMNAS_DEFAULT; }
if($columnas > 12){ $columnas = 12; }
if($columnas < 1){ $columnas = 1; }
$anchoColumnas = intval(12/$columnas);
$contenidoColumnas = array();
$contadorAux = 0;

$cantidadNoticias = sizeof($noticias);

if($cantidadNoticias == 1){
	$anchoColumnas = 12;
}
foreach($noticias as $noticia):
	if(!isset($contenidoColumnas[$contadorAux])){
		$contenidoColumnas[$contadorAux] = array();
	}
	//Agregar la noticia al array de la columna
	array_push($contenidoColumnas[$contadorAux], $noticia);
	if($contadorAux == $columnas-1){
		$contadorAux = 0;
	}else{
		$contadorAux++;
	}
endforeach;
?>
<div id="noticias_bloques" class="col_12">
	<?php for($i = 0; $i < $columnas; $i++): 
		if(!array_key_exists($i, $contenidoColumnas)){
			break;
		}
	?>
	<section class="col_<?= $anchoColumnas ?>">
		<?php foreach($contenidoColumnas[$i] as $noticia): ?>
			<?php
			//Variables auxiliares de la noticia
			$urlNoticia = Modules::run('noticias/obtener_url_noticia', $noticia);
			?>
			<article class="col_12">
				<?php
				//Si la noticia tiene imagen se muestra
				if($noticia['imagen'] != ''): ?>
				<div class="imagen center"><a href="<?= $urlNoticia ?>"><img src="<?= Modules::run('noticias/preparar_url_imagen', $noticia['imagen']) ?>" /></a></div>
				<?php endif; ?>
				<header class="col_12">
					<div class="titulo col_12"><a href="<?= $urlNoticia ?>"><?= $noticia['titulo']; ?></a></div>
					<div class="fecha_publicacion col_12"><?= date('d / M / Y', strtotime($noticia['fecha_publicacion'])); ?></div>
				</header>
				<div class="contenido col_12"><?= $noticia['contenido']; ?></div>
			</article>
		<?php endforeach; ?>
	</section>
	<?php endfor; ?>
</div>