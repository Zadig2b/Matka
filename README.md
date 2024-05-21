# Matka
Projet réalisé dans le cadre de la formation Développement web et web mobile à Simplon.
Site d'une agence de voyage. 
Front-end réalisé en Next.js / React
Back-end réalisé en Symfony (interface Admin en Symfony)
Front-end déployé sur Vercel à l'adresse suivante:
https://matka-prod.vercel.app/

# Description
Le projet Matka est une application web destinée à simuler un site de tour opérateur.



# Fonctionnalités
Back-end:
- Création, édition, suppression de:
 voyages, pays, catégories, utilisateurs 
 en fonction des rôles (admin ou éditeur)

Front-End:
Récupération et affichage des données de voyages.
Filtre par pays et catégorie cumulable. Filtre par durée non fonctionnel
Prise de contact pour un voyage ou pour une demande générale: enregistrement de la demande en base de donnée


# Pré-requis:
- installation Symfony
https://symfony.com/doc/current/setup.html

- installation Node.js / Next.js
https://www.freecodecamp.org/news/how-to-install-react-a-step-by-step-guide/
https://nextjs.org/docs/getting-started/installation


# Installation

# Prérequis
Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre système :

PHP >= 7.4
Composer
Node.js >= 14
npm ou Yarn
MySQL ou tout autre système de gestion de base de données compatible avec Symfony

# Instructions d'installation
Clonez ce dépôt sur votre machine locale :

bash
git clone https://github.com/Zadig2b/Matka.git

Le dossier backend contient le projet Symfony, tandis que le dossier Frontend contient le projet Next.js

# Configuration des variables d'environnement:

Configurez votre base de données dans le fichier .env et créez la base de données :

bash
php bin/console doctrine:database:create
ou
symfony console doctrine:database:create

Appliquez les migrations pour créer le schéma de base de données :

bash
symfony doctrine:migrations:migrate


Une fixture détaillée a été réalisée afin de générer automatiquement des données dans la BDD.
pour l'exécuter, il faudra réaliser la commande suivante:
 - symfony console doctrine:fixtures:load

# Lancez le serveur de développement Symfony :

bash
symfony server:start
une fois le serveur lancé, un lien vers celui-ci vous sera fourni dans la console.

# Dans un autre terminal, lancez le serveur de développement React :

bash
npm run dev

une fois le serveur lancé, un lien vers celui-ci vous sera fourni dans la console.


# Auteurs
Romain Dugeay - https://github.com/Zadig2b





