<?php
session_start();
?>
<?php

// Script de gestion de la connexion utilisateur 
// recuperation email et password en méthode POST 
// Verification username et password dans la base de données
$email = $_POST['email'];
$psw = $_POST['psw'];

// connexion pdo à la base de données
// utilisation d'un fichier Json pour récupérer les informations de connexion
$file_json = file_get_contents("config.json");
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

// recupération du mot de passe pour le décrypté et le comparer à celui saisi

// verification si couple email existe dans la table Utilisateur et récupération du mot de paase
$requete_pdo = $bdd->prepare("SELECT nom_Utilisateur, prenom_Utilisateur, status_Utilisateur, password_Utilisateur FROM Utilisateur WHERE mail_Utilisateur = '$email'");
$requete_pdo->execute();
if(($requete_pdo->rowCount()) == 0){
    //Si le résultat retourner par la fonction est égal à  0, alors l'email n'a pas été trouvé
    echo "Invalid_Email";

}
else {
    $resultat = $requete_pdo->fetch();
    // vérification du mot de passe 
    $isPasswordCorrect = password_verify($psw, $resultat['password_Utilisateur']);
    if ($isPasswordCorrect){
        // mot de passe OK
        $_SESSION['prenom'] = $resultat['prenom_Utilisateur'];
        $_SESSION['nom'] = $resultat['nom_Utilisateur'];
        $_SESSION['status'] = $resultat['status_Utilisateur'];
        echo "Success";
    }
    else {
        // mot de passe invalid
        echo "Invalid_Password";
    }
}

?>