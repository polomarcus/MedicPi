<div id="anomalie">
	<h1>Anomalies</h1>
	
	<table>
	<tr> 
	 <th class="col1">Alerte</th> 
	 <th class="col2">Description</th> 
	 <th class="col3">Valeur °C</th> 
	 <th class="col4">Date </th> 
	</tr> 
	  
	<?php foreach($anomalies as $ano): ?>
	 <tr>
	 		<?php  if($ano->type == "motion"):?>
	      	 <td>Mouvement</td>
	      	<?php endif;?>
	      	<?php  if($ano->type == "temperature"):?>
	      	 <td>Température</td>
	      	<?php endif;?>
	
	       <td><?php echo $ano->description ?></td>
	       <?php if($ano->type == "temperature"):?>
	     	  <td><?php echo $ano->data->val ?></td>
	     	  <td><a href="<?php echo site_url('data','index/' . $ano->data->dateTmp)?>"><?php echo $ano->data->dateTmp ?></a></td>
	       <?php endif; ?>
	       <?php if($ano->type == "motion"):?>
	       	 <td></td><!--  Pas de valeur pour motion -->
		  	 <td><a href="<?php echo site_url('data','index/' . $ano->data->dateMo)?>"><?php echo $ano->data->dateMo ?></a></td>
	       <?php endif; ?>
	</tr>
	<?php endforeach;?>
	</table>
	
	<?php echo $this->pagination->create_links(); ?>
</div>
