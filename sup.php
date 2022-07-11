<?php
include('db.php');
$Usuario = $_GET['usuario'];
//echo $usuario;
$cons="SELECT S.SUPERVISOR from TBL_UM_SUPERVISORES S
WHERE idsupervisor = '$Usuario'";

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
$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

 //convertimos los datos de array a string
 $sup = implode(" ", $fila);
    
//print $sup;

$cons="SELECT C.ARCHIVO from TBL_UM_CONTRATOS C
WHERE idsupervisor = '$Usuario'";

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
$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

 //convertimos los datos de array a string
 $arc = implode(" ", $fila);
    
//print $arc;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>supervisores</title>
</head>
<body>
<header>
   <!-- Image and text -->
    <nav class="navbar1 navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="css/IMG/etb-logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
        </a>  
        <div class="cont">
        <?php
        include('db.php');
        $Usuario = $_GET['usuario'];
            $cons="SELECT S.SUPERVISOR from TBL_UM_SUPERVISORES S
            WHERE idsupervisor = '$Usuario'";

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
            $fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
                
             //convertimos los datos de array a string
             $sup = implode(" ", $fila);
                
             echo "<h3><center> Supervisor: ".$sup."</center></h3>";
             echo "<br>";
             echo "<h3><center> corte a: ".$arc."</center></h3>";
        ?>
        </div>

    </nav>
</header>


<div class="container">
    <br>
    <h1>Supervisores</h1>
    <br>
<?php
include('db.php');
$Usuario = $_GET['usuario'];
$cons='SELECT C.IDCONTRATO "CONTRATO", P.PROVEEDOR, C.MON_CON "MONEDA CONTRATO", C.VR_CONTRATO "VALOR CONTRATO",

C.VR_POSICION "FACTURADO", C.VR_IVA_FACTURADO "IVA FACTURADO",

(C.VR_CONTRATO - (C.VR_POSICION + C.VR_IVA_FACTURADO)) "SALDO CONTRATO"

FROM TBL_UM_CONTRATOS C

INNER JOIN TBL_UM_SUPERVISORES S ON C.IDSUPERVISOR=S.IDSUPERVISOR

INNER JOIN TBL_UM_PROVEEDORES P ON C.IDPROVEEDOR=P.IDPROVEEDOR

WHERE C.IDSUPERVISOR = ' .$Usuario.'

GROUP BY C.IDCONTRATO, P.PROVEEDOR, S.IDSUPERVISOR, S.SUPERVISOR, C.ARCHIVO, C.MON_CON,C.VR_CONTRATO,C.VR_POSICION,C.VR_IVA_FACTURADO

ORDER BY C.IDCONTRATO ASC';

//WHERE tbl_um_contratos.ID_SUPERVISOR = '$usuario' 
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

        print "<table class='table table-striped' border='1'>\n";
        print " <thead class='thead-light'>\n";
        print "<tr>\n";
            print "<td><strong>CONTRATO</strong></td>";
            print "<td><strong>PROVEEDOR</strong></td>";
            print "<td><strong>MONEDA CONTRATO</strong></td>";
            print "<td><strong>VALOR CONTRATO</strong></td>";
            print "<td><strong>FACTURADO</strong></td>";
            print "<td><strong>IVA FACTURADO</strong></td>";
            print "<td><strong>SALDO CONTRATO</strong></td>";
            print "<td><strong>ENLACES</strong></td>";
        print "</tr>\n";
        print " </thead>\n";
        while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            print "<tr>\n";
            foreach ($fila as $elemento) {
                print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
            }
            print "<td><a href='enlaces.php'><button type='button' class='btn btn-primary'>Enlance</button></a></td>";
            print "</tr>\n";
            //print "<tr>\n";
           
           //print "</tr>\n";
        }
        
        print "</table>\n";


oci_free_statement($stid);
oci_close($conexión);

?>
</div>
<a href="index.html"><button>Salir</button></a>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>