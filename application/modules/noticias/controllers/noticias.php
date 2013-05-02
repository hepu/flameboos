<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends MX_Controller {

	public function index(){
		$idNoticia = $this->uri->segment($this->uri->total_segments()-1);
		$verNoticia = FALSE;
		$this->cargar_css();
		if($idNoticia != NULL){
			$this->load->model('noticias_model');
			$noticia = $this->noticias_model->obtener_noticia($idNoticia);
			if($noticia != NULL){
				$verNoticia = TRUE;
				$subtitulo = $noticia['titulo'];
				$data['noticia'] = $noticia;
				$ruta['ruta'] = array('Inicio' => base_url(), 'Noticias' => base_url().'noticias', $noticia['titulo'] => $this->obtener_url_noticia($noticia));
				$this->template->write_view('pre_contenido', 'navigator/'.PLANTILLA.'/ruta', $ruta);
				$this->template->write_view('contenido', PLANTILLA.'/ver_noticia', $data);
			}
		}
		if($verNoticia === FALSE){
			$subtitulo = 'Noticias'; //Configurar subtitulo
			$data['noticias'] = $this->obtener_noticias();
			$this->template->write_view('contenido', $this->obtener_vista_default(), $data); //Configurando contenido
			$ruta['ruta'] = array('Inicio' => base_url(), 'Noticias' => base_url().'noticias');
			$this->template->write_view('pre_contenido', 'navigator/'.PLANTILLA.'/ruta', $ruta);
		}
		if(SIDEBAR_SOLO_EN_INICIO === FALSE){ $this->template->write_view('sidebar', 'navigator/'.PLANTILLA.'/sidebar'); } //Mostrar sidebar si esta habilitada la opcion
		$this->template->write('titulo', SITIO_NOMBRE.' | '.$subtitulo);
		$this->template->render();
	}

	private function cargar_css(){
		//Incluir CSS noticias
		$this->template->add_less(RUTA_ASSETS.'noticias/css/noticias.less');
	}

	public function obtener_noticias($cantidad = 6){
		//Obtener las noticias de la DB
		$this->load->model('noticias_model');
		if(!isset($cantidad)){
			$cantidad = '';
		}
		return $this->noticias_model->obtener_noticias($cantidad);
	}
	
	/**
	 * Devuelve la vista de las noticias segun el tipo y los parametros que se hayan enviado
	 */
	public function obtener_vista_noticias($tipoVista = NOTICIAS_VISTA, $parametros = array()){
		$this->cargar_css();
		$data = array();
		foreach($parametros as $indice => $valor){
			$data[$indice] = $valor;
		}
		//Obtener las noticias de la DB
		$this->load->model('noticias_model');
		if(!isset($data['cantidad'])){
			$data['cantidad'] = '';
		}
		$data['noticias'] = $this->noticias_model->obtener_noticias($data['cantidad']);
		$this->load->view($this->obtener_vista_default(), $data);
	}
	
	public function obtener_url_noticia($noticia = NULL){
		return base_url().NOTICIAS_URL_BASE.'/'.$noticia['id'].'/'.url_title($noticia['titulo'], 'dash', true);
	}
	
	public function obtener_url_noticia_segun_id($idNoticia = 0){
		$this->load->model('noticias_model');
		$noticia = $this->noticias_model->obtener_noticia($idNoticia);
		if($noticia != NULL)
			return base_url().NOTICIAS_URL_BASE.'/'.$noticia['id'].'/'.url_title($noticia['titulo'], 'dash', true);
		else
			return base_url().'noticias';
	}
	
	public function preparar_url_imagen($archivoImagen = ''){
		if($archivoImagen == ''){
			$archivoImagen = 'empty.png';
		}
		return base_url().RUTA_IMAGENES.$archivoImagen;
	}
	
	private function obtener_vista_default(){
		switch(NOTICIAS_VISTA){
			case NOTICIAS_VISTA_DEFAULT:
				return PLANTILLA.'/noticias';
			break;
			default:
				return 'custom/'.NOTICIAS_VISTA;
		}
	}
}

/* End of file noticias.php */