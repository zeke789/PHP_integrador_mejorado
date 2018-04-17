<?php 
function comprobar_nombre_usuario($nombre_usuario){ 	
	if (strlen($nombre_usuario)<6 || strlen($nombre_usuario)>20){ 
      echo "El nombre de usuario debe ser entre 6 y 20 caracteres<br>"; 
      return false; 
   } 

	$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";	
    for ($i=0; $i<strlen($nombre_usuario); $i++){ 
    	if (strpos($permitidos, substr($nombre_usuario,$i,1))===false){ 
        	echo $nombre_usuario . " no es válido<br>";
        	return false;         
        }
    } 
   echo $nombre_usuario . " es válido<br>"; 
   return true;
}


function comprobar_nombre_usuario_expresiones_regulares($nombre_usuario){ 
   if (ereg("^[a-zA-Z0-9\-_]{3,20}$", $nombre_usuario)) { 
      echo "El nombre de usuario $nombre_usuario es correcto<br>"; 
      return true; 
   } else { 
       echo "El nombre de usuario $nombre_usuario no es válido<br>"; 
      return false; 
   } 
}



?>

