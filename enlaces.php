<?php 
$Usuario = $_GET['Usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/logos/LOGO_ETB.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?php $proveedor = $_GET['proveedor']; echo $proveedor ?> </title>
</head>
<body>
  <style>
    .over{
      width:95%;
      margin: auto;
      padding: 20px;
      overflow: auto;
      height: 700px;
      box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.1);
      border-radius: 1rem;
      background: #fff;
      margin-top:20px;
    }
  </style>
<!-- Image and text -->
<nav class="navbar navbar-light nav-justified" style="background: rgb(0,255,255);
background: linear-gradient(156deg, rgba(0,255,255,1) 0%, rgba(20,193,234,1) 61%); color: white;">
    <div></div>
        <a class="navbar-brand" href="#">
            <img src="assets/logos/Logo-blanco-tagline.png" width="100" height="auto" class="d-inline-block align-top" alt="">
        </a>
        <div>
            <h4>Proveedor: <?php $proveedor = $_GET['proveedor']; echo $proveedor ?></h4>
            <h4>Contrato N°: <?php $idcont = $_GET['contrato']; echo $idcont?></h4>
        </div>
        
        <div></div>
        <button type='button' class='btn btn-danger' onclick="window.close()">volver</button>
         <!-- Boton volver   -->
         <!-- <a href="sup.php?usuario="<?php //echo $Usuario?> ><button type='button' class='btn btn-danger'>volver</button></a>  -->
        <div></div>
</nav>
<?php
    
  include('db.php'); 
    $idcont = $_GET['contrato'];

    $cons = "SELECT COUNT (*) from TBL_UM_ENLACES where NUMERO_DE_CONTRATO=".$idcont;
    
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
    $conteo = implode(" ", $fila);

    if($conteo == 0){
      $msg = "No hay enlaces que mostrar";
    }else{
      $msg = "";
    }

    
    ?>
<div class="container">
    <br>
    <h1>Total de enlances: <?php echo $conteo;?></h1>
    <h3><?php echo $msg;?></h3>
    <p>
    
  </p>
    <br>
    
</div>
  <div class="over">
    <?php
include('db.php');
$idEnlace = $_GET['contrato'];
$cons='SELECT C.ID_ETB_ENLACE_CAV "ID ETB",C.NOMBRE_CLIENTE "CLIENTE",C.PROYECTO "PROYECTO",S.MON_CON "MONEDA",TP.TIP_SERV "SERVICIO",C.INICIO_SERVICIO "IN SERVICIO",
C.FIN_SERVICIO "FN SERVICIO",C.ESTADO "ESTADO",C.NUMERO_DE_CONTRATO "N CONTRATO",C.COP_MENSUALIDAD "MENSUALIDAD COP",C.USD_MENSUALIDAD "MENSUALIDAD USD",
C.ID_PROVEEDOR "ID PROVEEDOR"
FROM TBL_UM_ENLACES C
INNER JOIN TBL_UM_CONTRATOS S ON C.NUMERO_DE_CONTRATO=S.IDCONTRATO
INNER JOIN TBL_UM_TIP_SERV TP ON C.TIPO_SERVICIO = TP.TIPSERV
WHERE C.NUMERO_DE_CONTRATO ='.$idEnlace;

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
            print "<td><strong>#</strong></td>";
            print "<td><strong>ESTADO</strong></td>";
            print "<td><strong>VENCIMIENTO</strong></td>";
            print "<td><strong>ID ENLACE</strong></td>";
            print "<td><strong>CLIENTE</strong></td>";
            print "<td><strong>TIPO SERVICIO</strong></td>";
            print "<td><strong>INICIO SERVICIO</strong></td>";
            print "<td><strong>FIN SERVICIO</strong></td>";
            print "<td><strong>MONEDA</strong></td>";
            print "<td><strong>MENSUALIDAD</strong></td>";
            print "<td><strong>Mas Información</strong></td>";
        print "</tr>\n";
        print " </thead>\n";
        // verde #6CD410 
        // amarillo #F1C40F 
        // rojo #E74C3C 

        $fechaAc = date("d-m-y");
        $i = 1;
        while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {

          $vusd = oci_result($stid, 'MENSUALIDAD COP');
          $vcop = oci_result($stid, 'MENSUALIDAD USD');
          $moneda = oci_result($stid, 'MONEDA');
          if($moneda = "USD"){
            $vlr = $vusd;
          }else{
            $vlr = $vcop;
          }

           
            print "<tr>\n";
            ?>
                <tr>
                    <td><?php $j = $i++; echo $j ?></td>
                    <td><?php echo oci_result($stid, 'ESTADO'); ?></td>
                    <td><?php 

                    
                    // $fechaCon = oci_result($stid, 'FN SERVICIO');
                    // $dias = (strtotime($fechaCon)-strtotime($fechaAc))/86400;
                    // $days = abs($dias); $dias = floor($dias);
                    // echo $days;
                     
                     $fechaCon = oci_result($stid, 'FN SERVICIO');
                     $dateDifference = strtotime($fechaAc) - strtotime($fechaCon);
                     $dateAbs = abs($dateDifference);
                     $days = floor($dateAbs / (1000 * 3600 * 24));
                      echo $days;

                      if($days <= $fechaAc){
                        $color = "#000 ";
                      }else{
                        if($days > 60){
                          $color = "#6CD410";
                        }else if($days > 30){
                          $color = "#F1C40F";
                        }else if($days = 0){
                          $color = "#E74C3C ";
                        }
                      }
                      
                      ?>
                      <svg viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0, 28 C 0, 12.040000000000001 12.040000000000001, 0 28, 0 S 56, 12.040000000000001 56, 28 43.96, 56 28, 56 0, 43.96 0, 28
                         " fill="<?php echo $color ?>" transform="rotate(0,100,100) translate(72 72)">
                        </path>
                      </svg>
                    </td>
                    <td><?php $idetb = oci_result($stid, 'ID ETB'); echo $idetb ?></td>
                    <td><?php echo oci_result($stid, 'CLIENTE'); ?></td>
                    <td><?php echo oci_result($stid, 'SERVICIO'); ?></td>
                    <td><?php echo oci_result($stid, 'IN SERVICIO'); ?></td>
                    <td><?php echo oci_result($stid, 'FN SERVICIO')?></td>
                    <td><?php echo $moneda ?></td>
                    <td><?php echo $vlr ?></td>
                    <td><a target="_blank" href="enlaceDt.php?idetb=<?php echo $idetb ?>" ><button type='button' class='btn btn-primary'>Ver mas</button></a></td> 
                </tr>
            <?php
           
            print "</tr>\n";
        }
        
        print "</table>\n";


oci_free_statement($stid);
oci_close($conexión);

    ?>
</div>
</div>

<!-- Site footer -->
<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>ETB</h6>
            <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, tempore. Inventore quo alias omnis! Recusandae eum, dolore laboriosam quibusdam eligendi omnis vel dolorum sit fugit molestiae nulla magnam soluta nam?</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><a href="#">EJEMPLO</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="#">Ejemplo</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2022. Todos los derechos reservados.
         <a href="#">ETB S.A. ESP</a>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
              </a></li>
              <li><a class="twitter" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
              </a></li>
              <li><a class="linkedin" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                </svg>
              </a></li>   
            </ul>
          </div>
        </div>
      </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>