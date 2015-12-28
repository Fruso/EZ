<?php
class imagen_model extends CI_Model  {
   function __construct(){
      parent::__construct ();
      $this->load->database(); 
   }


	function actualizar($id_imagen,$imagen)
	{
        $this->db->where('id_imagen', $id_imagen);
        $this->db->update('imagen', $imagen); 
	}

	function insertar($imagen)
	{
		  $this->db->insert('imagen', $imagen); 
          return $this->db->insert_id();
	}



	function eliminar()
	{
		
	}

	function listar_imagenes_totales($limit,$offset,$filtro_opcion)
	{
        
        if($filtro_opcion=='5')
		{
			$query = $this->db->query("select * from imagen where id_rol=100 order by id_imagen desc LIMIT ".$limit." OFFSET ".$offset);
		}else
		{
			$query = $this->db->query("select * from imagen ".$filtro_opcion." order by id_imagen desc LIMIT ".$limit." OFFSET ".$offset);
		}
        return $query;
	}
	
	function listar_imagenes_por_usuario($id,$limit,$offset,$filtro_opcion)
	{
		
		if($filtro_opcion=='5')
		{
			//ESTA LINEA ES INUTIL, PERO MANTIENE FACILMENTE LA LOGICA DE LO QUE YA HAY
			$query = $this->db->query("select * from imagen where imagen.subido_por=".$id." and id_rol=100 order by id_imagen desc LIMIT ".$limit." OFFSET ".$offset);
		}else
		{
			$query = $this->db->query("select * from imagen where imagen.subido_por=".$id." ".str_replace("where","and",$filtro_opcion)." order by id_imagen desc LIMIT ".$limit." OFFSET ".$offset);
		}

        return $query;
	}


	function listar_imagenes_por_codigo($codigo)
	{
		
		$query = $this->db->query("select * from imagen where codigo='".$codigo."' order by id_imagen desc");

        return $query;
	}





	function ver($id_imagen)
	{
		return $this->db->query("select * from imagen where id_imagen=".$id_imagen);
	}


	function ver_producto($id_producto)
	{
		return $this->db->query("select * from products where code='".$id_producto."'");
	}

	function contar_estados($id_usuario,$estado)
	{
		$fila = $this->db->query("select count(id_imagen) as cantidad from imagen where subido_por='".$id_usuario."' and estado= ".$estado )->row_array();
		return $fila['cantidad'];
	}

	function contar_estados_admin($estado)
	{
		$fila = $this->db->query("select count(id_imagen) as cantidad from imagen where estado= ".$estado )->row_array();
		return $fila['cantidad'];
	}	

	function actualizar_estado_imagenes_aprobadas($codigo)
	{
		$this->db->query("update imagen set estado=3 where codigo='".$codigo."' and estado=1"  );
	}		
   
}