<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/logos/LOGO_ETB.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?php $idetb = $_GET['idetb']; echo $idetb ?> </title>
</head>
<body>

<style>
    body{
        background: #F2F4F4;
    }
    .divCont{
            background: #fff; 
            padding:10px;
            border-radius: 1rem;
            box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.1);
            
        }
    .divContMon{
        background: #186CD1;
        color: #fff; 
        padding:10px;
        border-radius: 1rem;
        box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.1);
    }
    .parent {
display: grid;
grid-template-columns: repeat(4, 1fr);
grid-template-rows: repeat(6, 1fr);
grid-column-gap: 10px;
grid-row-gap: 10px;
}

.div1 { grid-area: 1 / 1 / 2 / 2; }
.div2 { grid-area: 1 / 2 / 2 / 3; }
.div3 { grid-area: 1 / 3 / 2 / 4; }
.div4 { grid-area: 1 / 4 / 2 / 5; }
.div5 { grid-area: 2 / 1 / 3 / 2; }
.div6 { grid-area: 2 / 2 / 3 / 3; }
.div7 { grid-area: 2 / 3 / 3 / 4; }
.div8 { grid-area: 2 / 4 / 3 / 5; }
.div9 { grid-area: 3 / 1 / 4 / 2; }
.div10 { grid-area: 3 / 2 / 4 / 3; }
.div11 { grid-area: 3 / 3 / 4 / 4; }
.div12 { grid-area: 3 / 4 / 4 / 5; }
.div13 { grid-area: 4 / 1 / 5 / 2; }
.div14 { grid-area: 4 / 2 / 5 / 3; }
.div15 { grid-area: 4 / 3 / 5 / 4; }
.div16 { grid-area: 4 / 4 / 5 / 5; }
.div17 { grid-area: 5 / 1 / 6 / 2; }
.div18 { grid-area: 5 / 2 / 6 / 3; }
.div19 { grid-area: 5 / 3 / 6 / 4; }
.div20 { grid-area: 5 / 4 / 6 / 5; }
.div21 { grid-area: 6 / 1 / 7 / 2; }
.div22 { grid-area: 6 / 2 / 7 / 3; }
.div23 { grid-area: 6 / 3 / 7 / 4; }

</style>
<!-- Image and text -->
<nav class="navbar navbar-light nav-justified" style="background: rgb(0,255,255);
background: linear-gradient(156deg, rgba(0,255,255,1) 0%, rgba(20,193,234,1) 61%); color: white;">
    <div></div>
        <a class="navbar-brand" href="#">
            <img src="assets/logos/Logo-blanco-tagline.png" width="100" height="auto" class="d-inline-block align-top" alt="">
        </a>
        <div>
            <h4>Enlace N°: <?php $idcont = $_GET['idetb']; echo $idcont?></h4>
        </div>
        
        <div></div>
          <button type='button' class='btn btn-danger' onclick="window.close()">Cerrar</button>
        <div></div>
</nav>

<div class="container">
    <br>
    <h1></h1>
    <br>
    <?php
include('db.php');
$idetb = $_GET['idetb'];

$cons="SELECT E.ID_ETB_ENLACE_CAV as IDENLACE, E.NOMBRE_CLIENTE as CLIENTE, E.PROYECTO as PROYECTO, CENTRO_POBLADO as CIUDAD,E.DIRECCION as DIRECCION,
TIP_SERV as SERVICIO, E.ANCHO_DE_BANDA_KBPS as BANDA, E.DOWNSTREAM as DW, E.UPSTREAM as UP,E.INICIO_SERVICIO as INICIO,E.FIN_SERVICIO as FIN,E.ESTADO
as ESTADO,E.NUMERO_DE_CONTRATO as NCON, C.MON_CON as MONEDA,E.ID_SUBSEGMENTO as SUB,E.ID_REGIONAL as REGIONAL,E.ID_PROVEEDOR as IDP, M.MEDIO AS MEDIO,
E.COP_MENSUALIDAD as VCOP,E.USD_MENSUALIDAD as VUSD,E.FECHA_INICIO_PROV as FINIP,E.FECHA_INICIO_CLIE as FINIC, E.ID_SERV_PROV_1 as IDSP ,E.DATOS_ADICIONALES as DA
  
FROM TBL_UM_ENLACES E

INNER JOIN TBL_UM_CENTROS_POBLADOS ON E.CIUDAD = IDCENTROPOBLADO

INNER JOIN TBL_UM_TIP_SERV ON E.TIPO_SERVICIO = TIPSERV

INNER JOIN TBL_UM_MEDIOS M ON E.MEDIO = M.IDMEDIO

INNER JOIN TBL_UM_CONTRATOS C ON E.NUMERO_DE_CONTRATO = C.IDCONTRATO

