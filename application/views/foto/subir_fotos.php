
<div class="container">


<div class="panel panel-default">
  <div class="panel-heading">  <h2>Subir Imagen</h2></div>
  <div class="panel-body">

  <?php if(!empty ($msj_confirmacion) ) { echo $msj_confirmacion; } ?>
  
   <blockquote>
    <p><b>Subir Fotografía: </b>Recuerda que deben tener código de producto como nombre, para que sean reconocidas por el sistema.</p>
   
  </blockquote>


<form action="<?php echo site_url('/imagen/subir'); ?>" class="dropzone" id="dropzone" >

  <input type="hidden" name="post_form_subir" value="1">
</form>

<br>
  



  </div>



</div>



</div>