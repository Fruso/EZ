

  <?php $fila = $dato_usuario->row_array();  ?>


<div class="container">


<div class="panel panel-default">
  <div class="panel-heading">  <h2>Confirmar actualización usuario</h2></div>
  <div class="panel-body">

<?php if(isset ($msj_confirmacion) ) { echo $msj_confirmacion; } ?>

      <form role="form" name="login" action="<?php echo base_url()."index.php/usuario/editar/".$fila['id_usuario']; ?>" method="post" accept-charset="utf-8" >
   		
   		<input type="hidden" name="actualizar_confirmar" value="1">

   		<button type="submit" class="btn btn-default">Confirmar</button>
		<a href='<?php echo base_url()."index.php/usuario/editar/". $fila['id_usuario']; ?>' class='btn btn-default' role='button'>Volver</a>

      </form>

  </div>
</div>



</div>