<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../assets/logos/LOGO_ETB.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Contratos</title>
</head>
<body>
  <style>
    body{
        background: #F2F4F4;
    }

    .contBtn{
      width:30%;
    }

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

    .contM{
      display: none;
      margin-top:0px;
      background: #FFF;
      padding: 10px;
      border-radius: 1rem;
      box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.1);
}


.cont{
  margin-top:20px;
  margin-left: 20px;
}

  </style>
<!-- Image and text -->
<nav id="menu" class="navbar navbar-light nav-justified" style="background: rgb(0,255,255);
background: linear-gradient(156deg, rgba(0,255,255,1) 0%, rgba(20,193,234,1) 61%); color: white;">
    <div></div>
        <a class="navbar-brand" href="#">
            <img src="../assets/logos/Logo-blanco-tagline.png" width="100" height="auto" class="d-inline-block align-top" alt="">
        </a>
        <div>
        <?php
        include('db.php');
        $Usuario = $_GET['usuario'];
            $cons="SELECT S.SUPERVISOR from TBL_UM_SUPERVISORES S
            WHERE LOGIN = '$Usuario'";

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

            //  $cons="SELECT ARCHIVO from TBL_UM_CONTRATOS
            //  WHERE idsupervisor = '$Usuario'";
             
            //          $stid = oci_parse($conexión, $cons);
            //          if (!$stid) {
            //              $e = oci_error($conexión);
            //              trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            //          }// Realizar la lógica de la consulta
                     
            //          $r = oci_execute($stid);
            //          if (!$r) {
            //              $e = oci_error($stid);
            //              trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            //          }// Obtener los resultados de la consulta
            //  $fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
             
            //   //convertimos los datos de array a string
            //   $arc = implode(" ", $fila); 
               $fecha = "";
              
                print "<h4 class='tltSup'>Supervisor: ".$sup."</h4>";
                //print "<h4> corte a: ".$fecha."</h4>";
             
        ?>
        </div>
        <a href="enlacescons.php"><button class="btn btn-outline-light">Consultar</button></a>
        <a href="../index.html"><button class="btn btn-outline-danger " >Salir</button></a>
        <div></div>
</nav>
<!-- style="position: relative;" -->
<div class="container" >
 
<?php 
    $Usuario = $_GET['usuario'];

    $cons = "SELECT COUNT (*) from TBL_UM_CONTRATOS where IDSUPERVISOR=".$Usuario;
    
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

    
    ?>
    
  <br>
  <h1>Total de contratos:  <?php echo $conteo;?></h1> 
  <div class="row">
    <div class="contBtn">
      <button class="btn btn-info col-lg-6 btnM" onclick="mostrar()"> tipos de contratos</button>
    </div>
  
  <br>
  <div class="contM col-lg-4" id="contM">
  <?php 
      $Usuario = $_GET['usuario'];

      $cons = "select count(idcontrato),tipo from tbl_um_contratos where IDSUPERVISOR = " .$Usuario. " group by tipo order by tipo";

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

      print "<table>\n";
      print "<tr>\n";
          print "<td><strong>CANT</strong></td>";
          print "<td><center><strong>TIPO</strong></center></td>";
          print "</tr>\n";
      while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
          print "<tr>\n";
          foreach ($fila as $elemento) {
              print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
          }
          print "</tr>\n";
      }

      print "</table>\n";

    ?>
    </div>
  </div>
<?php
include('db.php');
$Usuario = $_GET['usuario'];
$cons='SELECT C.IDCONTRATO "CONTRATO", P.PROVEEDOR, C.MON_CON "MONEDA CONTRATO",C.FECHA_FIN "FECHA FIN", C.VR_CONTRATO "VALOR CONTRATO",

C.VR_POSICION "FACTURADO", C.VR_IVA_FACTURADO "IVA FACTURADO",

(C.VR_CONTRATO - (C.VR_POSICION + C.VR_IVA_FACTURADO)) "SALDO CONTRATO",C.FECHA_FIN - SYSDATE "TIEMPO CALCULADO"

FROM TBL_UM_CONTRATOS C

INNER JOIN TBL_UM_SUPERVISORES S ON C.IDSUPERVISOR=S.LOGIN

INNER JOIN TBL_UM_PROVEEDORES P ON C.IDPROVEEDOR=P.IDPROVEEDOR

