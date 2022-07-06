<?php
include('db.php'); 
$usuario=$_POST['usuario'];
$password=$_POST['password'];

echo $usuario;
echo $password;

//se define la consulta en una varible
$cons="SELECT cargo FROM tbl_um_supervisores where login='$usuario' and clave='$password'";
    
    //Almacena la consulta
    $stid = oci_parse($conexión, $cons);
    //ejecuta la consulta    
    $r = oci_execute($stid);
        

       $fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

       $str = implode(" ", $fila);

       print $str;

       if($str == "ADMINISTRADOR"){

        header('location: home.php');

       }else if($str == "SUPERVISOR"){
        
        header('location: sup.php');
        
       }

oci_free_statement($stid);
 oci_close($conexión);
 ?>