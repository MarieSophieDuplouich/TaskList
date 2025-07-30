<?php

/**
 * Ce fichier contient les fonctions de CRUD pour les utilisateurs et les tâches.
 * Il est utilisé pour interagir avec la base de données.
 * Presque toutes les pages de l'application utilisent ce fichier.
 * 
 * A vous de remplir ces fonction pour qu'elles fonctionnent correctement.
 * 
 * Vous pourrez ainsi facilment les utiliser dans les autres fichiers et construire votre site sans plus vous soucis du SQL.
 */


function connect_database(): PDO
{
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
    return $database;
}
// CRUD User
// Create (signin)
function create_user(string $nom_utilisateur, string $password): int | null
{
    $database = connect_database();
    // TODO
    $hashed_pwd =  password_hash($password, PASSWORD_BCRYPT);

    $request = $database->prepare("INSERT INTO User(nom_utilisateur,password)VALUES (?,?)");

    $isSuccessful = $request->execute([$nom_utilisateur, $hashed_pwd]);

    if ($isSuccessful) {

        return (int)$database->lastInsertId();
    }
    return null;
}


// Read (login)
function get_user(int $id): array | null
{
    $database = connect_database();
    // TODO 
    $request = $database->prepare("SELECT id, nom_utilisateur, password FROM User WHERE id = ?");
    $request->execute([$id]);
    $user = $request->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        return null;
    }

    return $user;
}


// // CRUD Task les tâches la table c'est task
// // ajouter add  le name est le nom de la tâche // remplir la table task
function add_task(string $name, string $description): int | null
{
    $database = connect_database();
    $sql = "INSERT INTO task (name, description) VALUES (:nom, :description)";
    $stmt = $database->prepare($sql);
    $stmt->execute(['nom' => $name, 'description' => $description]);
     
     $task_id = $database->lastInsertId();

    return $task_id; //ça je dois garder 
    var_dump($name);
    var_dump($description);

}

// //Read
function get_task(int $id): array | null
{
   $database = connect_database();
    $sql = "SELECT * FROM task WHERE id = :id";
    $stmt = $database->prepare($sql);
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    // TODO
    return $task;//ça je dois garder 
}


function get_all_task() : array | null {
    $database = connect_database();
    // TODO
    $sql = "SELECT * FROM task";
    $stmt = $database->prepare($sql); // à changer ne pas mettre de query
    $stmt ->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;//ça je dois garder 
}

// // Delete (BONUS)
function delete_task(int $id) : bool{
    $database = connect_database();
    // TODO
    $sql = "DELETE FROM task WHERE id = :id";
    $stmt = $database->prepare($sql);
    $isSuccessful = $stmt->execute(['id' => $id]);
    return $isSuccessful; //ça je dois garder 
    
}

//Update
function update(int $id, $name,$description)
{
    $database = connect_database();
    $sql = "UPDATE task SET name = :nom, description = :description WHERE id = :id";
    $stmt = $database->prepare($sql);
    $stmt->execute(['id' => $id, 'nom' => $name, 'description' => $description]); //ça je dois garder il manque pdo fetch qqchose je pense
}
