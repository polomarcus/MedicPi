<div id="configuration">
	<h1>Configuration du système</h1>
	<div class="row-fluid">
		<div class="span4">
			<form>
				<p>
					Température maximale : <span id="maxCurrent"><?php echo $config->maxTemp ?> °C</span>
	              	<span id="maxNext">
	              		<input id="max" type="text" name="max" size="3" value="<?php echo $config->maxTemp ?>"/> °C
	              	</span>
	              	<a id="changeValueMax" href="#">Modifier</a>
	              	<a id="buttomSubmitMax" href="#">Valider</a>
	              	<span class="reponseMax"></span>
				</p>
			</form>
		</div>
		<div class="span4">
			<form>
				<p>
					Température minimale : <span id="minCurrent"><?php echo $config->minTemp ?> °C</span>
	              	<span id="minNext">
	              		<input id="min" type="text" name="min" size="3" value="<?php echo $config->minTemp ?>"/> °C
	              	</span>
	              	<a id="changeValueMin" href="#">Modifier</a>
	              	<a id="buttomSubmitMin" href="#">Valider</a>
	              	<span class="reponseMin"></span>
				</p>
			</form>
		</div>
		<div class="span4">
			<form>
				<p>
					Délai avant alerte : <span id="delayCurrent"><?php echo $config->nbHourAlert ?> heures</span>
	              	<span id="delayNext">
	              		<input id="delay" type="text" name="delay" size="3" value="<?php echo $config->nbHourAlert ?>"/> heures
	              	</span>
	              	<a id="changeValueDelay" href="#">Modifier</a>
	              	<a id="buttomSubmitDelay" href="#">Valider</a>
	              	<span class="reponseDelay"></span>
				</p>
			</form>
		</div>
		<div class="span4">
			<form>
				<p>
					Mode Vacance :
					<input type="radio" name="vac" id="non" value="Non" 
						<?php if($config->holiday == 0): ?>checked <?php endif;?> />
	              	non	<input type="radio" name="vac" id="oui" value="Oui" 
						<?php if($config->holiday == 1):?>checked <?php endif;?> />
					oui <span id="reponseHoliday"></span>
				</p>
	              
			</form>
		</div>
	</div>
</div>