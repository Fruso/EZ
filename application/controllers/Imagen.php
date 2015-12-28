<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagen extends CI_Controller {



public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load session library
$this->load->library('session');

// Load validation library
$this->load->library('form_validation');

$this->load->helper('url');

$this->load->model('imagen_model');
$this->load->model('usuario_model');

$this->load->helper(array('form', 'url'));



	if(!$this->session->userdata('logged_in')=='TRUE')
	{
			redirect('login');
	}

}





	function subir()
	{




	
		

		$dato['msj_confirmacion']='';

		if( $this->input->post('post_form_subir')=="1" && !($_FILES['archivo']['name']  == FALSE))
	    {
			$this->load->helper('date');

			$format = '%Y-%m-%d %h:%i';

			$time = time();

			$fecha=mdate($format, $time); 
	
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
			finfo_close($finfo);
			//echo $mime;
			
			//CONTRATA CONTRA TABLA PRODUCTOS
			$codigo = str_replace(".JPG", "", strtoupper($_FILES['archivo']['name']));
			$producto_tupla = $this->imagen_model->ver_producto($codigo)->row_array();
				

		    	if(!($_FILES['archivo']['type']=="image/jpeg") || !($mime=="image/jpeg") ||  $producto_tupla['id']==false )
				{
					/*
					header('HTTP/1.1 500 Internal Server Error');
					redirect('imagen/subir/','refresh');
					*/

						if(!($_FILES['archivo']['type']=="image/jpeg"))
						{
						    $response_array['Error '] = 'Extencion de archivo no valido';  
					   	    header('HTTP/1.1 500 Internal Server Error');
    						echo json_encode($response_array);
    						redirect('imagen/subir/','refresh');
    					}


    					if(!($mime=="image/jpeg"))
						{
						    $response_array['Error '] = 'archivo no valido';  
					   	    header('HTTP/1.1 500 Internal Server Error');
    						echo json_encode($response_array);
    						redirect('imagen/subir/','refresh');
    					}

    					if( $producto_tupla['id']==false )
						{
						    $response_array['Error '] = 'Codigo de Fotografia no existe';  
					   	    header('HTTP/1.1 500 Internal Server Error');
    						echo json_encode($response_array);
    						redirect('imagen/subir/','refresh');
    					}
    					
				}
				$tipo_archivo="jpg";




		if($this->session->userdata('id_rol')==1 ||  $this->session->userdata('id_rol')==2 ||  $this->session->userdata('id_rol')==3 )
		{
			$grupo_rol=100;
		}else
		{
			$grupo_rol=0;
		}

				$imagen = array('codigo' => ''.$codigo,
        				 'estado' => 0,
        				 'tamano' => ($_FILES["archivo"]["size"] / 1024),
        				 'tipo' => $tipo_archivo,
        				 'subido_por' =>  $this->session->userdata('id_usuario'),
                         'fecha_creacion' => $fecha,
              			 'id_rol' => $grupo_rol);

				$id_imagen=$this->imagen_model->insertar($imagen);

	
					
				$target_path = "public/images/img_total_subidas/".$id_imagen.".".$tipo_archivo;

			
				
				//$target_path = $target_path . basename( $_FILES['archivo']['name']);
				//echo $target_path;

				if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) 
				{
			
				} else {
				 			$response_array['Error '] = 'No Subido';  
					   	    header('HTTP/1.1 500 Internal Server Error');
    						echo json_encode($response_array);
    						redirect('imagen/subir/','refresh');
				}

				$dato['msj_confirmacion'] = '<div class="alert alert-success"><strong>Accion realizada!</strong> .</div>';

				//
		}else if( $this->input->post('post_form_subir')=="1") 
		{
		
			$dato['msj_confirmacion'] = '<div class="alert alert-danger"><strong>Accion no realizada!</strong> .</div>';
		}


		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('foto/subir_fotos',$dato);
		  $this->load->view('estructura/footer');

	}




	function listar()
	{	



		$this->load->library('table');
		$this->load->model('usuario_model');

		$tmpl = array ( 'table_open'  => '<table  class="table table-striped">' );

		$this->table->set_template($tmpl);

		$this->table->set_heading('Fotografía', 'Código', 'Subido por', 'Fecha', 'Estado', 'Acción');




		//FILTRO
		$filtro='';
		if(!( $this->input->post('filtro')  == FALSE  ) )
		{
			$filtro="filtrar/".$this->input->post('filtro');
			redirect('imagen/listar/pag/0/'.$filtro,'refresh');
		}

		$filtro_url='';
		$filtro_opcion='';
		if( !($this->uri->segment(6)  == FALSE ) )
		{
			$filtro_url='filtrar/'.$this->uri->segment(6);
			
			if($this->uri->segment(6)==1)
			{
				$filtro_opcion='';
			}
			if($this->uri->segment(6)==2)
			{
				$filtro_opcion='where estado=0 ';
			}
			if($this->uri->segment(6)==3)
			{
				$filtro_opcion='where estado=1 ';
			}
			if($this->uri->segment(6)==4)
			{
				$filtro_opcion='where estado=2 ';
			}
			if($this->uri->segment(6)==5)
			{
				$filtro_opcion='5';
			}
			if($this->uri->segment(6)==6)
			{
				$filtro_opcion='';
			}						
		}

		//FIN FILTRO


		//PAGINACION 
		$incremento=10;
		$num_pagina=$this->uri->segment(4);
		$num_pagina_sig=$num_pagina+$incremento;
		$num_pagina_ant=$num_pagina-$incremento;

		//echo "".$this->uri->segment(4);

		


		$dato['pag_siguiente']='<li><a href="'.base_url().'index.php/imagen/listar/pag/'.$num_pagina_sig.'/'.$filtro_url.'">siguiente</a></li>';
		
		if(($this->uri->segment(4) == FALSE) || $num_pagina==0)
		{
			$dato['pag_anterior']='';
			$num_pagina=0;
		}else{
			$dato['pag_anterior']='<li><a href="'.base_url().'index.php/imagen/listar/pag/'.$num_pagina_ant.'/'.$filtro_url.'">Atrás</a></li>';
		}

		if($this->session->userdata('validar_fotos')=='TRUE')
		{
			$tabla = $this->imagen_model->listar_imagenes_totales($incremento,$num_pagina,$filtro_opcion);
			$dato['num_estado_pendientes'] = $this->imagen_model->contar_estados_admin("0");
			$dato['num_estado_aprobadas'] = $this->imagen_model->contar_estados_admin("1");
			$dato['num_estado_rechazadas'] = $this->imagen_model->contar_estados_admin("2");
			if(!( $this->input->post('buscar_codigo')  == FALSE ))
			$tabla = $this->imagen_model->listar_imagenes_por_codigo(trim($this->input->post('buscar_codigo')));
		}else
		{
			$tabla = $this->imagen_model->listar_imagenes_por_usuario($this->session->userdata('id_usuario'),$incremento,$num_pagina,$filtro_opcion);
			$dato['num_estado_pendientes'] = $this->imagen_model->contar_estados($this->session->userdata('id_usuario'),"0");
			$dato['num_estado_aprobadas'] = $this->imagen_model->contar_estados($this->session->userdata('id_usuario'),"1");
			$dato['num_estado_rechazadas'] = $this->imagen_model->contar_estados($this->session->userdata('id_usuario'),"2");


		}
		//FIN PAGINACION	

		foreach ($tabla->result_array() as $row)
   		{
   			if($row['estado']==0)
   			{$estado="<span class='label label-warning'>Pendiente</span>";}
   			else if($row['estado']==1)
   			{$estado="<span class='label label-success'>Aprobada</span>";}
			else if($row['estado']==2)
   			{$estado="<span class='label label-danger'>Rechazada</span>";}
   			else if($row['estado']==3)
   			{$estado="<span class='label label-default'>Obsoleta</span>";}

			$usuario_result = $this->usuario_model->ver_usuario_especifio($row['subido_por']);
			$usuario_tupla = $usuario_result->row_array(); 

   			$nombre=$usuario_tupla['nombre']." ".$usuario_tupla['apellido'];



		 	$this->table->add_row('<div class="zona_imagen_lista">'.'<center><img src="'.base_url().'public/images/img_total_subidas/'.$row['id_imagen'].'.'.$row['tipo'].'" alt="" width="100px"  height="100px"></center>'.'</div>', $row['codigo'], $nombre, $row['fecha_creacion'], $estado,  "<a href='".base_url()."index.php/imagen/ver/". $row['id_imagen']."' class='btn btn-primary' role='button'>Detalle</a> ");
		}

		$dato['tabla_listado_imagenes'] = $this->table->generate();


      

		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('foto/listar',$dato);
		  $this->load->view('estructura/footer');
	}



	function ver($id)
	{
		$this->load->library('table');

		$imagen_result = $this->imagen_model->ver($id);
		$imagen_tupla = $imagen_result->row_array();

		if($imagen_tupla['estado']==0){ $estado_texto = "Pendiente";}
		if($imagen_tupla['estado']==1){ $estado_texto = "Aprobada";}
		if($imagen_tupla['estado']==2){ $estado_texto = "Rechazada";}
		if($imagen_tupla['estado']==3){ $estado_texto = "Obsoleta";}


		$usuario_tupla_subido_por = $this->usuario_model->ver_usuario_especifio($imagen_tupla['subido_por'])->row_array();
		$usuario_tupla_validado_por = $this->usuario_model->ver_usuario_especifio($imagen_tupla['validado_por'])->row_array();
		
		if(($imagen_tupla['validado_por']  == FALSE))
		{ 
			$nombre_validado_por = "--";
		}
		else
		{
			$nombre_validado_por=$usuario_tupla_validado_por['nombre']." ".$usuario_tupla_validado_por['apellido'];
		}

		if($imagen_tupla['fecha_validacion']=="0000-00-00 00:00:00")
		{
			$fecha_validacion="--";
		}else
		{
			$fecha_validacion=$imagen_tupla['fecha_validacion'];
		}

		

		$dato['imagen_mostrar']='<center><img src="'.base_url().'public/images/img_total_subidas/'.$imagen_tupla['id_imagen'].'.'.$imagen_tupla['tipo'].'" alt="" class="img-rounded" width="60%" height="60%"></center>';


		$tmpl = array ( 'table_open'  => '<table  class="table .table-bordered">' );

		$this->table->set_template($tmpl);

		$this->table->set_heading('Id', 'Código', 'Subido por', 'Fecha Ingreso', 'Tamaño (KB)', 'Validado Por', 'Fecha Validación', 'Estado');

		$this->table->add_row($imagen_tupla['id_imagen'], $imagen_tupla['codigo'],$usuario_tupla_subido_por['nombre']." ".$usuario_tupla_subido_por['apellido'], $imagen_tupla['fecha_creacion'], $imagen_tupla['tamano'], $nombre_validado_por , $fecha_validacion, $estado_texto );
		
		$dato['imagen_detalle_tabla']= $this->table->generate();

		$dato['codigo']=$imagen_tupla['codigo'];


         if($imagen_tupla['estado']>0)
         {

         	if($imagen_tupla['comentario']==1){ $motivo_texto='<option value="1">1. Aprobada - cumple con todas las condiciones</option>';}
         	if($imagen_tupla['comentario']==2){ $motivo_texto='<option value="2">2. Rechazada - Mala calidad de imagen</option>';}
         	if($imagen_tupla['comentario']==3){ $motivo_texto='<option value="3">3. Rechazada - Imagen no corresponde a producto</option>';}
         	if($imagen_tupla['comentario']==4){ $motivo_texto='<option value="4">4. Rechazada - Ángulo de imagen no válido</option>';}

         	   $dato['combobox_motivo']= '<select class="form-control"  name="motivo" >'.$motivo_texto.'</select>';
         }else
         {
         	   $dato['combobox_motivo']= '<select class="form-control"  name="motivo">
               <option value="1">1. Aprobada - cumple con todas las condiciones</option>
               <option value="2">2. Rechazada - Mala calidad de imagen</option>
               <option value="3">3. Rechazada - Imagen no corresponde a producto</option>
               <option value="4">4. Rechazada - Ángulo de imagen no válido</option>
              </select>';
         }     



$dato['textarea_observaciones'] = '<div class="form-group">
  <label for="comment">Comentario:</label>
  <textarea class="form-control" rows="5" id="comment" name="observaciones">'.$imagen_tupla['observaciones'].'</textarea>
  </div>';





		//DATOS GENERALES PAGINA
		$dato['link_post_form']= base_url()."index.php/imagen/imagen_validar/".$id;
		$dato['link_volver']= base_url()."index.php/imagen/listar";


		if(!$this->session->userdata('validar_fotos')=='TRUE')
		{
			$dato['boton_deshabilitar']= "disabled";
		}



  		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('foto/detalle',$dato);
		  $this->load->view('estructura/footer');
	}

	function imagen_validar($id)
	{
		$imagen_tupla = $this->imagen_model->ver($id)->row_array();



		if(!$imagen_tupla['estado']==0)
		{
			//CAMBIOS YA FUERON REALIZADOS ENTONCES SALIR
 			redirect('imagen/ver/'.$id,'refresh'); 
		}
		if(!$this->session->userdata('validar_fotos')=='TRUE')
		{
			//SI NO CUENTA CON EL PERMISO "validar_fotos" RETORNA HACIA LA VISTA DETALLE IMAGEN.
 			redirect('imagen/ver/'.$id,'refresh'); 
		}

		$this->load->helper('date');

		$format = '%Y-%m-%d %h:%i';

		$time = time();

		$fecha=mdate($format, $time); 

		if($this->input->post('motivo')==1)
		{
			//IMAGEN APROBADA
			$estado=1;
			$this->imagen_model->actualizar_estado_imagenes_aprobadas($this->input->post('codigo'));

			$this->session->set_flashdata('msj_confirmacion', '<div class="alert alert-success"><strong>Fotografía aprobada por '.$this->session->userdata('nombre').' '.$this->session->userdata('apellido').'!</strong></div>');
		}else if($this->input->post('motivo') > 1)
		{
			//IMAGEN RECHAZADA
			$estado=2;
			$this->session->set_flashdata('msj_confirmacion', '<div class="alert alert-success"><strong>Fotografía rechazada por '.$this->session->userdata('nombre').' '.$this->session->userdata('apellido').'!</strong></div>');
		}


	
			
		
	   $target_path_copy = "public/images/img_total_subidas/".$id.".".$imagen_tupla['tipo'];
	  

	   //$target_path_paste = "public/images/products/".$imagen_tupla['codigo'].".JPG";

		$target_path_paste = "/var/www/desarrollo-ez/cake/app/webroot/img/products/".$imagen_tupla['codigo'].".JPG";

		copy( $target_path_copy, $target_path_paste);


		$imagen = array('estado' => $estado,
                    'comentario' => $this->input->post('motivo'),
                  'validado_por' => $this->session->userdata('id_usuario'),
              'fecha_validacion' => $fecha,
              'observaciones' => $this->input->post('observaciones'));

         $this->imagen_model->actualizar($id,$imagen);

         
   		 

        redirect('imagen/ver/'.$id,'refresh');    


	}
   
}
