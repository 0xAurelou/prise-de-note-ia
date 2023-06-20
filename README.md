   ##  Logiciels Prise de Notes IA




Ce projet permet de filtrer et d'afficher des logiciels de prise de notes IA en fonction de différents critères. Le code est écrit en PHP et utilise une base de données MySQL pour stocker les informations sur les logiciels.


   ## Pré-requis

Pour commencer avec ce projet, assurez-vous d'avoir les pré-requis suivants :

    - Un Serveur web avec prise en charge de PHP

    - Une Base de données MySQL fonctionnelle

   ## Installation

Pour installer le projet, suivez les étapes ci-dessous :

   Clonez le dépôt depuis GitHub :

    git clone <lien_vers_le_dépôt>

Configurez la base de données :

    Créez une base de données MySQL.
    Importez le fichier SQL fourni (bdd_ia.sql) dans la base de données pour créer la structure de la table.

Configurez les informations de connexion à la base de données :

    Ouvrez le fichier config.php dans un éditeur de texte.

Modifiez les paramètres de connexion à la base de données selon votre configuration :


        $host = 'localhost'; // Nom d'hôte de la base de données (127.0.0.1 si en local)
        $dbname = 'nom_de_la_base_de_donnees'; // Nom de la base de données (nom que vous avez donné à la bdd)
        $username = 'nom_utilisateur'; // Nom d'utilisateur de la base de données (si local user par défaut = "root")
        $password = 'mot_de_passe'; // Mot de passe de la base de données ( si local, pour root ne pas mettre de mot de passe)

Placez les fichiers du projet dans le répertoire de votre serveur web. (Htdocs ou www selon votre configuration de webServer) Htdows pour xampp et www pour Wamp

Accédez à l'application en ouvrant le fichier index.php dans votre navigateur en localhost/nom_du_repertoire/index.php

   ## Structure du code

Le code est divisé en deux fichiers principaux :

    - Un fichier index.php : Ce fichier contient le code HTML et JavaScript de l'interface utilisateur. Il affiche les filtres et les résultats des logiciels de prise de notes IA filtrés.

    - Un second fichier : filtre.php : Ce fichier contient le code PHP qui traite les données des filtres, exécute la requête SQL correspondante et affiche les résultats filtrés.

   ## Développé avec :

    PHP - Langage de programmation utilisé
    MySQL - Système de gestion de base de données
    jQuery - Bibliothèque JavaScript
    Select2 - Plugin JavaScript pour les listes déroulantes
    
 ## Auteur

* [@0xAurelou](https://github.com/0xAurelou)


    
    
    

