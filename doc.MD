# Documentation 

## Introduction

Skouerr est un ensemble d'outils conçus pour améliorer l'expérience des développeurs lors de la création et du développement de thèmes WordPress.

### Contexte 
Skouerr a été créé suite à un constat au sein de l'agence R2. L'utilisation de nombreux outils différents entre les projets s'est avérée non optimale, ce qui a conduit à la nécessité de développer une solution unifiée.

Après plusieurs phases d’itération, Skouerr a vu le jour pour répondre de manière optimale aux besoins des agences de communication qui développent des thèmes sur mesure pour leurs clients.

*Skouerr est issu du breton skouer, qui signifie modèle ou outil. Un nom bien trouvé pour une agence bretonne.*

Skouerr repose sur trois outils principaux :

- **Interface en ligne de commande** : Permet de gérer la création d’éléments.
- **Thème de démarrage** : Comprend des fonctionnalités prévues pour améliorer l’expérience développeur.
- **Utilitaire JavaScript** : Permet la compilation et le rafraîchissement en direct des assets.

Skouerr est un outil open-source développé par l'agence digitale R2. 

## Contribution

Pour contribuer au projet Skouerr, visitez notre page GitHub. Vous pouvez signaler des bugs, proposer des améliorations, ou soumettre des pull requests. Rejoignez notre communauté pour discuter et collaborer sur les outils. Chaque contribution, grande ou petite, est précieuse !

