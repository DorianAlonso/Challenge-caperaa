
		<?php
		include "base.php";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST['nom'];
		$edit_prenom = $_POST['prenom'];
		$edit_sexe = $_POST['sexe'];
		$edit_age = $_POST['age'];
		$edit_taille = $_POST['taille'];
		$edit_poids = $_POST['poids'];?> 

		<ul>
		<li class="case"> <form method="post"> <input name="nom" class="case" type="text" value="Faucher"> <input name="prenom" type="text" value="Noa"> <input name="age" type="number" value="20"> <input name="poids" type="number" value="69"> <input name="taille" type="number" value="170"> <input name="sexe" type="text" value="Homme"> <br><input type="submit" value="Valider"> </form> </li>
		</ul>
		<?php

		echo $edit_nom,"<br>"; 
		echo $edit_prenom,"<br>";
		echo $edit_sexe,"<br>";
		echo $edit_age,"<br>";
		unset($db);
		$edit_req_ma_table = $db->prepare("UPDATE participants SET Poids = 75 WHERE idParticipant = 7");
		$edit_req_ma_table->execute();

		echo $edit_poids,"<br>";
		echo $edit_taille,"<br>";
		

	


	

		?>
		