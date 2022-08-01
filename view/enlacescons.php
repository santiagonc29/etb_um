
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../assets/logos/LOGO_ETB.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Consulta</title>
</head>
<body>

<style>
    body{
        background: #F2F4F4;
    }

    .hide{
        border: solid 1px black;
        width: 120%;
        display: none;
    }
    .divCont{
            background: #fff; 
            padding:10px;
            
        }
    .divContMon{
        background: #186CD1;
        color: #fff; 
        padding:10px;
        border-radius: 1rem;
        box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.1);
    }
   
.divCons{
      
      width:100%;
      margin-top:20px;
      background: #FFF;
      padding: 10px;
      border-radius: 1rem;
      box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.1);
}


</style>
<!-- Image and text -->
<nav class="navbar navbar-light nav-justified" style="background: rgb(0,255,255);
background: linear-gradient(156deg, rgba(0,255,255,1) 0%, rgba(20,193,234,1) 61%); color: white;">
    <div></div>
        <a class="navbar-brand" href="#">
            <img src="../assets/logos/Logo-blanco-tagline.png" width="100" height="auto" class="d-inline-block align-top" alt="">
        </a>
        <div>
            <h2>Consultar</h2>
        </div>
        
        <div></div>
        <?php echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><button type="button" class="btn btn-danger">Volver</button></a>' ?>
          
        <div></div>
</nav>

<div class="container" style="height: 23em;">
<div id="divCons" class="divCons">
    <form class="row gx-3 gy-2 align-items-center" action="enlacescons.php" method="POST">
      <div class="col-md-2" style="margin:10px 0px;">
        <label class="visually-block" for="numero">Numero a consultar</label>
        <input type="text" class="form-control" id="numero" name="numero" placeholder="Id" required>
      </div>
      <br>
      <div class="col-md-2" style="margin:20px 0px;">
        <label class="visible" for="tipo">Tipo de consulta</label>
        <select class="form-select" id="tipo" name="tipo" required>
          <option selected>Seleccione...</option>
          <option value="1">Enlaces</option>
          <option value="2">Proveedores</option>
          <option value="3">Servicio</option>
        </select>
      </div>
      <div class="col-md-2" style="margin-top: 20px; ">
        <button type="submit" class="btn btn-outline-secondary" >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </button>
      </div>
      <div class="col-md-2">
        <h2 id="var"><script>getValueInput(case)</script> </h2>
      </div>
    </form>
  
<?php 
include('db.php');
error_reporting(0);
  $numero=$_POST['numero'];
  $tipo=$_POST['tipo'];


  switch($tipo){

    // Enlace
    case "1":
      // $cons="SELECT
          
      // FROM TBL_UM_ENLACES E
          
      // INNER JOIN TBL_UM_CENTROS_POBLADOS ON E.CIUDAD = IDCENTROPOBLADO
          
      // INNER JOIN TBL_UM_TIP_SERV ON E.TIPO_SERVICIO = TIPSERV
          
      // INNER JOIN TBL_UM_MEDIOS M ON E.MEDIO = M.IDMEDIO
          
      // INNER JOIN TBL_UM_CONTRATOS C ON E.NUMERO_DE_CONTRATO = C.IDCONTRATO
          
      // WHERE E.ID_ETB_ENLACE_CAV='".$idetb."'";
      
      //         $stid = oci_parse($conexión, $cons);
      //         if (!$stid) {
      //             $e = oci_error($conexión);
      //             trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      //         }// Realizar la lógica de la consulta
              
      //         $r = oci_execute($stid);
      //         if (!$r) {
      //             $e = oci_error($stid);
      //             trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      //         }// Obtener los resultados de la consulta
      //         while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
      //             $idenlace = oci_result($stid, 'IDENLACE');
      //             $client = oci_result($stid, 'CLIENTE');
      //             $proyecto = oci_result($stid, 'PROYECTO');
      //             $ciudad = oci_result($stid, 'CIUDAD');
      //             $dir = oci_result($stid, 'DIRECCION');
      //             $ser = oci_result($stid, 'SERVICIO');
      //             $banda = oci_result($stid, 'BANDA');
      //             $dw = oci_result($stid, 'DW');
      //             $up = oci_result($stid, 'UP');
      //             $in = oci_result($stid, 'INICIO');
      //             $fin = oci_result($stid, 'FIN');
      //             $est = oci_result($stid, 'ESTADO');
      //             $ncon = oci_result($stid, 'NCON');
      //             $sub = oci_result($stid, 'SUB');
      //             $reg = oci_result($stid, 'REGIONAL');
      //             $idp = oci_result($stid, 'IDP');
      //             $md = oci_result($stid, 'MEDIO');
      //             $vcop = oci_result($stid, 'VCOP');
      //             $vusd = oci_result($stid, 'VUSD');
      //             $moneda = oci_result($stid, 'MONEDA');
      //             $finip = oci_result($stid, 'FINIP');
      //             $finic = oci_result($stid, 'FINIC');
      //             $idps = oci_result($stid, 'IDSP');
      //             $da = oci_result($stid, 'DA');
                  
      //         }
      ?>
      <div class="row">
        <div class="col-md-4">
          <h6>Nombre tercero</h6>
          <p>Nombre</p>
        </div>
        <div class="col-md-4">
          <h6>Orden de tercero</h6><p>Numero</p>
          
        </div>
        <div class="col-md-4">
          <h6>Cliente</h6>
          <p>Nombre</p>
        </div>
      </div>

        <?php
        break;

        // proveedor
    case "2":

      ?>
      <div class="row">
        <div class="col-md-4">
          <h6>Nombre tercero</h6>
          <p>Nombre</p>
        </div>
        <div class="col-md-4">
          <h6>Orden de tercero</h6><p>Numero</p>
          
        </div>
        <div class="col-md-4">
          <h6>Cliente</h6>
          <p>Nombre</p>
        </div>
      </div>
      <?php
      break;

    // Servicio
    case "3":
      ?>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <h6>Nombre tercero</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Orden de tercero</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Cliente</h6>
          <p></p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-4">
          <h6>Ancho de banda</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Ancho de banda Up</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Ancho de banda Down</h6>
          <p></p>
        </div>
        <div class="col-md-4 ">
          <h6>Moneda</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Costo Mensualidad</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Plazo de duración</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Fin de servicio</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Renovación</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Ciudad</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Departamento</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          <h6>Dirección</h6>
          <p></p>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>
      <?php
      break;  

    case "0":
      ?>
      <h1></h1>
      <?php
      break;
    }

?>   


<?php
//oci_free_statement($stid);
//oci_close($conexión);

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
<script>
  function getValueInput(){
      let tipo = document.getElementById("tipo").value; 
      var case = "Enlaces";
      document.write(case);
      
    }
</script>
</body>
</html>