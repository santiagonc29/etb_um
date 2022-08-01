<?php
include('db.php'); 

$usuario=$_POST['usuario'];
$password=$_POST['password'];


//se define la consulta en una varible
$cons="SELECT cargo as CARGO, CONDICION as CONDICION FROM tbl_um_supervisores where login='$usuario' and clave='$password'";
    
//Almacena la consulta
$stid = oci_parse($conexión, $cons);

//ejecuta la consulta    
$r = oci_execute($stid);
        
//almacenamos los datos obtenidos en un array

while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $cargo = oci_result($stid, 'CARGO');
    $CONDICION = oci_result($stid, 'CONDICION');
    echo $CONDICION."\n";
    echo $cargo."\n";
   
    if($CONDICION == 1){
        //hacemos validación de cargo por medio de switch
        switch($cargo){
    
        case "ADMINISTRADOR":
            header('location: admin/inicio.php');
            break;
    
        case "SUPERVISOR":
            header('location: sup.php?usuario='.$_POST['usuario']);
            break;
        }
    }else{
        echo "Usted no esta habilitado";
    }
}




//cerramos la conexion
oci_free_statement($stid);
oci_close($conexión);
 ?>