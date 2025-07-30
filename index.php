<?php
require_once "bdd-crud.php";

// Ajout d'une tâche via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['nom']) && isset($_POST['description'])) {
        $name = $_POST['nom'];
        $description = $_POST['description'];
        add_task($name, $description);
    }

    // Suppression d'une tâche via le formulaire D
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        delete_task($id);
    }

    // mettre à jour les données update U tâche

     if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['description'])) {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
       
         update($id, $nom, $description);
    }
}


$task = get_all_task(); // c'est ça le read 
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
        <input type="text" name="nom" placeholder="Nom de la tâche" required>
        <input type="text" name="description" placeholder="description" required>
        <button type="submit">Ajouter</button>
      
    </form>

    <!-- Liste des tâches ne pas oublier les formulaires pour soumettre supprimer etc... nos données une tâche en front-end -->
    <h2>Liste des choses à faire</h2>
    <ul>
        <?php foreach ($task as $taches): ?>
            <li>
                <?= $taches['nom'] ?> (<?= $taches['description'] ?>)
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
        <input type="text" name="nom" value="<?= $taches['nom'] ?>" required>
        <input type="text" name="type"  value="<?= $taches['description'] ?>" required>
        <button type="submit">Modifier</button>
      <?php var_dump($taches['id']);?>
        <?php var_dump($taches['nom']);?>
    </form>

        <?php endforeach; ?>

    </ul>
</body>

</html>