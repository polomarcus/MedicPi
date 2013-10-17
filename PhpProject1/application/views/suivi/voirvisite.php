<div id="visite">
	<h1>Les jours de visite</h1>
	<table>
		<tr> 
		 <th>Date</th> 
		 <th>Qui</th> 
		</tr> 
		  
		<?php foreach($visits as $vis): ?>
		 <tr>
		      	 <td><?php echo $vis->date ?></td>
		      	 <td><?php echo $vis->prenom . ' ' . $vis->nom ?></td>
		<?php endforeach;?>
	</table>
		
		<?php echo $this->pagination->create_links(); ?>
</div>