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
$requete_pdo = $bdd->prepare("SELECT * from Categorie");
$requete_pdo->execute();
if(($requete_pdo->rowCount()) == 0){
    //Si le résultat retourner par la fonction est égal à  0 alors pas de catégories à afficher
    echo "Problème d'accès à la base de données";
}
else {
    // on n'affiche les catégories avec le nombre de questionnaires par catégories
    while($donnees = $requete_pdo->fetch()){  
        // Pour chaque catégorie on cherche combien de QCM existe
        $cat=$donnees['id_Categorie'];
        $requete_pdo1 = $bdd->prepare("SELECT COUNT(id_Categorie) from Questionnaire where id_Categorie='$cat'");
        $requete_pdo1->execute();
        $donnees1 = $requete_pdo1->fetch();

        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo $donnees['nom_Categorie'];
        echo '<span class="badge badge-primary badge-pill" title="Nombre de QCMs pour la catégorie">'.$donnees1['COUNT(id_Categorie)'].'</span>';
        echo '</li>';


    }
}

?>