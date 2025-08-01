<?php session_start();
require_once "bdd-crud.php";
?>
<?php
// Test auth
if (isset($_SESSION["user_id"]) == false) {
    header("Location: login.php");
    exit();
}

// Ajout d'une tâche via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['user_id']) && isset($_POST['name']) && isset($_POST['description'])) {
        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        add_task($user_id, $name, $description);
    }

    // Suppression d'une tâche via le formulaire D
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        delete_task($id);
    } // lien cliquable get

    // mettre à jour les données update U tâche

    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description'])) {
        $id = $_POST['id']; //// never change id 
        $name = $_POST['name'];
        $description = $_POST['description'];

        update($id, $name, $description);
    }
}


$taskss = trouver_tâche_par_userid($_SESSION['user_id']); // c'est ça le read 


?>

<!DOCTYPE html>
<html>

<head>
    <title>Tasklist Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
        <!-- dé en 3D -->
    <div class="dice">
        <div class="side one"></div>
        <div class="side two"></div>
        <div class="side three"></div>
        <div class="side four"></div>
        <div class="side five"></div>
        <div class="side six"></div>
    </div>

    <h1>Tasklist Accueil</h1>

    <!-- Navigation ne pas oublier le ! avant isset pour prouver l'inverse "ne pas" Si l'user_id n'est pas connecté il doit se connecter sinon il doit se déconnecter -->
    <header>
        <nav>
            <?php if (!isset($_SESSION["user_id"])): ?>
                <a href="login.php">Se connecter</a>
                <!-- //quand il n'est pas connecté -->
            <?php else: ?>
                <a href="logout.php">Se déconnecter</a>
                <!-- //quand il est  connecté -->
            <?php endif ?>
        </nav>
    </header>


    <h2>Bienvenue <?= htmlspecialchars($_SESSION['nom_utilisateur']) ?> sur la page d'administration</h2>

    <!-- Formulaire pour ajouter une tâche en front-end -->
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Nom de la tâche" required>
        <input type="text" name="description" placeholder="description" required>
        <button class="button" type="submit">Ajouter</button>

    </form>
    <!-- Liste des tâches ne pas oublier les formulaires pour soumettre supprimer etc... nos données une tâche en front-end -->
    <h2>Liste des choses à faire</h2>
    <ul>
        <table>
            <tr>
                <th>Tâche à faire</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($taskss as $taches): ?>
                <tr>
                    <td><?= $taches['name'] ?> </td>
                    <td><?= $taches['description'] ?> </td>
                    <td>
                        <!-- Formulaire pour supprimer une tâche en front-end   -->
                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $taches['id'] ?>">
                            <button class="button" type="submit" value="<?= $taches['id'] ?>">Supprimer</button>
                        </form>
                        <!-- Formulaire pour modifier (update mise à jour) une tâche en front-end -->

                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $taches['id'] ?>" required>
                            <input type="text" name="name" value="<?= $taches['name'] ?>" required>
                            <input type="text" name="description" value="<?= $taches['description'] ?>" required>
                            <button class="button" type="submit">Modifier</button>

                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>



    </ul>

</body>

</html>