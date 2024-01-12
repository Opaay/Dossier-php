<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des étudiants</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Matricule</th>
      <th>Âge</th>
      <th>Nationalité</th>
      <th>Modifier</th>
      <th>Ma nouvelle ligne</th>
    </tr>
  </thead>
  <tbody>

  <?php
  try
  {
    // On se connecte à MySQL
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=gest_etud', 'root', '',
    $pdo_options);
    // On récupère tout le contenu de la table jeux_video
    $reponse = $bdd->query('SELECT * FROM Etudiant');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch())
    {
  ?>

    <tr>
    <td><?php echo $donnees['nom_etud']; ?></td>
    <td><?php echo $donnees['prenom_etud']; ?></td>
    <td><?php echo $donnees['matricule']; ?></td>
    <td><?php echo $donnees['age']; ?></td>
    <td><?php echo $donnees['nationalite']; ?></td>
    <td>
        
        <a href="modifier.php?matricule=<?php echo $donnees['matricule']; ?>">Modifier</a>

    </td>
    </tr>


  <?php
    }
    $reponse->closeCursor();
  }
  catch(Exception $e)
  {

    die('Erreur : '.$e->getMessage());
  }
  ?>

  </tbody> 
</table>

</body>
</html>
