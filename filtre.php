<?php
include 'config.php';

$bdd = connect();

$langues = $_POST['langue'] ?? [];
$integrations = $_POST['integration'] ?? [];
$note_qualite_retranscription = $_POST['note_qualite_retranscription'] ?? '';
$note_qualite_resume = $_POST['note_qualite_resume'] ?? '';
$note_fonctionnalite_additionnelle = $_POST['note_fonctionnalite_additionnelle'] ?? '';
$note_rapport_upload_prix = $_POST['note_rapport_upload_prix'] ?? '';

$sql = "SELECT * FROM `logiciels` WHERE 1=1";

if (!empty($langues)) {
  $sql .= " AND (";
  foreach ($langues as $langue) {
    $sql .= " `langues` LIKE '%" . $langue . "%'";
    if ($langue !== end($langues)) {
      $sql .= " AND";
    }
  }
  $sql .= ")";
}

if (!empty($integrations)) {
  $sql .= " AND (";
  foreach ($integrations as $integration) {
    $sql .= " `integrations` LIKE '%$integration%'";
    if ($integration !== end($integrations)) {
      $sql .= " AND";
    }
  }
  $sql .= ")";
}

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

$stmt = $bdd->prepare($sql);

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

$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
