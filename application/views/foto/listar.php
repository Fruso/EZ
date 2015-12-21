
<div class="container">

  

<div class="panel panel-default">


<nav class="navbar navbar-default" style="height: 70px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <p class="navbar-text" style=" font-size: 200%; color: #fff;">Lista de Fotografías</p>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <form class="navbar-form navbar-right" role="search" style="margin-top: 20px;"  method="post" action="<?php echo base_url()."index.php/imagen/listar"; ?>">
        <div class="form-group">
               <select class="form-control" name="filtro" >
                <option value="1">Todas</option>
                <option value="2">Pendientes  (<?php echo $num_estado_pendientes; ?>)</option>
                <option value="3">Aprobadas (<?php echo $num_estado_aprobadas; ?>)</option>
                <option value="4">Rechazadas (<?php echo $num_estado_rechazadas; ?>)</option>
              </select>
        </div>
        <button type="submit" class="btn btn-default">Filtrar</button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- 
  <div class="panel-heading" >  <h2>Listar Imagenes</h2> 
        

      <div class="row" style=" float:right;  ">
        <div class="col-sm-4 ">
              <div class="form-group">
              <label for="sel1">QWEQWEQWE</label>
              <select class="form-control" id="sel1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              </div>
        </div>
      </div>


</div>
-->



  <div class="panel-body">



  
  <?php 
  echo $tabla_listado_imagenes; 
    
   ?>




  

<nav>
  <ul class="pager">
    <?php echo $pag_anterior; ?>
    <?php echo $pag_siguiente; ?>

  </ul>
</nav>




  </div>
</div>



</div>