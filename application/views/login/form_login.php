
<div class="contenedor_login" >

<div class="container">




  <h2>Login</h2>
  <form role="form" class="col-xs-8" name="login" action="<?php echo base_url()."index.php/login/validar"; ?>" method="post" accept-charset="utf-8" >
    <div class="form-group">
      <label for="email">Correo:</label>
      <input type="email" class="form-control"  name="usuariocorreo" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Contraseña:</label>
      <input type="password" class="form-control"  name="usuarioclave" placeholder="Enter password">
    </div>

    <button type="submit" class="btn btn-default">Entrar</button>

  </form>




</div>


</div>