<?php

//$usuario = $_POST['usuario'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <title>Admin</title>
</head>
<body>
<h1>Administrador</h1>
<?php
include('db.php');
$cons='SELECT C.IDCONTRATO "CONTRATO", P.PROVEEDOR, C.MON_CON "MONEDA CONTRATO", C.VR_CONTRATO "VALOR CONTRATO",

C.VR_POSICION "FACTURADO", C.VR_IVA_FACTURADO "IVA FACTURADO",

(C.VR_CONTRATO - (C.VR_POSICION + C.VR_IVA_FACTURADO)) "SALDO CONTRATO"

FROM TBL_UM_CONTRATOS C

INNER JOIN TBL_UM_SUPERVISORES S ON C.IDSUPERVISOR=S.IDSUPERVISOR

INNER JOIN TBL_UM_PROVEEDORES P ON C.IDPROVEEDOR=P.IDPROVEEDOR

GROUP BY C.IDCONTRATO, P.PROVEEDOR, S.IDSUPERVISOR, S.SUPERVISOR, C.ARCHIVO, C.MON_CON,C.VR_CONTRATO,C.VR_POSICION,C.VR_IVA_FACTURADO

ORDER BY C.IDCONTRATO ASC';

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
        print "<tr>\n";
            print "<td>CONTRATO</td>";
            print "<td>PROVEEDOR</td>";
            print "<td>MONEDA CONTRATO</td>";
            print "<td>VALOR CONTRATO</td>";
            print "<td>FACTURADO</td>";
            print "<td>IVA FACTURADO</td>";
            print "<td>SALDO CONTRATO</td>";
            print "<td>enlace</td>";
        print "</tr>\n";
            
        while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            print "<tr>\n";
            foreach ($fila as $elemento) {
                print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
                //print '<td><a href="#"><button>Enlance</button></a></td>';
            }
            print "</tr>\n";
        }
        
        print "</table>\n";



oci_free_statement($stid);
oci_close($conexión);

?>
    
</body>
</html>