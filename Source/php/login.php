<?php


if (isset($_POST['email']) && isset($_POST['psw']))
{

// Script de gestion de la connexion utilisateur 
// recuperation email et password en méthode POST 
// Verification username et password dans la base de données
$email = $_POST['email'];
$psw = $_POST['psw'];

// connexion pdo à la base de données
// utilisation d'un fichier Json pour récupérer les informations de connexion
$file_json = file_get_contents('config.json');
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

// verification si couple email/password existe dans la table Utilisateur
$requete_pdo = $bdd->prepare("SELECT nom_Utilisateur, prenom_Utilisateur FROM Utilisateur WHERE mail_Utilisateur = '$email' AND password_Utilisateur = '$psw'");
$requete_pdo->execute();
if(($requete_pdo->rowCount()) == 0){
    //Si le résultat retourner par la fonction est égal à  0, alors le couple email/password n'a pas été trouvé. 
    echo "Invalid";

}
else {
    $resultat = $requete_pdo->fetch();
    session_start();
    $_SESSION['prenom'] = $resultat['prenom_Utilisateur'];
    $_SESSION['nom'] = $resultat['nom_Utilisateur'];
    echo $_SESSION['prenom'];
}
}
?>