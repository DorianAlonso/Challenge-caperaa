
		<?php
		include "base.php";
		include "fonctions.php";
		if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Organisateur" )) {
			header("location: login.php");
		  }
		$s = "Homme";
		$id = "20";
		$db = new PDO("mysql:host=localhost;dbname=caperaa;charset=utf8", "root", "root");
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST['nom'];
		$edit_prenom = $_POST['prenom'];
		$edit_sexe = $_POST['sexe'];
		$edit_age = $_POST['age'];
		$edit_taille = $_POST['taille'];
		$edit_poids = $_POST['poids'];
		$edit_ceinture = $_POST['ceinture'];
		echo $edit_nom;
		echo $edit_prenom;
		echo $edit_sexe;
		echo $edit_age;
		echo $edit_taille;
		echo $edit_poids;
		echo $edit_ceinture;
		?> 

		
		<form method="post" class="inscription"> 
		<a class="inscription" href="participant.php" > <span class="material-icons icon">arrow_back</span> Retour</a>
		<label>Nom</label>
		<input class="inscription" name="nom" class="case" type="text" value="Test">
		<label>Prénom</label> 
		<input class="inscription" name="prenom" type="text" value="Testt">
		<label>Age</label> 
		<input class="inscription" name="age" type="number" value="18">
		<label>Poids</label>
		<input class="inscription" name="poids" type="number" value="80">
		<label>Taille</label> 
		<input class="inscription" name="taille" type="number" value="185"> 
		<label>Sexe</label> 
		<?php
		if ($s == "Homme"){
		echo '<select class="inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme" selected >Homme</option>
        <option value="Femme">Femme</option>
    	</select>';
		} 
		if ($s == "Femme"){
		echo '<select class="inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme" selected >Femme</option>
    	</select>';
	} 
	if(array_key_exists('valider', $_POST)) {
		echo 'testtt';
		edit($db,$id);
	}
	if(array_key_exists('refuser', $_POST)) {
		refuser_demande($db,$id);
	}
		?>
		<label>Ceinture</label> 
		<select class="inscription" name="ceinture" id="">
        <option value="">Sélectionnez votre ceinture</option>
        <option value="blanche">blanche</option>
        <option value="blanche et jaune">blanche et jaune</option>
        <option value="jaune">jaune</option>
        <option value="jaune et orange">jaune et orange</option>
        <option value="orange">orange</option>
        <option value="orange et verte">orange et verte</option>
        <option value="verte">verte</option>
        <option value="verte et bleue">verte et bleue</option>
        <option value="bleue">bleue</option>
        <option value="marron">marron</option>
    	</select>
		<div>
		<input class="inscription" name="valider" type="submit" value="Valider"> 
		<input type="submit" name="refuser" class="inscription" id="refuser" value="Retirer ce combatant" /> </form>



		<?php

		function refuser_demande($db,$id){
			$req_ma_table = $db->prepare("DELETE FROM participants WHERE `idParticipant` = '$id'");
			$req_ma_table->execute();
			header("location: participant.php");
		}

		function edit($db,$id){
		$edit_req_ma_table = $db->prepare("UPDATE participants SET Nom = '$edit_nom', Prenom = '$edit_prenom', Age = $edit_age, Poids = $edit_poids, Taille = $edit_taille, Sexe = '$edit_sexe', Ceinture = '$edit_ceinture'  WHERE idParticipant = 20");
		$edit_req_ma_table->execute();
		}
		?>
		