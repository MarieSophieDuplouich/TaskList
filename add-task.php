<?php
require_once "bdd-crud.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Ajouter une tâche</h1>
    <!-- TODO Formulaire pour ajouter une tâche -->
    
</body>
</html>


//// code de Massi ci-dessous

<!-- <?php
// session_start();
// if(isset($_SESSION["user_id"]) == false){
//     header("Location: login.php");
//     exit();
// }
// $isSuccess = false;
// if(isset($_POST["title"])){
//     $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
//     $request = $database->prepare("INSERT INTO Task (title,user_id) VALUES (?,?)");
//     $isSuccess = $request->execute([
//         $_POST["title"],
//         $_SESSION["user_id"]
//     ]);
    
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="" method="post">
    <input type="text" name="title">
    <button>Ajouter la tache</button>
</form>
<?php if($isSuccess):?>
    <p>Nouvelle Tâche ajoutée !</p>
    <a href="index.php">Voir toute les taches</a>
<?php endif;?>
</body>
</html> -->