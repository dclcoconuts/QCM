<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include('php/head.php'); ?>
    <title>Accueil | Mes QCM</title>
</head>
<body>

    <?php include('php/header.php'); ?>

    <main>
        <div class="accueil">
            <div class="logo">
                <p id="q">Q</p>
                <p id="c">C</p>
                <p id="m">M</p>
            </div>
        </div>

        <div class="container" id="dernier">
            <!-- Div contenant la liste des derniers QCM validés -->
            <h1>Les derniers QCMs validés</h1>
            <div class="list-group">
                <?php include('php/listeQCM.php'); ?>
            </div>
        </div>

        <div class="container" id="categorie">
            <h1>Les catégories de QCMs</h1>
            <!-- Div contenant la liste des catégories -->
            <ul class="list-group">
                <?php include('php/listeCategorie.php'); ?>
            </ul>
        </div>
    </main>

    <footer>
    <?php include('php/footer.php'); ?>
    </footer>

</body>
</html>