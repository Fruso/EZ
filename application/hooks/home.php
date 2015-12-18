<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed'); 
class Home
{
	private $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
		!$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
		!$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;

		

	}	
 
	public function check_login()
	{
		if( $this->ci->session->userdata('logged_in')== FALSE ) 
		{
			/*
			$newdata = array(
			        'nombre'  => "",
			        'correo'     => "",
			        'logged_in' => ""
			);
			$this->ci->session->unset_userdata($newdata);
			$this->ci->session->sess_destroy();
			*/
			//redirect('hooks/index');
		}

	}
}
