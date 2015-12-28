
<div class="container">


<div class="panel panel-default">
  <div class="panel-heading">  <h2>Actualizar usuario</h2></div>
  <div class="panel-body">

  <?php if(isset ($msj_confirmacion) ) { echo $msj_confirmacion; } ?>
  
   <?php $fila = $dato_usuario->row_array();  ?>
   <?php $fila_get_usuario_rol = $get_usuario_rol->row_array();  ?>

      <form role="form" name="login" action="<?php echo base_url()."index.php/usuario/editar/".$fila['id_usuario']; ?>"  method="post" accept-charset="utf-8" >
        <div class="form-group">
          <label for="pwd">Nombre:</label>
           <input type="text" class="form-control" id="email" name="nombre" placeholder="" value="<?php echo $fila['nombre']; ?>">
        </div>
        <div class="form-group">
          <label for="pwd">Apellido:</label>
           <input type="text" class="form-control" id="email" name="apellido" placeholder="" value="<?php echo $fila['apellido']; ?>">
        </div>

       <div class="form-group">
          <label for="pwd">Correo:</label>
           <input type="email" class="form-control" id="email" name="correo" placeholder="" value="<?php echo $fila['correo']; ?>">
        </div>

       <div class="form-group">
          <label for="pwd">Clave:</label>
           <input type="text" class="form-control" id="email" name="clave" placeholder="Dejar en blanco en caso de no modificar">
        </div>                        
		

       <div class="form-group" >
         <label for="pwd">Roles:</label>
              <select class="form-control"  name="rol" >
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

        <input type="hidden" name="actualizar" value="1">

        <button type="submit" class="btn btn-default">Modificar</button>
   		

		<a href='<?php echo base_url()."index.php/usuario/ver/". $fila['id_usuario']; ?>' class='btn btn-default' role='button'>Volver</a>

   		

         

      </form>

  </div>
</div>



</div>