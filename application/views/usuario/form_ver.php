
<div class="container">


<div class="panel panel-default">
  <div class="panel-heading">  <h2>Detalle usuario</h2></div>
  <div class="panel-body">

  <?php if(isset ($msj_confirmacion) ) { echo $msj_confirmacion; } ?>
  
   <?php $fila = $dato_usuario->row_array();  ?>
   <?php $fila_get_usuario_rol = $get_usuario_rol->row_array();  ?>

      <form role="form" name="login" action="<?php echo base_url()."index.php/usuario/editar/".$fila['id_usuario']; ?>" method="post" accept-charset="utf-8" >
        <div class="form-group">
          <label for="pwd">Nombre:</label>
           <input type="text" class="form-control" id="email" name="nombre" placeholder="" value="<?php echo $fila['nombre']; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="pwd">Apellido:</label>
           <input type="text" class="form-control" id="email" name="apellido" placeholder="" value="<?php echo $fila['apellido']; ?>" readonly>
        </div>

       <div class="form-group">
          <label for="pwd">Correo:</label>
           <input type="email" class="form-control" id="email" name="correo" placeholder="" value="<?php echo $fila['correo']; ?>" readonly>
        </div>
                      

       <div class="form-group" >
         <label for="pwd">Roles:</label>
              <select class="form-control"  name="rol" readonly>
              <?php   
                foreach ($roles->result_array() as $row)
                {
					if($fila_get_usuario_rol['id_rol']==$row['id_rol'])
					{
						echo " <option selected value=".$row['id_rol'].">". $row['rol_nombre']."</option>";
					}else
					{
						echo " <option value=".$row['id_rol'].">". $row['rol_nombre']."</option>";
					}
                }
               ?>
              </select>
        </div>

        <button type="submit" class="btn btn-default">Modificar</button>
          <a href='<?php echo base_url()."index.php/usuario/eliminar/".$fila['id_usuario']; ?>' class='btn btn-default' role='button'>Eliminar</a>
         <a href='<?php echo base_url()."index.php/usuario/listar/"; ?>' class='btn btn-default' role='button'>Volver</a>

      </form>

  </div>
</div>



</div>