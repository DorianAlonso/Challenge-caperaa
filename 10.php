
		<?php
		$s = "Homme";
		$id = "10";
		$db = new PDO("mysql:host=localhost;dbname=caperaa;charset=utf8", "root", "root");
		include "base.php";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST['nom'];
		$edit_prenom = $_POST['prenom'];
		$edit_sexe = $_POST['sexe'];
		$edit_age = $_POST['age'];
		$edit_taille = $_POST['taille'];
		$edit_poids = $_POST['poids'];?> 

		
		
		<form method="post"> 
		<div>
		<label>Nom</label>
		<input class="ecart_inscription" name="nom" class="case" type="text" value="Faucher">
		</div>
		<div>
		<label>Prénom</label> 
		<input class="ecart_inscription" name="prenom" type="text" value="Noa">
		</div>
		<div>
		<label>Age</label> 
		<input class="ecart_inscription" name="age" type="number" value="20">
		</div>
		<div>
		<label>Poids</label>
		<input class="ecart_inscription" name="poids" type="number" value="69">
		</div>
		<div>
		<label>Taille</label> 
		<input class="ecart_inscription" name="taille" type="number" value="170"> 
		</div>
		<div>
		<label>Sexe</label> 
		<?php
		if ($s == "Homme"){
		echo '<select class="ecart_inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme" selected >Homme</option>
        <option value="Femme">Femme</option>
    	</select>';
		} 
		if ($s == "Femme"){
		echo '<select class="ecart_inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme" selected >Femme</option>
    	</select>';
	} 
	if(array_key_exists('refuser', $_POST)) {
		refuser_demande($db,$id);
	}
		?>
		<br>
		<div>
		<input class="ecart_inscription" type="submit" value="Valider"> 
		<input type="submit" name="refuser" class="ecart_inscription" value="Retirer ce combatant" /> </form>


		</div>
		
		<?php


		$edit_req_ma_table = $db->prepare("UPDATE participants SET Nom = '$edit_nom', Prenom = '$edit_prenom', Age = $edit_age, Poids = $edit_poids, Taille = $edit_taille, Sexe = '$edit_sexe'  WHERE idParticipant = 10");
		$edit_req_ma_table->execute();
		function refuser_demande($db,$id){
			$req_ma_table = $db->prepare("DELETE FROM participants WHERE `idParticipant` = '$id'");
			$req_ma_table->execute();
			header("location: participant.php");
		}

		?>
		