<?php
include 'config.php';

$bdd = connect();

// Requête pour l'affichage des langues
$stmt = $bdd->prepare("SELECT `nom_langue` FROM `langues`");
$stmt->execute();
$langues = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Requête pour l'affichage des notes
$stmt2 = $bdd->prepare("SELECT DISTINCT note_qualite_retranscription, note_qualite_resume, note_fonctionnalite_additionnelle, note_rapport_upload_prix FROM logiciels");
$stmt2->execute();
$notes = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Requête pour l'affichage des fonctionnalités (intégrations)
$stmt3 = $bdd->prepare("SELECT `nom_fonctionnalites` FROM `fonctionnalites`");
$stmt3->execute();
$integrations = $stmt3->fetchAll(PDO::FETCH_COLUMN);


// Création de tableaux pour chaque note
$note_qualite_retranscription = array_values(array_unique(array_column($notes, 'note_qualite_retranscription')));
$note_qualite_resume = array_values(array_unique(array_column($notes, 'note_qualite_resume')));
$note_fonctionnalite_additionnelle = array_values(array_unique(array_column($notes, 'note_fonctionnalite_additionnelle')));
$note_rapport_upload_prix = array_values(array_unique(array_column($notes, 'note_rapport_upload_prix')));

// Tri des tableaux par ordre décroissant
rsort($note_qualite_retranscription);
rsort($note_qualite_resume);
rsort($note_fonctionnalite_additionnelle);
rsort($note_rapport_upload_prix);


?>
<!DOCTYPE html>
<html>
<head>
  <title>Logiciels Prise de Notes IA</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

  <div class="main-container">
    <div class="left-side">
      <h1>Logiciels prise de notes IA</h1>
      <div class="filters">
        <h2 class="filter-title">Filtrer les Résultats</h2>

        <form id="filtre-form">

          <div class="filter-row">
                <div class="filtre">
                <label for="langue">Trier par langue</label><br>
                <select id="langue" name="langue[]" multiple class="select2">
                    <option value="" disabled>Choisir une langue</option>
                    <?php foreach ($langues as $langue): ?>
                    <option value="<?= $langue ?>"><?= $langue ?></option>
                    <?php endforeach; ?>
                </select>

                </div>

                <div class="filtre">
                <label for="integration">Trier par intégration</label><br>
                <select id="integration" name="integration[]" multiple class="select2">
                    <option value="" disabled>Choisir une intégration</option>
                    <?php foreach ($integrations as $integration): ?>
                    <option value="<?= $integration ?>"><?= $integration ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
          </div>



          <div class="filter-row">
                <div class="filtre">
                <label for="note_qualite_retranscription">Trier par qualité de retranscription</label><br>
                <select id="note_qualite_retranscription" name="note_qualite_retranscription">
                    <option value="" >Choisir une note</option>
                    <?php foreach ($note_qualite_retranscription as $note): ?>
                      <?php if($note == 5){?>
                        <option value="<?= $note ?>"><?= $note . " " ?></option>
                      <?php }else{ ?>
                    <option value="<?= $note ?>"><?= $note . " " . "ou plus" ?></option>
                    <?php } ?> 
                  <?php endforeach; ?>
                </select>
                <div class="btn-container">
                <button type="button" class="bouton" data-filter="note_qualite_retranscription">Réinitialiser</button>
                </div>
                </div>

                <div class="filtre">
                <label for="note_qualite_resume">Trier par qualité de résumé</label><br>
                <select id="note_qualite_resume" name="note_qualite_resume">
                    <option value="" >Choisir une note</option>
                    <?php foreach ($note_qualite_resume as $note): ?>
                      <?php if($note == 5){?>
                        <option value="<?= $note ?>"><?= $note . " " ?></option>
                      <?php }else{ ?>
                    <option value="<?= $note ?>"><?= $note . " " . "ou plus" ?></option>
                    <?php } ?> 
                  <?php endforeach; ?>
                </select>
                <div class="btn-container">
                <button type="button" class="bouton" data-filter="note_qualite_resume">Réinitialiser</button>
                </div>
                </div>
          </div>

          <div class="filter-row">
                <div class="filtre">
                <label for="note_fonctionnalite_additionnelle">Trier par note des fonctionnalités</label><br>
                <select id="note_fonctionnalite_additionnelle" name="note_fonctionnalite_additionnelle">
                    <option value="">Choisir une note</option>
                    <?php foreach ($note_fonctionnalite_additionnelle as $note): ?>
                      <?php if($note == 5){?>
                        <option value="<?= $note ?>"><?= $note . " " ?></option>
                      <?php }else{ ?>
                    <option value="<?= $note ?>"><?= $note . " " . "ou plus" ?></option>
                    <?php } ?> 
                  <?php endforeach; ?>
                </select>
                <div class="btn-container">
                <button type="button" class="bouton" data-filter="note_fonctionnalite_additionnelle">Réinitialiser</button>
                </div>
            </div>

            <div class="filtre">
              <label for="note_rapport_upload_prix">Trier par note de rapport upload/prix</label><br>
              <select id="note_rapport_upload_prix" name="note_rapport_upload_prix">
                <option value="">Choisir une note</option>
                <?php foreach ($note_rapport_upload_prix as $note): ?>
                  <?php if($note == 5){?>
                        <option value="<?= $note ?>"><?= $note . " " ?></option>
                      <?php }else{ ?>
                    <option value="<?= $note ?>"><?= $note . " " . "ou plus" ?></option>
                    <?php } ?> 
                  <?php endforeach; ?>
              </select>
              <div class="btn-container">
              <button type="button" class="bouton" data-filter="note_rapport_upload_prix">Réinitialiser</button>
                </div>
            </div>
          </div>

          <div class="filtre">
            <button id="reset-filters">Réinitialiser tous les filtres</button>
          </div>

        </form>
      </div>
    </div>
<div class="right-side">
  <div id="filtered-results" class="container"></div>
</div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();

      $('.filtre select').change(function() {
        var formData = $('#filtre-form').serialize();

        $.ajax({  
          type: 'POST',
          url: 'filtre.php',
          data: formData,
          success: function(response) {
            $('#filtered-results').html(response);
          }
        });
      });

      $('#boutons').click(function() {
        $('#filtre-form')[0].reset();
        $('.filtre select').trigger('change');
        location.reload();
      });

      $('.bouton').click(function() {
        var filterName = $(this).data('filter');
        $('#' + filterName).val('').trigger('change');
      });
    });
  </script>
</body>
</html>
