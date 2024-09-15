# Documentation des outils proposé par Skouerr

## Introduction

Skouerr est un ensemble d'outils conçus pour améliorer l'expérience des développeurs lors de la création et du développement de thèmes WordPress.

### Contexte 
Skouerr a été créé suite à un constat au sein de l'agence de communication R2. L'utilisation de nombreux outils différents entre les projets s'est avérée non optimale, ce qui a conduit à la nécessité de développer une solution unifiée.

Après plusieurs phases d’itération, Skouerr a vu le jour pour répondre de manière optimale aux besoins des agences de communication qui développent des thèmes sur mesure pour leurs clients.

*Skouerr est issu du breton skouer, qui signifie modèle ou outil. Un nom bien trouvé pour une agence bretonne.*

Skouerr repose sur 3 outils : 

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

La boilerplate **roots/bedrock** permet de gérer WordPress, ses plugins et thèmes comme des dépendances PHP via un fichier `composer.json`, tout en révisant l'architecture des dossiers.

Pour créer un projet Bedrock, utilisez la commande suivante :

```bash
composer create-project roots/bedrock
````

Une fois Bedrock installé, pour travailler avec Skouerr, vous devrez ajouter les dépôts suivants dans le fichier composer.json :

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

Le thème sera activé par défaut \!

Pour commencer a créer vos premiers blocks lancer cette commande :

```bash
wp skouerr make:block
```

Vous pouvez lister les commandes disponible

```bash
wp skouerr list
```

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

2. Installez-le dans le dossier `plugins` ou `mu-plugins`.

3. Suivez la documentation à partir de [ce lien](#).


# Theme

Le thème Skouerr est un thème **Full Site Editing** et repose donc sur les normes définies par WordPress.

Le style atomique des composants du thème doit être défini dans le fichier `theme.json`.


## Loader

Pour gérer les blocs créés par la CLI, une classe `Skouerr_Loader` est définie dans `inc/core/loader`. Cette classe scanne les dossiers suivants pour charger dynamiquement les différents éléments :

- `blocks/*/*.block.json`
- `templates/*.html`
- `patterns/*.php`

## Render et Utilisation du Pattern MVC pour les Blocs

Pour définir une norme et améliorer la clarté du code, nous avons adopté le pattern MVC pour la gestion des blocs. De plus, Skouerr permet de gérer différents types de moteurs de template (PHP, Twig, React) de manière commune grâce à la classe `Skouerr_Block`.

### Fonctions Principales

- **`set_data`**

    ```php
    $skouerr_block->set_data('');
    ```

    Cette fonction permet d’envoyer une valeur au moteur de template.

- **`the_data`**

    ```php
    $skouerr_block->the_data('');
    ```

    Cette fonction permet de récupérer des données lorsque le moteur de template est PHP.

- **`render`**

    ```php
    $skouerr_block->render('php|twig|react');
    ```

    Cette fonction permet de choisir le moteur de rendu (PHP, Twig, ou React).


## Skouerr Mails


Skouerr améliore la gestion des mails en récupérant les valeurs définies dans le Full Site Editing. Il est possible de créer des templates personnalisés pour les mails en utilisant Twig.

Vous pouvez définir et revoir vos templates dans le dossier :
/mails/

Vous avez la possibilité de tester les mails avec ces deux commandes : 

#### Tester l'envoi des mails avec la template
```bash 
wp skouerr-theme mail --test
````

#### Afficher les variables disponible dans twig dans un mail
```bash
wp skouerr-theme mail --dump
```

Par défaut, la template par défaut va être utiliser pour **tous** les mails envoyé par wordpress

Vous pouvez intéragir l'utilisation de ces mails avec ces filtres : 
- skouerr_mail_use_template (boolean)
- skouerr_mail_template (string)

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

Les blocs ne contiendront pas les mêmes fichiers, car un bloc ACF sera automatiquement enregistré par le plugin, tandis qu'un bloc natif doit charger le fichier `register.js`.

Les blocs ACF gèrent directement leurs champs personnalisés dans le dossier `/acf/`.

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

#### Import d'un block distant (todo)
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
```php
skouerr_block_before_render_{{name}}($name,$type,$data)
````
```php
skouerr_block_after_render($name,$type,$data)
```
```php
skouerr_block_after_render_{{name}}($name,$type,$data)
```
```php
skouerr_theme_setup_before()
```
```php
skouerr_theme_setup_after()
```

### Filtres
```php
skouerr_after_sanitize_file_name($filename)
```
```php
skouerr_block_get_data($name,$key)
```

```php
skouerr_block_get_data_{{name}}($data,$key)
```

```php
skouerr_scripts_widget_display(true)
```

```php
skouerr_scripts_widget_settings($settings)
```

```php
skouerr_scripts_widget_server_infos($server_infos)
```

```php
skouerr_scripts_widget_page_infos($page_infos)
```
```php
skouerr_scripts_widget_active(true|false)
```

```php
skouerr_mail_template(string)
```

```php
skouerr_mail_use_template(boolean)
```

