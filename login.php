<?php
require_once "bdd-crud.php";
// TODO Connection Utilisateur via la session
session_start();
if (isset($_SESSION["user_id"]) == true) {
    // Connecté !
    header("Location: index.php");
    exit;
}

$error = null;
if (
    isset($_POST["nom_utilisateur"]) &&
    isset($_POST["password"])
) {
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
    // 1. request
    $request = $database->prepare("SELECT * FROM User WHERE nom_utilisateur = :nom_utilisateur");
    $request->execute(['nom_utilisateur'=>
        $_POST["nom_utilisateur"]]);
    // 2. response  
    $user = $request->fetch(PDO::FETCH_ASSOC);
    // var_dump($_POST["nom_utilisateur"]); 

    // 3. Authentification password ?
    if (
        password_verify($_POST["password"], $user["password"])
    ) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Login incorrect";
    }
}

//trouver l'utilisateur par son nom_utilisateur

function trouver_utilisateur_par_nom_utilisateur
($nom_utilisateur):array | null
{
$database = connect_database();
$request = $database->prepare("SELECT* FROM User WHERE nom_utilisateur = :nom_utilisateur");
$request->execute(['nom_utilisateur' =>$nom_utilisateur]);
$user = $request->fetch(PDO::FETCH_ASSOC);
return $user?:null;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

</head>

<body>
    <h1>Connexion</h1>


    <a href="inscription.php">Pas de compte ? S'inscrire</a>

    <!-- TODO Formulaire de connexion -->
    <form action="" method="post">
        <input type="text" name="nom_utilisateur" placeholder="votre nom...">
        <input type="password" name="password">
        <button>Se connecter</button>
    </form>
    <?php if ($error != null): ?>
        <?= $error ?>
    <?php endif; ?>
</body>

</html>