<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller {
	
	private $itemMenuActual = '';
	
	public function index()
	{
		$aliasItemMenu = $this->uri->segment($this->uri->total_segments());
		$this->itemMenuActual = $this->obtener_item_menu($aliasItemMenu);
		if(!empty($this->itemMenuActual) && $aliasItemMenu != MENU_ITEM_ALIAS_DEFAULT){
			//Muestra el titulo del item de menu en la barra de titulo
			$this->template->write('titulo', SITIO_NOMBRE.' | '.$this->itemMenuActual->titulo);
			//Configurando pre-contenido para mostrar la ruta donde se encuentra ahora mismo el usuario
			$data['ruta'] = $this->obtener_ruta_actual();
			$this->template->write_view('pre_contenido', 'navigator/'.PLANTILLA.'/ruta', $data);
			//Configurando la vista del contenido
			$data['contenido'] = $this->itemMenuActual->contenido;
			$data['horizontal_1'] = '';
			//Llenando el contenido según el contenedor utilizado para el contenido de la plantilla
			$this->template->write_view('contenido', 'navigator/'.PLANTILLA.'/contenedor_principal', $data);
			if(SIDEBAR_SOLO_EN_INICIO === FALSE){
				$this->template->write_view('sidebar', 'navigator/'.PLANTILLA.'/sidebar');
			}
		}else{
			//Redirecciona al inicio, en caso de no encontrarse un item de menu asociado
			redirect('404', 'Menu no encontrado');
		}
		//Realiza el render de la plantilla actual
		$this->template->render();
	}
	
	/**
	 * Imprime el menu identificado con el parámetro enviado
	 */
	public function imprimir_menu($idCabecera = MENU_ID_DEFAULT)
	{
		$data['menu'] = $this->obtener_menu($idCabecera);
		$this->load->view(PLANTILLA.'/menu', $data);
	}
	
	/**
	 * Imprime el submenu del item representado por el parámetro enviado
	 */
	public function imprimir_submenu($idItemMenu = MENU_ITEM_ID_DEFAULT){
		$this->load->model('menu_model');
		$submenu = $this->menu_model->obtener_submenu($idItemMenu);
		$retorno = '';
		if(sizeof($submenu) > 0){
			$retorno = '<ul>';
			foreach($submenu as $itemMenu){
				$retorno .= '<li '.$this->item_menu_seleccionado($itemMenu['alias'], TRUE).'><a href="'.$this->crear_url_item_menu($itemMenu).'">'.$itemMenu['titulo'].'</a>';
				$retorno .= $this->imprimir_submenu($itemMenu['id']);
				$retorno .= '</li>';
			}
			$retorno .= '<ul>';
		}
		return $retorno;
	}
	
	/**
	 * Devuelve un array con el menú representado por el ID de cabecera enviado como parámetro
	 */
	public function obtener_menu($idCabecera = MENU_ID_DEFAULT){
		$this->load->model('menu_model');
		return $this->menu_model->obtener_menu($idCabecera);
	}
	
	/**
	 * Busca en la BD el item representado por el alias enviado
	 */
	public function obtener_item_menu($aliasItemMenu = MENU_ITEM_ALIAS_DEFAULT){
		$this->load->model('menu_model');
		$itemMenu = $this->menu_model->obtener_item_menu($aliasItemMenu);
		if(isset($itemMenu)){
			return $itemMenu;
		}else{
			return FALSE;
		}
	}
	
	/**
	 * Busca en la BD el item representado por el alias enviado
	 */
	public function obtener_item_menu_por_id($idItemMenu = MENU_ITEM_ID_DEFAULT){
		$this->load->model('menu_model');
		$itemMenu = $this->menu_model->obtener_item_menu_por_id($idItemMenu);
		if(isset($itemMenu)){
			return $itemMenu;
		}else{
			return FALSE;
		}
	}
	
	/**
	 * Devuelve el item de menu actual. Si no lo encuentra, lo busca y lo devuelve
	 */
	public function obtener_item_menu_actual($aliasItemMenu = MENU_ITEM_ALIAS_DEFAULT){
		if(!empty($this->itemMenuActual)){
			return $this->itemMenuActual;
		}else{
			$this->itemMenuActual = $this->obtener_item_menu($aliasItemMenu);
			return $this->itemMenuActual;
		}
	}
	
	/**
	 * Permite saber si el alias enviado es el item en el que se encuentra ahora mismo la página.
	 * Retornar = Si es TRUE, devuelve un String con la clase que muestra un item del menu seleccionado. FALSE simplemente si el item esta seleccionado o no
	 */
	public function item_menu_seleccionado($aliasItemMenu = MENU_ITEM_ALIAS_DEFAULT, $retornar = FALSE){
		$itemMenu = $this->itemMenuActual;
		if($itemMenu == ''){
			$itemMenu = $this->obtener_item_menu_actual();
		}
		if($itemMenu->alias == $aliasItemMenu || ($aliasItemMenu == MENU_ITEM_ALIAS_DEFAULT && (current_url() == base_url()))){
			if($retornar === TRUE){
				return 'class="current"';
			}else{
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
	
	/**
	 * Crea el URL del item de menu enviado
	 */
	public function crear_url_item_menu($itemMenu = FALSE){
		$this->load->helper('url');
		if($itemMenu->alias == MENU_ITEM_ALIAS_DEFAULT || $itemMenu['alias'] == MENU_ITEM_ALIAS_DEFAULT){
			return base_url();
		}else{
			$superiores = $this->obtener_url_superiores($itemMenu['superior']);
			return base_url().MENU_SIMBOLO.'/'.$superiores.$itemMenu['alias']."/";
		}
	}
	
	/**
	 * Crea el URL utilizando el alias del item de menu enviado
	 */
	public function crear_url_item_menu_alias($aliasItemMenu = FALSE){
		$this->load->helper('url');
		$itemMenu = $this->obtener_item_menu($aliasItemMenu);
		if($itemMenu->alias == MENU_ITEM_ALIAS_DEFAULT){
			return base_url();
		}else{
			$superiores = $this->obtener_url_superiores($itemMenu->superior);
			return base_url().MENU_SIMBOLO.'/'.$superiores.$itemMenu->alias."/";
		}
	}
	
	/**
	 * Obtiene la URL de los superiores del item identificado con el ID enviado
	 */
	private function obtener_url_superiores($idItemSuperior = ''){
		if($idItemSuperior != ''){
			$superior = $this->obtener_item_menu_por_id($idItemSuperior);
			if(!empty($superior)){
				//Superior valido
				return $this->obtener_url_superiores($superior->superior).$superior->alias.'/';
			}else{
				//Sin superior
				return '';
			}
		}else{
			return '';
		}
	}
	
	/**
	 * Obtiene un Array con los titulos de la ruta del item de menu actual
	 */
	public function obtener_ruta_actual(){
		$itemMenu = $this->obtener_item_menu_actual();
		$arrayTitulos = array();
		$this->obtener_titulos_superiores($itemMenu->id, $arrayTitulos);
		$itemMenuDefault = $this->obtener_item_menu();
		$arrayTitulos[$itemMenuDefault->titulo] = $this->crear_url_item_menu($itemMenuDefault);
		$arrayTitulos = array_reverse($arrayTitulos);
		return $arrayTitulos;
	}
	
	/**
	 * Dado el id del item superior de un item de menu y un array, llena el array con los titulos de los items de menu superiores y el mismo
	 */
	private function obtener_titulos_superiores($idItemSuperior = '', &$arrayTitulos = array()){
		if($idItemSuperior != ''){
			$superior = $this->obtener_item_menu_por_id($idItemSuperior);
			if(!empty($superior)){
				//Superior valido
				$arrayTitulos[$superior->titulo] = $this->crear_url_item_menu_alias($superior->alias);
				$this->obtener_titulos_superiores($superior->superior, $arrayTitulos);
			}else{
				//Sin superior
				return $arrayTitulos;
			}
		}else{
			return $arrayTitulos;
		}
	}
}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */