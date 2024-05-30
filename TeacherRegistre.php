# Bibliotheque-
<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees', 'utilisateur', 'mot_de_passe');

// Récupération des données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['password'];

// Vérification si l'utilisateur est déjà enregistré
$req = $bdd->prepare('SELECT id FROM enseignants WHERE email = 'email');
$req->execute(array('email' => $email));
$resultat = $req->fetch();

if ($resultat) {
    // L'utilisateur est déjà enregistré
    echo 'Cet utilisateur est déjà enregistré.';
} else {
    // Ajout de l'utilisateur à la base de données
    $req = $bdd->prepare('INSERT INTO enseignants(nom, email, password) VALUES(:nom, :email, :password)');
    $req->execute(array(
        'nom' => $nom,
        'email' => $email,
        'password' => $password
    ));

    echo 'Enregistrement réussi !';
}
?>
