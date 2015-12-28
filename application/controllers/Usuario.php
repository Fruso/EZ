<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {



public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load session library
$this->load->library('session');

// Load validation library
$this->load->library('form_validation');

$this->load->helper('url');

$this->load->model('Usuario_model');

$this->load->model('Rbac_model');



	//Validar Acceso

	if(!$this->session->userdata('logged_in')=='TRUE')
	{
			redirect('login');
	}

	
}




	public function index()
	{
		
  	



	}







	function Ver($id){

	
	

		$dato['dato_usuario'] = $this->Usuario_model->ver_usuario_especifio($id);


		$dato['roles'] =  $this->Rbac_model->listar_roles();

		$dato['get_usuario_rol'] =  $this->Rbac_model->get_usuario_rol($id);


   		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('usuario/form_ver',$dato);
		  $this->load->view('estructura/footer');
	}	
  




	function Editar($id){

	
	
		/*
		if($this->input->post('actualizar_confirmar')==1)
		{

			$dato['msj_confirmacion'] = '<div class="alert alert-success"><strong>accion realizada!</strong> .</div>';
		}*/

		if($this->input->post('actualizar')==1)
		{

	    	if( $this->input->post('clave')=="")
	    	{

	    		    $persona = array('nombre' => $this->input->post('nombre'),
        				'apellido' => $this->input->post('apellido'),
                          'correo' => $this->input->post('correo'));
	    			$this->Usuario_model->actualizar($id,$persona, $this->input->post('rol'));



	    	}else
	    	{
	    			$persona = array('nombre' => $this->input->post('nombre'),
        				'apellido' => $this->input->post('apellido'),
        				 'clave' => md5( $this->input->post('clave')),
                          'correo' => $this->input->post('correo'));
	    			$this->Usuario_model->actualizar($id,$persona, $this->input->post('rol'));
	    	}

	    	$dato['msj_confirmacion'] = '<div class="alert alert-success"><strong>accion realizada!</strong> .</div>';

    	  $dato['dato_usuario'] = $this->Usuario_model->ver_usuario_especifio($id);
		  $dato['roles'] =  $this->Rbac_model->listar_roles();
		  $dato['get_usuario_rol'] =  $this->Rbac_model->get_usuario_rol($id);

		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('usuario/form_editar',$dato);
		  $this->load->view('estructura/footer');

		}else
		{
		  $dato['dato_usuario'] = $this->Usuario_model->ver_usuario_especifio($id);
		  $dato['roles'] =  $this->Rbac_model->listar_roles();
		  $dato['get_usuario_rol'] =  $this->Rbac_model->get_usuario_rol($id);


   		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('usuario/form_editar',$dato);
		  $this->load->view('estructura/footer');
		}



	}	


	function Eliminar($id)
	{
		$this->Usuario_model->eliminar($id);
		$this->Rbac_model->eliminar_usuario_rol($id);

		redirect('usuario/listar/','refresh');
	}


	function Crear(){
   		
	   

       $dato['titulo'] = 'Actualizar usuario';

       $dato['roles'] =  $this->Rbac_model->listar_roles();
       //$dato['accion'] = site_url('person/updatePerson');


        $persona = array('nombre' => $this->input->post('nombre'),
        				'apellido' => $this->input->post('apellido'),
        				 'clave' => md5( $this->input->post('clave')),
                          'correo' => $this->input->post('correo'));
       
		if(! ($this->input->post('nombre') == FALSE ))
		{
				$id_usuario = $this->Usuario_model->insertar($persona);
				$this->Rbac_model->insertar_usuario_rol($id_usuario, $this->input->post('rol'));

				//echo "esto se imprime ".$id;
				 $dato['msj_confirmacion'] = '<div class="alert alert-success"><strong>Usuario creado satisfactoriamente!</strong> .</div>';
		}

	
        


  		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('usuario/form_crear',$dato);
		  $this->load->view('estructura/footer');

	}

	function Listar(){

		
		 $dato['listado_query'] = $this->Usuario_model->listar();

 		  $this->load->view('estructura/header');
   		  $this->load->view('estructura/nav_bar');
		  $this->load->view('usuario/listar',$dato);
		  $this->load->view('estructura/footer');
	}	





   
}
