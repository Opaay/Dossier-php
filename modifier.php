<?php

try {
  // On se connecte à MySQL
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
  $bdd = new PDO('mysql:host=localhost;dbname=gest_etud', 'root', '',
  $pdo_options);

  // On récupère les données de l'étudiant à partir de l'URL
  $matricule = $_GET['matricule'];
  $requete = $bdd->prepare('SELECT * FROM Etudiant WHERE matricule = :matricule');
  $requete->bindParam(':matricule', $matricule);
  $requete->execute();

  // On vérifie si la requête a renvoyé un résultat
  if ($requete->rowCount()) {
    $donnees = $requete->fetch();
  } else {
    echo "Aucun étudiant trouvé avec ce matricule";
  }

  // On traite le formulaire
  if ($_POST) {
    $nom = $_POST['nom'];

    // On met à jour les données de l'étudiant dans la base de données
    $requete = $bdd->prepare('UPDATE Etudiant SET nom_etud = :nom WHERE matricule = :matricule');
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':matricule', $matricule);
    $requete->execute();

    // On redirige l'utilisateur vers la page d'affichage des étudiants
    header('Location: affichage.php');
  }

  // On affiche le formulaire de modification
?>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un étudiant</title>
  <link rel="stylesheet" href="modifier.css">
</head>
<body>

<h1><center>Modification</center></h1>

<form action="modifier.php" method="post">
  <input type="hidden" name="matricule" value="<?php echo $matricule; ?>">
  <label for="nom">Nom</label>
  <input type="text" name="nom" id="nom" value="<?php echo $donnees['nom_etud']; ?>">
  <br>
  <label for="prenom">Prénom</label>
  <input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom_etud']; ?>">
  <br>
  <label for="age">Âge</label>
  <input type="number" name="age" id="age" value="<?php echo $donnees['age']; ?>">
  <br>
  <label for="nationalite">Nationalité</label>
  <input type="text" name="nationalite" id="nationalite" value="<?php echo $donnees['nationalite']; ?>">
  <br>
  <input type="submit" value="Modifier">
</form>

</body>
</html>

<?php
} catch(Exception $e) {

  die('Erreur : '.$e->getMessage());
}
?>
