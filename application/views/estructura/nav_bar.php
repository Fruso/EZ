<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Dashboard</a>
    </div>
<p class="navbar-text"><?php echo "".$this->session->userdata('nombre')." ".$this->session->userdata('apellido')." - ".$this->session->userdata('Rol'); ?></p>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



      <ul class="nav navbar-nav">


<?php 

    if($this->session->userdata('administrar_usuarios')=='TRUE')
    {
     $mostrar_menu_usuarios = '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="'.base_url()."index.php/usuario/crear".'">Crear</a></li>
              <li><a href="'.base_url()."index.php/usuario/listar".'">Listar</a></li>
          </ul>
        </li>';
        echo $mostrar_menu_usuarios; 
    }

?>

       

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar Fotos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/imagen/listar"; ?>">Listar todas las fotos</a></li>
              <li><a href="<?php echo base_url()."index.php/imagen/subir"; ?>">Subir fotos</a></li>

          </ul>
        </li>

      </ul>

<!-- 
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-default">Ir</button>
      </form>
-->


      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sistema <span class="caret"></span></a>
          <ul class="dropdown-menu">
      
            <li><a href="<?php echo base_url()."index.php/login/salir"; ?>">Cerrar Sesión</a></li>

          </ul>
        </li>
      </ul>



    </div><!-- /.navbar-collapse -->




  </div><!-- /.container-fluid -->
</nav>