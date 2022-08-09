<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/adminStyle.css">
    <link rel="shortcut icon" href="../assets/logos/LOGO_ETB.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>ADMINISTRADOR</title>
</head>
<body>
  <style>
  .switchBtn {
    position: relative;
    display: inline-block;
    width: 70px;
    height: 34px;
}
.switchBtn input {display:none;}
.slide {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #F57E58;
    -webkit-transition: .4s;
    transition: .4s;
    padding: 8px;
    color: #fff;
}
.slide:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 40px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}
input:checked + .slide {
    background-color: #8CE196;
    padding-left: 40px;
}
input:focus + .slide {
    box-shadow: 0 0 1px #01aeed;
}
input:checked + .slide:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    left: -20px;
}

.slide.round {
    border-radius: 34px;
}
.slide.round:before {
    border-radius: 50%;
}

.btnSwt{
  
}

  </style>

<nav class="navbar navbar-light nav-justified" style="background: rgb(0,255,255);
background: linear-gradient(156deg, rgba(0,255,255,1) 0%, rgba(20,193,234,1) 61%); color: white;">
    <div></div>
        <a class="navbar-brand" href="#">
            <img src="../assets/logos/Logo-blanco-tagline.png" width="100" height="auto" class="d-inline-block align-top" alt="">
        </a>
        <div>
            <h1>Usuarios</h1>
            
        </div>
        
        <div></div>
        <?php echo '<a href="'.$_SERVER['HTTP_REFERER'].'"><button type="button" class="btn btn-danger">Volver</button></a>' ?>
        <div></div>
</nav>
<?php 
include('db.php');
$cons='SELECT SUPERVISOR, LOGIN, CONDICION, CARGO, CEDULA FROM TBL_UM_SUPERVISORES';

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

       
       $i = 1;

       function test(){
        echo "Se ha activado el boton";
       }
?>
<div class="container">
    <h1 class="text-center">Usuarios </h1> 
    <table class="table table-bordered">

        <thead>
	    
	    <a href="nuevo_usuario.php">
	        <button type="submit" style="float: right; margin-bottom: 10px;" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
          </button>
        </a>
            <tr>
                <th>#</th>
                <th>ID ETB</th>
			          <th>Cargo</th>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Editar</th>
                <th>estado</th>
            </tr>
        </thead>
        <tbody>
          <?php 
             while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {

              $sup = oci_result($stid, 'SUPERVISOR');
              $login = oci_result($stid, 'LOGIN');
              $cond = oci_result($stid, 'CONDICION');
              $cargo = oci_result($stid, 'CARGO');
              $cedula = oci_result($stid, 'CEDULA');          
          ?>
            <tr>
              <td><?php $j = $i++; echo $j?></td>
              <td><?php echo $login ?></td>
              <td><?php echo $cargo ?></td>
              <td><?php echo $sup ?></td>
              <td><?php echo $cedula ?></td>
              
			        <td>
                <a href="modificar_usu.php?id=<?php echo $login?>"><button type="button" class="btn btn-light" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
                </button></a>
             </td>
                <td>
                  <?php
                if($cond == 1){
                  
                   print '<a href="crud.php?op=habilitar&cond='.$cond.'&id='.$login.'"><button class="btn btn-light btnSwt" style="background:#F57E58;" >
                   deshabilitar
                  </button>';
                }else{
                  print '<a href="crud.php?op=habilitar&cond='.$cond.'&id='.$login.'"><button class="btn btn-light btnSwt" style="background: #8CE196;">
                  habilitar
                  </button></a>';
                }
                ?>
                </td>
			        </tr>
                  <?php 
                  }
                ?>
        </tbody>
    </table>
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
  <script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
	
</body>
</html>