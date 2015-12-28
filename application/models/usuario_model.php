<?php
class usuario_model extends CI_Model  {
   function __construct(){
      parent::__construct ();
      $this->load->database(); 
   }


         function usuario_login($email,$clave){
               $this->db->where('correo', $email); 
               $this->db->where('clave', md5($clave));
               $query = $this->db->get('usuario');

               if ($query->num_rows() > 0){

                return $query;


               }
               return 0;
            }



   function insertar($persona){

          $this->db->insert('usuario', $persona); 
          $id_usuario = $this->db->insert_id();

          //$this->db->insert('usuario_rol', array('id_usuario' => $id_usuario,'id_rol' => $id_rol));          
          //$this->db->insert($this->usuario, $persona);

          return $id_usuario;
    }  

   function listar(){
       return  $this->db->query("select * from usuario where estado=0 order by id_usuario desc");;
    }

    function ver_usuario_especifio($persona){
           return  $this->db->query("select * from usuario where id_usuario=".$persona);
    }   

   function actualizar($id_usuario,$persona,$id_rol){


        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuario', $persona); 

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuario_rol', array('id_rol' => $id_rol) ); 
    } 


  function eliminar($id_usuario)
  {
    //$this->db->delete('usuario', array('id_usuario' => $id_usuario)); 

      return  $this->db->query("UPDATE usuario SET estado='1' WHERE id_usuario=".$id_usuario);
  }


   
}