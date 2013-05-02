<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigator extends MX_Controller {
	
	/**
	 * Pantalla de inicio / Landing page
	 */
	public function index()
	{
		$this->template->write('titulo', SITIO_NOMBRE);
		//Configurando contenido del precontenido
		$this->template->write('pre_contenido', 'Pre Contenido');
		//Configurando contenido del inicio
		$data['contenido'] = Modules::run('noticias/obtener_vista_noticias');
		$data['horizontal_1'] = '<div style="text-align: center">Espacio horizontal diseñado para pequeños Widgets</div>';
		$this->template->write_view('sidebar', PLANTILLA.'/sidebar');
		$this->template->write_view('contenido', PLANTILLA.'/contenedor_principal', $data);
		$this->template->render();
	}
	
	/**
	 * Imprime la vista del copyright
	 */
	public function copyright(){
		$this->load->view('copyright');
	}
	
	/**
	 * Imprime el mapa del sitio
	 */
	public function mapa_sitio(){
		$this->load->view('mapa_sitio');
	}
}

/* End of file navigator.php */