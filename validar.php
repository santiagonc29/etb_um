<?php
include('db.php'); 

$usuario=$_POST['usuario'];
$password=$_POST['password'];


//se define la consulta en una varible
$cons="SELECT cargo FROM tbl_um_supervisores where login='$usuario' and clave='$password'";
    
//Almacena la consulta
$stid = oci_parse($conexión, $cons);

//ejecuta la consulta    
$r = oci_execute($stid);
        
//almacenamos los datos obtenidos en un array
$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

//convertimos los datos de array a string
$str = implode(" ", $fila);

print $str;

//hacemos validación de cargo por medio de switch
switch($str){

    case "ADMINISTRADOR":
        header('location: home.php');
        break;

    case "SUPERVISOR":
        header('location: sup.php?usuario='.$_POST['usuario']);
        break;
}

//cerramos la conexion
oci_free_statement($stid);
oci_close($conexión);
 ?>