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

	public function categoria($id = null)
	{
			$query = $this->db->select('*');
			$query = $this->db->from('categoria');
			if($id != null)
			$query = $this->db->where('idcategoria',$id);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}else
			return null;
	}

		public function productos_detalle($id = null)
		{

		$this->db->from('producto');
		$this->db->join('categoria','categoria.idcategoria = producto.idcategoria','inner');
		if($id != null)
		$this->db->where('categoria.idcategoria', $id);
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
			return  $query->num_rows();
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

	public function productos($array = null)
	{
		$this->db->from('producto');
		$this->db->where_in('idproducto',$array);
		$this->db->join('categoria','categoria.idcategoria = producto.idcategoria','inner');
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
	public function insertArticulos($contenido)
	{
		$this->db->insert('pedido',$contenido);
	}

	public function insertUtiliza($ids,$ultimoid)
	{
		$this->db->insert('utiliza',array(
			'idproducto' => $ids,
			'idpedido' => $ultimoid));
	}

	public function insertTiene($ultimoid)
	{	
		$this->db->insert('tiene',array(
			'idpedido' => $ultimoid,
			'edo' => 0));

	}

}