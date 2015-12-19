<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {



public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load session library
$this->load->library('session');

// Load validation library
$this->load->library('form_validation');

$this->load->helper('url');

}




	public function index()
	{
		
  	
		$this->load->model('Usuario_model');
		$data['title'] =  'vacio';

 		$datos['page_title'] = 'dato en texto';

 			$this->load->view('login/template_login');

/*
		$this->load->view('estructura/header');
		$this->load->view('login/form_login',$data);
		$this->load->view('estructura/footer');
*/
	}



   


	function validar(){
   			//echo 'usuario: ' . $_POST["usuariocorreo"]. ", clave: ".$_POST["usuarioclave"];
			$this->load->model('Usuario_model');
			$this->load->model('rbac_model');

   			$resultado=$this->Usuario_model->usuario_login($_POST["usuariocorreo"],$_POST["usuarioclave"]);
			

   			if(empty($resultado))
   			{
				$this->load->library('session');
   				$this->session->set_flashdata('error_login', '<div class="login_texto">Error de usuario o contraseña</div>');
				redirect('/','refresh'); 
   			}
   			//$fila = mysql_fetch_array($resultado)
			
			$row = $resultado->row_array();
			
                

			$rol_usuaio =$this->rbac_model->get_usuario_rol($row['id_usuario'])->row_array();



			echo "".$rol_usuaio['rol_nombre']."<br>";

			$newdata = array(
			        'id_usuario'  => "".$row['id_usuario'],
			        'nombre'  => "".$row['nombre'],
			        'apellido'  => "".$row['apellido'],
			        'correo'     => "".$row['correo'],
			        'Rol' => $rol_usuaio['rol_nombre'],
			        'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);

			$permisos = $this->rbac_model->get_usuario_rol_permisos($row['id_usuario']);


                foreach ($permisos->result_array() as $row1)
                {
						$this->session->set_userdata(''.$row1['permiso_tipo'], 'TRUE');     
						echo "	Permiso:".$row1['permiso_tipo']."<br>";   
                }

		
		if($rol_usuaio['rol_nombre']=="Administrador")
		{
			redirect('imagen/listar');
		}
		if($rol_usuaio['rol_nombre']=="Diseñador")
		{
			redirect('imagen/subir');
		}
		if($rol_usuaio['rol_nombre']=="Administrador EZ")
		{
			redirect('imagen/listar');
		}
	

	}
   

		function Salir(){
			$this->session->sess_destroy();
			redirect('login','refresh');

		}



}