WHERE E.ID_ETB_ENLACE_CAV='".$idetb."'";

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
        while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $idenlace = oci_result($stid, 'IDENLACE');
            $client = oci_result($stid, 'CLIENTE');
            $proyecto = oci_result($stid, 'PROYECTO');
            $ciudad = oci_result($stid, 'CIUDAD');
            $dir = oci_result($stid, 'DIRECCION');
            $ser = oci_result($stid, 'SERVICIO');
            $banda = oci_result($stid, 'BANDA');
            $dw = oci_result($stid, 'DW');
            $up = oci_result($stid, 'UP');
            $in = oci_result($stid, 'INICIO');
            $fin = oci_result($stid, 'FIN');
            $est = oci_result($stid, 'ESTADO');
            $ncon = oci_result($stid, 'NCON');
            $sub = oci_result($stid, 'SUB');
            $reg = oci_result($stid, 'REGIONAL');
            $idp = oci_result($stid, 'IDP');
            $md = oci_result($stid, 'MEDIO');
            $vcop = oci_result($stid, 'VCOP');
            $vusd = oci_result($stid, 'VUSD');
            $moneda = oci_result($stid, 'MONEDA');
            $finip = oci_result($stid, 'FINIP');
            $finic = oci_result($stid, 'FINIC');
            $idps = oci_result($stid, 'IDSP');
            $da = oci_result($stid, 'DA');
            
        }

        IF($moneda = "USD"){
            $vlr = $vusd;
        }else{
            $vlr = $vcop;
        }

?>
        <div class="parent">
            <div class="div1 divCont">
                <H5>IDENLACE</H5>
                <br>
                <p><?php echo $idenlace ?></p>
            </div>
            <div class="div2 divCont">
                <h5>ID SERVICIO PROVEEDOR </h5>
                <br>
                <p><?php echo $idps?></p>
            </div>
            <div class="div5 divCont">
                <h5>NOMBRE CLIENTE</h5>
                <br>
                <p><?php echo $client?></p>
            </div>
            <div class="div8 divContMon">
                <h5>MONEDA</h5>
                <br>
                <p><?php echo $moneda?></p>
            </div>
            <div class="div9 divCont">
                <h5>PROYECTO</h5>
                <br>
                <p><?php echo $proyecto?></p>
            </div>
            <div class="div6 divCont">
                <h5>CIUDAD</h5>
                <br>
                <p><?php echo $ciudad?></p>
            </div>
            <div class="div12 divContMon">
                <h5>MENSUALIDAD</h5>
                <br>
                <p><?php echo  $vlr?></p>
            </div>
            <div class="div7 divCont">
                <h5>DIRECCION</h5>
                <br>
                <p><?php echo $dir?></p>
            </div>
            <div class="div10 divCont">
                <h5>TIPO SERVICIO</h5>
                <br>
                <p><?php echo $ser?></p>
            </div>
            <div class="div13 divCont">
                <h5>ANCHO DE BANDA </h5>
                <br>
                <p><?php echo $banda?></p>
            </div>
            <div class="div15 divCont">
                <h5>MEGAS DE BAJADA </h5>
                <br>
                <p><?php echo $dw?></p>
            </div>
            <div class="div14 divCont">
                <h5>MEGAS DE SUBIDA</h5>
                <br>
                <p><?php echo $up?></p>
            </div>
            <div class="div16 divContMon">
                <h5>INICIO DE SERVICIO</h5>
                <br>
                <p><?php echo $in?></p>
            </div>
            <div class="div20 divContMon">
                <h5>FIN DE SERVICIO</h5>
                <br>
                <p><?php echo $fin?></p>
            </div>
            <div class="div3 divCont">
                <h5>ESTADO </h5>
                <br>
                <p><?php echo $est?></p>
            </div>
            <div class="div4 divContMon">
                <h5>NUMERO DE CONTRATO </h5>
                <br>
                <p><?php echo $ncon?></p>
            </div>
            <div class="div18 divCont">
                <h5>ID SUBSEGMENTO</h5>
                <br>
                <p><?php echo $sub?></p>
            </div>
            <div class="div17 divCont">
                <h5>ID REGIONAL </h5>
                <br>
                <p><?php echo $reg?></p>
            </div>
            <div class="div23 divCont">
                <h5>ID PROVEEDOR  </h5>
                <br>
                <p><?php echo $idp?></p>
            </div>
            <div class="div11 divCont">
                <h5>MEDIO  </h5>
                <br>
                <p><?php echo $md?></p>
            </div>
            <div class="div22 divCont">
                <h5>FECHA INICIO PROVEEDOR  </h5>
                <br>
                <p><?php echo $finip?></p>
            </div>
            <div class="div21 divCont">
                <h5>FECHA INICIO CLIENTE </h5>
                <br>
                <p><?php echo $finic?></p>
            </div>
            
            <div class="div19 divCont">
                <h5>DATOS ADICIONALES  </h5>
                <br>
                <p><?php echo $da?></p>
            </div>
            
        </div>
        
               
<?php
      
oci_free_statement($stid);
oci_close($conexión);

    ?>
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