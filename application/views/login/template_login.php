<!DOCTYPE html>
<html>
<head>
<title>Login</title>

 
 
<script src="<?php echo base_url()."public/js/dropzone.js"; ?>"></script>

<link rel="stylesheet" href="<?php echo base_url()."public/css/style.css"; ?>">

</head>
<body>


<div class="contenedor_login" >

<div class="contenedor_login_header" >
	 
</div>
 
<div class="contenedor_login_body" >
	

  <?php if(!empty ($this->session->flashdata('error_login')) ) { echo $this->session->flashdata('error_login'); } ?>

  <form name="login" action="<?php echo base_url()."index.php/login/validar"; ?>" method="post" accept-charset="utf-8" >
  
     
      <input type="email" class="input-form input-form-correo"  name="usuariocorreo" placeholder="Ingrese correo">

 
     
      <input type="password" class="input-form input-form-clave"  name="usuarioclave" placeholder="Ingrese contraseña">


    <button type="submit" class="boton_1">Entrar</button>

  </form>

</div>


</div>

</body>
</html>