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


function connect_database() : PDO{
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database","root","root");
    return $database;
}
// CRUD User
// Create (signin)
function create_user(string $nom_utilisateur,string $password) : int | null {
    $database = connect_database();
    // TODO
    $hashed_pwd =  password_hash($password,PASSWORD_BCRYPT);

    $request = $database ->prepare("INSERT INTO User(nom_utilisateur,password)VALUES (?,?)");

    $isSuccessful = $request->execute([$nom_utilisateur,$hashed_pwd]);

    if ($isSuccessful) {

        return (int)$database ->lastInsertId();
    }
    return null;
    }
    

// Read (login)
function get_user(int $id) : array | null {
    $database = connect_database();
    // TODO 
    $request = $database ->prepare("SELECT id, nom_utilisateur, password FROM User WHERE id = ?");
    $request->execute([$id]);
    $user = $request->fetch(PDO::FETCH_ASSOC);
    if($user===false){
        return null;
    }

    return $user;
}


// CRUD Task AAAAAAHHHHHH
// Create
function add_task(string $name,string $description) : int | null {
    $database = connect_database();

    
    return $task_id;
}

//Read
function get_task(int $id) : array | null {
    $database = connect_database();
    // TODO
    return $task;
}

function get_all_task() : array | null {
    $database = connect_database();
    // TODO
    return $tasks;
}

// Delete (BONUS)
function delete_task(int $id) : bool{
    $database = connect_database();
    // TODO
    return $isSuccessful;
}