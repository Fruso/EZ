<?php

//$target_path = "/home/juan/html/sistema/public/images/products/";
$target_path = "/var/www/desarrollo-ez/cake/app/webroot/img/products/";

$target_path = $target_path . basename( $_FILES['archivo-a-subir']['name']);


if(move_uploaded_file($_FILES['archivo-a-subir']['tmp_name'], $target_path))
{
	echo "El archivo ". basename( $_FILES['archivo-a-subir']['name'])." ha sido subido exitosamente!";
}
else
{
	echo "Hubo un error al subir tu archivo! Por favor intenta de nuevo.";
	print_r($_FILES);
	echo "<br>";
	echo $_FILES["archivo-a-subir"]["error"];
}



?>