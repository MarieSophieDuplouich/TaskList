<?php
// $password = "Igaming_1234!!!!çççç"; // Ton mot de passe
// $hash = password_hash($password, PASSWORD_DEFAULT);
// echo "Mot de passe haché : " . $hash . PHP_EOL;
//sinon le password verify va tout faire "capoter" cad quand on met le name et le bon mot de passe ça ne va pas marcher car il veut le mdp hashé (il a déjà hashé donc il faut mettre le mdp hashé dans la bdd adminer website)
?>

<?php
$password = "sdiaeqjdize!uay_45678!!!"; // Ton mot de passe
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Mot de passe haché : " . $hash . PHP_EOL;
?>

