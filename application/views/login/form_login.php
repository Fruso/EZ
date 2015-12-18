
<div class="container">
  <h2>Login</h2>
  <form role="form" name="login" action="<?php echo base_url()."index.php/login/validar"; ?>" method="post" accept-charset="utf-8" >
    <div class="form-group">
      <label for="email">Correo:</label>
      <input type="email" class="form-control" id="email" name="usuariocorreo" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Contraseña:</label>
      <input type="password" class="form-control" id="pwd" name="usuarioclave" placeholder="Enter password">
    </div>

    <button type="submit" class="btn btn-default">Entrar</button>

  </form>





  
</div>