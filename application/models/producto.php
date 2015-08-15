<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
		class Producto extends CI_Model 
		{
			
			public function listado()	
			{
				$query=$this->db->get("producto");
				$resultado=$query->result_array();
				return $resultado;

			}

			public function insert($datos)
			{
				if($this->db->insert("producto",$datos))
					return true;
				else
					return false;

			}

			public function delete($id)
			{
				if($this->db->delete("producto",array("id"=>$id)))
					return true;
				else
					return false;
			}

			public function update($id,$datos)
			{	
				$this->db->where("id",$id);
				if($this->db->update("producto",$datos))
					return true;
				else
					return false;
			}

			public function getProductoId($id)
			{
				$query=$this->db->get_where("producto",array("id"=>$id));
				$resultado=$query->result_array();
					return $resultado[0];
			}

			public function getTalles($id)
			{
				$sql="select rt.*,t.numero from relacion_talle rt 
						inner join talle t on rt.id_talle=t.id
						where rt.id_producto=".$id;
				$query=$this->db->query($sql);
				$resultado=$query->result_array();
				if (count($resultado)>0)
					return $resultado;
				else
					return false;
			}

			public function getComboTalles($id_producto,$tipo)
			{
				$sql="SELECT * FROM talle where id NOT IN (select id_talle from relacion_talle where id_producto=".$id_producto.") AND tipo_producto=".$tipo;
				$query=$this->db->query($sql);
				$resultado=$query->result_array();
				return $resultado;

			}

			public function outlet($id_producto,$id_talle,$temporada)
			{

				$this->db->where('id_producto',$id_producto);
				$this->db->where('id_talle',$id_talle);
				if($this->db->update('relacion_talle',array('outlet'=>1,'temporada'=>$temporada)))
					return true;
				else
					return false;
			}

			public function getOutlet()
			{
				$sql="SELECT * FROM relacion_talle r 
				INNER JOIN producto  p ON (r.id_producto=p.id) 
				LEFT JOIN talle t ON (r.id_talle = t.id)
				WHERE r.outlet=1";
				$query = $this->db->query($sql);
				$resultado=$query->result_array();
				if (count($resultado)>0)
					return $resultado;
				else
					return false;

			}
		
		}
		
		/* End of file producto.php */
		/* Location: ./application/models/producto.php */
?>