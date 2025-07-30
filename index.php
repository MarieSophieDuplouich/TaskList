<?php session_start();
require_once "bdd-crud.php";
?>
<?php require_once "add-task.php";  //add-task.php?>
<?php
// Test auth
if(isset($_SESSION["user_id"]) == false){
    header("Location: login.php");
}

// Ajout d'une tâche via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['user_id']) && isset($_POST['name']) && isset($_POST['description'])) {
        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        add_task($user_id,$name, $description);
    }

    // Suppression d'une tâche via le formulaire D
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        delete_task($id);
    }

    // mettre à jour les données update U tâche

     if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
       
         update($id, $name, $description);
    }
}


$taskss = get_all_task(); // c'est ça le read 


?>

<!DOCTYPE html>
<html>

<head>
    <title>Tasklist Accueil</title>
</head>

<body>
    <h1>Tasklist Accueil</h1>

    <!-- Formulaire pour ajouter une tâche en front-end -->
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Nom de la tâche" required>
        <input type="text" name="description" placeholder="description" required>
        <button type="submit">Ajouter</button>
      
    </form>

    <!-- Liste des tâches ne pas oublier les formulaires pour soumettre supprimer etc... nos données une tâche en front-end -->
    <h2>Liste des choses à faire</h2>
    <ul>
        <?php foreach ($taskss as $taches): ?>
            <li>
                <?= $taches['name'] ?> (<?= $taches['description'] ?>)
            </li> 
            <!-- read ci dessus -->
             <!-- Formulaire pour supprimer une tâche en front-end   -->

            <form action="" method="POST" style="display: inline;">
                <input type="hidden" name="id" value="<?= $taches['id'] ?>">
                <button type="submit" value="<?= $taches['id'] ?>">Supprimer</button>
            </form>
           <!-- Formulaire pour modifier (update mise à jour) une tâche en front-end -->

        <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $taches['id'] ?>" required>
        <input type="text" name="name" value="<?= $taches['name'] ?>" required>
        <input type="text" name="description"  value="<?= $taches['description'] ?>" required>
        <button type="submit">Modifier</button>
    
    </form>

        <?php endforeach; ?>

    </ul>
</body>

</html>