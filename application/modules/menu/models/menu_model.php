<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {
	
	/**
	 * Devuelve el menú dado el ID de la cabecera
	 */
	public function obtener_menu($idCabecera = '1')
	{
		$this->load->database();
		$where = array('menu_cabeceras_id' => $idCabecera, 'menu_items_superior' => NULL);
		$this->db->select('menu_items_titulo titulo,
							menu_items_alias alias,
							menu_items_id id, 
							menu_items_contenido contenido,
							menu_items_estado estado,
							menu_items_orden orden,
							menu_items_superior superior')->from('ob_menu_items')->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/**
	 * Devuelve el menú dado el alias de la cabecera
	 */
	public function obtener_item_menu($aliasItemMenu = MENU_ITEM_ALIAS_DEFAULT)
	{
		$this->load->database();
		$this->db->select('menu_items_titulo titulo,
							menu_items_alias alias,
							menu_items_id id, 
							menu_items_contenido contenido,
							menu_items_estado estado,
							menu_items_orden orden,
							menu_items_superior superior')->from('ob_menu_items')->where('menu_items_alias', $aliasItemMenu)->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
	
	/**
	 * Devuelve el menú dado el ID de la cabecera
	 */
	public function obtener_item_menu_por_id($idItemMenu = MENU_ITEM_ID_DEFAULT)
	{
		$this->load->database();
		$this->db->select('menu_items_titulo titulo,
							menu_items_alias alias,
							menu_items_id id, 
							menu_items_contenido contenido,
							menu_items_estado estado,
							menu_items_orden orden,
							menu_items_superior superior')->from('ob_menu_items')->where('menu_items_id', $idItemMenu)->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
	
	/**
	 * Devuelve el submenu del item de menu asociado con la ID enviada
	 */
	public function obtener_submenu($idItemMenu = MENU_ITEM_ID_DEFAULT){
		$this->load->database();
		$where = array('menu_items_superior' => $idItemMenu);
		$this->db->select('menu_items_titulo titulo,
							menu_items_alias alias,
							menu_items_id id, 
							menu_items_contenido contenido,
							menu_items_estado estado,
							menu_items_orden orden,
							menu_items_superior superior')->from('ob_menu_items')->where($where)->where_not_in('menu_items_superior', NULL);
		$query = $this->db->get();
		return $query->result_array();
	}
}
/* End of file menu_model.php */
/* Location: ./application/models/menu_model.php */