CLI :   
[https://github.com/skouerr/skouerr-cli](https://github.com/skouerr/skouerr-cli)

Scripts :   
[https://github.com/skouerr/skouerr-scripts](https://github.com/skouerr/skouerr-scripts)

Thème :  
[https://github.com/skouerr/skouerr-theme](https://github.com/skouerr/skouerr-theme)


Les pull requests sont évidemment les bienvenues. Elles seront examinées par les développeurs qui maintiennent le dépôt de l’équipe R2.

Si vous détectez un bug, un problème ou une évolution potentielle, vous pouvez ouvrir une issue sur le projet GitHub correspondant.

Pour toute question, n’hésitez pas à contacter l’équipe à l'adresse suivante : [support-skouerr@r2.fr](mailto:support-skouerr@r2.fr).

## RoadMap

- **Implémentation OpenAI** : Une intégration avec OpenAI est prévue pour rédiger automatiquement la documentation du thème et des différents blocs.
- **Librairie de Blocs** : Une librairie de blocs est également prévue pour faciliter le développement et la gestion des éléments du thème.

# Getting Started

## Setup roots/bedrock

La boilerplate **roots/bedrock** permet de gérer WordPress, ses plugins et thèmes comme des dépendances PHP via un fichier **composer.json**, tout en révisant l'architecture des dossiers.

Pour créer un projet Bedrock, utilisez la commande suivante :

```bash
composer create-project roots/bedrock
```

Une fois Bedrock installé, pour travailler avec Skouerr, vous devrez ajouter le mu-plugin skouerr-cli

```bash
composer require skouerr/skouerr-cli
```

Bravo 🥳 \! Vous avez installer la première pierre de skouerr \! 

Pour créer un thème, vous pouvez lancer cette commande : 

### Création d'un thème
```bash
wp skouerr make:theme
```

Le thème sera activé par défaut \!

### Création d'un block

Pour commencer a créer vos premiers blocks lancer cette commande :

```bash
wp skouerr make:block
```

### Liste des commandes
Vous pouvez lister les commandes disponible

```bash
wp skouerr list
```

### Scripts de compilation
Une fois votre premier bloc créé, vous pourrez compiler et recharger vos fichiers. Le thème Skouerr, par défaut, intègre **Skouerr Script**.

Assurez-vous d’avoir la dernière version en lançant la commande suivante dans le répertoire du thème :


```bash
npm install  
npm update
```

Une fois les dépendances JavaScript du thème mises à jour et installées, pour lancer l’outil, utilisez la commande suivante :

```bash
npm run watch 
```

Le script devrait lancer la compilation automatique et vous devriez voir apparaitre le statut de la compilation en bas a droite de votre écran

## Setup traditionnal wordpress


Pour travailler avec un WordPress classique, procédez comme suit :

1. Téléchargez le plugin depuis [ce lien](#).

2. Installez-le dans le dossier **plugins** ou **mu-plugins**.

3. Suivez la documentation à partir de Création d'un thème dans Setup Bedrock


# Theme

Le thème Skouerr est un thème **Full Site Editing** et repose donc sur les normes définies par WordPress.

Le style atomique des composants du thème doit être défini dans le fichier **theme.json**.


## Loader

Pour gérer les blocs créés par la CLI, une classe **Skouerr_Loader** est définie dans **inc/core/loader**. Cette classe scanne les dossiers suivants pour charger dynamiquement les différents éléments :

- blocks/{name}/{name}.block.json
- templates/{name}.html
- patterns/{name}.php

## Render et Utilisation du Pattern MVC pour les Blocs

Pour définir une norme et améliorer la clarté du code, nous avons adopté le pattern MVC pour la gestion des blocs. De plus, Skouerr permet de gérer différents types de moteurs de template (PHP, Twig, React) de manière commune grâce à la classe **Skouerr_Block** .

### Fonctions Principales

- **set_data**

    ```php
    $skouerr_block->set_data('<DATA_KEY>', '<DATA_VALUE>');
    ```

    Cette fonction permet d’envoyer une valeur au moteur de template.

    La valeur peut être de n'importe quel type.

- **the_data**

    ```php
    $skouerr_block->the_data('<DATA_KEY>');
    ```

    Cette fonction permet d'**afficher** des données lorsque le moteur de template est PHP.

- **render**

    ```php
    $skouerr_block->render('php|twig|react');
    ```

    Cette fonction permet de choisir le moteur de rendu (PHP, Twig, ou React).


## Mise à jour du cœur du thème

Les fichiers de `inc/core/` (loader, rendu des blocs, outils de développement, setup) sont communs à tous les thèmes Skouerr. Leur version est notée dans `inc/core/skouerr-core.json`. Pour les mettre à jour :

```bash
wp skouerr update:core --format=patch   # voir les changements
wp skouerr update:core                  # appliquer
```

Un fichier modifié dans le projet n'est jamais écrasé sans `--force`. Le code propre au projet va dans `inc/` (filtres ci-dessous), pas dans `inc/core/`.

## Custom blocks
## Flexibilité et Extensions avec Skouerr

Une des forces de Skouerr est de permettre aux développeurs WordPress de répondre aux besoins spécifiques de leurs clients que les blocs Gutenberg de base ne peuvent pas satisfaire.

Nous avons donc choisi de continuer à utiliser le plugin **ACF** (Advanced Custom Fields), tout en conservant les fonctionnalités natives de Gutenberg.

*Pour créer des blocs avec Advanced Custom Fields, il est recommandé de souscrire à la licence ACF Pro.*

Nous mettons à disposition des blocs prêts à développer sous plusieurs formats :

- **Native - PHP**
- **Native - Twig**
- **ACF - PHP**
- **ACF - Twig**

Les blocs ne contiendront pas les mêmes fichiers, car un bloc ACF sera automatiquement enregistré par le plugin, tandis qu'un bloc natif doit charger le fichier **register.js**.

Les blocs ACF gèrent directement leurs champs personnalisés dans le dossier **/acf-json/**.

Ces blocs doivent être conçus de manière réutilisable entre les projets. Il est donc fortement recommandé de construire le style des blocs personnalisés à partir des variables CSS, ainsi que d'utiliser les classes communes de WordPress.

### Création de Blocs avec la CLI

La création d’un bloc avec la CLI nécessite plusieurs paramètres :

- Type (ACF ou Native)
- Template (PHP ou Twig)
- Title
- Name
- Dashicon

Les paramètres vous seront demandés tout au long du processus :

```bash
wp skouerr make:block
```

## Full Site Editing

Skouerr est un thème créé pour être entièrement compatible avec le Full Site Editing (FSE) de WordPress.

Ainsi, les compositions et templates seront gérés via l'éditeur de site. Par défaut, les compositions et templates sont enregistrés dans la base de données, ce qui signifie que les modifications ne sont pas versionnées.

Avec Skouerr, il est possible de synchroniser les templates et compositions grâce à la CLI. Pour ce faire, lancez la commande suivante et choisissez l’élément à versionner :


```bash
wp skouerr sync:template
```

```bash
wp skouerr sync:patterns
```

# CLI

Skouerr repose sur trois outils, dont une interface en ligne de commande. Cette ligne de commande permet de créer, gérer et manipuler votre thème WordPress.

Par défaut, nous utilisons **WP CLI**, mais nous y avons ajouté une couche supplémentaire avec **Symfony Console** pour améliorer l'interaction avec le développeur.

Voici la liste des commandes disponibles :

#### Liste des commandes
```bash
wp skouerr list 
``` 
#### Création d'un thème
```bash
wp skouerr make:theme
````

#### Création d'un bloc
```bash
wp skouerr make:block  
````

#### Liste des blocks
```bash
wp skouerr list:blocks  
```

#### Import d'un block distant
```bash
wp skouerr import:blocks  
````

#### Création d'un post-type
```bash
wp skouerr make:post-type  
````

#### Enregistrement local d'un template
```bash
wp skouerr save:template  
````

#### Création d'un fichier de template
```bash
wp skouerr make:template  
````

#### Enregistrement local d'une compositions
```bash
wp skouerr save:pattern
```

#### Création d'une variation

```bash
wp skouerr make:variation
```


# Scripts javascript

Un package npm permet à Skouerr de faire fonctionner un module de rechargement automatique. 

Pour l'ajouter à votre projet, utilisez la commande suivante :

```bash
npm install skouerr-scripts
```

Ensuite, vous pouvez l'utiliser comme une CLI en ajoutant son exécution dans votre fichier package.json. Voici les commandes disponibles :

```bash
skouerr-scripts watch 
````
```bash 
skouerr-scripts build
```

# Hooks

### Actions

```php 
skouerr_block_before_render($name,$type,$data)
```
**Paramètres :**
**name** : Nom du block
**type** : Type du block (php|twig|react)
**data** : Données du block

**Description :**
Cette action est déclenchée avant le rendu de tous les blocks.

```php
skouerr_block_before_render_{{name}}($type,$data)
```
**Prototype :**
**{{name}}** : Nom du block

**Paramètres :**
**string $type** : Type du block (php|twig|react)
**array $data** : Données du block

**Description :**
Cette action est déclenchée avant le rendu du block nommé **{{name}}**.

```php
skouerr_block_after_render($name,$type,$data)
```
**Paramètres :**
**name** : Nom du block
**type** : Type du block (php|twig|react)
**data** : Données du block

**Description :**
Cette action est déclenchée après le rendu de tous les blocks.

```php
skouerr_block_after_render_{{name}}($type,$data)
```
**Prototype :**
**{{name}}** : Nom du block

**Paramètres :**
**string $type** : Type du block (php|twig|react)
**array $data** : Données du block

**Description :**
Cette action est déclenchée après le rendu du block nommé **{{name}}**.

```php
skouerr_theme_setup_before()
```
**Description :**
Cette action est déclenchée avant le setup du thème (lors de l'exécution de la commande **wp skouerr-theme setup**).

```php
skouerr_theme_setup_after()
```
**Description :**
Cette action est déclenchée après le setup du thème (lors de l'exécution de la commande **wp skouerr-theme setup**).

### Filtres
```php
skouerr_after_sanitize_file_name($filename)
```
**Paramètres :**
**string $filename** : Nom du fichier
 
**Description :**
Ce filtre est déclenché après la sanitization du nom du fichier, ce qui vous permet de renommer le fichier comme bon vous semble.

```php
skouerr_block_get_data($data,$name,$key)
```
**Paramètres :**
**string $data** : Donnée du block
**string $name** : Nom du block
**string $key** : Clé de la donnée

**Description :**
Ce filtre est déclenché lors de la récupération des données d'un block, ce qui vous permet de manipuler les données avant de les retourner.

```php
skouerr_block_get_data_{{name}}($data,$key)
```
**Prototype :**
**{{name}}** : Nom du block
 
**Paramètres :**
**string $data** : Donnée du block
**string $key** : Clé de la donnée

**Description :**
Ce filtre est déclenché lors de la récupération des données du block nommé **{{name}}**, ce qui vous permet de manipuler les données avant de les retourner.

```php
skouerr_scripts_widget_display(true)
```
**Paramètres :**
**boolean $display** : Affichage du widget

**Description :**
Ce filtre est déclenché lors de la définition du paramètre d'affichage du widget, ce qui vous permet de contrôler l'affichage du widget ou non.

```php
skouerr_scripts_widget_settings($settings)
```
**Paramètres :**
**array $settings** : Les paramètres du widget

**Description :**
Ce filtre est déclenché lors de la définition des paramètres du widget, ce qui vous permet de contrôler les paramètres appliqués au widget.

```php
skouerr_scripts_widget_server_infos($server_infos)
```
**Paramètres :**
**array $server_infos** : Les informations du serveur

**Description :**
Ce filtre est déclenché lors de la définition des informations du serveur, ce qui vous permet de contrôler les informations du serveur qui seront affichées.

```php
skouerr_scripts_widget_page_infos($page_infos)
```
**Paramètres :**
**array $page_infos** : Les informations de la page

**Description :**
Ce filtre est déclenché lors de la définition des informations de la page, ce qui vous permet de contrôler les informations sur la page.

```php
skouerr_scripts_widget_active(true|false)
```
**Paramètres :**
**boolean** : **true** si l'environnement est en mode développement, **false** sinon

**Description :**
Ce filtre est déclenché lors de la définition de l'activation du widget, ce qui vous permet de contrôler l'activation du widget.

```php
skouerr_allowed_blocks($blocks, $editor_context)
```
**Paramètres :**
**array $blocks** : Noms des blocs du thème ajoutés aux blocs autorisés
**WP_Block_Editor_Context $editor_context** : Contexte de l'éditeur

**Description :**
Ce filtre permet de retirer ou d'ajouter des blocs du thème selon le contenu édité (par exemple réserver un bloc à la page d'accueil).

```php
skouerr_scripts_port(4100)
```
**Paramètres :**
**int** : Port du serveur `skouerr-scripts watch -p <port>`

**Description :**
Ce filtre définit le port du widget de rechargement en développement. À déclarer dans le thème si le port de `package.json` change.

```php
skouerr_setup_home_pattern($file)
```
**Paramètres :**
**string $file** : Fichier de pattern utilisé comme contenu de la page d'accueil par `wp skouerr-theme setup`

**Description :**
Ce filtre permet de choisir le contenu initial de la page d'accueil.
