


<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Facturas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>

<style>
	

body{

background-image: url(img/etb.jpg);


}


</style>


  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
		<div class="panel panel-">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button'><a  href="nuevo_contrato.php" class="btn"><span class="glyphicon glyphicon-plus" ></span> Agregar Contrato</a></button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Contrato</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">BUSCAR CONTRATO</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Buscar Contrato" onkeyup='load(1);'>
							</div>
							
							
							
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div>
				<div class='outer_div'></div>
			</div>
		</div>	
		
	</div>
	
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
  </body>
</html>