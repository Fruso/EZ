


<div class="container">

  

<div class="panel panel-default">
  <div class="panel-heading">  <h2>Crear usuario</h2></div>
  <div class="panel-body">

  <?php if(!empty ($msj_confirmacion) ) { echo $msj_confirmacion; } ?>
  
 

      <form role="form" name="login" action="<?php echo base_url()."index.php/usuario/crear"; ?>" method="post" accept-charset="utf-8" >
        <div class="form-group">
          <label for="email">Nombre:</label>
          <input type="text" class="form-control" id="email" name="nombre" placeholder="">
        </div>
        <div class="form-group">
          <label for="email">Apellidos:</label>
          <input type="text" class="form-control" id="email" name="apellido" placeholder="">
        </div>

        <div class="form-group">
          <label for="pwd">Correo:</label>
           <input type="email" class="form-control" id="email" name="correo" placeholder="">
        </div>

       <div class="form-group">
          <label for="pwd">Clave:</label>
           <input type="text" class="form-control" id="email" name="clave" placeholder="">
        </div>

       <div class="form-group" >
         <label for="pwd">Roles:</label>
              <select class="form-control"  name="rol" >
              <?php   
                foreach ($roles->result_array() as $row)
                {
                      echo " <option value=".$row['id_rol'].">". $row['rol_nombre']."</option>";
                }
               ?>
              </select>
        </div>





        <button type="submit" class="btn btn-default">Crear</button>

      </form>

  </div>
</div>



</div>