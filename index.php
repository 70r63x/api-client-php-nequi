<?php  
/*
 * @description Utiliza el cliente del API de Nequi
 * @author Jorge Herrera, https://www.linkedin.com/in/jorge-herrera93/
 * @author Diego Gutierres, https://github.com/agldiego
 */
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test consumo API Nequi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<?php
		include 'validUser.php';
		include 'codeQR.php';
		include 'notificacionPush.php';
	?>
</head>
<body>
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-12 mb-4 text-center">
				<h1>Test consumo API Nequi</h1>
			</div>
			<div class="accordion" id="accordionExample">
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h2 class="mb-0">
			        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			          Validar Usuario
			        </button>
			      </h2>
			    </div>

			    <div id="collapseOne" class="collapse <?php echo ($accionV == 'validar')? 'show' : '' ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
			      <div class="card-body">
			        <form action="index.php" method="post">
			        	<div class="row">
			        		<div class="col">
			        			<label>Número celular</label>
			        			<input type="tel" name="celular" required placeholder="000 000 0000">
			        		</div>
			        		<div class="col my-auto">
			        			<button class="btn btn-primary" type="submit" name="validar" id="validar">Validar</button>
			        		</div>
			        	</div>
			        </form>
			       	<div class="row mt-4">
			       		<?php if ($valid != null) { ?>
			       			<div class="col-3">
				       			Usuario <?php echo $valid; ?>
				       		</div>
			       		<?php } ?>
			       		
			       		<?php if ($nombreUser != null) { ?>
			       			<div class="col">
				       			Nombre de Usuario: <?php echo $nombreUser; ?>
				       		</div>
			       		<?php } ?>
			       	</div>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingTwo">
			      <h2 class="mb-0">
			        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          Obtener codigo QR
			        </button>
			      </h2>
			    </div>
			    <div id="collapseTwo" class="collapse <?php echo ($accion == 'qr')? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
			      <div class="card-body">
			      	<div class="row">
			      		<div class="col-12">
			      			<p>Para saber como pagar con codigo QR, ver el siguiente video <a target="_blank" href="https://youtu.be/OwAREO5QsG8">Nequi QR</a></p>
			      		</div>
			      	</div>
			        <form action="index.php" method="post">
			        	<div class="row">
			        		<div class="col">
			        			<label>Valor a cobrar</label>
			        			<input type="number" name="valor" required min="1" value="1">
			        		</div>
			        		<div class="col my-auto">
			        			<button class="btn btn-primary" type="submit" name="qrGenerate" id="validar">Generar QR</button>
			        		</div>
			        	</div>
			        </form>
			        <div class="row mt-4">
			       		<?php if ($validQR != null) { ?>
			       			<div class="col-6">
				       			<?php echo $validQR; ?>
				       		</div>
			       		<?php } ?>
			       		
			       		<?php if ($codeQR != null) { ?>
			       			<div class="col-6">
				       			<?php echo $codeQR; ?>
				       		</div>
				       		<div class="col-12 text-center mt-4">
				       			<img class="img_fluid w-25" src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=bancadigital-<?php echo $codeQR;?>">
				       		</div>
			       		<?php } ?>
			       		<div class="col-12 mt-4">
			       			<p><strong>Nota: </strong>Si quieres pagar despues ten en cuenta que tienes 45 minutos para realizar el pago o si no será totalmente rechazado y tendras que solicitar de nuevo tu pago desde nuestro sitio web</p>
			       		</div>
			       	</div>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingThree">
			      <h2 class="mb-0">
			        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          Notificación Push
			        </button>
			      </h2>
			    </div>
			    <div id="collapseThree" class="collapse <?php echo ($accionN == 'validarn')? 'show' : '' ?>" aria-labelledby="headingThree" data-parent="#accordionExample">
			      <div class="card-body">
			        <form action="index.php" method="post">
			        	<div class="row">
			        		<div class="col">
			        			<label>Número celular</label>
			        			<input type="tel" name="celularn" required placeholder="000 000 0000">
			        		</div>
			        		<div class="col">
			        			<label>Valor a cobrar</label>
			        			<input type="number" name="valorn" required min="1" value="1">
			        		</div>
			        		<div class="col my-auto">
			        			<button class="btn btn-primary" type="submit" name="notificacion" id="validar">Enviar Notificación</button>
			        		</div>
			        	</div>
			        </form>
			        <div class="row mt-4">
			       		<?php if ($validN != null) { ?>
			       			<div class="col-6">
				       			<?php echo $validN; ?>
				       		</div>
			       		<?php } ?>
			       		
			       		<?php if ($transactionId != null) { ?>
			       			<div class="col-6">
				       			ID Transacción: <?php echo $transactionId; ?>
				       		</div>
			       		<?php } ?>
			       	</div>
			       	<div class="col-12 mt-4">
		       			<p><strong>Nota: </strong>Si quieres pagar despues ten en cuenta que tienes 45 minutos para realizar el pago o si no será totalmente rechazado y tendras que solicitar de nuevo tu pago desde nuestro sitio web</p>
		       		</div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>