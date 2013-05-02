<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias_model extends CI_Model {
	
	//Los campos utilizados de la noticia en las vistas
	private $camposNoticia = 'noticias_id id,
							noticias_titulo titulo,
							noticias_contenido contenido, 
							noticias_imagen imagen,
							noticias_fechapublicacion fecha_publicacion,
							noticias_fechacreacion fecha_creacion';
	
	/**
	 * Obtiene una noticia según su ID
	 */
	public function obtener_noticia($idNoticia = NULL){
		if($idNoticia != NULL){
			$this->load->database();
			$where = array('noticias_estado' => 'A', 'noticias_id' => $idNoticia);
			$this->db->select($this->camposNoticia);
			$this->db->from('ob_noticias');
			$this->db->where($where);
			$this->db->limit(1);
			$query = $this->db->get();
			return $query->row_array();
		}else{
			return NULL;
		}
	}
	
	/**
	 * Devuelve el menú dado el ID de la cabecera
	 */
	public function obtener_noticias($cantidad = '')
	{
		$this->load->database();
		$where = array('noticias_estado' => 'A');
		$this->db->select($this->camposNoticia);
		$this->db->from('ob_noticias');
		$this->db->where($where);
		if($cantidad != ''){
			$this->db->limit($cantidad);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
}
/* End of file noticias_model.php */