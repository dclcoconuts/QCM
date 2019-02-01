<?php

// Script de gestion de la connexion utilisateur 
// recuperation email et password en méthode POST 
// Verification username et password dans la base de données
$email = $_POST['email_forgot'];

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

// verification si email existe dans la table Utilisateur
$requete_pdo = $bdd->prepare("SELECT * FROM Utilisateur WHERE mail_Utilisateur = '$email'");
$requete_pdo->execute();
if(($requete_pdo->rowCount()) == 0){
    //Si le résultat retourner par la fonction est égal à  0, alors l'email n'a pas été trouvé.
    echo "Invalid";

}
else {
    $donnees = $requete_pdo->fetch();  
    $prenom = $donnees['prenom_Utilisateur'];
    $nom = $donnees['nom_Utilisateur'];
    $msg = "Bonjour\t";
    $msg .= "$prenom\t";
    $msg .= "$nom,\n";
    $msg .= "Pour réinitialiser votre mot de passe, ";
    $msg .= "veuillez cliquer sur le lien suivant\t";
    $msg .= 'http:\\';


    $from = "test@domaine.com";
    
    $to = $email;
   
    $subject = "QCM";
    
    $headers = "From:" . $from;
    
    mail($to,$subject,$msg,$headers);
    echo "Success";
}

?>