<?php
class Rbac_model extends CI_Model  {
   function __construct(){
      parent::__construct ();
      $this->load->database(); 
   }




   function listar_roles(){
       return  $this->db->query("select * from rol order by id_rol asc");
    }

   function insertar_usuario_rol($id_usuario,$id_rol){
       return  $this->db->query("INSERT INTO usuario_rol (id_usuario,id_rol) VALUES ('".$id_usuario."','".$id_rol."')");
    }

   function eliminar_usuario_rol($id_usuario){
       $this->db->delete('usuario_rol', array('id_usuario' => $id_usuario)); 
    }

    function get_usuario_rol($id_usuario){
       return  $this->db->query("select rol.id_rol,rol.rol_nombre from usuario_rol,rol where id_usuario=".$id_usuario." and usuario_rol.id_rol=rol.id_rol");
    }

    function get_usuario_rol_permisos($id_usuario){
       return  $this->db->query("select permiso.permiso_tipo from usuario_rol,rol_permiso, permiso where usuario_rol.id_usuario=".$id_usuario." and rol_permiso.id_rol=usuario_rol.id_rol and rol_permiso.id_permiso=permiso.id_permiso");
    }




   
}