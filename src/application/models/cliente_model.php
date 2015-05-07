<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Cliente Model
*/

class Cliente_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function productos($id = null)
	{
			$query = $this->db->select('*');
			$query = $this->db->from('producto');
			if($id != null)
			$query = $this->db->where('idproducto',$id);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}else
			return null;
	}

		public function productos_detalle($id = null)
		{

		$this->db->select('nombre,tipo,talla,marca,existencias,color,producto.idproducto');
		$this->db->from('producto');
		$this->db->join('detalle','producto.idproducto = detalle.idproducto','inner');
		if($id != null)
		$this->db->where('producto.idproducto', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}
	}


	public function pedidos_count($id = null)
		{
		$this->db->from('pedido');
		$this->db->where('users_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $this->db->count_all_results();
		}
		else
		{
			return 0;
		}
	}

	public function pedidos($id = null)
	{
		$this->db->select('*');
		$this->db->from('pedido');
		$this->db->where('users_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}
	}
}