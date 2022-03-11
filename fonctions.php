<?php
$db = new PDO('mysql:host=localhost;dbname=caperaa;charset=utf8', 'root', 'root');


function get__classement($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants ORDER BY points DESC");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$i++;
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$points = $result['points'];
		if($i==1){
			echo '<li class="classement"> <p class="classement">🥇'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i==2){
			echo '<li class="classement"> <p class="classement">🥈'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i==3){
			echo '<li class="classement"> <p class="classement">🥉'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i >3)
		echo '<li class="classement"> <p class="classement">'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
	}
}





function get__participants($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$sexe = $result['Sexe'];
		$age = $result['Age'];
		$taille = $result['Taille'];		
		$poids = $result['Poids'];
		$club = $result['Nom_club'];
		$ceinture = $result['Ceinture'];


		$edit_nom = $result['Nom'];
		$edit_prenom = $result['Prenom'];
		$edit_sexe = $result['Sexe'];
		$edit_age = $result['Age'];		
		$edit_taille = $result['Taille'];
		$edit_poids = $result['Poids'];
		$edit_ceinture = $result['Ceinture'];
		

		$id =  $result['idParticipant'];
		$file_handle = fopen($id.'.php', 'w');


		fwrite($file_handle,'
		<?php
		$s = "'.$sexe.'";
		$id = "'.$id.'";
		$db = new PDO("mysql:host=localhost;dbname=caperaa;charset=utf8", "root", "root");
		include "base.php";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST[\'nom\'];
		$edit_prenom = $_POST[\'prenom\'];
		$edit_sexe = $_POST[\'sexe\'];
		$edit_age = $_POST[\'age\'];
		$edit_taille = $_POST[\'taille\'];
		$edit_poids = $_POST[\'poids\'];
		$edit_ceinture = $_POST[\'ceinture\'];
		echo $edit_nom;
		echo $edit_prenom;
		echo $edit_sexe;
		echo $edit_age;
		echo $edit_taille;
		echo $edit_poids;
		echo $edit_ceinture;
		?> 

		
		
		<form method="post" class="inscription"> 
		<div>
		<label>Nom</label>
		<input class="inscription" name="nom" class="case" type="text" value="'.$edit_nom.'">
		</div>
		<div>
		<label>Prénom</label> 
		<input class="inscription" name="prenom" type="text" value="'.$edit_prenom.'">
		</div>
		<div>
		<label>Age</label> 
		<input class="inscription" name="age" type="number" value="'.$edit_age.'">
		</div>
		<div>
		<label>Poids</label>
		<input class="inscription" name="poids" type="number" value="'.$edit_poids.'">
		</div>
		<div>
		<label>Taille</label> 
		<input class="inscription" name="taille" type="number" value="'.$edit_taille.'"> 
		</div>
		<div>
		<label>Sexe</label> 
		<?php
		if ($s == "Homme"){
		echo \'<select class="inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme" selected >Homme</option>
        <option value="Femme">Femme</option>
    	</select>\';
		} 
		if ($s == "Femme"){
		echo \'<select class="inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme" selected >Femme</option>
    	</select>\';
	} 
	if(array_key_exists(\'valider\', $_POST)) {
		echo \'testtt\';
		edit($db,$id);
	}
		?>
		<div>
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
		</div>
		<br>
		<div>
		<input class="inscription" name="valider" type="submit" value="Valider"> 
		<input type="submit" name="refuser" class="inscription" value="Retirer ce combatant" /> </form>


		</div>
		
		<?php

		function edit($db,$id){
		$edit_req_ma_table = $db->prepare("UPDATE participants SET Nom = \'$edit_nom\', Prenom = \'$edit_prenom\', Age = $edit_age, Poids = $edit_poids, Taille = $edit_taille, Sexe = \'$edit_sexe\', Ceinture = \'$edit_ceinture\'  WHERE idParticipant = '.$id.'");
		$edit_req_ma_table->execute();
		}
		?>
		');
		
		
		fclose($file_handle);
		echo '<li class="case"> <p class="case">Nom : '.$nom.'</p> <p class="case">Prenom : '.$prenom.'</p> <p class="case">Age : '.$age.'</p> <p class="case">Poids : '.$poids." ".' kg</p> <p class="case">Taille : '.$taille.' cm</p> <p class="case">Sexe : '.$sexe.'</p> <p class = "case">Club :  '.$club.'</p> <p class = "case">Ceinture : '.$ceinture.'</p> <br><button onclick="location.href=\''.$id.'.php\'" id="'.$id.'" class="modifier">Modifier</button></li>';
	}
		
}

function add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids,$ceinture){
	$nom_club = get_nom_club($db);
	echo $nom;
	echo $prenom;
	echo $sexe;
	echo $age;
	echo $taille;
	echo $poids;
	echo $ceinture;
    $req_ma_table = $db->prepare("INSERT INTO participants (Nom,Prenom,Sexe,Age,Taille,Poids,Nom_club,Ceinture) VALUES ('$nom','$prenom','$sexe','$age','$taille','$poids','$nom_club','$ceinture')");
	$req_ma_table->execute();
}



define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'caperaa');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

    

function add_demande_inscription($db,$nom,$prenom,$email,$mdp,$role,$nom_club){
    $req_ma_table = $db->prepare("INSERT INTO demande_inscription (Nom,Prenom,Email,Mdp,Role,Nom_club) VALUES ('$nom','$prenom','$email','".hash('sha256', $mdp)."','$role','$nom_club')");
	$req_ma_table->execute();
}

// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}


function list_club($db){
        $req_ma_table = $db->prepare("SELECT `Nom-du-club` FROM `codes_clubs` ORDER BY `Nom-du-club`");
        $req_ma_table->execute();
        $result_req_ma_table = $req_ma_table->fetchAll();
        foreach ($result_req_ma_table as $result) {
            $club = $result['Nom-du-club'];
            echo '<option value="'.$club.'"> '.$club.'</option>';

		}
}


function get_role($db,$email){
	$req_ma_table = $db->prepare("SELECT Role FROM utilisateurs WHERE email = '$email'");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$role = $result['Role'];
	}
	return $role;
}


function get_nom_club($db){
	$email = $_SESSION["email"];
	$req_ma_table = $db->prepare("SELECT `Nom_club` FROM `utilisateurs` WHERE `email`= '$email' ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$nom_club = $result['Nom_club'];
	}
	return $nom_club;
}
    ?>

