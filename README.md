# Matka

## Projet

Projet réalisé dans le cadre de la formation Développement web et web mobile à Simplon. Site d'une agence de voyage. Front-end réalisé en Next.js / React. Back-end réalisé en Symfony (interface Admin en Symfony). Front-end déployé sur Vercel à l'adresse suivante : [https://matka-prod.vercel.app/](https://matka-prod.vercel.app/).

## Description

Le projet Matka est une application web destinée à simuler un site de tour opérateur.

## Fonctionnalités

### Back-end

- Création, édition, suppression de : voyages, pays, catégories, utilisateurs en fonction des rôles (admin ou éditeur).

### Front-End

- Récupération et affichage des données de voyages.
- Filtre par pays et catégorie cumulable.
- Filtre par durée non fonctionnel.
- Prise de contact pour un voyage ou pour une demande générale : enregistrement de la demande en base de données.

## Pré-requis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre système :

- PHP >= 7.4
- Composer
- Node.js >= 14
- npm ou Yarn
- MySQL ou tout autre système de gestion de base de données compatible avec Symfony

## Installation

### Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre système :

- PHP >= 7.4
- Composer
- Node.js >= 14
- npm ou Yarn
- MySQL ou tout autre système de gestion de base de données compatible avec Symfony

### Instructions d'installation

Clonez ce dépôt sur votre machine locale :

```bash
git clone https://github.com/Zadig2b/Matka.git
```
Le dossier backend contient le projet Symfony, tandis que le dossier frontend contient le projet Next.js.

Configuration des variables d'environnement
Configurez votre base de données dans le fichier .env et créez la base de données :

Copier le code
```bash
php bin/console doctrine:database:create
```
 ou
```bash
symfony console doctrine:database:create
```
Appliquez les migrations pour créer le schéma de base de données :

Copier le code
``` bash
symfony doctrine:migrations:migrate
```
Une fixture détaillée a été réalisée afin de générer automatiquement des données dans la BDD. Pour l'exécuter, réalisez la commande suivante :

Copier le code
```bash
symfony console doctrine:fixtures:load
```
Lancez le serveur de développement Symfony :

Copier le code
```bash
symfony server:start
```
Une fois le serveur lancé, un lien vers celui-ci vous sera fourni dans la console.

Dans un autre terminal, lancez le serveur de développement React :

Copier le code
``` bash
npm run dev
```
Une fois le serveur lancé, un lien vers celui-ci vous sera fourni dans la console.

# Déploiement
## Déploiement du Front-end sur Vercel
### Préparer le Projet :

Assurez-vous que votre projet Next.js est prêt pour le déploiement. Testez-le localement pour vérifier que tout fonctionne comme prévu.
Connexion à Vercel :

Connectez-vous à votre compte Vercel. Si vous n'avez pas encore de compte, inscrivez-vous sur Vercel.
Déploiement :

Connectez votre projet Next.js à un dépôt Git (GitHub, GitLab, Bitbucket).
Importez votre projet sur Vercel depuis le dépôt Git. Vercel détectera automatiquement les paramètres du projet et configurera le déploiement.
Configurez les variables d'environnement spécifiques à votre projet sur la plateforme Vercel. Vous pouvez le faire via le tableau de bord Vercel sous "Settings" -> "Environment Variables".
Automatisation :

Chaque fois que vous poussez des modifications vers votre dépôt Git, Vercel déclenchera automatiquement un déploiement, assurant que la version la plus récente de votre application est toujours en ligne.
Vérification :

Une fois le déploiement terminé, vérifiez que l'application est accessible via l'URL fournie par Vercel (par exemple, https://matka-prod.vercel.app/).

## Déploiement du Back-end

### Préparer le Serveur :

Assurez-vous que le serveur où le back-end Symfony sera déployé est correctement configuré avec PHP, Composer, et MySQL.

Utilisez un outil FTP comme FileZilla pour transférer les fichiers du projet Symfony sur le serveur.
Configuration :

Configurez les variables d'environnement du serveur en éditant le fichier .env avec les paramètres de production (comme les identifiants de base de données).
Base de Données :

Connectez-vous au serveur via SSH et exécutez les commandes pour créer la base de données, appliquer les migrations et charger les fixtures :
Copier le code
```bash
php bin/console doctrine:database:create
```
```bash
php bin/console doctrine:migrations:migrate
```
```bash
php bin/console doctrine:fixtures:load
```
Lancer le Serveur :

Lancez le serveur web (comme Apache ou Nginx) pour héberger votre application Symfony.
# Vérification :

Accédez à l'URL de votre application pour vérifier que le back-end est correctement déployé et accessible.

### Auteurs
Romain Dugeay - https://github.com/Zadig2b
