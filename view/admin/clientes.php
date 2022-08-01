

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>

  <style>
	

body{

background-image: url(img/fondo.jpg);


}


</style>


  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a href="nuevo_usuario.php"><button type='button' class="btn " data-toggle="" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo usuario</button></a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar usuario</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
				include("modal/registro_clientes.php");
				include("modal/editar_clientes.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Cliente</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre Usuario" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			
		
	
			
			
			
  </div>
</div>
		 
	</div>

	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/clientes.js"></script>
  </body>
</html>
