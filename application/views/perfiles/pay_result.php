<div class="container" style="padding-top:180px;">

	<h2>Facturación - Resultado de Pago en línea</h1>
    <div class="amigas-separator"></div>
    <div class="container" style="padding-top:50px;">
	    <div class="text-center panel-registro col-md-8 col-md-offset-2 alert alert-success" style="padding:30px;">
	    	<?php
			if (strtoupper($firma) == strtoupper($firmacreada)) {
			?>
            	<h2>Resumen Transacción</h2>
                <table>
                <tr>
                <td>Estado de la transaccion</td>
                <td><?php echo $estadoTx; ?></td>
                </tr>
                <tr>
                <tr>
                <td>ID de la transaccion</td>
                <td><?php echo $transactionId; ?></td>
                </tr>
                <tr>
                <td>Referencia de la venta</td>
                <td><?php echo $reference_pol; ?></td> 
                </tr>
                <tr>
                <td>Referencia de la transaccion</td>
                <td><?php echo $referenceCode; ?></td>
                </tr>
                <tr>
                <?php
                if($pseBank != null) {
                ?>
                    <tr>
                    <td>cus </td>
                    <td><?php echo $cus; ?> </td>
                    </tr>
                    <tr>
                    <td>Banco </td>
                    <td><?php echo $pseBank; ?> </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                <td>Valor total</td>
                <td>$<?php echo number_format($TX_VALUE); ?></td>
                </tr>
                <tr>
                <td>Moneda</td>
                <td><?php echo $currency; ?></td>
                </tr>
                <tr>
                <td>Descripción</td>
                <td><?php echo ($extra1); ?></td>
                </tr>
                <tr>
                <td>Entidad:</td>
                <td><?php echo ($lapPaymentMethod); ?></td>
                </tr>
                </table>
            <?php 
			}
			else {
			?>
            	<h1>Error validando firma digital.</h1>
            <?php 
			}
			?>
	    </div>
    </div>
    
</div>

<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>

<script>



</script>