<?php
session_start();
$isSuccess = false;

if (
    isset($_POST["nom_utilisateur"]) &&
    isset($_POST["password"])

) {
    // Essaye de s'inscrire !
    try {

        $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
        $request = $database->prepare("INSERT INTO User(nom_utilisateur,password) VALUES (:nom_utilisateur,:password)");

        $isSuccess = $request->execute([
            ':nom_utilisateur' => $_POST["nom_utilisateur"],
            ':password' => password_hash($_POST["password"], PASSWORD_BCRYPT)
        ]);
 
    } catch (\Throwable $th) {
        //throw $th;
        echo "Erreur :" . $th->GetMessage();
    }
}

require_once "bdd-crud.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

</head>

<body>
    <!-- Page d'inscription	Permettre à un nouvel utilisateur de s'inscrire avec un nom d'utilisateur et un mot de passe	-Créer un nouvel utilisateur dans la table User avec le mot de passe chiffré avec l'algo bcrypt
    -Redirection vers la page de connexion -->
    <!-- TODO Formulaire pour s'inscrire (créer un utilisateur) -->
    <h1>Inscriptionnn</h1>
    <a href="inscription.php">S'inscrire</a>
    <a href="seconnecter.php">Se connecter</a>
    
    <form action="" method="post">
        <input type="text" name="nom_utilisateur" placeholder="votre nom...">
        <input type="password" name="password" placeholder="votre mot de passe...">
        <button>S'inscrire</button>
    </form>
    <?php if ($isSuccess == true): ?>
        <p>création de compte réussi (utilisateur ajouté) !</p>
    <?php endif; ?>
</body>

</html>