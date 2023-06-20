<?php
include 'config.php'; // Inclusion du fichier de configuration contenant les informations de connexion à la base de données

$bdd = connect(); // Connexion à la base de données en utilisant la fonction connect()

$langues = $_POST['langue'] ?? []; // Récupération des langues sélectionnées dans un tableau, ou un tableau vide si aucune langue n'est sélectionnée
$integrations = $_POST['integration'] ?? []; // Récupération des intégrations sélectionnées dans un tableau, ou un tableau vide si aucune intégration n'est sélectionnée
$note_qualite_retranscription = $_POST['note_qualite_retranscription'] ?? ''; // Récupération de la note de qualité de retranscription, ou une chaîne vide si aucune note n'est spécifiée
$note_qualite_resume = $_POST['note_qualite_resume'] ?? ''; // Récupération de la note de qualité de résumé, ou une chaîne vide si aucune note n'est spécifiée
$note_fonctionnalite_additionnelle = $_POST['note_fonctionnalite_additionnelle'] ?? ''; // Récupération de la note de fonctionnalités additionnelles, ou une chaîne vide si aucune note n'est spécifiée
$note_rapport_upload_prix = $_POST['note_rapport_upload_prix'] ?? ''; // Récupération de la note de rapport upload/prix, ou une chaîne vide si aucune note n'est spécifiée

$sql = "SELECT * FROM `logiciels` WHERE 1=1"; // Requête SQL de base pour sélectionner toutes les lignes de la table "logiciels"

// Construction de la clause WHERE de la requête en ajoutant des conditions en fonction des langues sélectionnées
if (!empty($langues)) {
  $sql .= " AND ("; // Ouverture de la parenthèse pour séparer cette clause
  foreach ($langues as $langue) {
    $sql .= " `langues` LIKE '%" . $langue . "%'"; // Condition de recherche pour chaque langue
    if ($langue !== end($langues)) {
      $sql .= " AND"; // Ajout de l'opérateur AND entre les langues
    }
  }
  $sql .= ")"; // Fermeture de la parenthèse
}

// Construction de la clause WHERE de la requête en ajoutant des conditions en fonction des intégrations sélectionnées
if (!empty($integrations)) {
  $sql .= " AND ("; // Ouverture de la parenthèse pour séparer cette clause
  foreach ($integrations as $integration) {
    $sql .= " `integrations` LIKE '%$integration%'"; // Condition de recherche pour chaque intégration
    if ($integration !== end($integrations)) {
      $sql .= " AND"; // Ajout de l'opérateur AND entre les intégrations
    }
  }
  $sql .= ")"; // Fermeture de la parenthèse
}

// Ajout des conditions pour les notes minimales, si elles sont spécifiées
if (!empty($note_qualite_retranscription)) {
  $sql .= " AND `note_qualite_retranscription` >= :note_qualite_retranscription";
}

if (!empty($note_qualite_resume)) {
  $sql .= " AND `note_qualite_resume` >= :note_qualite_resume";
}

if (!empty($note_fonctionnalite_additionnelle)) {
  $sql .= " AND `note_fonctionnalite_additionnelle` >= :note_fonctionnalite_additionnelle";
}

if (!empty($note_rapport_upload_prix)) {
  $sql .= " AND `note_rapport_upload_prix` >= :note_rapport_upload_prix";
}

$stmt = $bdd->prepare($sql); // Préparation de la requête SQL en utilisant PDO

// Liaison des valeurs des variables liées aux paramètres de la requête, si elles ne sont pas vides
if (!empty($note_qualite_retranscription)) {
  $stmt->bindValue(':note_qualite_retranscription', $note_qualite_retranscription, PDO::PARAM_INT);
}

if (!empty($note_qualite_resume)) {
  $stmt->bindValue(':note_qualite_resume', $note_qualite_resume, PDO::PARAM_INT);
}

if (!empty($note_fonctionnalite_additionnelle)) {
  $stmt->bindValue(':note_fonctionnalite_additionnelle', $note_fonctionnalite_additionnelle, PDO::PARAM_INT);
}

if (!empty($note_rapport_upload_prix)) {
  $stmt->bindValue(':note_rapport_upload_prix', $note_rapport_upload_prix, PDO::PARAM_INT);
}

$stmt->execute(); // Exécution de la requête préparée
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats de la requête dans un tableau associatif

// Boucle foreach pour parcourir les résultats et afficher les informations correspondantes
foreach ($resultats as $resultat) {
  echo '<div class="groupe">';
  echo '<img class="img" src="./img/' . $resultat['nom_logiciel'] . '.png">';
  echo "<br> <br>";
  echo '<div class="bas">';
  echo '<div class="texte_gauche">';
  $langues = explode(',', $resultat['langues']);
  echo '<p>Langues : <br><br>';

  foreach ($langues as $langue) {
    $langue = trim($langue);
    $couleur = '';
    // Attribution des couleurs en fonction de la langue
    if ($langue == 'Allemand') {
      $couleur = '#e8deee';
    } elseif ($langue == 'Neerlandais') {
      $couleur = '#f5e0e9';
    } elseif ($langue == 'Francais') {
      $couleur = '#fdecc8';
    } elseif ($langue == 'Italien') {
      $couleur = '#dbeddb';
    } elseif ($langue == 'Anglais') {
      $couleur = '#d3e5ef';
    } elseif ($langue == 'Espagnol') {
      $couleur = '#f1f0ef';
    } elseif ($langue == 'Portugais') {
      $couleur = '#ffe2dd';
    } elseif ($langue == 'Japonais') {
      $couleur = '#fadec9';
    }
    echo '<div class="langue-item" style="background-color: ' . $couleur . ';">' . $langue . '</div>';
  }
  echo '</p><br>';
  echo '<p>Intégrations : <br><br>';
  $integrations = explode(',', $resultat['integrations']);
  foreach ($integrations as $integration) {
    $integration = trim($integration);
    $couleur = '';
    // Attribution des couleurs en fonction de l'intégration
    if ($integration == 'Slack') {
      $couleur = '#fdecc8'; 
    } elseif ($integration == 'Notion') {
      $couleur = '#d3e5ef'; 
    } elseif ($integration == 'Mail') {
      $couleur = '#f5e0e9';
    } elseif ($integration == 'Monday') {
      $couleur = '#ffe2dd';
    } elseif ($integration == 'Jira') {
      $couleur = '#f1f0ef';
    }
    echo '<div class="integration-item" style="background-color: ' . $couleur . ';">' . $integration . '</div>';
  }
  echo '</p>';
  echo '</div>';
  echo '<div class="texte_droite">';
  echo '<p>Note qualité de retranscription : ' . $resultat['note_qualite_retranscription'] . '</p><br>';
  echo '<p>Note qualité de résumé : ' . $resultat['note_qualite_resume'] . '</p><br>';
  echo '<p>Note fonctionnalités additionnelles : ' . $resultat['note_fonctionnalite_additionnelle'] . '</p><br>';
  echo '<p>Note rapport upload/prix : ' . $resultat['note_rapport_upload_prix'] . '</p><br>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}
?>

