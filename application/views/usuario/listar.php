
<div class="container">

  

<div class="panel panel-default">
  <div class="panel-heading">  <h2>Listar usuarios</h2></div>
  <div class="panel-body">


<table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Correo</th>
        <th>Acceso</th>
      </tr>
    </thead>
    <tbody>

  <?php 
    
  

    foreach ($listado_query->result_array() as $row)
    {
    


          echo "
                <tr>
                  <td >". $row['nombre']."</td>
                  <td>". $row['apellido']."</td>
                  <td>". $row['correo']."</td>
                  <td width='10%'>  <a href='".base_url()."index.php/usuario/ver/". $row['id_usuario']."' class='btn btn-primary' role='button'>Detalle</a> </td>
                
                </tr>";
  
    }



   ?>




    </tbody>
  </table>





  </div>
</div>



</div>