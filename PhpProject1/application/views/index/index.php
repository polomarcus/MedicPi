<div id="accueil">
	<h1>Bienvenue !</h1>
	<p>
		Medic Pi est un site qui vous alerte lorsque quelque chose ne va pas chez une personne assistée à domicile.
	</p>
	
	<div id="inscription">
		<h3>Inscription</h3>
		<form method="post" action="#">
	
			<label class="label floatl"  for="login">Login : </label>
			<input class="input floatl"  id="loginIns" type="text" name="login" />
			
			<div id="loadLogin" class="floatl marginl10" style="display: none;">
				  <img src="<?php echo img_url('icones/ajax-loader.gif') ?>"/>
			</div>
			<label id="responseLogIns"></label>
			<br class="clear"/><br/>
			
			<label class="label floatl" for="pwd">Password :</label>
			<input class="input floatl" id="pwdIns" type="password" name="pwd"/>
			<label id="responsePwdIns"></label>
			<br class="clear"/><br />
			
			<label class="label floatl" for="cPwd">Confirm password :</label>
			<input class="input floatl" id="cPwdIns" type="password" name="cPwd"/>
			<label id="responseCPwdIns"></label>
			
			<br class="clear"/><br />
			
			<label class="label floatl" for="nom">Nom : </label>
			<input class="input floatl" id="nomIns" type="text" name="nom"/>
			<br class="clear"/><br/>
			
			<label class="label floatl" for="prenom">Prénom : </label>
			<input class="input floatl" id="prenomIns" type="text" name="prenom"/>
			<br class="clear"/><br/>
			
			<label class="label floatl" for="mail">Mail : </label>
			<input class="input floatl" id="mailIns" type="text" name="mail"/>
			<label id="responseMailIns"></label>
			<br class="clear"/><br/>
			
			<label class="label floatl" for="role">Role : </label>
			<select class="input floatl" id="roleIns" name="role">
				<option>Patient</option>
				<option>Medecin</option>
				<option>Famille</option>
			</select>
			<br class="clear"/><br/>
			
			<input class="submit" type="submit" id="submitIns" value="Inscription" />
			<label id="responseIns"></label>
		</form>
	</div>
</div>