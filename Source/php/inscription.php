<?php

// Script de gestion de l'inscription utilisateur
// recuperation des informations en méthode POST 
// Verification que l'adresse email n'existe pas déjà dans la base de données

$firstname = $_POST['firstname'];
$usrname = $_POST['usrname'];
$email_inscrip = $_POST['email_inscrip'];

// Hachage du mot de passe
$psw1 = password_hash($_POST['psw1'], PASSWORD_DEFAULT);

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

// verification si email existe dans la table Utilisateur
$requete_pdo = $bdd->prepare("SELECT * FROM Utilisateur WHERE mail_Utilisateur = '$email_inscrip'");
$requete_pdo->execute();
if(($requete_pdo->rowCount()) == 0){
    //Si le résultat retourner par la fonction est égal à  0, alors l'email n'a pas été trouvé
    //donc la création peut avoir lieu 
    $date = new DateTime();
    $requete_pdo = $bdd->prepare("INSERT INTO Utilisateur (nom_Utilisateur, prenom_utilisateur, dateInscript_Utilisateur, status_Utilisateur, password_Utilisateur, mail_Utilisateur) VALUES ('$usrname', '$firstname', CURDATE(), '1', '$psw1', '$email_inscrip')");
    $requete_pdo->execute();
    echo "Success";
 
    $msg = "Bonjour\t";
    $msg .= "$firstname\t";
    $msg .= "$usrname,\n";
    $msg .= "Votre inscription a bien été prise en compte, ";
    $msg .= "bienvenue sur le site MesQCMs\t";
 
    $from = "test@domaine.com";
    
    $to = $email_inscrip;
   
    $subject = "QCM";
    
    $headers = "From:" . $from;
    
    mail($to,$subject,$msg,$headers);
    echo "Success";

}
else {
    // email existe déjà dans la base de données
    // creation impossible
    echo "Invalid";
}

?>