WHERE C.IDSUPERVISOR = ' .$Usuario.'

GROUP BY C.IDCONTRATO, P.PROVEEDOR, S.LOGIN, S.SUPERVISOR,C.MON_CON,C.FECHA_FIN,C.VR_CONTRATO,C.VR_POSICION,C.VR_IVA_FACTURADO

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
        $fechaAc = date("d-m-y");
        $i = 1;
?>
</div>
  <div class="over">
    <div class="cont" >
       <table class="table table-striped" border="1"> 
        <thead class="thead-dark">
        <tr>
            <td><strong>#</strong></td>
            <td><strong>CONTRATO</strong></td>
            <td><strong>PROVEEDOR</strong></td>
            <td><strong>MONEDA CONTRATO</strong></td>
            <td><strong>VALOR CONTRATO</strong></td>
            <td><strong>FACTURADO</strong></td>
            <td><strong>IVA FACTURADO</strong></td>
            <td><strong>SALDO CONTRATO</strong></td>
            <td><strong>P.P.P</strong></td>
            <td><strong>P.P.E</strong></td>
            <td><strong>Vencimiento</strong></td>
            <td><strong>ENLACES</strong></td>
            <td><strong>MAS INFORMACIÓN</strong></td>
        </tr>
         </thead>
    <?php
        while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
          
          $tc = oci_result($stid, 'TIEMPO CALCULADO');
          $dias = intval($tc)+1;
            print "<tr>\n";
            ?>
            
                <tr>
                    <td><?php $j = $i++; echo $j ?></td>
                    <td><?php $contrato = oci_result($stid, 'CONTRATO'); echo $contrato ?></td>
                    <td><?php $proveedor = oci_result($stid, 'PROVEEDOR'); echo $proveedor ?></td>
                    <td><?php echo oci_result($stid, 'MONEDA CONTRATO') ?></td>
                    <td><?php echo oci_result($stid, 'VALOR CONTRATO') ?></td>
                    <td><?php echo oci_result($stid, 'FACTURADO') ?></td>
                    <td><?php echo oci_result($stid, 'IVA FACTURADO') ?></td>
                    <td><?php echo oci_result($stid, 'SALDO CONTRATO') ?></td>
                    <td><?php echo "Sin datos" ?></td>
                    <td><?php echo "Sin datos" ?></td>
                    <td><?php 
                       if($dias <= 0){
                        $color = "#000 ";
                      }else{
                        if($dias > 90){
                          $color = "#6CD410";
                        }else if($dias > 60){
                          $color = "#F1C40F";
                        }else if($days = 30){
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
                    <td><a href="enlaces.php?contrato=<?php echo $contrato ?>&proveedor= <?php echo $proveedor?>&Usuario= <?php echo $Usuario?>" ><button type='button' class='btn btn-light'>Enlace</button></a></td>

                    <td><a href="contratos.php?contrato=<?php echo $contrato ?>" ><button type='button' class='btn btn-light'>Ver mas</button></a></td>
                    </td>
                </tr>
            <?php
           
            print "</tr>\n";
        }
        
        print "</table>\n";

oci_free_statement($stid);
oci_close($conexión);

?>
<!-- fin del div cont -->
    </div>
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
            <h6>Categoria</h6>
            <ul class="footer-links">
              <li><a href="#">EJEMPLO</a></li>
             
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="http://scanfcode.com/about/">About Us</a></li>
              <li><a href="http://scanfcode.com/contact/">Contact Us</a></li>
              <li><a href="http://scanfcode.com/contribute-at-scanfcode/">Contribute</a></li>
              <li><a href="http://scanfcode.com/privacy-policy/">Privacy Policy</a></li>
              <li><a href="http://scanfcode.com/sitemap/">Sitemap</a></li>
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
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/bootstrap.bundle.min.js"></script>
<script>

var c = document.getElementById("divCons");
  function consluta(){
   
    if (c.style.display === "block") {
          c.style.display = "none";
    } else {
        c.style.display = "block";
    }
  }

var x = document.getElementById("contM");

  function mostrar() {
         
    if (x.style.display === "block") {
          x.style.display = "none";
    } else {
        x.style.display = "block";
    }
  }

 
</script>
</body>
</html>