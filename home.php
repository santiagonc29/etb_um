<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
require('validar.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet" href="file:///C:/xampp/htdocs/etb_2/view/template/header.php">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="..plantilla/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="css/cssAdicionales/jquery.dataTables.min.css">
  <link rel="stylesheet" href="view/css/cssAdicionales/responsive.dataTables.min.css">
  <link rel="stylesheet" href="view/css/cssAdicionales/buttons.dataTables.min.css">
  <link rel="stylesheet" href="plantilla/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plantilla/dist/css/datatable.css">
  <link rel="stylesheet" href="view/css/cssAdicionales/select2-bootstrap.min.css" />
  <link href="view/css/cssAdicionales/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="view/css/cssAdicionales/mdb.lite.min.css" />
  <link rel="stylesheet" href="view/css/cssAdicionales/mdb.min.css" />
  <link rel="stylesheet" href="view/css/cssAdicionales/choices.min.css">
  <link rel="stylesheet" href="view/css/cssAdicionales/bootstrap-select.css" />

  <style>
    div.container {
      max-width: 1200px
    }
  </style>
  <style>
    .swal2-popup {
      font-size: 1.6rem !important;
    }

    .select2-container .select2-choice,
    .select2-result-label {
      font-size: 1.5em;
      height: 41px;
      overflow: auto;
    }

    .select2-selection {
      min-height: 10px !important;
    }

    .select2-container .select2-selection--single {
      height: 35px !important;
    }

    .select2-selection__arrow {
      height: 34px !important;
    }
  </style>
    <title>home</title>
</head>
<body>
<h1>BIENVENIDOS</h1>
<?php
include('db.php');
$usuario=$_POST['usuario'];
$cons="SELECT cargo from tbl_um_supervisores WHERE idsupervisor = '$usuario'";

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



switch ($r){

  case "ADMINISTRADOR":
    echo "Ha ingresado como admin";
  break;

  case "SUPERVISOR":

    echo "Ha ingresado como supervisor";
    
  break;
}
// $cons = "SELECT tbl_um_contratos.CONTRATO_PADRE,tbl_um_contratos.IDCONTRATO,
// tbl_um_contratos.IDPROVEEDOR,tbl_um_proveedores.PROVEEDOR,tbl_um_supervisores.SUPERVISOR,tbl_um_contratos.FECHA_INICIO,tbl_um_contratos.FECHA_FIN,
//  tbl_um_contratos.VALOR_COP,tbl_um_contratos.ADICIONES_COP,tbl_um_contratos.VALOR_USD,tbl_um_contratos.ADICIONES_USD 
// FROM tbl_um_contratos 
// INNER JOIN tbl_um_proveedores ON tbl_um_contratos.IDPROVEEDOR=tbl_um_proveedores.IDPROVEEDOR 
// INNER JOIN tbl_um_supervisores ON tbl_um_contratos.ID_SUPERVISOR=tbl_um_supervisores.IDSUPERVISOR 
// ORDER BY tbl_um_contratos.CONTRATO_PADRE ASC";
// $stid = oci_parse($conexión, $cons);
//         if (!$stid) {
//             $e = oci_error($conexión);
//             trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
//         }// Realizar la lógica de la consulta
        
//         $r = oci_execute($stid);
//         if (!$r) {
//             $e = oci_error($stid);
//             trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
//         }// Obtener los resultados de la consulta

//         print "<table border='1'>\n";
// while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
//     print "<tr>\n";
//     foreach ($fila as $elemento) {
//         print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
//     }
//     print "</tr>\n";
// }

// print "</table>\n";
oci_free_statement($stid);
oci_close($conexión);

?>
    
</body>
</html>