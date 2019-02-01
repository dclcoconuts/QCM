<?php

// ce script doit generer les lignes suivantes pour chaque QCM
// <a href="#" class="list-group-item list-group-item-action active">
// <div class="d-flex w-100 justify-content-between">
// <h5 class="mb-1">List group item heading</h5>
// <small>3 days ago</small>
// </div>
// <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
// <small>Donec id elit non mi porta.</small>
// </a>

// mettre active seulement sur le plus récent

// connexion pdo à la base de données
// utilisation d'un fichier Json pour récupérer les informations de connexion
$file_json = file_get_contents("php/config.json");
$parsed_json = json_decode($file_json, true);
$servername = $parsed_json['servername'];
$dbname = $parsed_json['dbname'];
$username = $parsed_json['username'];
$password = $parsed_json['password'];


try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // $bdd = new PDO("mysql:host=localhost;dbname=BDD_QCM", 'BDDQCM', 'comake');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec("SET NAMES utf8");
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


// récupération de la liste des 5 derniers QCMs validés
$requete_pdo = $bdd->prepare("SELECT * from Questionnaire ORDER BY date_Questionnaire ASC");
$requete_pdo->execute();
if(($requete_pdo->rowCount()) == 0){
    //Si le résultat retourner par la fonction est égal à  0, alors l'email n'a pas été trouvé
    echo "Problème d'accès à la base de données";
}
else {
    // on n'affiche que les 5 questionnaires les plus récents
    // on teste si il y a au moins 5 questionnaires
    if(($requete_pdo->rowCount()) < 5){
        $nb = $requete_pdo->rowCount();
    } else {
        $nb = 5;
    }

    for ($i=0; $i<$nb ; $i++){
        $resultat = $requete_pdo->fetch();
        echo '<a href="pageQCM.php" id="QCM'.$i.'" class="list-group-item list-group-item-action">';
        echo '<div class="d-flex w-100 justify-content-between">';
        echo '<h3 class="mb-1">'.$resultat['nom_Questionnaire'].'</h3>';
        echo '<small>'.$resultat['date_Questionnaire'].'</small>';
        echo '</div>';
        // echo '<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>';
        // echo '<small>QCM ajouté par </small>';
        echo '</a>';
    }
}

?>