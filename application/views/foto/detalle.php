
<div class="container">

  

<div class="panel panel-default">
  <div class="panel-heading">  <h2>Detalle Imagenes</h2></div>
  <div class="panel-body">



  
  <?php 
 	echo $imagen_mostrar;
  ?>


<br>

  <?php 
 	echo $imagen_detalle_tabla;
  ?>



      <form role="form" name="login" action="<?php echo $link_post_form; ?>"  method="post" accept-charset="utf-8" >


       <div class="form-group" >
         <label for="pwd">Seleccione un Motivo:</label>
              <?php 
              echo $combobox_motivo;
              ?>




        </div>

 			    <button type="submit" class="btn btn-default" <?php if(!empty ($boton_deshabilitar) ) { echo $boton_deshabilitar; } ?>>Confirmar cambios</button>
         	<a href='<?php echo $link_volver; ?>' class='btn btn-default' role='button'>Volver</a>



      </form>


  </div>
</div>



</div>