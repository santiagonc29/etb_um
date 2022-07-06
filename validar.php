<?php
include('db.php'); 
$usuario=$_POST['usuario'];
$password=$_POST['password'];

echo $usuario;
echo $password;

$cons="SELECT*FROM tbl_um_supervisores where login='$usuario' and clave='$password'";
    $stid = oci_parse($conexión, $cons);
        if (!$stid) {
            $e = oci_error($conexión);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }// Realizar la lógica de la consulta
        
        $r = oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }// Obtener los resultados de la consulta
        
        print "<table border='1'>\n";
        while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            print "<tr>\n";
            foreach ($fila as $elemento) {
                print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
            }
           
        }
        
       $fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);



if($fila){
  
    header('location: home.php');

}else{
    ?>
   
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
 <?php
}

oci_free_statement($stid);
 oci_close($conexión);
 ?>