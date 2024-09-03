# Overview

## Introduction

Skouerr est un ensemble d’outil pour améliorer l’expérience développeur lors du développement de thème Wordpress.

Skouerr est né d’un constat dans l’agence de communication R2. L’agence reposait sur une équipe de développeur en partie en freelance qui utilisait différents outils. Cela créait de la frustration et ont décidé de créer une plateforme de développement commune afin d’améliorer le partage des projets.

Après plusieurs phases d’itération Skouerr est né, pour s’appâter au mieux au besoin des agences de communication qui développent des thèmes sur mesures pour leur client.

*Skouerr est issu du breton skouer, qui signifie modèle ou outil. Un nom bien trouvé pour une agence bretonne.*

Skouerr repose sur 3 outils : 

- Une interface en ligne de commande pour gérer la création d’éléments  
- Un thème de démarrage comprenant des fonctionnalités prévus pour améliorer l’expérience développeur  
- Un utilitaire javascript permettant la compilation et le raffraichissement en direct des assets

C’est un outil open-source développé par l’agence digitale R2. 

## Contribution

Les outils sont disponibles sur le Github de Skouerr

CLI :   
[https://github.com/skouerr/skouerr-cli](https://github.com/skouerr/skouerr-cli)

Scripts :   
[https://github.com/skouerr/skouerr-scripts](https://github.com/skouerr/skouerr-scripts)

Thème :  
[https://github.com/skouerr/skouerr-theme](https://github.com/skouerr/skouerr-theme)

Les pull request sont évidement les bienvenue. Elles seront étudier par les développeurs qui maintienne le dépôt de l’équipe r2

Si vous détectez un bug, un problème ou une évolution potentielle, vous pouvez laisser une issue sur le projet GitHub correspondant

Si vous avez une question, n’hésitez pas à contacter l’équipe à cette adresse :   
support-skouerr@r2.fr 

## RoadMap

Une implémentation OpenAI est prévu afin de rédiger la documentation du thème et des différents block

Une libraire de block est prévu.

# Getting Started

## Setup roots/bedrock

La boilerplate roots/bedrock permet de gérer WordPress, ses plugins et thèmes comme des dépendances PHP via un fichier composer.json tout en revoyant l’architecture des dossiers.

Pour rappel voici la commande pour créer un projet bedrock 

composer create-project roots/bedrock

Une fois bedrock installé pour travailler avec Skouerr , vous aller devoir ajouter dans les repositories du fichier composer.json ceci :

```json
{  
  "type": "composer",  
  "url": "https://packages.skouerr.dev",  
  "only": [  
    "skouerr/*"  
  ]
}
```


Puis lancer un composer validate pour être sur de ne pas avoir faît d’erreur

Ensuite ajouter le mu plugin skouerr-cli

```bash
composer require skouerr/skouerr-cli
```

Bravo \! Vous avez installer la première pierre de skouerr

Pour créer un thème, vous pouvez lancer cette commande : 

```bash
wp skouerr make:theme
```

Le thème sera activer par défaut \!

Pour commencer a créer vos premiers blocks lancer cette commande 👍

```bash
wp skouerr make:block
```

Vous pouvez lister les commandes disponible

```bash
wp skouerr list
```

Une fois votre premier block créer vous aller pouvoir compiler et recharger vos fichiers.  
Le thème Skouerr par défaut intégre Skouerr Script. 

Assurez-vous bien d’avoir la dernière version en lançant cette commande dans le répertoire du thème

```bash
npm install  
npm update
```

Une fois les dépendances JavaScript du thème mis à jour et installé pour lancer l’outil lancer 

npm run watch 

Le script devrait lancer la compilation automatique et vous devriez voir apparaitre le statut de la compilation en bas a droite de votre écran

## Setup traditionnal wordpress

Pour travailler avec un Wordpress classique, il vous suffit de télécharger le plugin ici : 

De l’installer dans le dossier plugins ou mu-plugins 

Puis de suivre la documentation a partir d’ici

# Theme

Le thème Skouerr est un thème Full Site Editing et donc repose sur les normes posé par Wordpress.  
Le style atomique des composants du thème doit être défini dans le fichier theme.json

## Loader

Afin de gérér les blocks créer par la cli une class Skouerr\_Loader est défini dans inc/core/loader, qui scanne ces dossiers afin de charger dynamiquement les différents éléments

- blocks/\*/\*.block.json  
- templates/\*.html  
- patterns/\*.php

// HOOK A AJOUTER ICI

## Render

Afin de définir une norme et avoir meilleure clarté du code ous avons décidé d’utiliser le pattern MVC pour la gestion des blocks.  
Également nous avons la possibilité de gérer différents types de moteurs de template (PHP, Twig, React).

Ainsi Skouerr\_Block permet de gérer cela d’une manière commune.

3 fonctions a retenir : 

```php
$skouerr_block->set_data(‘’)
```

Cette fonction permet d’envoyer une valeur au moteur de template

```php
$skouerr_block->the_data(‘’)
```

Cette fonction permet de récupère lorsque le moteur de template est PHP

```php
$skouerrr_block->render(‘php|twig|react’)
```

Cette fonction permet de choisir le moteur de rendu 

## Skouerr Mails

Skouerr permet une meilleure gestion des mails tout en récupérant les valeurs définit par dans le full site editing, ainsi, il est possible de créer des templates personnalisés de mails avec Twig

Vous pouvez définir et revoir vos templates dans /inc/mails/mails.php

## Custom blocks

Une des forces de Skouerr est de permettre aux développeurs WordPress de continuer a répondre aux besoin spécifique de leur clients que les blocs Gutenberg basique ne peuvent pas répondre.

Nous avons donc fait le choix de continuer de travailler avec le plugin ACF, tout en gardant les fonctionnalités native

*Pour créer des blocks avec Advanced Custom Field il est recommandé de souscrire à la licence ACF Pro*

Ainsi, nous mettons à disposition des blocs prêts à développer sous plusieurs formats : 

Native \- PHP  
Native \- Twig  
ACF \- PHP  
ACF \- Twig

Les blocs ne vont pas contenir les même fichiers, car un block ACF sera automatique enregistré par le plugin, alors qu’un block native doit charger le fichier register.js

Également les blocs ACF gèrent directement leur champs personnalisés dans le dossier /acf/

Ces blocs doivent être conçus de manière réutilisable entre les projets, ainsi il est très recommandé de construire le style des block custom à partir des variables CSS, ainsi que d’utiliser les classes communes de Worpdress

// Créer bloc avec la CLI

La création d’un bloc avec la CLI va prendre plusieurs paramètres : 

- Type (ACF ou Native)  
- Template (PHP ou Twig)  
- Title  
- Name  
- Dashicon

Les paramètres vous seront posé tout au long du processus : 

wp skouerr make:block

## Full Site Editing

Skouerr est un thème créer pour être entièrement compatible avec le Full Site Editing de Wordpress.

Ainsi, les compositions et templates seront géré via l’éditeur de site.

Par défaut les compositions et templates sont enregistrés dans la base de donnée et donc, les modifications ne sont versioné.

Avec skouerr il est possible de synchroniser les templates et compositions grâce  à la CLI, lancer la commande suivante et choisissez l’élément a versionné.

```bash
wp skouerr sync:template
```

```bash
wp skouerr sync:patterns
```

# CLI

Skouerr repose sur 3 outils dont une interface en ligne de commande.  
Cette ligne de commande permet de créer , gérer, et manipuler votre thème Wordpress.

Par défaut nous utilisons WP CLI mais nous lui avons ajouter une couche supplémentaire avec Symfony Console permettant d’intéragir avec le développeur.

Liste des commandes disponible 

wp skouerr list  
wp skouerr make:theme  
wp skouerr make:block  
wp skouerr list:blocks  
wp skouerr import:blocks  
wp skouerr make:post-type  
wp skouerr save:template  
wp skouerr make:template  
wp skouerr save:pattern

# Scripts javascript

Un package npm permet a Skouerr de faire fonctionner un module de rechargement automatique 

Il s’ajoute avec 

npm install skouerr-scripts

et s’utilise comme une cli en ajoutant sont execution dans votre fichier package json

skouerr-scripts watch  
skouerr-scripts build

# Hooks

Pas de hook pour l’instant