<div class="container body-admin">
	<h3 >Listado de códigos promocionales</h3>
    <div class="amigas-separator"></div>
    <div>
    	<table class="class table table-striped table-bordered" style="font-size:12px;">
        	<thead>
            	<tr>
                	<th>#</th>
                    <th>Código</th>
                    <th>Vigencia inicial</th>
                    <th>Vigencia final</th>
                    <th>Valor de descuento</th>
                    <th>Fecha de uso</th>
                    <th>Usuario que lo usó</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            	<?php 
    			foreach($promo_list as $promo){ ?>
        		<tr>
                	<td><?php echo $promo["id"]; ?></td>
                    <td><?php echo $promo["code_number"]; ?></td>
                    <td><?php echo $promo["vig_from"]; ?></td>
                    <td><?php echo $promo["vig_to"]; ?></td>
                    <td><?php echo $promo["value"]; ?></td>
                    <td><?php echo $promo["date_used"]; ?></td>
                    <td><?php echo $promo["user_used"]; ?></td>
                    <td>
                    <?php 
					if(!$promo["user_used"]) {
					?>
                    
                    <input onClick="deleteElement('<?php echo $promo["id"]; ?>')"  name="Eliminar" type="button" id="Eliminar" title="Eliminar" value="Eliminar"/></td>
                    
                     <?php }?>
                    
                    
              </tr>
                
                <?php }?>
            	
            </tbody>
        </table>
    </div>
    
</div>


<script>

function deleteElement(id) {
	alert(id);
}

</script>