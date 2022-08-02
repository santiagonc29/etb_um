<?php
include('db.php'); 

$usuario=$_POST['usuario'];
$password=$_POST['password'];


//se define la consulta en una varible
$cons="SELECT cargo as CARGO, CONDICION as CONDICION FROM tbl_um_supervisores where login='$usuario' and clave='$password'";
    
//Almacena la consulta
$stid = oci_parse($conexión, $cons);
if (!$stid) {
    $e = oci_error($conexión);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}// Realizar la lógica de la consulta
//ejecuta la consulta    
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}// Obtener los resultados de la consulta       
//almacenamos los datos obtenidos en un array
if(!$r){
    header('location: index.html');
}else{
    while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $cargo = oci_result($stid, 'CARGO');
    $CONDICION = oci_result($stid, 'CONDICION');
    echo $CONDICION."\n";
    echo $cargo."\n";
   
        if($CONDICION == 1){
            //hacemos validación de cargo por medio de switch
            switch($cargo){
        
            case "ADMINISTRADOR":
                header('location: inicio.php');
                break;
        
            case "SUPERVISOR":
                header('location: menu.php?usuario='.$_POST['usuario']);
                break;
            }
        }else{
            echo "Usted no esta habilitado";
        }
    }

}




//cerramos la conexion
oci_free_statement($stid);
oci_close($conexión);
 ?>